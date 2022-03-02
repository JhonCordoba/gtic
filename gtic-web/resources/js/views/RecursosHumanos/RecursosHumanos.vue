<template>
    <crudtable-component
        fetch-url="/users"
        :columns="[
            'ID',
            'Nombre',
            'Email',
            'Dependencia',
            'Rol',
            'Cargo',
            'Celular',
            'Dirección',
            'Cédula'
        ]"
        :botonesporelemento="[
            '<i class=\'material-icons\' title=\'Editar\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'editar_persona\' >edit</i>'
        ]"
        :botonestoptabla="[
            '<i class=\'material-icons\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'agregar_persona\'  title=\'Agregar persona\'>add_circle</i>'
        ]"
        name="usuarios"
    >
    </crudtable-component>
</template>

<script>
window.$ = window.jQuery = require("jquery");
import { llenarSelect } from "../../helpers/selects.js";

export default {
    methods: {
        mostrarFormularioAgregarPersona() {
            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text("Crear Personal");
            var formularioEditarActivo =
                "<form id='formularioCrearPersona'>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre</label>" +
                "<input class='inputModificar' name='name'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Email</label>" +
                "<input type='email' class='inputModificar' name='email' ></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Dependencia</label>" +
                "<select id='selectDependenciasEditarPersona' class='inputModificar' name='dependencia'> <option>Dependencia</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario' >" +
                "<label>Rol</label>" +
                "<select id='selectRolesEditarPersona' class='inputModificar' name='rol'> <option value=-1>Rol</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Cargo</label>" +
                "<select id='selectCargosEditarPersona'  class='inputModificar' name='cargo'> <option>Cargo</option>  </select>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Celular</label>" +
                "<input class='inputModificar' name='celular'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Cédula</label>" +
                "<input class='inputModificar' name='cedula' ></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Dirección</label>" +
                "<input class='inputModificar' name='direccion' ></input>" +
                "</div>";

            formularioEditarActivo +=
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_persona'  type='button'> Guardar </button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioEditarActivo);

            llenarSelect(
                "/dependencias_arreglo_llave_valor",
                "selectDependenciasEditarPersona"
            );
            llenarSelect(
                "/roles_arreglo_llave_valor",
                "selectRolesEditarPersona"
            );
            llenarSelect(
                "/cargos_arreglo_llave_valor",
                "selectCargosEditarPersona"
            );

            $("#btn_guardar_persona").on("click", function() {
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
                    url: "users",
                    data: $("#formularioCrearPersona").serialize(),
                    success: function(response) {
                        console.log(response);
                        if (response.mensaje != null) {
                            alert(response.mensaje);
                        }
                        $("[data-dismiss=modal]").trigger({
                            type: "click"
                        });
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

        mostrarFormularioEditarPersona(e) {
            $("#modalSGTbody").empty();
            $("#modalSGTtitle").text(
                "Actualizar datos de " + $(e.relatedTarget).data("nombre")
            );
            var formularioEditarActivo =
                "<form id='formularioEditarPersona'>" +
                "<input name='id_persona' type='hidden' value='" +
                $(e.relatedTarget).data("id") +
                "'></input>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Nombre</label>" +
                "<input class='inputModificar' name='name' value='" +
                $(e.relatedTarget).data("nombre") +
                "'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Email</label>" +
                "<input type='email' class='inputModificar' name='email' value='" +
                $(e.relatedTarget).data("email") +
                "'></input>" +
                "</div>" +
                "<div class='contenedorInputFormulario'>" +
                "<label>Contraseña</label>" +
                "<input class='inputModificar' type='password' name='password' placeholder='***' ></input>" +
                "</div>";

            formularioEditarActivo +=
                "<hr/>" +
                "<button class='btn_guardar_cambios' id='btn_guardar_cambios_persona'  type='button'> Guardar Cambios </button>" +
                "<button class='btn_eliminar' id='btn_eliminar_persona'  type='button'>Eliminar</button>" +
                "</form> ";

            $("#modalSGTbody").append(formularioEditarActivo);

            $("#btn_guardar_cambios_persona").on("click", function() {
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
                    url: "users",
                    data: $("#formularioEditarPersona").serialize(),
                    success: function(response) {
                        console.log(response);

                        if (response.mensaje != null) {
                            alert(response.mensaje);
                        }

                        $("[data-dismiss=modal]").trigger({
                            type: "click"
                        });
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
                "/dependencias_arreglo_llave_valor",
                "selectDependenciasEditarPersona"
            );
            llenarSelect(
                "/roles_arreglo_llave_valor",
                "selectRolesEditarPersona"
            );
            llenarSelect(
                "/cargos_arreglo_llave_valor",
                "selectCargosEditarPersona"
            );
        }
    },

    mounted() {
        let this_context_component = this;

        $(document).on("show.bs.modal", "#modalSGT", function(e) {
            if ($(e.relatedTarget).data("id_metodo") === "editar_persona") {
                this_context_component.mostrarFormularioEditarPersona(e);
            }

            if ($(e.relatedTarget).data("id_metodo") === "agregar_persona") {
                this_context_component.mostrarFormularioAgregarPersona();
            }
        });
    }
};
</script>

<style scoped></style>
