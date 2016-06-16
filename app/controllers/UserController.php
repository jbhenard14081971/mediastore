<?php
namespace app\controllers;

use app\helper\Redirect;
use app\models\User;
use app\helper\Auth;
use app\helper\Link;

class UserController extends BaseController
{
    public function login() {
        if(isset($_POST['login']) && isset($_POST['password'])) {
            if(Auth::auth($_POST['login'], $_POST['password'])) {
                Redirect::url('ArticlesController@nouveautes');
            }
            Auth::setFlash("Identifiant ou mot de passe incorrect", "error");
        }
        echo $this->render('user/login.php');
    }

    public function logout() {
        session_destroy();
        Redirect::url('UserController@login');
    }

    public function register() {
        if(isset($_POST['login']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['password']) && isset($_POST['email']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['tel'])) {
            if(Auth::register($_POST['login'],$_POST['nom'],$_POST['prenom'],$_POST['password'],$_POST['email'],$_POST['adresse'],$_POST['cp'],$_POST['tel'])) {
                if(Auth::auth($_POST['login'], $_POST['password'])) {
                    Redirect::url('ArticlesController@nouveautes');
                }
            }else{
                Auth::setFlash("Une erreur est survenue, veuillez réessayer ultérieurement", "error");
            }
        }
        echo $this->render('user/register.php');
    }

    public function profile() {
        if(isset($_POST['login']) && isset($_POST['prenom']) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['adresse']) && isset($_POST['cp']) && isset($_POST['tel'])) {
            if(Auth::editUser(Auth::getUser()->id, $_POST['login'],$_POST['nom'],$_POST['prenom'],$_POST['email'],$_POST['adresse'],$_POST['cp'],$_POST['tel'],Auth::isAdmin())) {
                Redirect::url('ArticlesController@nouveautes');
            }else{
                Auth::setFlash("Une erreur est survenue, veuillez réessayer ultérieurement", "error");
            }
        }
        $user = User::where('id', '=', Auth::getUser()->id)->first();

        echo $this->render('user/profile.php', compact('user'));
    }
}
