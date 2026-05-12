
<section class="slider-home">
	<div class="owl-carousel2 owl-theme">
		<? if ($sliders):
			foreach ($sliders as $slider): ?>
				<? if ($slider->idprecurso != 581): ?>
					<div class="item">
						<a href="<?= $slider->urlrecurso ?>">
							<img src="<?= base_url(); ?>archivos/slider/<?= $slider->urlimagen1 ?>" alt="">
						</a>
					</div>

				<? else: ?>
					<a href="<?= $slider->urlrecurso ?>">
						<video autoplay loop muted playsinline>
							<source src="<?= base_url(); ?>archivos/slider/<?= $slider->urlimagen1 ?>" type="video/mp4" />
						</video>
					</a>
				<? endif; ?>

		<? endforeach;
		endif; ?>
	</div>

	<div class="owl-carousel3 owl-theme">
		<? if ($sliders):
			foreach ($sliders as $slider): ?>
				<? if ($slider->idprecurso != 581): ?>
					<div class="item">
						<a href="<?= $slider->urlrecurso ?>">
							<img src="<?= base_url(); ?>archivos/slider/<?= $slider->urlimagen2 ?>" alt="">
						</a>
					</div>

				<? else: ?>
					<div class="item">
						<a href="<?= $slider->urlrecurso ?>">
							<video autoplay loop muted playsinline>
								<source src="<?= base_url(); ?>archivos/slider/<?= $slider->urlimagen2 ?>" type="video/mp4" />
							</video>
						</a>
					</div>
				<? endif; ?>

		<? endforeach;
		endif; ?>
	</div>
</section>
<section class="nosotros-home">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="ed-header layout-2">
					<span class="ed-badge">Explore</span>
					<h2 class="section-header">Bienvenidos al Instituto Cultural Nórdico Peruano Finlandés.</h2>
					<p>Hola! Promovemos el conocimiento de los idiomas nórdicos. Aprende un idioma para situaciones cotidianas. Ofrecemos cursos de idiomas nórdicos que son interactivos, comunicativos y asequibles. Ingrese al aula virtual del Instituto Cultural Nórdico Peruano Finlandés, (I.C.N.P.F.) donde aprenderá de un tutor calificado. Se cubren las cuatro áreas de habilidades, hablar, escuchar, escribir y leer para situaciones cotidianas. Nuestras clases están abiertas al público en general y no tienen requisitos previos ni pruebas de nivel. Simplemente inscríbase en línea y reciba su enlace del curso vía nuestra plataforma Zoom.</p>
					<a href="#">Más información</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="aprender">
	<div class="container">
		<div class="row">

			<div class="col-md-9">
				<div class="accordion" id="accordionExample">
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
								Aprendiendo idiomas nórdicos Vía Zoom
							</button>
						</h2>
						<div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<div class="d-flex">
									<div class="box-texto">
										<p>Todos los cursos de idiomas de nórdicos utilizan actualmente el software de videoconferencia Zoom. Ingrese a una de las aulas virtuales, donde aprenderá de tutores calificados. No hay requisitos de ingreso, simplemente puede inscribirse en línea. Aunque la oficina del I.C.N.P.F., está cerrada hasta nuevo aviso, se puede contactar fácilmente durante el horario laboral por correo electrónico. ¡Esperamos verlos muy pronto!</p>
									</div>
									<div class="box-img">
										<img src="<?= base_url(); ?>template/images/logo-zoom.png">
										<img src="<?= base_url(); ?>template/images/fines-espanol.jpg">
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion-item">
						<h2 class="accordion-header">
							<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
								Anuncio
							</button>
						</h2>
						<div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
							<div class="accordion-body">
								<p>Traductora e intérprete</p>
								<p><strong>Finés – Español</strong></p>
								<img style="width: 500px;" src="<?= base_url(); ?>template/images/fines-espanol.jpg">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-md-3">
				<img src="<?= base_url(); ?>template/images/aprendiendo.png">
			</div>

		</div>
	</div>
</section>

<section class="ayuda-home">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="ed-header layout-2">
					<h2 class="section-header">¿Necesitas alguna ayuda?</h2>
					<p>Comunícate con nosotros por nuestros distintos canales selecciona alguna de nuestras opciones.</p>
				</div>
				<div class="btns-ayuda">
					<a href="#" class="con">Contáctanos</a>
					<a href="#" class="wsp">Whatsapp</a>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="cursos-home">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="ed-header layout-2">
					<span class="ed-badge">Explore</span>
					<h2 class="section-header">Nuestros cursos</h2>
					<p>Te damos la bienvenida a los cursos online en Aula Virtual, también disponemos de cursos presenciales, clases particulares online</p>
				</div>

				<div class="owl-carousel4 owl-theme">
					<div class="item">
						<div class="img">
							<a href="#"><img src="<?= base_url(); ?>template/images/bandera-noruega.png"></a>
						</div>
						<div class="texto">
							<h4>Curso de Noruego Online</h4>
							<p>Ofrecemos cursos de idioma noruego que son interactivos, comunicativos y asequibles. Todas las lecciones de idioma noruego</p>
							<a href="#">Ver más</a>
						</div>
					</div>
					<div class="item">
						<div class="img">
							<a href="#"><img src="<?= base_url(); ?>template/images/bandera-finlandia.png"></a>
						</div>
						<div class="texto">
							<h4>Curso de Fines Online</h4>
							<p>Te damos la Bienvenida! Ofrecemos cursos de idioma fines, que son interactivos, comunicativos y asequibles. Todas las lecciones</p>
							<a href="#">Ver más</a>
						</div>
					</div>
					<div class="item">
						<div class="img">
							<a href="#"><img src="<?= base_url(); ?>template/images/bandera-suecia.png"></a>
						</div>
						<div class="texto">
							<h4>Curso de Sueco Online</h4>
							<p>Ofrecemos cursos de idioma sueco que son interactivos, comunicativos y asequibles. Todas las lecciones de idioma sueco </p>
							<a href="#">Ver más</a>
						</div>
					</div>
				</div>

			</div>
		</div>

	</div>
</section>

<section class="institucion-home">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="ed-header layout-2">
					<span class="ed-badge">Explore</span>
					<h2 class="section-header">NUESTRA INSTITUCIÓN</h2>
					<p>Descubre por ti mismo, nuestra vida institucional.</p>
				</div>

				<div class="contador">
					<div class="box">
						<i class="fa-solid fa-book"></i>
						<span class="numero" data-target="4">0</span>
						<p>Cursos</p>
					</div>

					<div class="box">
						<i class="fa-solid fa-sitemap"></i>
						<span class="numero" data-target="1">0</span>
						<p>Instalaciones</p>
					</div>

					<div class="box">
						<i class="fa-solid fa-user"></i>
						<span class="numero" data-target="4">0</span>
						<p>PROFESORES</p>
					</div>

					<div class="box">
						<i class="fa-solid fa-users"></i>
						<span class="numero" data-target="150">0</span>
						<p>ESTUDIANTES</p>
					</div>

				</div>

			</div>
		</div>
	</div>
</section>

<script>
	const counters = document.querySelectorAll('.numero');

	counters.forEach(counter => {
		const target = +counter.getAttribute('data-target');

		const duration = 2000; // duración total (ms)
		const startTime = performance.now();

		function updateCounter(currentTime) {
			const elapsed = currentTime - startTime;
			let progress = elapsed / duration;

			if (progress > 1) progress = 1;

			// 🔥 efecto: empieza lento y termina rápido
			const easeIn = Math.pow(progress, 3);

			const value = Math.floor(easeIn * target);
			counter.innerText = value;

			if (progress < 1) {
				requestAnimationFrame(updateCounter);
			} else {
				counter.innerText = target;
			}
		}

		requestAnimationFrame(updateCounter);
	});
</script>