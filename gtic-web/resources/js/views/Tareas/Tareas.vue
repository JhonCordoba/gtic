<template>
    <crudtable-component
        fetch-url="/tareas"
        :columns="[
            '¿Finalizada?',
            'Título',
            'Descripción',
            'Asignada Por',
            'Asignada a',
            'Tiempo Requerido',
            'Categoría',
            'Fecha creación',
            'id'
        ]"
        :botonesporelemento="[
            '<i class=\'material-icons\' title=\'Editar\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'editar_tarea\' >edit</i>'
        ]"
        :botonestoptabla="[
            '<i class=\'material-icons\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'agregar_tarea\'  title=\'Agregar tarea\'>add_circle</i>'
        ]"
        name="tareas"
    >
    </crudtable-component>
</template>

<script>
window.$ = window.jQuery = require("jquery");
import { llenarSelect } from "../../helpers/selects.js";
import { isAuthenticated } from "../../helpers/login.js";

export default {
    name: "TareasView",
    methods: {
        mostrarFormularioCrearTarea() {
            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text("Crear Tarea");
            let formulario =
                "<form id='formularioCrearTarea'>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Categoría</label>" +
                "<select id='selectCategoriasTareas' class='inputModificar' name='categoria'> <option value='null'>Tipo de tarea</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario' >" +
                "<label>Asignar a:</label>" +
                "<select id='selectUsuario_asignar' class='inputModificar' name='usuario_asignar'> <option value=-1>Mí persona :D</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Título</label>" +
                "<input class='inputModificar' name='titulo' ></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Descripción</label>" +
                "<textarea  class='inputModificar' name='descripcion'> </textarea>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Tiempo requerido (Minutos)</label>" +
                "<input class='inputModificar' type='number' name='tiempo_requerido_minutos' value='0'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario' >" +
                "<label>¿Finalizada?</label>" +
                "<select  class='inputModificar' name='finalizada'> <option value=0>No</option><option value=1>Sí</option>  </select>" +
                "</div>";

            formulario +=
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_tarea'  type='button'> Guardar </button>" +
                "</form> ";

            $("#modalSGTbody").append(formulario);

            llenarSelect(
                "/personas_arreglo_llave_valor",
                "selectUsuario_asignar"
            );
            llenarSelect(
                "/categoriasTareas_arreglo_llave_valor",
                "selectCategoriasTareas"
            );

            $("#btn_guardar_tarea").on("click", function() {
                if ($("#selectCategoriasTareas").val() == "null") {
                    alert("Debes seleccionar el tipo de tarea");
                    return;
                }

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
                    url: "tareas",
                    data: $("#formularioCrearTarea").serialize(),
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

        mostrarFormularioEditarTarea(e) {
            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text("Editar Tarea");
            var formularioEditarTarea =
                "<form id='formularioEditarTarea'>" +
                "<input  name='id' type='hidden' value='" +
                $(e.relatedTarget).data("id") +
                "'> </input>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Categoría</label>" +
                "<select id='selectCategoriasTareas' class='inputModificar' name='categoria'> <option value=-1>Tipo de tarea</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario' >" +
                "<label>Asignar a:</label>" +
                "<select id='selectUsuario_asignar' class='inputModificar' name='usuario_asignar'> <option value=-1>Mí persona :D</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Título</label>" +
                "<input class='inputModificar' name='titulo' value='" +
                $(e.relatedTarget).data("título") +
                "'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario ajustadoAtextArea'>" +
                "<label>Descripción</label>" +
                "<textarea  class='inputModificar' name='descripcion'> " +
                $(e.relatedTarget).data("descripción") +
                " </textarea>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Tiempo requerido (Minutos)</label>" +
                "<input class='inputModificar' type='number' name='tiempo_requerido_minutos' value='" +
                $(e.relatedTarget).data("tiemporequerido") +
                "'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario' >" +
                "<label>¿Finalizada?</label>" +
                "<select class='inputModificar' name='finalizada'> <option value=0>No</option><option value=1>Sí</option>  </select>" +
                "</div>";

            formularioEditarTarea +=
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_edicion_tarea'  type='button'> Guardar </button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioEditarTarea);

            llenarSelect(
                "/personas_arreglo_llave_valor",
                "selectUsuario_asignar"
            );
            llenarSelect(
                "/categoriasTareas_arreglo_llave_valor",
                "selectCategoriasTareas"
            );

            $("#btn_guardar_edicion_tarea").on("click", function() {
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
                    url: "tareas",
                    data: $("#formularioEditarTarea").serialize(),
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
        isAuthenticated
    },
    mounted() {
        let this_component = this;

        $(document).on("show.bs.modal", "#modalSGT", function(e) {
            if ($(e.relatedTarget).data("id_metodo") === "agregar_tarea") {
                this_component.mostrarFormularioCrearTarea();
            }

            if ($(e.relatedTarget).data("id_metodo") === "editar_tarea") {
                this_component.mostrarFormularioEditarTarea(e);
            }
        });
    },
    created() {

    }
};
</script>
