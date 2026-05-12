<footer>
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-4">
				<div class="empresa2">
					<h4>Idiomas Nórdicos</h4>
					<ul>
						<li><a href="#">Curso de Sueco Online</a></li>
						<li><a href="#">Curso de Finés Online</a></li>
						<li><a href="#">Curso de Noruego Online</a></li>
						<li><a href="#">Curso de Danés Online</a></li>
						<li><a href="#">Curso de Islandés Online</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="datos">
					<h4>ENCUENTRÁNOS</h4>
					<ul>
						<li><a class="ubi" target="_blank" href="#">Av. Arenales 2160 ofc. 7 distrito de Lince.</a></li>
						<li><a class="wsp" target="_blank" href="#">942 086 741</a></li>
						<li><a class="msj" target="_blank" href="#">contacto@finlandinstitute.com</a></li>
						<li><a class="ruc" href="#" target="_blank">RUC:20605288309 RAZON: INSTITUTO CULTURAL NORDICO PERUANO FINLANDES- FINLAND</a></li>
					</ul>
				</div>
			</div>

			<div class="col-md-4">
				<div class="empresa2">
					<h4>UBÍCANOS</h4>
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.3757764096013!2d-77.03807112500269!3d-12.08640704263993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c85f8fe0dd81%3A0xb5816f33083078f7!2sFinland%20Institute%20-%20Instituto%20Cultural%20N%C3%B3rdico%20Peruano%20Finland%C3%A9s!5e0!3m2!1ses!2spe!4v1777604951199!5m2!1ses!2spe" width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>

		</div>
	</div>
</footer>

<section class="footer-bottom">
	<div class="container">
		<div class="row">
			<div class="col-dm-12">
				<p>
					<a href="<?= env('ADMIN_SITE') ?>" target="_blank">
						<i class="fa-solid fa-cog"></i></a>
					Copyright © 2026 INSTITUTO CULTURAL NORDICO PERUANO FINLANDES</a>
				</p>
			</div>
		</div>
	</div>
</section>

<div class="carga" style=" display:none;opacity: 1;pointer-events: auto;position: fixed;top: 0;bottom: 0;left: 0;right: 0;text-align: center;font-size: 0;overflow-y: scroll;background-color: rgba(0,0,0,.4);z-index: 10000;transition: opacity .3s;">
	<div class="gif">
		<img src="<?= base_url() ?>template/images/loader.svg" style="margin-top: 20%;width: 5%;">
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url(); ?>template/js/bootstrap.min.js"></script>
<script src="<?= base_url(); ?>template/js/jquery.validate.js"></script>
<script src="<?= base_url(); ?>template/js/owl.carousel.js"></script>
<script src="<?= base_url(); ?>template/js/carrusel.js"></script>
<script src="<?= base_url(); ?>template/js/all.min.js"></script>
<script src="<?= base_url(); ?>template/js/fontawesome.min.js"></script>
<script src="<?= base_url(); ?>template/js/aos.js"></script>
<script src="<?= base_url(); ?>template/js/lightbox-plus-jquery.min.js"></script>

</body>

</html>

<script>
	function removerClases() {
		// Ocultar y limpiar textos
		document.querySelectorAll('.validacion, .validaclass, .validaform').forEach(el => {
			el.style.display = 'none';
			el.innerHTML = '';
		});

		// Remover clase is-invalid de inputs, selects y textareas
		document.querySelectorAll('select, textarea, input').forEach(el => {
			el.classList.remove('is-invalid');
		});

		// Ocultar el elemento con clase carga
		const carga = document.querySelector('.carga');
		if (carga) carga.style.display = 'none';
	}

	function showErrores(errors) {
		errors.forEach(item => {
			const input = document.getElementById(item.campo);
			if (input) input.classList.add('is-invalid');

			const errorElems = document.querySelectorAll('.' + item.campo);
			errorElems.forEach(el => {
				el.classList.add('invalid-feedback');
				el.style.display = 'inline';
				el.innerHTML = item.valor;
			});

		});

		const carga = document.querySelector('.carga');
		if (carga) carga.style.display = 'none';
	}
</script>