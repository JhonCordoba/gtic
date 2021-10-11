<template>
    <div>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item">
                <a
                    class="nav-link active"
                    id="home-tab"
                    data-toggle="tab"
                    href="#seccionConfiguracionDependencias"
                    role="tab"
                    aria-controls="home"
                    aria-selected="true"
                    >Dependencias</a
                >
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    id="profile-tab"
                    data-toggle="tab"
                    href="#seccionConfiguracionCargos"
                    role="tab"
                    aria-controls="profile"
                    aria-selected="false"
                    >Cargos</a
                >
            </li>
            <li class="nav-item">
                <a
                    class="nav-link"
                    id="contact-tab"
                    data-toggle="tab"
                    href="#seccionConfiguracionEdificios"
                    role="tab"
                    aria-controls="contact"
                    aria-selected="false"
                    >Edificios</a
                >
            </li>

            <li class="nav-item">
                <a
                    class="nav-link"
                    id="contact-tab"
                    data-toggle="tab"
                    href="#seccionConfiguracionOficinas"
                    role="tab"
                    aria-controls="contact"
                    aria-selected="false"
                    >Oficinas</a
                >
            </li>

            <li class="nav-item">
                <a
                    class="nav-link"
                    id="contact-tab"
                    data-toggle="tab"
                    href="#seccionConfiguracionEstadosActivos"
                    role="tab"
                    aria-controls="contact"
                    aria-selected="false"
                    >Estados de Activos</a
                >
            </li>

            <li class="nav-item">
                <a
                    class="nav-link"
                    id="contact-tab"
                    data-toggle="tab"
                    href="#seccionConfiguracionTiposTareas"
                    role="tab"
                    aria-controls="contact"
                    aria-selected="false"
                    >Tareas</a
                >
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <div
                class="tab-pane fade show active"
                id="seccionConfiguracionDependencias"
                role="tabpanel"
                aria-labelledby="home-tab"
            >
                <!--CONTENT PANE 1-->
                <dependencias-configuracion> </dependencias-configuracion>
                <!---->
            </div>

            <div
                class="tab-pane fade"
                id="seccionConfiguracionCargos"
                role="tabpanel"
                aria-labelledby="profile-tab"
            >
                <!--CONTENT PANE 2-->
                <cargos-configuracion> </cargos-configuracion>
                <!---->
            </div>
            <div
                class="tab-pane fade"
                id="seccionConfiguracionEdificios"
                role="tabpanel"
                aria-labelledby="contact-tab"
            >
                <!--CONTENT PANE 3-->
                <edificios-configuracion> </edificios-configuracion>
                <!---->
            </div>

            <div
                class="tab-pane fade"
                id="seccionConfiguracionOficinas"
                role="tabpanel"
                aria-labelledby="contact-tab"
            >
                <!--CONTENT PANE 4-->
                <oficinas-configuracion> </oficinas-configuracion>
                <!---->
            </div>

            <div
                class="tab-pane fade"
                id="seccionConfiguracionEstadosActivos"
                role="tabpanel"
                aria-labelledby="contact-tab"
            >
                <!--CONTENT PANE 5-->
                <estados-configuracion> </estados-configuracion>
                <!---->
            </div>

            <div
                class="tab-pane fade"
                id="seccionConfiguracionTiposTareas"
                role="tabpanel"
                aria-labelledby="contact-tab"
            >
                <!--CONTENT PANE 6-->
                <tareas-configuracion> </tareas-configuracion>
                <!---->
            </div>
        </div>
    </div>
</template>

<script>
import { llenarSelect } from "../../helpers/selects.js";
import DependenciasConfiguracion from "./components/DependenciasConfiguracion.vue";
import CargosConfiguracion from "./components/CargosConfiguracion.vue";
import EdificiosConfiguracion from "./components/EdificiosConfiguracion";
import OficinasConfiguracion from "./components/OficinasConfiguracion";
import EstadosConfiguracion from "./components/EstadosConfiguracion";
import TareasConfiguracion from "./components/TareasConfiguracion";
export default {
    name: "ConfiguracionGTIC",

    components: {
        "dependencias-configuracion": DependenciasConfiguracion,
        "cargos-configuracion": CargosConfiguracion,
        EdificiosConfiguracion,
        OficinasConfiguracion,
        EstadosConfiguracion,
        TareasConfiguracion
    },

    mounted() {

        let this_context_component = this;
            
        $(document).on("shown.bs.modal", "#modalSGT", function(e) {

            if ($(e.relatedTarget).data("id_metodo") === "agregar_dependencia") {
                this_context_component.mostrarFormularioAgregarDependencia();
            }

            if ($(e.relatedTarget).data("id_metodo") === "agregar_cargo") {
                this_context_component.mostrarFormularioAgregarCargo();
            }

            if ($(e.relatedTarget).data("id_metodo") === "agregar_edificio") {
                this_context_component.mostrarFormularioAgregarEdificio();
            }

            if ($(e.relatedTarget).data("id_metodo") === "agregar_oficina") {
                this_context_component.mostrarFormularioAgregarOficina();
            }

            if (
                $(e.relatedTarget).data("id_metodo") === "agregar_estado_activo"
            ) {
                this_context_component.mostrarFormularioAgregarEstado();
            }

            if ($(e.relatedTarget).data("id_metodo") === "agregar_tipo_tarea") {
                this_context_component.mostrarFormularioAgregarTipoTarea();
            }
        });
    },

    methods: {
        mostrarFormularioAgregarTipoTarea() {
            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text("Crear Tipo de Actividad");

            var formularioCrearTipoTarea =
                "<form id='formularioCrearTipoTarea'>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre Tipo de Actividad</label>" +
                "<input class='inputModificar' name='nombre' required></input>" +
                "</div>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Descripción</label>" +
                "<textarea class='inputModificar' name='descripcion'></textarea>" +
                "</div>" +
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_tipoTarea'  type='button'>Guardar</button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioCrearTipoTarea);

            $("#btn_guardar_tipoTarea").on("click", function() {
                $.ajax({
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token_auth_api"
                        )}`,
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        )
                    },
                    type: "POST",
                    url: "tipo_tareas",
                    data: $("#formularioCrearTipoTarea").serialize(),
                    success: function(response) {
                        console.log(response);
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(jqXHR);
                        console.log(errorThrown);
                        alert(
                            "Se produjo un error, por favor intenta nuevamente"
                        );
                    }
                });
            });
        },

        mostrarFormularioAgregarDependencia() {
            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text("Crear dependencia");

            var formularioEditarActivo =
                "<form id='formularioCrearDependencia'>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre Dependencia</label>" +
                "<input class='inputModificar' name='nombreDependencia' required></input>" +
                "</div>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Descripción</label>" +
                "<textarea class='inputModificar' name='descripcionDependencia' required></textarea>" +
                "</div>" +
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_dependencia'  type='button'>Guardar</button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioEditarActivo);

            $("#btn_guardar_dependencia").on("click", function() {
                $.ajax({
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token_auth_api"
                        )}`,
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        )
                    },
                    type: "POST",
                    url: "dependencias",
                    data: $("#formularioCrearDependencia").serialize(),
                    success: function(response) {
                        console.log(response);

                        if (response.mensaje != null) {
                            alert(response.mensaje);
                        }

                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(jqXHR);
                        console.log(errorThrown);
                        alert(
                            "Se produjo un error, por favor intenta nuevamente"
                        );
                    }
                });
            });
        },
        mostrarFormularioAgregarCargo() {
            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text("Crear Cargo");

            var formularioEditarActivo =
                "<form id='formularioCrearCargo'>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre Cargo</label>" +
                "<input class='inputModificar' name='nombreCargo' required></input>" +
                "</div>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Descripción</label>" +
                "<textarea class='inputModificar' name='descripcionCargo' required></textarea>" +
                "</div>" +
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_cargo'  type='button'>Guardar</button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioEditarActivo);

            $("#btn_guardar_cargo").on("click", function() {
                $.ajax({
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token_auth_api"
                        )}`,
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        )
                    },
                    type: "POST",
                    url: "cargos",
                    data: $("#formularioCrearCargo").serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response.mensaje != null) {
                            alert(response.mensaje);
                        }
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(jqXHR);
                        console.log(errorThrown);
                        alert(
                            "Se produjo un error, por favor intenta nuevamente"
                        );
                    }
                });
            });
        },

        mostrarFormularioAgregarEdificio() {
            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text("Crear Edificio");

            var formularioEditarActivo =
                "<form id='formularioCrearEdificio'>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre Edificio</label>" +
                "<input class='inputModificar' name='nombreEdificio' required></input>" +
                "</div>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Dirección Edificio</label>" +
                "<input class='inputModificar' name='direccionEdificio' required></input>" +
                "</div>" +
                "</div>" +
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_edificio'  type='button'>Guardar</button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioEditarActivo);

            $("#btn_guardar_edificio").on("click", function() {
                $.ajax({
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token_auth_api"
                        )}`,
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        )
                    },
                    type: "POST",
                    url: "edificios",
                    data: $("#formularioCrearEdificio").serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response.mensaje != null) {
                            alert(response.mensaje);
                        }
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(jqXHR);
                        console.log(errorThrown);
                        alert(
                            "Se produjo un error, por favor intenta nuevamente"
                        );
                    }
                });
            });
        },

        mostrarFormularioAgregarOficina() {
            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text(
                "Crear Oficina",
                "selectEdificiosAgregarOficina"
            );

            var formularioAgregarOficina =
                "<form id='formularioCrearOficina'>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre Oficina</label>" +
                "<input class='inputModificar' name='nombreOficina' required></input>" +
                "</div>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Edificio</label>" +
                "<select id='selectEdificiosAgregarOficina' class='inputModificar' name='edificio'><option value=null>Edificio</option> </select>" +
                "</div>" +
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_oficina'  type='button'>Guardar</button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioAgregarOficina);

            $("#btn_guardar_oficina").on("click", function() {
                $.ajax({
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token_auth_api"
                        )}`,
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        )
                    },
                    type: "POST",
                    url: "oficinas",
                    data: $("#formularioCrearOficina").serialize(),
                    success: function(response) {
                        if (
                            response.mensaje != null &&
                            response.mensaje != ""
                        ) {
                            alert(response.mensaje);
                            return;
                        }

                        console.log(response);
                        if (response.mensaje != null) {
                            alert(response.mensaje);
                        }
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(jqXHR);
                        console.log(errorThrown);
                        alert(
                            "Se produjo un error, por favor intenta nuevamente"
                        );
                    }
                });
            });

            llenarSelect(
                "/edificios_arreglo_llave_valor",
                "selectEdificiosAgregarOficina"
            );
        },

        mostrarFormularioAgregarEstado() {
            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text("Crear Estado");

            var formularioEditarActivo =
                "<form id='formularioCrearEstado'>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre Estado</label>" +
                "<input class='inputModificar' name='nombre' required></input>" +
                "</div>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Descripción</label>" +
                "<textarea id='textareaDescripcionEstado' class='inputModificar' name='descripcion'></textarea>" +
                "</div>" +
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_estado'  type='button'>Guardar</button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioEditarActivo);

            $("#btn_guardar_estado").on("click", function() {
                if ($("#textareaDescripcionEstado").val() == "") {
                    alert("Debes agregar una descripción");
                    $("#textareaDescripcionEstado").css(
                        "background-color",
                        "red"
                    );
                    return;
                }

                $.ajax({
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token_auth_api"
                        )}`,
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        )
                    },
                    type: "POST",
                    url: "estados",
                    data: $("#formularioCrearEstado").serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response.mensaje != null) {
                            alert(response.mensaje);
                        }
                        $("[data-dismiss=modal]").trigger({ type: "click" });
                        location.reload();
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(jqXHR);
                        console.log(errorThrown);
                        alert(
                            "Se produjo un error, por favor intenta nuevamente"
                        );
                    }
                });
            });
        }
    }
};
</script>
