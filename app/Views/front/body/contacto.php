<section class="bg_menu_page" style="background-image: url(<?= base_url(); ?>template/images/fondo-bg.jpg);background-size: cover;width: 100%;height: 200px;display: table;background-repeat: no-repeat;background-position: right center;">
	<div class="inner_subpage_banner">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="text-banner">
						<h1>Galería</h1>
						<p><a href="<?= base_url(); ?>">Inicio</a> <span>></span> Galería</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="contactenos">
	<div class="container-fluid">
		<div class="row">

			<div class="col-md-12">
				<h2>Contacto</h2>

				<div class="bloque-contacto">
					<div class="box1">
						<h4>Dirección</h4>
						<a href="#"><i class="fa-solid fa-location-dot"></i> Av. Arenales 2160 ofc. 7 distrito de Lince.</a>
					</div>
					<div class="box1">
						<h4>Whatsapp</h4>
						<a href="https//wa.me/51942086741" target="_blank"><i class="fa-brands fa-whatsapp"></i> +51 942 086 741</a>
					</div>
					<div class="box1">
						<h4>Correo</h4>
						<a href="mailto:contacto@finlandinstitute.com" target="_blank"><i class="fa-solid fa-envelope"></i> contacto@finlandinstitute.com</a>
					</div>
				</div>

				<div class="d-flex">

					<form class="form-contacto" id="formContacto">
						<h4>Escríbenos</h4>
						<div class="row">

							<div class="col-md-6">
								<div class="form-group">
									<input class="form-control" name="nombres" id="nombres" placeholder="Nombres y apellidos *" type="text">
									<span class="validacion nombres"></span>
								</div>
							</div>

							<div class="col-md-6">
								<div class="form-group">
									<input class="form-control" id="correo" name="correo" placeholder="Correo electrónico *" type="text">
									<span class="validacion correo"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input class="form-control" id="telefono" name="telefono" placeholder="Teléfono *" type="text">
									<span class="validacion telefono"></span>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<input class="form-control" id="asunto" name="asunto" placeholder="Asunto" type="text">
									<span class="validacion asunto"></span>
								</div>
							</div>

							<div class="col-md-12">
								<div class="form-group">
									<textarea class="form-control" name="mensaje" id="mensaje" placeholder="Mensaje" cols="30" rows="4"></textarea>
									<span class="validacion mensaje"></span>
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<img class="captcha-imagen" src="<?= base_url() ?>captcha" alt="CAPTCHA">
									<button type="button" id="refres" class="refresh-captcha">
										<i class="fa-solid fa-refresh"></i>
									</button>
									<input class="form-control" type="text" name="captcha" id="captcha" placeholder="Complete el captcha" pattern="[A-Za-z]{6}">
									<span style="color:red;" class="validacion captcha"></span>
								</div>
							</div>

							<div class="col-md-12">
								<button type="submit" class="enviar-servicios">Enviar <i class="fa fa-paper-plane"></i></button>
							</div>

						</div>
					</form>

					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3901.3757764096013!2d-77.03807112500269!3d-12.08640704263993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9105c85f8fe0dd81%3A0xb5816f33083078f7!2sFinland%20Institute%20-%20Instituto%20Cultural%20N%C3%B3rdico%20Peruano%20Finland%C3%A9s!5e0!3m2!1ses!2spe!4v1777604951199!5m2!1ses!2spe" width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>

				</div>

			</div>

		</div>
	</div>
</section>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
	$(document).ready(function() {
		document.querySelector(".captcha-imagen").src = `${BASE_URL}captcha?` + Date.now();
	});

	let refreshButton = document.querySelector(".refresh-captcha");
	refreshButton.onclick = function() {
		document.querySelector(".captcha-imagen").src = `${BASE_URL}captcha?` + Date.now();
	}
</script>
<script>
	document.addEventListener("DOMContentLoaded", function() {
		const form = document.getElementById("formContacto");
		const loader = document.querySelector(".carga");

		if (form) {
			form.addEventListener("submit", function(e) {
				e.preventDefault();

				// Scroll suave al formulario
				form.scrollIntoView({
					behavior: "smooth"
				});

				if (loader) loader.style.display = "block";

				fetch(`${BASE_URL}api/FormularioController/mailContacto`, {
						method: "POST",
						body: new FormData(form),
					})
					.then(response => response.json())
					.then(res => {
						removerClases();

						if (res.status === 'exito') {
							Swal.fire({
								title: 'Contáctenos!',
								text: 'Sus datos se han registrado exitosamente. Pronto nos pondremos en contacto con usted',
								icon: 'success',
								confirmButtonText: 'Aceptar'
							}).then(() => {
								location.reload();
							});
						} else {
							showErrores(res.errors);
						}

						if (loader) loader.style.display = "none";
					})
					.catch(err => {
						removerClases();

						if (loader) loader.style.display = "none";

						Swal.fire({
							title: 'Contáctenos!',
							text: 'Errores encontrados. Verifique y complete la información requerida',
							icon: 'warning',
							confirmButtonText: 'Continuar'
						}).then(() => {
							location.reload();
						});
					});
			});
		}
	});
</script>