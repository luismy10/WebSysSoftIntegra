<?php
session_start();

if (!isset($_SESSION['IdEmpleado'])) {
    echo '<script>location.href = "login.php";</script>';
} else {
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <?php include './layout/head.php'; ?>
    </head>

    <body class="app sidebar-mini">
        <!-- Navbar-->
        <?php include "./layout/header.php"; ?>
        <!-- Sidebar menu-->
        <?php include "./layout/menu.php"; ?>
        <main class="app-content">

            <div class="app-title">
                <div>
                    <h1>Configurar mi Empresa
                    </h1>

                </div>
            </div>
            <div class="tile mb-4">

                <div class="overlay d-none" id="divOverlayEmpresa">
                    <div class="m-loader mr-4">
                        <svg class="m-circular" viewBox="25 25 50 50">
                            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                        </svg>
                    </div>
                    <h4 class="l-text" id="lblTextOverlayEmpresa">Cargando información...</h4>
                </div>

                <div class="tile-body">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-text"> R.U.C: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                    <div class="form-group">
                                        <input id="txtNumDocumento" class="form-control" type="text" placeholder="R.U.C.">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-text"> Razón Social: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                    <div class="form-group">
                                        <input id="txtRazonSocial" class="form-control" type="text" placeholder="Razón Social" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-text">Nombre Comercial: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                                    <div class="form-group">
                                        <input id="txtNomComercial" class="form-control" type="text" placeholder="Nombre Comercial">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12 text-center p-3">
                                    <img src="./images/noimage.jpg" style="object-fit: cover;" width="160" height="160" id="lblImagen">
                                </div>
                                <div class="col-md-12 text-center">
                                    <input type="file" id="fileImage" accept="image/png, image/jpeg, image/gif, image/svg" style="display: none" />
                                    <label class="btn btn-warning" for="fileImage" id="txtFile"><i class="fa fa-photo"></i> Subir Imagen</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-text"> Dirección Fiscal:</label>
                            <div class="form-group">
                                <input id="txtDireccion" class="form-control" type="text" placeholder="Ingrese su dirección fiscal">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-text">Teléfono: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                            <div class="form-group">
                                <input id="txtTelefono" class="form-control" type="text" placeholder="Teléfono">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-text">Celular:</label>
                            <div class="form-group">
                                <input id="txtCelular" class="form-control" type="text" placeholder="Celular">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-text">Pagina web:</label>
                            <div class="form-group">
                                <input id="txtPaginWeb" class="form-control" type="text" placeholder="Página Web">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-text">Email: <i class="fa fa-fw fa-asterisk text-danger"></i></label>
                            <div class="form-group">
                                <input id="txtEmail" class="form-control" type="text" placeholder="Email" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-text"> Usuario Sol:</label>
                            <div class="form-group">
                                <input id="txtUsuarioSol" class="form-control" type="text" placeholder="Usuario Sol" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-text"> Contraseña Sol:</label>
                            <div class="form-group">
                                <input id="txtClaveSol" class="form-control" type="password" placeholder="Password SOL" />
                            </div>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-6">
                            <label class="form-text"> Seleccionar Archivo:</label>
                            <div class="form-group d-flex">
                                <div class="input-group">
                                    <input type="file" class="form-control d-none" id="fileCertificado">
                                    <label class="form-control" for="fileCertificado" id="lblNameCertificado">Seleccionar archivo</label>
                                    <div class="input-group-append">
                                        <label for="fileCertificado" class="btn btn-info" type="button" id="btnReloadCliente">Subir</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-text"> Contraseña de tu Certificado:</label>
                            <div class="form-group">
                                <input id="txtClaveCertificado" class="form-control" type="password" placeholder="Contraseña de tu Certificado" />
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-text text-left text-danger">Todos los campos marcados con <i class="fa fa-fw fa-asterisk text-danger"></i> son obligatorios</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group text-right">
                                <button class="btn btn-success" type="button" id="btnGuardar"><i class="fa fa-save"></i>
                                    Guardar</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </main>
        <!-- Essential javascripts for application to work-->
        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools();
            let idEmpresa = 0;
            let txtNumDocumento = $("#txtNumDocumento");
            let txtRazonSocial = $("#txtRazonSocial");
            let txtNomComercial = $("#txtNomComercial");
            let lblImagen = $("#lblImagen");
            let fileImage = $("#fileImage");
            let txtDireccion = $("#txtDireccion");
            let txtTelefono = $("#txtTelefono");
            let txtCelular = $("#txtCelular");
            let txtPaginWeb = $("#txtPaginWeb");
            let txtEmail = $("#txtEmail");
            let txtUsuarioSol = $("#txtUsuarioSol");
            let txtClaveSol = $("#txtClaveSol");
            let lblNameCertificado = $("#lblNameCertificado");
            let fileCertificado = $("#fileCertificado");
            let txtClaveCertificado = $("#txtClaveCertificado");
            $(document).ready(function() {              

                $("#fileImage").on('change', function(event) {
                    lblImagen.attr("src", URL.createObjectURL(event.target.files[0]));
                });

                $("#fileCertificado").on('change', function(event) {
                    lblNameCertificado.val(event.target.files[0].name);
                });

                $("#btnGuardar").keypress(function(event) {
                    if (event.keyCode == 13) {
                        crudEmpresa();
                    }
                    event.preventDefault();
                });

                $("#btnGuardar").click(function() {
                    crudEmpresa();
                });
                modalEvents();
                LoadDataEmpresa();
            });

            function modalEvents() {
                $('#modalAlert').on('shown.bs.modal', function(e) {
                    $("#btnButtonAcceptModal").focus();
                })

                $("#btnIconCloseModal").click(function(event) {
                    $("#modalAlert").modal('hide');
                });

                $("#btnIconCloseModal").keypress(function(event) {
                    if (event.keyCode === 13) {
                        $("#modalAlert").modal('hide');
                    }
                    event.preventDefault();
                });

                $("#btnButtonAcceptModal").click(function(event) {
                    $("#modalAlert").modal('hide');
                });

                $("#btnButtonAcceptModal").keypress(function(event) {
                    if (event.keyCode === 13) {
                        $("#modalAlert").modal('hide');
                    }
                    event.preventDefault();
                });
            }

            function LoadDataEmpresa() {
                $.ajax({
                    url: "../app/controller/empresa/ListarEmpresa.php",
                    method: "GET",
                    data: {},
                    beforeSend: function() {
                        tools.AlertInfo("Mi Empresa", "Cargando información.", "toast-bottom-right");
                        $("#divOverlayEmpresa").removeClass("d-none");
                    },
                    success: function(result) {
                        let data = result;
                        if (data.estado == 1) {
                            idEmpresa = data.result.IdEmpresa;
                            txtNumDocumento.val(data.result.NumeroDocumento);
                            txtRazonSocial.val(data.result.RazonSocial);
                            txtNomComercial.val(data.result.NombreComercial);
                            if (data.result.Image == "") {
                                lblImagen.attr("src", "./image/noimage.jpg");
                            } else {
                                lblImagen.attr("src", "data:image/png;base64," + data.result.Image);
                            }
                            txtDireccion.val(data.result.Domicilio);
                            txtTelefono.val(data.result.Telefono);
                            txtCelular.val(data.result.Celular);
                            txtPaginWeb.val(data.result.PaginaWeb);
                            txtEmail.val(data.result.Email);
                            txtUsuarioSol.val(data.result.UsuarioSol);
                            txtClaveSol.val(data.result.ClaveSol);
                            lblNameCertificado.val(data.result.CertificadoRuta);
                            txtClaveCertificado.val(data.result.CertificadoClave);
                            $("#divOverlayEmpresa").addClass("d-none");
                        } else {
                            $("#lblTextOverlayEmpresa").html(data.message);
                        }

                    },
                    error: function(error) {
                        $("#lblTextOverlayEmpresa").html("Error en :" + error.responseText);
                    }
                });
            }

            function crudEmpresa() {

                var formData = new FormData();
                formData.append("idEmpresa", idEmpresa);
                formData.append("txtNumDocumento", txtNumDocumento.val());
                formData.append("txtRazonSocial", txtRazonSocial.val());
                formData.append("txtNomComercial", txtNomComercial.val());
                formData.append("txtDireccion", txtDireccion.val());
                formData.append("txtTelefono", txtTelefono.val());
                formData.append("txtCelular", txtCelular.val());
                formData.append("txtPaginWeb", txtPaginWeb.val());
                formData.append("txtEmail", txtEmail.val());

                formData.append("imageType", fileImage[0].files.length);
                formData.append("image", fileImage[0].files[0]);

                formData.append("txtUsuarioSol", txtUsuarioSol.val());
                formData.append("txtClaveSol", txtClaveSol.val());
                formData.append("certificadoUrl", lblNameCertificado.val());
                formData.append("certificadoType", fileCertificado[0].files.length);
                formData.append("certificado", fileCertificado[0].files[0]);
                formData.append("txtClaveCertificado", txtClaveCertificado.val());

                // console.log(fileCertificado[0].files.length)
                // console.log(fileCertificado[0].files[0])
                // console.log(txtClaveCertificado.val())

                tools.ModalDialog("Mi Empresa", "¿Está seguro de continuar?", function(value) {
                    if (value == true) {
                        $.ajax({
                            url: "../app/controller/empresa/CrudEmpresa.php",
                            method: "POST",
                            data: formData,
                            contentType: false,
                            processData: false,
                            beforeSend: function() {
                                tools.ModalAlertInfo("Mi Empresa", "Procesando petición..");
                            },
                            success: function(result) {
                                if (result.state == 1) {
                                    tools.ModalAlertSuccess("Mi Empresa", result.message);
                                } else {
                                    tools.ModalAlertWarning("Mi Empresa", result.message);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Mi Empresa", "Se produjo un error: " + error.responseText);
                            }
                        });
                    }
                });

            }
        </script>
    </body>

    </html>

<?php
}
