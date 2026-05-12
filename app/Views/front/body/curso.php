<section class="bg_menu_page" style="background-image: url(<?= base_url(); ?>archivos/curso/<?= $curso->urlbanner ?>);background-size: cover;width: 100%;height: 200px;display: table;background-repeat: no-repeat;background-position: right center;">
	<div class="inner_subpage_banner">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="text-banner">
						<h1>Idiomas Nórdicos</h1>
						<p><a href="<?= base_url(); ?>">Inicio</a> <span>></span> <?= $curso->nombre ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="cursos-int">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">

				<h2><?= $curso->nombre ?></h2>
				<img src="<?= base_url(); ?>archivos/curso/<?= $curso->urlbanner2 ?>">

				<p><?= $curso->resumen ?></p>

			</div>

			<?= $curso->contenido ?>

		</div>
	</div>
</section>