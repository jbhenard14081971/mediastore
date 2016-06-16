<div class="ui vertical stripe segment">
	<h1>Liste des articles</h1>
	<div class="ui three stackable cards container">
		<a href="<?= \app\helper\Link::url('AdminController@addArticle')?>" style="float:right" class="positive ui button floated right">Ajouter</a>
		<table class="ui selectable inverted table">
			<thead>
				<tr>
					<th>Titre</th>
					<th>Description</th>
					<th>Type</th>
					<th>Prix</th>
					<th>Éditeur</th>
					<th>Date d'ajout</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($articles as $article): ?>

					<tr>
						<td><?= $article->nom ?></td>
						<td style="overflow: hidden;text-overflow: ellipsis;max-width: 370px;white-space: nowrap;"><?= $article->description ?></td>
						<td><?= $article->type->name ?></td>
						<td><?= $article->prix ?></td>
						<td><?= $article->editeur ?></td>
						<td><?= $article->created_at->diffForHumans() ?></td>
						<td>
							<div class="ui icon top left pointing dropdown button">
								<i class="wrench icon"></i>
								<div class="menu">
									<div class="item"><a href="<?= \app\helper\Link::url('AdminController@editArticle', ['id' => $article->id])?>" class="ui blue button"><i class="edit icon"></i> Éditer</a></div>
									<div class="item"><a href="<?= \app\helper\Link::url('AdminController@deleteArticle', ['id' => $article->id])?>" class="ui red button"><i class="trash icon"></i> Supprimer</a></div>
								</div>
							</div>
						</td>
					</tr>

				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<script>$('.dropdown').dropdown();</script>