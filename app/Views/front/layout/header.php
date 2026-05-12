<!DOCTYPE HTML>
<html lang="es">

<head>
	<!--Title-->
	<title><?= ((isset($titulo)) ? $titulo : ((isset($tituloGeneral)) ? $tituloGeneral : 'FINLAND INSTITUTE | Instituto Cultural Nórdico Peruano Finlandés')) ?></title>
	<meta name="description" content="<?= ((isset($descripcion)) ? strip_tags($descripcion) : ((isset($descripcionGeneral)) ? $descripcionGeneral : '')) ?>">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<!--description-->
	<meta property="og:title" content="<?= ((isset($titulo)) ? $titulo : ((isset($tituloGeneral)) ? $tituloGeneral : 'FINLAND INSTITUTE | Instituto Cultural Nórdico Peruano Finlandés')) ?>" />
	<meta property="og:description" content="<?= ((isset($descripcion)) ? $descripcion : ((isset($descripcionGeneral)) ? $descripcionGeneral : '')) ?>" />
	<meta property="og:url" content="<?= base_url() ?><?= ((isset($url)) ? $url : '') ?>" />
	<!--Key Words-->
	<meta name="keywords" content="<?= ((isset($keywords)) ? $keywords : ((isset($keywordsGeneral)) ? $keywordsGeneral : '')) ?>">


	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

	<!--bootstrap-->
	<script src="<?= base_url(); ?>template/js/jquery-3.3.1.min.js"></script>
	<link rel="stylesheet" href="<?= base_url(); ?>template/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>template/css/all.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>template/css/fontawesome.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>template/css/lightbox.min.css">
	<link rel="stylesheet" href="<?= base_url(); ?>template/css/owl.carousel.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>template/css/owl.theme.default.min.css" />
	<link rel="stylesheet" href="<?= base_url(); ?>template/css/style.css">
	<link rel="stylesheet" href="<?= base_url(); ?>template/paginator/paginator.css">
	<link rel="stylesheet" href="<?= base_url(); ?>template/css/responsive.css">
	<link rel="shortcut icon" href="<?= base_url(); ?>template/images/favicon.png">
	<link rel="stylesheet" href="<?= base_url(); ?>/template/css/aos.css">
	<script src="<?= base_url(); ?>template/js/owl.carousel.js"></script>

	<script src="<?= base_url(); ?>template/paginator/paginator.js"></script>
	<script>
		const BASE_URL = "<?= base_url() ?>";
	</script>

	<!-- GetButton.io widget -->
	<script type="text/javascript">
		(function() {
			var options = {
				facebook: "", // Facebook page ID
				whatsapp: "+51942086741", // WhatsApp number
				call_to_action: "Escríbenos", // Call to action
				button_color: "#2e3090", // Color of button
				position: "right", // Position may be 'right' or 'left'
				order: "whatsapp,facebook", // Order of buttons
				pre_filled_message: "Hola, solicito más información", // WhatsApp pre-filled message
			};
			var proto = 'https:',
				host = "getbutton.io",
				url = proto + '//static.' + host;
			var s = document.createElement('script');
			s.type = 'text/javascript';
			s.async = true;
			s.src = url + '/widget-send-button/js/init.js';
			s.onload = function() {
				WhWidgetSendButton.init(host, proto, options);
			};
			var x = document.getElementsByTagName('script')[0];
			x.parentNode.insertBefore(s, x);
		})();
	</script>
	<!-- /GetButton.io widget -->

</head>

<body>

	<div class="top-header">
		<div class="container-fluid">
			<div class="row">

				<div class="col-md-9">
					<div class="d-flex">
						<p><a href="#" target="_blank"><i class="fa-solid fa-envelope"></i> contacto@finlandinstitute.com</a></p>
						<p><a href="#" target="_blank"><i class="fa-brands fa-whatsapp"></i> 942 086 741</a></p>
						<p><a href="#" target="_blank"><i class="fa-solid fa-map-marker-alt"></i> Av. Arenales 2160 Of. 7</a></p>
					</div>
				</div>

				<div class="col-md-3">
					<div class="redes">
						<li><a href="https://www.facebook.com/finlandinstituteperu/" target="_blank"><i class="fa-brands fa-facebook-f"></i></a></li>
						<li><a href="https://www.instagram.com/institutoculturalnordico" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
						<li><a href="https://www.youtube.com/channel/UCpzDvUZGnKffIkHgXqw7JzQ?view_as=subscriber" target="_blank"><i class="fa-brands fa-youtube"></i></a></li>
					</div>
				</div>

			</div>
		</div>
	</div>

	<nav class="navbar navbar-expand-lg bg-body-tertiary menuweb">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?= base_url(); ?>"><img src="<?= base_url(); ?>template/images/logo-finland.png" alt=""></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav mx-auto menubar">
					<li class="nav-item">
						<a class="nav-link <?= ($seccion == 'inicio') ? 'active' : ''; ?>" aria-current="page" href="<?= base_url(); ?>">Inicio</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= ($seccion == 'nosotros') ? 'active' : ''; ?>" aria-current="page" href="<?= base_url(); ?>nosotros">Nosotros</a>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link <?= ($seccion == 'cursos') ? 'active' : ''; ?>" aria-current="page" href="#">Idiomas Nórdicos</a>
						<ul class="dropdown-menu">
							<? foreach ($cursos as $curso): ?>
								<li><a href="<?= base_url(); ?>curso-online/<?= $curso->urlamigable ?>"><?= $curso->nombre ?></a></li>
							<? endforeach; ?>
							<!-- <li><a href="<?= base_url(); ?>curso-de-noruego-online">Curso de Noruego Online</a></li>
							<li><a href="<?= base_url(); ?>curso-de-fines-online">Curso de Finés Online</a></li>
							<li><a href="<?= base_url(); ?>curso-de-danes-online">Curso de Danés Online</a></li> -->
						</ul>
					</li>
					<li class="nav-item dropdown">
						<a class="nav-link <?= ($seccion == 'paises') ? 'active' : ''; ?>" aria-current="page" href="#">Países Nórdicos</a>
						<ul class="dropdown-menu">
							<li><a href="<?= base_url(); ?>paises-nordicos/finlandia/">Finlandia</a></li>
							<li><a href="<?= base_url(); ?>paises-nordicos/suecia/">Suecia</a></li>
							<li><a href="<?= base_url(); ?>paises-nordicos/noruega/">Noruega</a></li>
							<li><a href="<?= base_url(); ?>paises-nordicos/dinamarca/">Dinamarca</a></li>
							<li><a href="<?= base_url(); ?>paises-nordicos/islandia/">Islandia</a></li>
						</ul>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= ($seccion == 'galeria') ? 'active' : ''; ?>" aria-current="page" href="<?= base_url(); ?>galeria">Galería</a>
					</li>
					<li class="nav-item">
						<a class="nav-link <?= ($seccion == 'contacto') ? 'active' : ''; ?>" aria-current="page" href="<?= base_url(); ?>contacto">Contacto</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>