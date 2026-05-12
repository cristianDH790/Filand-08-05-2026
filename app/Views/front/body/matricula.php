<section class="bg_menu_page" style="background-image: url(<?= base_url(); ?>template/images/fondo-bg.jpg);background-size: cover;width: 100%;height: 200px;display: table;background-repeat: no-repeat;background-position: right center;">
    <div class="inner_subpage_banner">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="text-banner">
                        <h1>Matricula</h1>
                        <p><a href="<?= base_url(); ?>">Inicio</a> <span>></span> Matricula</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="contactenos matricula-int">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h2>Formulario de matricula</h2>

                <form class="form-contacto form-matricula" id="formMatricula">
                    <h4>Datos de matricula</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group form-check-group">
                                <label class="form-label">Idiomas de interes *</label>
                                <div class="checkbox-list">
                                    <label><input type="checkbox" name="languages[]" value="Fines"> Fin&eacute;s</label>
                                    <label><input type="checkbox" name="languages[]" value="Noruego"> Noruego</label>
                                    <label><input type="checkbox" name="languages[]" value="Sueco"> Sueco</label>
                                    <label><input type="checkbox" name="languages[]" value="Danes"> Dan&eacute;s</label>
                                </div>
                                <span class="validacion languages"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="prospects[names]" id="prospects_names" placeholder="Nombres *" type="text">
                                <span class="validacion prospects_names"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="prospects[firstlastename]" id="prospects_firstlastename" placeholder="Apellido paterno *" type="text">
                                <span class="validacion prospects_firstlastename"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="prospects[secondlastename]" id="prospects_secondlastename" placeholder="Apellido materno *" type="text">
                                <span class="validacion prospects_secondlastename"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="prospects[documentnumber]" id="prospects_documentnumber" placeholder="DNI/Pasaporte *" type="number">
                                <span class="validacion prospects_documentnumber"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="prospects[telephone]" id="prospects_telephone" placeholder="Telefono" type="number">
                                <span class="validacion prospects_telephone"></span>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <input class="form-control" name="prospects[email]" id="prospects_email" placeholder="Correo electronico *" type="email">
                                <span class="validacion prospects_email"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <select class="form-control" name="prospects[levellanguages]" id="prospects_levellanguages">
                                    <option value="">Nivel de idioma actual</option>
                                    <option value="Alto">Alto</option>
                                    <option value="Medio">Medio</option>
                                    <option value="Bajo">Bajo</option>
                                    <option value="Ninguno">Ninguno</option>
                                </select>
                                <span class="validacion prospects_levellanguages"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-check-group">
                                <label class="form-label">Interes por el idioma</label>
                                <div class="checkbox-list">
                                    <label><input type="checkbox" name="interest[]" value="Familiar"> Familiar</label>
                                    <label><input type="checkbox" name="interest[]" value="Trabajo"> Trabajo</label>
                                    <label><input type="checkbox" name="interest[]" value="Otro"> Otro</label>
                                </div>
                                <span class="validacion interest"></span>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group form-check-group">
                                <label class="form-label">&iquest;Como encontro nuestro centro?</label>
                                <div class="checkbox-list">
                                    <label><input type="checkbox" name="branding[]" value="Internet"> Internet</label>
                                    <label><input type="checkbox" name="branding[]" value="Amigos/Familiares"> Amigos/Familiares</label>
                                    <label><input type="checkbox" name="branding[]" value="Redes Sociales"> Redes Sociales</label>
                                    <label><input type="checkbox" name="branding[]" value="Otros"> Otros</label>
                                </div>
                                <span class="validacion branding"></span>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group form-check-group">
                                <label class="policy-check">
                                    <input type="checkbox" name="policy" id="policy" value="1">
                                    Acepto las <a href="#" data-bs-toggle="modal" data-bs-target="#modalPoliticas">politicas y privacidad</a> *
                                </label>
                                <span class="validacion policy"></span>
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
            </div>
        </div>
    </div>
</section>

<div class="modal fade" id="modalPoliticas" tabindex="-1" aria-labelledby="modalPoliticasLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPoliticasLabel">Politicas y privacidad</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <p>Autorizo al Instituto Cultural Nordico Peruano Finlandes a utilizar mis datos para gestionar mi solicitud de matricula y contactarme sobre informacion academica relacionada.</p>
            </div>
        </div>
    </div>
</div>

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
        const form = document.getElementById("formMatricula");
        const loader = document.querySelector(".carga");

        if (form) {
            form.addEventListener("submit", function(e) {
                e.preventDefault();

                form.scrollIntoView({
                    behavior: "smooth"
                });

                if (loader) loader.style.display = "block";

                fetch(`${BASE_URL}api/FormularioController/mailMatricula`, {
                        method: "POST",
                        body: new FormData(form),
                    })
                    .then(response => response.json())
                    .then(res => {
                        removerClases();

                        if (res.status === 'exito') {
                            Swal.fire({
                                title: 'Matricula',
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
                            title: 'Matricula',
                            text: 'Errores encontrados. Verifique y complete la informacion requerida',
                            icon: 'warning',
                            confirmButtonText: 'Continuar'
                        });
                    });
            });
        }
    });
</script>
