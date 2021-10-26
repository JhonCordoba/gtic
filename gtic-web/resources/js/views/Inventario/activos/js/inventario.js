window.$ = window.jQuery = require("jquery");
import { llenarSelect } from "../../../../helpers/selects.js";

export default {
    name: "ActivosView",
    methods: {
        listarInventario(numero_pagina) {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    Authorization: `Bearer ${localStorage.getItem(
                        "token_auth_api"
                    )}`
                },
                url: "inventario?page=" + numero_pagina,
                method: "GET",
                success: function(result, status, xhr) {
                    let numero_elemento = 1;
                    $("#cuerpo_tabla_inventario").empty();

                    console.log(result);

                    result.forEach(function(element, idx) {
                        var observacion = "";
                        if (element[0].observaciones)
                            observacion = element[0].observaciones;
                        //si estamos en el último elmento, no hacemos la iteración porque estamos en los links de pagination
                        if (idx !== result.length - 1) {
                            let elemento_columna =
                                "<tr>" +
                                "<td>" +
                                numero_elemento +
                                "</td>" +
                                "<td>" +
                                element[0].numero_inventario +
                                "</td>" +
                                "<td>" +
                                element[0].nombre +
                                " - " +
                                element[0].marca_referencia +
                                "</td>" +
                                "<td>" +
                                element[0].edificio +
                                " - " +
                                element[0].nombre_oficina_ubicacion +
                                "</td>" +
                                "<td>" +
                                element[0].nombre_funcionario_responsable +
                                "</td>" +
                                "<td>" +
                                element[0].nombre_usuario +
                                "</td>" +
                                "<td>" +
                                element[0].observaciones +
                                "</td>" +
                                "<td>" +
                                element[0].nombre_estado_de_activo +
                                "</td>" +
                                "<td>" +
                                element[0].ultima_revision_estado +
                                "</td>" +
                                '<td><i class="material-icons" title="Más información" data-toggle="modal" data-target="#modalSGT" data-id_metodo="mas_informacion_activo" data-serial="' +
                                element[0].numero_serial +
                                '" data-nombre="' +
                                element[0].nombre +
                                '"data-fecha_aceptacion="' +
                                element[0].fecha_aceptacion +
                                '"data-fecha_aceptacion="' +
                                element[0].fecha_aceptacion +
                                '"data-costo_inicial="' +
                                element[0].costo_inicial +
                                '"data-datos_proveedor="' +
                                element[0].datos_contacto_proveedor +
                                '"data-fecha_fin_garantia="' +
                                element[0].fecha_fin_garantia +
                                '"data-numero_factura="' +
                                element[0].numero_factura +
                                '"data-fecha_ingreso_al_sistema="' +
                                element[0].created_at +
                                '"data-id_activo="' +
                                element[0].id +
                                '"data-ultimo_mantenimiento="' +
                                element[0].ultimo_mantenimiento +
                                '"data-cada_cuantos_dias_mantenimiento="' +
                                element[0].cada_cuantos_dias_mantenimiento +
                                '"data-es_computador="' +
                                element[0].es_computador;

                            if (
                                element[0].es_computador === 1 &&
                                element[1] != null
                            ) {
                                elemento_columna +=
                                    '"data-nombre_computador="' +
                                    element[1].nombre_equipo +
                                    '"data-tipo_escritorio_portatil="' +
                                    element[1].tipo_escritorio_portatil +
                                    '"data-mac_address="' +
                                    element[1].MACaddress +
                                    '"data-ip_address="' +
                                    element[1].IPaddress +
                                    '"data-ip_gateway="' +
                                    element[1].ip_puerta_enlace +
                                    '"data-capacidad_ram="' +
                                    element[1].capacidad_ram +
                                    '"data-capacidad_almacenamiento="' +
                                    element[1].capacidad_almacenamiento +
                                    '"data-cantidad_tarjeta_red_inalambrica="' +
                                    element[1]
                                        .cantidad_tarjeta_red_inalambrica +
                                    '"data-cantidad_tarjeta_red_alambrica="' +
                                    element[1].cantidad_tarjeta_red_alambrica;
                            }

                            elemento_columna +=
                                '" >info</i></td>' +
                                '<td><i class="material-icons" title="Editar activo" data-toggle="modal" data-target="#modalSGT" data-id_metodo="editar_activo"' +
                                '" data-nombre="' +
                                element[0].nombre +
                                '"data-id="' +
                                element[0].id +
                                '"data-numero_inventario="' +
                                element[0].numero_inventario +
                                '"data-marca_referencia="' +
                                element[0].marca_referencia +
                                '"data-fecha_aceptacion="' +
                                element[0].fecha_aceptacion +
                                '"data-edificio="' +
                                element[0].edificio +
                                '"data-oficina="' +
                                element[0].nombre_oficina_ubicacion +
                                '"data-observaciones="' +
                                observacion.replace(/['"]+/g, "") +
                                '"data-ultima_revision="' +
                                element[0].ultima_revision_estado +
                                '"data-serial="' +
                                element[0].numero_serial +
                                '"data-costo_inicial="' +
                                element[0].costo_inicial +
                                '"data-datos_proveedor="' +
                                element[0].datos_contacto_proveedor +
                                '"data-fecha_fin_garantia="' +
                                element[0].fecha_fin_garantia +
                                '"data-numero_factura="' +
                                element[0].numero_factura +
                                '"data-fecha_ingreso_al_sistema="' +
                                element[0].created_at +
                                '"data-ultimo_mantenimiento="' +
                                element[0].ultimo_mantenimiento +
                                '"data-cada_cuantos_dias_mantenimiento="' +
                                element[0].cada_cuantos_dias_mantenimiento +
                                '"data-es_computador="' +
                                element[0].es_computador;

                            if (
                                element[0].es_computador === 1 &&
                                element[1] != null
                            ) {
                                elemento_columna +=
                                    '"data-nombre_computador="' +
                                    element[1].nombre_equipo +
                                    '"data-tipo_escritorio_portatil="' +
                                    element[1].tipo_escritorio_portatil +
                                    '"data-mac_address="' +
                                    element[1].MACaddress +
                                    '"data-ip_address="' +
                                    element[1].IPaddress +
                                    '"data-ip_gateway="' +
                                    element[1].ip_puerta_enlace +
                                    '"data-capacidad_ram="' +
                                    element[1].capacidad_ram +
                                    '"data-capacidad_almacenamiento="' +
                                    element[1].capacidad_almacenamiento +
                                    '"data-cantidad_tarjeta_red_inalambrica="' +
                                    element[1]
                                        .cantidad_tarjeta_red_inalambrica +
                                    '"data-cantidad_tarjeta_red_alambrica="' +
                                    element[1].cantidad_tarjeta_red_alambrica +
                                    '"data-numero_inventario="' +
                                    element[1].id;
                            }

                            elemento_columna += '" >edit</i></td>' + "</tr>";

                            $("#cuerpo_tabla_inventario").append(
                                elemento_columna
                            );

                            numero_elemento++;
                        }
                    });

                    for (
                        let i = 1;
                        i <= result[result.length - 1].last_page;
                        i++
                    ) {
                        $("#paginacion_inventario").append(
                            "<li class='list-group-item' style='float: left; cursor: pointer;' >" +
                                i +
                                "</li>"
                        );
                    }
                },

                error: function(xhr) {
                    console.log(
                        "Request Status: " +
                            xhr.status +
                            " Status Text: " +
                            xhr.statusText +
                            " " +
                            xhr.responseText
                    );
                }
            });
        },

        mostrarMasInformacionDeActivo(e) {
            $("#modalSGTbody").empty();

            $("#modalSGTtitle").text(
                "Más información - " + $(e.relatedTarget).data("nombre")
            );
            $("#modalSGTbody").append("<table>");

            /////////////////table head//////////////
            $("#modalSGTbody").append("<thead>");
            $("#modalSGTbody").append("<tr>");

            $("#modalSGTbody").append("<th scope='col'>Propiedad");
            $("#modalSGTbody").append("</th>");

            $("#modalSGTbody").append("<th scope='col'>Valor");
            $("#modalSGTbody").append("</th>");

            $("#modalSGTbody").append("</tr>");
            $("#modalSGTbody").append("</thead>");
            ////////////////////////////////////////

            $("#modalSGTbody").append("<tr>");
            $("#modalSGTbody").append("<td>Serial del activo: </td>");
            $("#modalSGTbody").append(
                "<td>" + $(e.relatedTarget).data("serial") + "</td>"
            );
            $("#modalSGTbody").append("</tr>");

            $("#modalSGTbody").append("<tr>");
            $("#modalSGTbody").append("<td>Fecha de Aceptación: </td>");
            $("#modalSGTbody").append(
                "<td>" + $(e.relatedTarget).data("fecha_aceptacion") + "</td>"
            );
            $("#modalSGTbody").append("</tr>");

            $("#modalSGTbody").append("<tr>");
            $("#modalSGTbody").append("<td>Costo Inicial: </td>");
            $("#modalSGTbody").append(
                "<td>" + $(e.relatedTarget).data("costo_inicial") + "</td>"
            );
            $("#modalSGTbody").append("</tr>");

            $("#modalSGTbody").append("<tr>");
            $("#modalSGTbody").append("<td>Datos del Proveedor: </td>");
            $("#modalSGTbody").append(
                "<td>" + $(e.relatedTarget).data("datos_proveedor") + "</td>"
            );
            $("#modalSGTbody").append("</tr>");

            $("#modalSGTbody").append("<tr>");
            $("#modalSGTbody").append("<td>Fecha fin garantía: </td>");
            $("#modalSGTbody").append(
                "<td>" + $(e.relatedTarget).data("fecha_fin_garantia") + "</td>"
            );
            $("#modalSGTbody").append("</tr>");

            $("#modalSGTbody").append("<tr>");
            $("#modalSGTbody").append("<td>Número Factura: </td>");
            $("#modalSGTbody").append(
                "<td>" + $(e.relatedTarget).data("numero_factura") + "</td>"
            );
            $("#modalSGTbody").append("</tr>");

            $("#modalSGTbody").append("<tr>");
            $("#modalSGTbody").append("<td>Fecha de registro: </td>");
            $("#modalSGTbody").append(
                "<td>" +
                    $(e.relatedTarget).data("fecha_ingreso_al_sistema") +
                    "</td>"
            );
            $("#modalSGTbody").append("</tr>");

            $("#modalSGTbody").append("<tr>");
            $("#modalSGTbody").append("<td>Último mantenimiento: </td>");
            $("#modalSGTbody").append(
                "<td>" +
                    $(e.relatedTarget).data("ultimo_mantenimiento") +
                    "</td>"
            );
            $("#modalSGTbody").append("</tr>");

            $("#modalSGTbody").append("<tr>");
            $("#modalSGTbody").append(
                "<td>Periodo mantenimiento (días): </td>"
            );
            $("#modalSGTbody").append(
                "<td>" +
                    $(e.relatedTarget).data("cada_cuantos_dias_mantenimiento") +
                    "</td>"
            );
            $("#modalSGTbody").append("</tr>");

            //Si es un computador mostramos sus propiedades:
            if ($(e.relatedTarget).data("es_computador") === 1) {
                $("#modalSGTbody").append("<tr>");
                $("#modalSGTbody").append("<td>Nombre Computador: </td>");
                $("#modalSGTbody").append(
                    "<td>" +
                        $(e.relatedTarget).data("nombre_computador") +
                        "</td>"
                );
                $("#modalSGTbody").append("</tr>");

                $("#modalSGTbody").append("<tr>");
                $("#modalSGTbody").append("<td>Tipo Computador: </td>");
                $("#modalSGTbody").append(
                    "<td>" +
                        $(e.relatedTarget).data("tipo_escritorio_portatil") +
                        "</td>"
                );
                $("#modalSGTbody").append("</tr>");

                $("#modalSGTbody").append("<tr>");
                $("#modalSGTbody").append("<td>Dirección MAC: </td>");
                $("#modalSGTbody").append(
                    "<td>" + $(e.relatedTarget).data("mac_address") + "</td>"
                );
                $("#modalSGTbody").append("</tr>");

                $("#modalSGTbody").append("<tr>");
                $("#modalSGTbody").append("<td>Dirección IP: </td>");
                $("#modalSGTbody").append(
                    "<td>" + $(e.relatedTarget).data("ip_address") + "</td>"
                );
                $("#modalSGTbody").append("</tr>");

                $("#modalSGTbody").append("<tr>");
                $("#modalSGTbody").append("<td>Puerta de enlace: </td>");
                $("#modalSGTbody").append(
                    "<td>" + $(e.relatedTarget).data("ip_gateway") + "</td>"
                );
                $("#modalSGTbody").append("</tr>");

                $("#modalSGTbody").append("<tr>");
                $("#modalSGTbody").append("<td>Cantidad RAM (MegaByte): </td>");
                $("#modalSGTbody").append(
                    "<td>" + $(e.relatedTarget).data("capacidad_ram") + "</td>"
                );
                $("#modalSGTbody").append("</tr>");

                $("#modalSGTbody").append("<tr>");
                $("#modalSGTbody").append(
                    "<td>Capacidad Almacenamiento (GB): </td>"
                );
                $("#modalSGTbody").append(
                    "<td>" +
                        $(e.relatedTarget).data("capacidad_almacenamiento") +
                        "</td>"
                );
                $("#modalSGTbody").append("</tr>");

                $("#modalSGTbody").append("<tr>");
                $("#modalSGTbody").append("<td>NIC inalambricas: </td>");
                $("#modalSGTbody").append(
                    "<td>" +
                        $(e.relatedTarget).data(
                            "cantidad_tarjeta_red_inalambrica"
                        ) +
                        "</td>"
                );
                $("#modalSGTbody").append("</tr>");

                $("#modalSGTbody").append("<tr>");
                $("#modalSGTbody").append("<td>NIC alambricas: </td>");
                $("#modalSGTbody").append(
                    "<td>" +
                        $(e.relatedTarget).data(
                            "cantidad_tarjeta_red_alambrica"
                        ) +
                        "</td>"
                );
                $("#modalSGTbody").append("</tr>");
            }

            $("#modalSGTbody").append(
                "<hr/><button class='btn_guardar_cambios' id='btn_listarAnexos' value='" +
                    $(e.relatedTarget).data("id_activo") +
                    "'  type='button'> Anexos </button>"
            );

            let this_context_component = this;

            $("#btn_listarAnexos").click(function(event) {
                let id_activo = event.target.value;
                this_context_component.listarAnexosDelActivo(id_activo);
            });

            $("#modalSGTbody").append("</table>");

            var idActivoCompuesto = $(e.relatedTarget).data("id_activo");
            $.ajax({
                url: "/activo/componentes-compuestode",
                headers: {
                    Authorization: `Bearer ${localStorage.getItem(
                        "token_auth_api"
                    )}`
                },
                data: { id_activo: idActivoCompuesto },
                method: "GET",
                success: function(result, status, xhr) {
                    console.log(result);
                    let listaDeComponentes =
                        " <h3> Componentes del activo: </h3>" +
                        "<table>" +
                        "<tr> <th> Nombre </th> <th> # Inventario </th> <th> # Serial </th>    </tr>";

                    result[0].forEach(function(element) {
                        let fila =
                            "<tr style='box-shadow: 0px 1px 1px 0px rgba(0,0,0,0.75);'>";

                        fila += "<td>" + element.nombre + "</td>";
                        fila += "<td>" + element.numero_inventario + "</td>";
                        fila += "<td>" + element.numero_serial + "</td>";

                        fila += "</tr>";

                        listaDeComponentes += fila;
                    });

                    listaDeComponentes += "</table> ";

                    if (result[0].length == 0) {
                        listaDeComponentes = "";
                    }
                    $("#modalSGTbody").append(listaDeComponentes);

                    ////
                    if (result[1] == null) return;
                    let compuestoDe =
                        " <h3>El activo es un compuesto de: </h3>" +
                        "<table>" +
                        "<tr> <th> Nombre </th> <th> # Inventario </th> <th> # Serial </th>    </tr>" +
                        "<tr style='box-shadow: 0px 1px 1px 0px rgba(0,0,0,0.75);'>" +
                        "<td>" +
                        result[1].nombre +
                        "</td>" +
                        "<td>" +
                        result[1].numero_inventario +
                        "</td>" +
                        "<td>" +
                        result[1].numero_serial +
                        "</td> </tr> </table> ";

                    if (result[1].length == 0) {
                        compuestoDe = "";
                    }
                    $("#modalSGTbody").append(compuestoDe);
                    ////
                },

                error: function(xhr) {
                    console.log(
                        "Request Status: " +
                            xhr.status +
                            " Status Text: " +
                            xhr.statusText +
                            " " +
                            xhr.responseText
                    );
                }
            });
        },

        listarAnexosDelActivo(id_activo) {
            $("#modalSGTbody").empty();

            $("#modalSGTtitle").text("Anexos del activo");
            $("#modalSGTbody").append("<table>");

            /////////////////table head//////////////
            $("#modalSGTbody").append("<thead>");
            $("#modalSGTbody").append("<tr>");

            $("#modalSGTbody").append("<th scope='col'>Nombre del archivo");
            $("#modalSGTbody").append("</th>");

            $("#modalSGTbody").append("<th scope='col'>");
            $("#modalSGTbody").append("</th>");

            $("#modalSGTbody").append("<th scope='col'>");
            $("#modalSGTbody").append("</th>");

            $("#modalSGTbody").append("</tr>");
            $("#modalSGTbody").append("</thead>");
            ////////////////////////////////////////

            $.ajax({
                url: "/activos/anexos",
                headers: {
                    Authorization: `Bearer ${localStorage.getItem(
                        "token_auth_api"
                    )}`
                },
                data: { id_activo: id_activo },
                method: "GET",
                success: function(result, status, xhr) {
                    if (result.length == 0) {
                        $("#modalSGTtitle").text("Este activo no tiene anexos");
                        $("#modalSGTbody").empty();
                    }

                    result.forEach(function(element) {
                        let fila =
                            "<tr style='box-shadow: 0px 1px 1px 0px rgba(0,0,0,0.75);'>";

                        fila += "<td>" + element[0] + "</td>";
                        fila +=
                            "<td> <a href='/activos/anexo/" +
                            id_activo +
                            "/" +
                            element[0] +
                            "'> <i class='material-icons'>cloud_download</i> </a> </td>";
                        fila +=
                            '<td> <i class="material-icons">delete</i> </td>';

                        fila += "</tr>";

                        $("#modalSGTbody").append(fila);
                    });

                    $("#modalSGTbody").append("</table>");
                },

                error: function(xhr) {
                    console.log(
                        "Request Status: " +
                            xhr.status +
                            " Status Text: " +
                            xhr.statusText +
                            " " +
                            xhr.responseText
                    );
                }
            });
        },

        listarInventarioFiltrado(inventario_filtrado) {
            let numero_elemento = 1;
            $("#cuerpo_tabla_inventario").empty();

            inventario_filtrado.forEach(function(element) {
                var observacion = "";
                if (element[0].observaciones)
                    observacion = element[0].observaciones;
                let elemento_columna =
                    "<tr>" +
                    "<td>" +
                    numero_elemento +
                    "</td>" +
                    "<td>" +
                    element[0].numero_inventario +
                    "</td>" +
                    "<td>" +
                    element[0].nombre +
                    " - " +
                    element[0].marca_referencia +
                    "</td>" +
                    "<td>" +
                    element[0].edificio +
                    " - " +
                    element[0].nombre_oficina_ubicacion +
                    "</td>" +
                    "<td>" +
                    element[0].nombre_funcionario_responsable +
                    "</td>" +
                    "<td>" +
                    element[0].nombre_usuario +
                    "</td>" +
                    "<td>" +
                    observacion.replace(/['"]+/g, "") +
                    "</td>" +
                    "<td>" +
                    element[0].nombre_estado_de_activo +
                    "</td>" +
                    "<td>" +
                    element[0].ultima_revision_estado +
                    "</td>" +
                    '<td><i class="material-icons" title="Más información" data-toggle="modal" data-target="#modalSGT" data-id_metodo="mas_informacion_activo" data-serial="' +
                    element[0].numero_serial +
                    '" data-nombre="' +
                    element[0].nombre +
                    '"data-fecha_aceptacion="' +
                    element[0].fecha_aceptacion +
                    '"data-fecha_aceptacion="' +
                    element[0].fecha_aceptacion +
                    '"data-costo_inicial="' +
                    element[0].costo_inicial +
                    '"data-datos_proveedor="' +
                    element[0].datos_contacto_proveedor +
                    '"data-fecha_fin_garantia="' +
                    element[0].fecha_fin_garantia +
                    '"data-numero_factura="' +
                    element[0].numero_factura +
                    '"data-fecha_ingreso_al_sistema="' +
                    element[0].created_at +
                    '"data-id_activo="' +
                    element[0].id +
                    '"data-ultimo_mantenimiento="' +
                    element[0].ultimo_mantenimiento +
                    '"data-cada_cuantos_dias_mantenimiento="' +
                    element[0].cada_cuantos_dias_mantenimiento +
                    '"data-es_computador="' +
                    element[0].es_computador;

                if (null != element[1] && element[0].es_computador === 1) {
                    elemento_columna +=
                        '"data-nombre_computador="' +
                        element[1].nombre_equipo +
                        '"data-tipo_escritorio_portatil="' +
                        element[1].tipo_escritorio_portatil +
                        '"data-mac_address="' +
                        element[1].MACaddress +
                        '"data-ip_address="' +
                        element[1].IPaddress +
                        '"data-ip_gateway="' +
                        element[1].ip_puerta_enlace +
                        '"data-capacidad_ram="' +
                        element[1].capacidad_ram +
                        '"data-capacidad_almacenamiento="' +
                        element[1].capacidad_almacenamiento +
                        '"data-cantidad_tarjeta_red_inalambrica="' +
                        element[1].cantidad_tarjeta_red_inalambrica +
                        '"data-cantidad_tarjeta_red_alambrica="' +
                        element[1].cantidad_tarjeta_red_alambrica;
                }

                elemento_columna +=
                    '" >info</i></td>' +
                    '<td><i class="material-icons" title="Editar activo" data-toggle="modal" data-target="#modalSGT" data-id_metodo="editar_activo"' +
                    '" data-nombre="' +
                    element[0].nombre +
                    '"data-id="' +
                    element[0].id +
                    '"data-numero_inventario="' +
                    element[0].numero_inventario +
                    '"data-marca_referencia="' +
                    element[0].marca_referencia +
                    '"data-fecha_aceptacion="' +
                    element[0].fecha_aceptacion +
                    '"data-edificio="' +
                    element[0].edificio +
                    '"data-oficina="' +
                    element[0].nombre_oficina_ubicacion +
                    '"data-observaciones="' +
                    element[0].observaciones +
                    '"data-ultima_revision="' +
                    element[0].ultima_revision_estado +
                    '"data-serial="' +
                    element[0].numero_serial +
                    '"data-costo_inicial="' +
                    element[0].costo_inicial +
                    '"data-datos_proveedor="' +
                    element[0].datos_contacto_proveedor +
                    '"data-fecha_fin_garantia="' +
                    element[0].fecha_fin_garantia +
                    '"data-numero_factura="' +
                    element[0].numero_factura +
                    '"data-fecha_ingreso_al_sistema="' +
                    element[0].created_at +
                    '"data-ultimo_mantenimiento="' +
                    element[0].ultimo_mantenimiento +
                    '"data-cada_cuantos_dias_mantenimiento="' +
                    element[0].cada_cuantos_dias_mantenimiento +
                    '"data-es_computador="' +
                    element[0].es_computador;

                if (null != element[1] && element[0].es_computador === 1) {
                    elemento_columna +=
                        '"data-nombre_computador="' +
                        element[1].nombre_equipo +
                        '"data-tipo_escritorio_portatil="' +
                        element[1].tipo_escritorio_portatil +
                        '"data-mac_address="' +
                        element[1].MACaddress +
                        '"data-ip_address="' +
                        element[1].IPaddress +
                        '"data-ip_gateway="' +
                        element[1].ip_puerta_enlace +
                        '"data-capacidad_ram="' +
                        element[1].capacidad_ram +
                        '"data-capacidad_almacenamiento="' +
                        element[1].capacidad_almacenamiento +
                        '"data-cantidad_tarjeta_red_inalambrica="' +
                        element[1].cantidad_tarjeta_red_inalambrica +
                        '"data-cantidad_tarjeta_red_alambrica="' +
                        element[1].cantidad_tarjeta_red_alambrica +
                        '"data-numero_inventario="' +
                        element[1].id;
                }

                elemento_columna += '" >edit</i></td>' + "</tr>";

                $("#cuerpo_tabla_inventario").append(elemento_columna);

                numero_elemento++;
            });
        },

        mostrarFormularioFiltrarInventario() {
            $("#cuerpo_tabla_inventario").empty();

            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text("Filtrar");

            let formularioFiltrarInventario =
                "<form id='formularioFiltrarInventario'>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Número de Inventario</label>" +
                "<input class='inputModificar' name='numero_inventario'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre</label>" +
                "<input class='inputModificar' name='nombre'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Marca</label>" +
                "<input class='inputModificar' name='marca'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Oficina Ubicación</label>" +
                "<select id='selectOficinaEditarActivo'  class='inputModificar' name='oficina'> <option value=null>Oficina Ubicación</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Responsable del activo</label>" +
                "<select id='selectResponsableEditarActivo' class='inputModificar' name='id_responsable'> <option value=null>Responsable</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Usuario</label>" +
                "<select id='selectUsuarioEditarActivo'  class='inputModificar' name='id_usuario'> <option value=null>Usuario</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Funciona Correctamente</label>" +
                "<select  class='inputModificar' name='funciona_correctamente'> <option selected value=null>---</option> <option value=1>Sí</option> <option value=0>No</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Observación</label>" +
                "<textarea  class='inputModificar' name='observaciones'></textarea>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Estado</label>" +
                "<select id='selectEstadosEditarActivo' class='inputModificar' name='estado'> <option value=null>Estado</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Última Revisión</label>" +
                "<input class='inputModificar' type='date' name='fecha_ultima_revision'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Serial del activo</label>" +
                "<input class='inputModificar' name='serial'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Fecha de aceptación</label>" +
                "<input type='date' class='inputModificar' name='fecha_aceptacion'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Datos del proveedor</label>" +
                "<textarea class='inputModificar' name='datos_proveedor'></textarea>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Número de factura</label>" +
                "<input class='inputModificar' name='numero_factura'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Fecha de registro</label>" +
                "<input type='date' class='inputModificar' name='fecha_registro'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Es un computador</label>" +
                "<select class='inputModificar' name='es_computador'> <option selected value=null>---</option> <option value=1>Sí</option><option value=0>No</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre Computador</label>" +
                "<input class='inputModificar' name='nombre_equipo'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Tipo Computador</label>" +
                "<select class='inputModificar' name='tipo_escritorio_portatil'> <option value=''>Tipo Computador</option> <option value='ESCRITORIO'>Escritorio</option> <option value='PORTATIL'>Portátil</option> <option value='TODOENUNO'>Todo en uno</option> </select>" +
                "</div>" +
                "<label>MAC</label>" +
                "<input class='inputModificar' name='mac'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>IP</label>" +
                "<input class='inputModificar' name='ip'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Puerta de enlace</label>" +
                "<input class='inputModificar' name='ip_gateway'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Cantidad RAM</label>" +
                "<input class='inputModificar' name='capacidad_ram'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>C. de almacenamiento</label>" +
                "<input class='inputModificar' name='capacidad_almacenamiento'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Cantidad NIC inalambricas</label>" +
                "<input class='inputModificar' name='cantidad_tarjeta_red_inalambrica' ></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Cantidad NIC alambricas</label>" +
                "<input class='inputModificar' name='cantidad_tarjeta_red_alambrica'></input>" +
                "</div>" +
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_filtrar_inventario'  type='button'> Filtrar </button>" +
                "<button class='btn_eliminar' id='btn_cancelar_filtro_inventario'  type='button'> Cancelar </button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioFiltrarInventario);

            llenarSelect(
                "/oficinas_arreglo_llave_valor",
                "selectOficinaEditarActivo"
            );
            llenarSelect(
                "/personas_arreglo_llave_valor",
                "selectResponsableEditarActivo"
            );
            llenarSelect(
                "/personas_arreglo_llave_valor",
                "selectUsuarioEditarActivo"
            );
            llenarSelect(
                "/estados_arreglo_llave_valor",
                "selectEstadosEditarActivo"
            );
            llenarSelect(
                "/personas_arreglo_llave_valor",
                "selectUsuarioSolicitoEditarActivo"
            );

            //Enlazamos los eventos DESPUÉS DE CREAR EL FORMULARIO
            let this_context_component = this;
            $("#btn_filtrar_inventario").click(function() {
                this_context_component.filtrarInventario();
                $("[data-dismiss=modal]").trigger({ type: "click" });
            });

            $("#modalSGT").modal("toggle");
        },

        filtrarInventario() {
            let this_context_component = this;
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    Authorization: `Bearer ${localStorage.getItem(
                        "token_auth_api"
                    )}`
                },
                type: "POST",
                url: "filtrar_inventario",
                data: $("#formularioFiltrarInventario").serialize(),
                success: function(response) {
                    console.log("AQUI:\n");
                    console.log(response);
                    this_context_component.listarInventarioFiltrado(response);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(jqXHR);
                    console.log(errorThrown);
                    alert(
                        "Se produjo un error, por favor intenta nuevamente:\n" +
                            errorThrown
                    );
                }
            });
        },

        mostrarFormularioEditarActivo(e) {
            console.log($(e.relatedTarget).data("capacidad_ram"));

            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text(
                "Editar activo - " + $(e.relatedTarget).data("nombre")
            );

            var formularioEditarActivo =
                "<form id='formularioEditarActivo'>" +
                "<input name='id_activo' type='hidden' value='" +
                $(e.relatedTarget).data("id") +
                "'></input>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Número de Inventario</label>" +
                "<input class='inputModificar' name='numero_inventario' readonly='true' value='" +
                $(e.relatedTarget).data("numero_inventario") +
                "'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre</label>" +
                "<input class='inputModificar' name='nombre' value='" +
                $(e.relatedTarget).data("nombre") +
                "'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Marca</label>" +
                "<input class='inputModificar' name='maraca' value='" +
                $(e.relatedTarget).data("marca_referencia") +
                "'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Oficina Ubicación</label>" +
                "<select id='selectOficinaEditarActivo'  class='inputModificar' name='oficina'> <option value=null>Oficina Ubicación</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Responsable del activo</label>" +
                "<select id='selectResponsableEditarActivo' class='inputModificar' name='id_responsable'> <option value=null>Responsable</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Usuario</label>" +
                "<select id='selectUsuarioEditarActivo'  class='inputModificar' name='id_usuario'> <option value=null>Usuario</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Funciona Correctamente</label>" +
                "<select  class='inputModificar' name='funciona_correctamente'> <option value=1 selected=''>Sí</option> <option value=0>No</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Observación</label>" +
                "<textarea  class='inputModificar' name='observaciones'>" +
                $(e.relatedTarget).data("observaciones") +
                "</textarea>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Estado</label>" +
                "<select id='selectEstadosEditarActivo' class='inputModificar' name='estado'> <option value=null>Estado</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Última Revisión</label>" +
                "<input class='inputModificar' type='date' name='fecha_ultima_revision' value=" +
                $(e.relatedTarget).data("ultima_revision") +
                "></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Serial del activo</label>" +
                "<input class='inputModificar' name='serial' value=" +
                $(e.relatedTarget).data("serial") +
                "></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Fecha de aceptación</label>" +
                "<input type='date' class='inputModificar' name='fecha_aceptacion' value=" +
                $(e.relatedTarget).data("fecha_aceptacion") +
                "></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Costo inicial</label>" +
                "<input type='number' class='inputModificar' name='costo_inicial' value=" +
                $(e.relatedTarget).data("costo_inicial") +
                "></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Datos del proveedor</label>" +
                "<textarea  class='inputModificar' name='datos_proveedor'>" +
                $(e.relatedTarget).data("datos_proveedor") +
                "</textarea>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Fin Garantía</label>" +
                "<input type='date' class='inputModificar' name='fin_garantia' value=" +
                $(e.relatedTarget).data("fecha_fin_garantia") +
                "></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Número de factura</label>" +
                "<input class='inputModificar' name='numero_factura' value=" +
                $(e.relatedTarget).data("numero_factura") +
                "></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Último mantenimiento</label>" +
                "<input type='date' class='inputModificar' name='ultimo_mantenimiento' value=" +
                $(e.relatedTarget).data("ultimo_mantenimiento") +
                "></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Periodo mantenimiento (días)</label>" +
                "<input type='number' min='0' class='inputModificar' name='cada_cuantos_dias_mantenimiento' value=" +
                $(e.relatedTarget).data("cada_cuantos_dias_mantenimiento") +
                "></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Fecha de registro</label>" +
                "<input type='date' class='inputModificar' name='fecha_registro' value=" +
                $(e.relatedTarget).data("fecha_ingreso_al_sistema") +
                "></input>" +
                "</div>";

            if ($(e.relatedTarget).data("es_computador") === 1) {
                formularioEditarActivo +=
                    "<div class='contenedorInputFormulario'>" +
                    "<label>Es un computador</label>" +
                    "<select class='inputModificar' name='es_computador'> <option selected value=1>Sí</option><option value=0>No</option>  </select>" +
                    "</div>";
            } else {
                formularioEditarActivo +=
                    "<div class='contenedorInputFormulario'>" +
                    "<label>Es un computador</label>" +
                    "<select class='inputModificar' name='es_computador'> <option value=1>Sí</option><option selected value=0>No</option>  </select>" +
                    "</div>";
            }

            //Si es un computador, mostramos las propiedades del computador:
            if ($(e.relatedTarget).data("es_computador") === 1) {
                formularioEditarActivo +=
                    "<div class='contenedorInputFormulario'>" +
                    "<label>Nombre Computador</label>" +
                    "<input class='inputModificar' name='nombre_computador' value=" +
                    $(e.relatedTarget).data("nombre_computador") +
                    "></input>" +
                    "</div>" +
                    "<div class='contenedorInputFormulario'>" +
                    "<label>Tipo Computador</label>" +
                    "<select  class='inputModificar' name='tipo_escritorio_portatil'> <option value=''>Tipo Computador</option> <option value='ESCRITORIO'>Escritorio</option> <option value='PORTATIL'>Portátil</option> <option value='TODOENUNO'>Todo en uno</option> </select>" +
                    "</div>" +
                    "<div class='contenedorInputFormulario'>" +
                    "<label>MAC</label>" +
                    "<input class='inputModificar' name='mac' value=" +
                    $(e.relatedTarget).data("mac_address") +
                    "></input>" +
                    "</div>" +
                    "<div class='contenedorInputFormulario'>" +
                    "<label>IP</label>" +
                    "<input class='inputModificar' name='ip' value=" +
                    $(e.relatedTarget).data("ip_address") +
                    "></input>" +
                    "</div>" +
                    "<div class='contenedorInputFormulario'>" +
                    "<label>Puerta de enlace</label>" +
                    "<input class='inputModificar' name='ip_gateway' value=" +
                    $(e.relatedTarget).data("ip_gateway") +
                    "></input>" +
                    "</div>" +
                    "<div class='contenedorInputFormulario'>" +
                    "<label>Cantidad RAM</label>" +
                    "<input class='inputModificar' name='capacidad_ram' value=" +
                    $(e.relatedTarget).data("capacidad_ram") +
                    "></input>" +
                    "</div>" +
                    "<div class='contenedorInputFormulario'>" +
                    "<label>C. de almacenamiento</label>" +
                    "<input class='inputModificar' name='capacidad_almacenamiento' value=" +
                    $(e.relatedTarget).data("capacidad_almacenamiento") +
                    "></input>" +
                    "</div>" +
                    "<div class='contenedorInputFormulario'>" +
                    "<label>Cantidad NIC inalambricas</label>" +
                    "<input class='inputModificar' name='cantidad_tarjeta_red_inalambrica' value=" +
                    $(e.relatedTarget).data(
                        "cantidad_tarjeta_red_inalambrica"
                    ) +
                    "></input>" +
                    "</div>" +
                    "<div class='contenedorInputFormulario'>" +
                    "<label>Cantidad NIC alambricas</label>" +
                    "<input class='inputModificar' name='cantidad_tarjeta_red_alambrica' value=" +
                    $(e.relatedTarget).data("cantidad_tarjeta_red_alambrica") +
                    "></input>" +
                    "</div>";
            }

            formularioEditarActivo +=
                "<div class='contenedorInputFormulario'>" +
                "<label>¿Solicitado por?</label>" +
                "<select id='selectUsuarioSolicitoEditarActivo'  class='inputModificar' name='id_usuario_solicito'> <option value=null>Usuario</option>  </select>" +
                "</div>" +
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_cambios_activos'  type='button'> Guardar Cambios </button>" +
                "<button style='margin-left: 0.2em;' class='btn_guardar_cambios' id='btn_mostrarFormulario_addAnexo' value='" +
                $(e.relatedTarget).data("id") +
                "' type='button'> Anexar archivo </button>" +
                "<button class='btn_guardar_cambios' id='btn_listar_componentes_activo' style='margin-left: 0.2em;'  value='" +
                $(e.relatedTarget).data("id") +
                "' type='button'> Componentes </button>" +
                "<button class='btn_eliminar' id='btn_eliminar_activo'  type='button'> Eliminar</button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioEditarActivo);

            llenarSelect(
                "/oficinas_arreglo_llave_valor",
                "selectOficinaEditarActivo"
            );

            llenarSelect(
                "/personas_arreglo_llave_valor",
                "selectResponsableEditarActivo"
            );
            llenarSelect(
                "/personas_arreglo_llave_valor",
                "selectUsuarioEditarActivo"
            );
            llenarSelect(
                "/estados_arreglo_llave_valor",
                "selectEstadosEditarActivo"
            );
            llenarSelect(
                "/personas_arreglo_llave_valor",
                "selectUsuarioSolicitoEditarActivo"
            );

            //Enlazamos los eventos DESPUÉS DE CREAR EL FORMULARIO
            let this_context_component = this;
            $("#btn_guardar_cambios_activos").click(function() {
                this_context_component.guardarModificacionesActivos();
            });

            $("#btn_mostrarFormulario_addAnexo").click(function(event) {
                let id_activo_anexar = event.target.value;

                $("#modalSGTbody").empty();
                $("#modalSGTtitle").text(
                    "Anexar archivo a la información del activo"
                );

                let formularioAnexarArchivo =
                    '<form enctype="multipart/form-data" method="post" action="/activos/anexar_archivo">' +
                    '<input type="hidden"  name="_token" value=" ' +
                    $('meta[name="csrf-token"]').attr("content") +
                    ' ">' +
                    '<input type="hidden" readonly name="id_activo" value="' +
                    id_activo_anexar +
                    '">' +
                    'Reemplazar archivo con el mismo nombre <input type="checkbox" name="reemplazar_archivo"  value="REEMPLAZAR_ARCHIVO"> <br>' +
                    '<input type="file"  name="archivo"/>' +
                    '<input type="submit" value="Subir" class="button" >' +
                    "</form>";

                $("#modalSGTbody").append(formularioAnexarArchivo);
            });

            $("#btn_listar_componentes_activo").click(function(event) {
                var idActivoCompuesto = event.target.value;

                $.ajax({
                    url: "/activo/componentes-compuestode",
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token_auth_api"
                        )}`
                    },
                    data: { id_activo: idActivoCompuesto },
                    method: "GET",
                    success: function(result, status, xhr) {
                        let listaDeComponentes =
                            "<h3> Componentes del activo: </h3>" +
                            "<table>" +
                            "<tr> <th> Nombre </th> <th> # Inventario </th> <th> # Serial </th>  <th> quitar </th>  </tr>";
                        console.log(result);
                        result[0].forEach(function(element) {
                            let fila =
                                "<tr style='box-shadow: 0px 1px 1px 0px rgba(0,0,0,0.75);'>";

                            fila += "<td>" + element.nombre + "</td>";
                            fila +=
                                "<td>" + element.numero_inventario + "</td>";
                            fila += "<td>" + element.numero_serial + "</td>";

                            fila +=
                                "<td> <a href='/activo/" +
                                idActivoCompuesto +
                                "/eliminar-componente/" +
                                element.id +
                                "'> <i class='material-icons'>delete</i> </a> </td>";

                            fila += "</tr>";

                            listaDeComponentes += fila;
                        });

                        listaDeComponentes += "</table>";

                        if (result.length == 0) {
                            listaDeComponentes =
                                "El activo no tiene componentes todavía.";
                        }

                        $("#modalSGTbody").empty();
                        $("#modalSGTtitle").text(
                            "Editar componentes del activo"
                        );

                        let formulario =
                            '<form enctype="multipart/form-data" method="post" action="/activos/agregar-componente" style="text-align: center">' +
                            '<input type="hidden"  name="_token" value=" ' +
                            $('meta[name="csrf-token"]').attr("content") +
                            ' ">' +
                            '<input type="hidden" readonly name="id_activo" value="' +
                            idActivoCompuesto +
                            '">' +
                            "<select data-live-search='true' id='selectNumeroInventario' required  class='selectpicker' multiple name='idActivosComponentes[]'> <option value=null>Número de Inventario</option>  </select>" +
                            '<button class="btn btn-primary float-right" > Agregar </button>' +
                            "</form>";

                        llenarSelect(
                            "/inventario_arreglo_llave_valor",
                            "selectNumeroInventario"
                        );

                        $("#modalSGTbody").append(listaDeComponentes);
                        $("#modalSGTbody").append(formulario);
                    },

                    error: function(xhr) {
                        console.log(
                            "Request Status: " +
                                xhr.status +
                                " Status Text: " +
                                xhr.statusText +
                                " " +
                                xhr.responseText
                        );
                    }
                });
            });
        },

        guardarModificacionesActivos() {
            if ($(selectUsuarioSolicitoEditarActivo).val() == "null") {
                alert("debes llenar el campo: ¿Solicitado por?");

                $(selectUsuarioSolicitoEditarActivo).css(
                    "background-color",
                    "red"
                );

                return;
            }
            var inventarioComponentThis = this;
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    Authorization: `Bearer ${localStorage.getItem(
                        "token_auth_api"
                    )}`
                },
                type: "PUT",
                url: "activo",
                data: $("#formularioEditarActivo").serialize(),
                success: function(response) {
                    $("#modalSGTbody").empty();
                    $("#modalSGTtitle").text("Editar Activo");
                    $("#modalSGTbody").text(response);
                    inventarioComponentThis.listarInventario();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(jqXHR);
                    console.log(errorThrown);
                    alert(
                        "Se produjo un error, por favor intenta nuevamente:\n" +
                            errorThrown
                    );
                }
            });
        },

        mostrarFormularioCrearActivo() {
            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text("Crear activo");

            var formularioCrearActivo =
                "<form id='formularioCrearActivo'>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Número de Inventario</label>" +
                "<input class='inputModificar' name='numero_inventario'> </input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre</label>" +
                "<input class='inputModificar' name='nombre'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Marca</label>" +
                "<input class='inputModificar' name='marca_referencia'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Oficina Ubicación</label>" +
                "<select id='selectOficinaEditarActivo'  class='inputModificar' name='id_oficina'> <option value=null>Oficina Ubicación</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Responsable del activo</label>" +
                "<select id='selectResponsableEditarActivo' class='inputModificar' name='id_funcionario_responsable'> <option value=null>Responsable</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Usuario</label>" +
                "<select id='selectUsuarioEditarActivo'  class='inputModificar' name='id_usuario'> <option value=null>Usuario</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Funciona Correctamente</label>" +
                "<select  class='inputModificar' name='funciona_correctamente'> <option value=1 selected=''>Sí</option> <option value=0>No</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Observación</label>" +
                "<textarea  class='inputModificar' name='observaciones'> </textarea>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Estado</label>" +
                "<select id='selectEstadosEditarActivo' class='inputModificar' name='id_estado'> <option value=null>Estado</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Última Revisión</label>" +
                "<input class='inputModificar' type='date' name='fecha_ultima_revision'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Serial del activo</label>" +
                "<input class='inputModificar' name='numero_serial'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Fecha de aceptación</label>" +
                "<input type='date' class='inputModificar' name='fecha_aceptacion'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Costo inicial</label>" +
                "<input type='number' class='inputModificar' name='costo_inicial'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Datos del proveedor</label>" +
                "<textarea  class='inputModificar' name='datos_contacto_proveedor'> </textarea>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Fin Garantía</label>" +
                "<input type='date' class='inputModificar' name='fecha_fin_garantia'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Número de factura</label>" +
                "<input class='inputModificar' name='numero_factura'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Fecha de registro</label>" +
                "<input type='date' class='inputModificar' name='fecha_aceptacion' ></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Último mantenimiento</label>" +
                "<input type='date' class='inputModificar' name='ultimo_mantenimiento' ></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Periodo mantenimiento (días)</label>" +
                "<input type='number' min='0' class='inputModificar' name='cada_cuantos_dias_mantenimiento'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Es un computador</label>" +
                "<select id='selectEsComputador' class='inputModificar' name='es_computador'> <option  value=1>Sí</option><option selected value=0>No</option>  </select>" +
                "</div>" +
                "<div id='inputs_computador'>" +
                "</div>" +
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_activo'  type='button'> Guardar </button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioCrearActivo);

            llenarSelect(
                "/oficinas_arreglo_llave_valor",
                "selectOficinaEditarActivo"
            );
            llenarSelect(
                "/personas_arreglo_llave_valor",
                "selectResponsableEditarActivo"
            );
            llenarSelect(
                "/personas_arreglo_llave_valor",
                "selectUsuarioEditarActivo"
            );
            llenarSelect(
                "/estados_arreglo_llave_valor",
                "selectEstadosEditarActivo"
            );
            llenarSelect(
                "/personas_arreglo_llave_valor",
                "selectUsuarioSolicitoEditarActivo"
            );

            //Enlazamos los eventos DESPUÉS DE CREAR EL FORMULARIO
            let this_context_component = this;
            $("#btn_guardar_activo").click(function() {
                this_context_component.guardarActivo();
            });

            $("#modalSGT").modal("toggle");

            $("#selectEsComputador").on("change", function(e) {
                $("#inputs_computador").empty();

                if (e.target.value == 1) {
                    //Si cambia a es_un_computador
                    $("#inputs_computador").append(
                        "<div class='contenedorInputFormulario'>" +
                            "<label>Nombre Computador</label>" +
                            "<input class='inputModificar' name='nombre_computador'></input>" +
                            "</div>" +
                            "<div class='contenedorInputFormulario'>" +
                            "<label>Tipo Computador</label>" +
                            "<select  class='inputModificar' name='tipo_escritorio_portatil'> <option value=''>Tipo Computador</option> <option value='ESCRITORIO'>Escritorio</option> <option value='PORTATIL'>Portátil</option> <option value='TODOENUNO'>Todo en uno</option> </select>" +
                            "</div>" +
                            "<div class='contenedorInputFormulario'>" +
                            "<label>MAC</label>" +
                            "<input class='inputModificar' name='MACaddress'></input>" +
                            "</div>" +
                            "<div class='contenedorInputFormulario'>" +
                            "<label>IP</label>" +
                            "<input class='inputModificar' name='IPaddress'></input>" +
                            "</div>" +
                            "<div class='contenedorInputFormulario'>" +
                            "<label>Puerta de enlace</label>" +
                            "<input class='inputModificar' name='ip_puerta_enlace'></input>" +
                            "</div>" +
                            "<div class='contenedorInputFormulario'>" +
                            "<label>Cantidad RAM</label>" +
                            "<input class='inputModificar' name='capacidad_ram'></input>" +
                            "</div>" +
                            "<div class='contenedorInputFormulario'>" +
                            "<label>C. de almacenamiento</label>" +
                            "<input class='inputModificar' name='capacidad_almacenamiento'></input>" +
                            "</div>" +
                            "<div class='contenedorInputFormulario'>" +
                            "<label>Cantidad NIC inalambricas</label>" +
                            "<input class='inputModificar' name='cantidad_tarjeta_red_inalambrica'></input>" +
                            "</div>" +
                            "<div class='contenedorInputFormulario'>" +
                            "<label>Cantidad NIC alambricas</label>" +
                            "<input class='inputModificar' name='cantidad_tarjeta_red_alambrica'></input>" +
                            "</div>"
                    );
                }
            });
        },

        guardarActivo() {
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                    Authorization: `Bearer ${localStorage.getItem(
                        "token_auth_api"
                    )}`
                },
                type: "POST",
                url: "activos",
                data: $("#formularioCrearActivo").serialize(),
                success: function(response) {
                    $("#modalSGTbody").empty();
                    $("#modalSGTtitle").text("Crear Activo");
                    $("#modalSGTbody").text(response["mensaje"]);
                    location.reload();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(jqXHR);
                    console.log(errorThrown);
                    alert(
                        "Se produjo un error, por favor intenta nuevamente:\n" +
                            errorThrown
                    );
                }
            });
        }
    },

    mounted() {
        let this_context_component = this;

        this.listarInventario();

        $("#btn-listar-inventario").on("click", function(e) {
            this_context_component.listarInventario();
        });

        $("#btn-getFormulario-addActivo").on("click", function(e) {
            this_context_component.mostrarFormularioCrearActivo();
        });

        //$("#modalSGT").unbind("shown.bs.modal");
        $(document).on("show.bs.modal", "#modalSGT", function(e) {
            if (
                $(e.relatedTarget).data("id_metodo") ===
                "mas_informacion_activo"
            ) {
                this_context_component.mostrarMasInformacionDeActivo(e);
            }

            if ($(e.relatedTarget).data("id_metodo") === "editar_activo") {
                this_context_component.mostrarFormularioEditarActivo(e);
            }
        });

        $("#btn-getFormulario-subir-activos").on("click", function(e) {
            $.ajax({
                url: "/formulario_subir_activos",
                headers: {
                    Authorization: `Bearer ${localStorage.getItem(
                        "token_auth_api"
                    )}`
                },
                method: "GET",
                success: function(result, status, xhr) {
                    $("#modalSGTbody").empty();
                    $("#modalSGTtitle").text(
                        "Selecciona el formato para agregar activos"
                    );

                    $("#modalSGTbody").html(result.html);
                },

                error: function(xhr) {
                    console.log(
                        "Request Status: " +
                            xhr.status +
                            " Status Text: " +
                            xhr.statusText +
                            " " +
                            xhr.responseText
                    );
                }
            });

            $("#modalSGT").modal();
        });

        $("#btn-filtrar_tabla_activos").on("click", function() {
            this_context_component.mostrarFormularioFiltrarInventario();
        });
    }
};
