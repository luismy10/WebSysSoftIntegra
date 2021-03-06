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
                <h1><i class="fa fa-folder"></i> Nota de Crédito <small>Lista</small></h1>
            </div>

            <div class="tile mb-4">

                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <h4> Resumen de documentos emitidos</h4>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/sunat_logo.png" width="28" height="28" />
                            <span class="small">Estados SUNAT:</span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/accept.svg" width="28" height="28" />
                            <span class="small">Aceptado</span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/unable.svg" width="28" height="28" />
                            <span class="small"> Rechazado</span>
                        </div>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/reuse.svg" width="28" height="28" />
                            <span class="small"> Pendiente de Envío</span>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <div class="form-group">
                            <img src="./images/error.svg" width="28" height="28" />
                            <span class="small">Comunicación de Baja (Anulado)</span>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Fecha de Inicio:</label>
                        <div class="form-group">
                            <input class="form-control" type="date" id="txtFechaInicial" />
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Fecha de Fin:</label>
                        <div class="form-group">
                            <input class="form-control" type="date" id="txtFechaFinal" />
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Procesar:</label>
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnEnvioMasivo">
                                <i class="fa fa-arrow-circle-up"></i> Envío masivo a sunat
                            </button>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-12">
                        <label>Generar Excel:</label>
                        <div class="form-group">
                            <button class="btn btn-success" id="btnExcel">
                                <i class="fa fa-file-excel"></i> Excel por Fecha
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                        <label>Buscar:</label>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <button type="button" class="btn btn-danger" id="btnReload"><i class="fa fa-refresh"></i> Recargar</button>
                                </div>
                                <input type="text" class="form-control" placeholder="Escribir para filtrar" id="txtSearch">
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <label>Paginación:</label>
                        <div class="form-group">
                            <button class="btn btn-primary" id="btnAnterior">
                                <i class="fa fa-arrow-circle-left"></i>
                            </button>
                            <span class="m-2" id="lblPaginaActual">0</span>
                            <span class="m-2">de</span>
                            <span class="m-2" id="lblPaginaSiguiente">0</span>
                            <button class="btn btn-primary" id="btnSiguiente">
                                <i class="fa fa-arrow-circle-right"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover" style="border-width: 1px;border-style: dashed;border-color: #007bff;">
                                <thead style="background-color: #0766cc;color: white;">
                                    <tr>
                                        <th style="width:5%;">#</th>
                                        <th style="width:10%;">Fecha</th>
                                        <th style="width:10%;">Comprobante</th>
                                        <th style="width:15%;">Cliente</th>
                                        <th style="width:15%;">Detalle</th>
                                        <th style="width:10%;">Total</th>
                                        <th style="width:10%;">Estado SUNAT</th>
                                        <th style="width:20%;">Observación SUNAT</th>
                                    </tr>
                                </thead>
                                <tbody id="tbList">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <?php include "./layout/footer.php"; ?>
        <script src="./js/notificaciones.js"></script>
        <script>
            let tools = new Tools();
            let state = false;
            let paginacion = 0;
            let opcion = 0;
            let totalPaginacion = 0;
            let filasPorPagina = 20;
            let tbList = $("#tbList");

            let lblPaginaActual = $("#lblPaginaActual");
            let lblPaginaSiguiente = $("#lblPaginaSiguiente");

            $(document).ready(function() {

                $("#txtFechaInicial").val(tools.getCurrentDate());
                $("#txtFechaFinal").val(tools.getCurrentDate());

                $("#txtFechaInicial").on("change", function() {
                    var fechaInicial = $("#txtFechaInicial").val();
                    var fechaFinal = $("#txtFechaFinal").val();
                    if (!state) {
                        paginacion = 1;
                        fillNotaCreditoTable(0, "", fechaInicial, fechaFinal);
                        opcion = 0;
                    }
                });

                $("#txtFechaFinal").on("change", function() {
                    var fechaInicial = $("#txtFechaInicial").val();
                    var fechaFinal = $("#txtFechaFinal").val();
                    if (!state) {
                        paginacion = 1;
                        fillNotaCreditoTable(0, "", fechaInicial, fechaFinal);
                        opcion = 0;
                    }
                });

                $("#txtSearch").on("keyup", function(event) {
                    let value = $("#txtSearch").val();
                    if (event.keyCode !== 9 && event.keyCode !== 18) {
                        if (value.trim().length != 0) {
                            if (!state) {
                                paginacion = 1;
                                fillNotaCreditoTable(1, value.trim(), "", "");
                                opcion = 1;
                            }
                        }
                    }
                });

                $("#btnAnterior").click(function() {
                    if (!state) {
                        if (paginacion > 1) {
                            paginacion--;
                            onEventPaginacion();
                        }
                    }
                });

                $("#btnSiguiente").click(function() {
                    if (!state) {
                        if (paginacion < totalPaginacion) {
                            paginacion++;
                            onEventPaginacion();
                        }
                    }
                });

                $("#btnReload").click(function() {
                    loadInitNotaCredito();
                });

                $("#btnReload").keypress(function(event) {
                    if (event.keyCode === 13) {
                        loadInitNotaCredito();
                    }
                    event.preventDefault();
                });


                $("#btnExcel").click(function() {
                    openExcel();
                });

                $("#btnExcel").keypress(function(event) {
                    if (event.keyCode === 13) {
                        openExcel();
                    }
                    event.preventDefault();
                });

                loadInitNotaCredito();
            });

            function onEventPaginacion() {
                let fechaInicial = $("#txtFechaInicial").val();
                let fechaFinal = $("#txtFechaFinal").val();
                let value = $("#txtSearch").val();
                switch (opcion) {
                    case 0:
                        fillNotaCreditoTable(0, "", fechaInicial, fechaFinal);
                        break;
                    case 1:
                        fillNotaCreditoTable(1, value.trim(), "", "");
                        break;
                }
            }

            function loadInitNotaCredito() {
                let fechaInicial = $("#txtFechaInicial").val();
                let fechaFinal = $("#txtFechaFinal").val();
                if (tools.validateDate(fechaInicial) && tools.validateDate(fechaFinal)) {
                    if (!state) {
                        paginacion = 1;
                        fillNotaCreditoTable(0, "", fechaInicial, fechaFinal);
                        opcion = 0;
                    }
                }
            }

            function fillNotaCreditoTable(opcion, search, fechaInicial, fechaFinal) {
                $.ajax({
                    url: "../app/controller/ventas/ListarVentas.php",
                    method: "GET",
                    data: {
                        "type": "listaNotaCredito",
                        "opcion": opcion,
                        "search": search,
                        "fechaInicial": fechaInicial,
                        "fechaFinal": fechaFinal,
                        "posicionPagina": ((paginacion - 1) * filasPorPagina),
                        "filasPorPagina": filasPorPagina
                    },
                    beforeSend: function() {
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="8"><img src="./images/loading.gif" id="imgLoad" width="34" height="34" /> <p>Cargando información...</p></td></tr>');
                        state = true;
                        totalPaginacion = 0;
                    },
                    success: function(result) {
                        tbList.empty();
                        if (result.estado == 1) {
                            if (result.data.length == 0) {
                                tbList.append('<tr><td class="text-center" colspan="8"><p>No hay datos para mostrar</p></td></tr>');
                                lblPaginaActual.html(0);
                                lblPaginaSiguiente.html(0);
                                state = false;
                            } else {
                                for (let detalle of result.data) {
                                    let estadosunat = detalle.Xmlsunat === "" ?
                                        '<button class="btn btn-default" onclick="firmarXml(\'' + detalle.IdNotaCredito + '\')"><img src="./images/reuse.svg" width="26"/></button>' :
                                        detalle.Xmlsunat === "0" ?
                                        '<button class="btn btn-default"><img src="./images/accept.svg" width="26" /></button>' :
                                        '<button class="btn btn-default" onclick="firmarXml(\'' + detalle.IdNotaCredito + '\')"><img src="./images/unable.svg" width="26" /></button>';

                                    let descripcion = '<p class="recortar-texto">' + (detalle.Xmldescripcion === "" ? "Por Generar Xml" : detalle.Xmldescripcion) + '</p>';

                                    tbList.append('<tr>' +
                                        '<td>' + detalle.Id + '</td>' +
                                        '<td>' + tools.getDateForma(detalle.FechaNotaCredito) + '<br>' + tools.getTimeForma24(detalle.HoraNotaCredito) + '</td>' +
                                        '<td>' + detalle.SerieNotaCredito + '-' + detalle.NumeracionNotaCredito + '</td>' +
                                        '<td>' + detalle.NumeroDocumento + '<br>' + detalle.Informacion + '</td>' +
                                        '<td>Comprobante Editado' + '<br>' + detalle.Serie + '-' + detalle.Numeracion + '</td>' +
                                        '<td>' + detalle.Simbolo + " " + tools.formatMoney(detalle.Total) + '</td>' +
                                        '<td>' + estadosunat + '</td>' +
                                        '<td>' + descripcion + '</td>' +
                                        '</tr>');
                                }
                                totalPaginacion = parseInt(Math.ceil((parseFloat(result.total) / filasPorPagina)));
                                lblPaginaActual.html(paginacion);
                                lblPaginaSiguiente.html(totalPaginacion);
                                state = false;
                            }
                        } else {
                            tbList.append('<tr><td class="text-center" colspan="8"><p>' + result.message + '</p></td></tr>');
                            lblPaginaActual.html(0);
                            lblPaginaSiguiente.html(0);
                            state = false;
                        }
                    },
                    error: function(error) {
                        tbList.empty();
                        tbList.append('<tr><td class="text-center" colspan="8"><p>' + error.responseText + '</p></td></tr>');
                        lblPaginaActual.html(0);
                        lblPaginaSiguiente.html(0);
                        state = false;
                    }
                });
            }

            function firmarXml(idNotaCredito) {
                tools.ModalDialog("Nota de Crédito", "¿Está seguro de enviar el documento?", function(value) {
                    if (value == true) {

                        $.ajax({
                            url: "../app/examples/notacredito.php",
                            method: "GET",
                            data: {
                                "idNotaCredito": idNotaCredito
                            },
                            beforeSend: function() {
                                tools.ModalAlertInfo("Ventas", "Firmando xml y enviando a la sunat.");
                            },
                            success: function(result) {
                                let object = result;
                                if (object.state === true) {
                                    if (object.accept === true) {
                                        tools.ModalAlertSuccess("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                    } else {
                                        tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                    }
                                } else {
                                    tools.ModalAlertWarning("Ventas", "Resultado: Código " + object.code + " " + object.description);
                                }
                            },
                            error: function(error) {
                                tools.ModalAlertError("Ventas", "Error en el momento de firmar el xml: " + error.responseText);
                            }
                        });

                    }
                });
            }

            function openExcel() {
                $("#mdAlert").modal("show");

                $("#btnFacturados").unbind();
                $("#btnFacturados").bind("click", function() {
                    let fechaInicial = $("#txtFechaInicial").val();
                    let fechaFinal = $("#txtFechaFinal").val();
                    if (fechaInicial !== "" && fechaInicial !== undefined && fechaFinal !== "" && fechaFinal !== undefined) {
                        window.open("../app/sunat/excelnotacredito.php?txtFechaInicial=" + fechaInicial + "&txtFechaFinal=" + fechaFinal + "&facturado=1", "_blank");
                        $("#mdAlert").modal("hide");
                    }
                });

                $("#btnCancelar").unbind();
                $("#btnCancelar").bind("click", function() {
                    $("#mdAlert").modal("hide");
                });

                $("#btnClose").unbind();
                $("#btnClose").bind("click", function() {
                    $("#mdAlert").modal("hide");
                });

            }
        </script>
    </body>

    </html>

<?php

}
