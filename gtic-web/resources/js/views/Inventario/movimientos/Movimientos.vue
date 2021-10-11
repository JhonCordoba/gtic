<template>
    
    <crudtable-component
        fetch-url='/movimientos' 
        :columns="['Solicitado por', 'Nombre Activo', 'Observaciones', 'Fecha', '¿Prestamo Finalizado?']"
        :botonesporelemento="['<i class=\'material-icons\' title=\'Editar\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'editar_movimiento\' >edit</i>']"
        :botonestoptabla="[ '<i class=\'material-icons\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'registrar_movimiento\'  title=\'Registrar Prestamo\'>add_circle</i>']"
        name='Movimientos y prestamos'>
    </crudtable-component> 

</template>

<script>

window.$ = window.jQuery = require('jquery');
import {llenarSelect} from '../../../helpers/selects.js'; 

export default{
    
name: 'MovimientoView',
methods: {

    mostrarFormularioCrearMovimiento() {



        $("#modalSGTbody").empty();
        $("#modalSGTtitle").text("Registrar Prestamo");
        var formularioCrearMovimiento = "<form id='formularioCrearMovimiento'>"
        
        
                + "<input type='hidden' name='yaDevuelto' value=0></input>"

                + "<div class='contenedorInputFormulario'>"
                + "<label>#Inventario del Activo</label>"
                + "<div style='padding: 0; margin: 0; float: right;'>"       
                + "<select data-live-search='true' id='selectNumeroInventario'  class='selectpicker' multiple name='id_activos[]'> <option value=null>Número de Inventario</option>  </select>"
                + "</div>"       
                + "</div>"          

                + "<div  style='margin-top: 1em;' class='contenedorInputFormulario'>"
                + "<label>Solicitado por:</label>"
                + "<div style='padding: 0; margin: 0; float: right;'>" 
                + "<select  data-live-search='true' id='selectSolitadoPor' class='selectpicker' name='idUsuarioSolicito'> <option value=null>Solicitado por:</option>  </select>"
                + "</div>" 
        

                + "<div style='margin-top: 1em;' class='contenedorInputFormulario ajustadoAtextArea'>"
                + "<label>Observación</label>"
                + "<textarea  class='inputModificar' name='observaciones'></textarea>"
                + "</div>"

                + "<div style='margin-top: 1em;' class='contenedorInputFormulario'>"
                + "<label>Firma recibido</label>"
                + "<input id='password_recibido' placeholder='****' type='password' class='inputModificar' name='password_recibido'></input>"
                + "</div>"

                +"<div id='container_change_password' style='display: none;'"

                    +"<hr> <label style='color: red; text-align: center; width: 100%; font-size: 1.5em; margin-top: 1em; box-shadow: 0px 0px 5px 0px rgba(255,0,0,1);'>CAMBIO DE CONTRASEÑA REQUERIDA</label><hr>"
                    +"<div  style='' class='contenedorInputFormulario'>"
                    +"<label>Contraseña Nueva:</label>"
                    +"<input id='password_nueva' type='password' placeholder='Ingresa la nueva contraseña' class='inputModificar' name='password_nueva'></input>"
                    +"</div>"

                    +"<div  style='margin-top: 1em;' class='contenedorInputFormulario'>"
                    +"<label>Confirma la contraseña:</label>"
                    +"<input id='password_nueva_confirmacion' type='password' placeholder='Vuelve a ingresar la contraseña' class='inputModificar' name='password_nueva_confirmacion'></input>"
                    +"</div>"

                +"</div>";



        formularioCrearMovimiento +=
                "<hr/>"
                + "<button class='btn_guardar_cambios' id='btn_guardar_prestamo'  type='button'> Guardar </button>"
                + "</form> ";

        $("#modalSGTbody").append(formularioCrearMovimiento);
        
        llenarSelect("/personas_arreglo_llave_valor", "selectSolitadoPor");
        llenarSelect("/inventario_arreglo_llave_valor", "selectNumeroInventario");

        $("#selectSolitadoPor").on("change", this.mostrarCamposCambiarPassword );


        $("#btn_guardar_prestamo").on("click", function () {

            if( $("#password_recibido").val() == "1234" ){
                alert("El profesor requiere cambiar la contraseña por defecto");
                return;
            }

            if( $("#password_nueva").val() != $("#password_nueva_confirmacion").val() ){
                alert("Las contraseñas nuevas no coinciden");
                return;
            }

            if( $("#password_nueva").val() == "1234" ){
                alert("La contraseña nueva no debe ser 1234");
                $("#password_nueva_confirmacion").val("");
                $("#password_nueva").val("");
                return;            
            }
            
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'Authorization' : `Bearer ${localStorage.getItem("token_auth_api")}`
                },            
                type: "POST",
                url: "movimientos",
                data: $("#formularioCrearMovimiento").serialize(),
                success: function (response) {
                    console.log(response);
                    
                    //-1: Código de error para no autorizado
                    switch( response["codigo"] ){
                        case -1:
                            alert(response["mensaje"]);
                            console.log(response["mensaje"]);
                        break;
                        
                        case -2:
                            alert(response["mensaje"]);
                            $("#password_recibido").css("background-color", "red");                        
                        break;
                        
                        case -3:
                            alert(response["mensaje"]);
                        break;

                        case -4: //Muestra el mensaje y desaparece el modal
                            alert(response["mensaje"]);
                            $("[data-dismiss=modal]").trigger({ type: "click" });
                        break;

                        
                        default:
                            $("[data-dismiss=modal]").trigger({ type: "click" });
                        break;
                    }
                    
                    location.reload();

                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus);
                    console.log(jqXHR);
                    console.log(errorThrown);
                    alert("Se produjo un error, por favor intenta nuevamente");
                }

            });

        });

    },

    mostrarFormularioEditarMovimiento(e){
        $("#modalSGTbody").empty();
        $("#modalSGTtitle").text("Editar/registrar finalización de prestamo");
        let observaciones = $(e.relatedTarget).data("observaciones");
        if(observaciones == null)
            observaciones = "";

        var formularioEditarMovimiento =
                "<form id='formularioEditarMovimiento'>"
                
                + "<div class='contenedorInputFormulario'>"
                + "<label>Nombre-Inventario-id_movimiento</label>"
                + "<input class='inputModificar'  name='id_movimiento' readonly='true' value='" + $(e.relatedTarget).data("nombreactivo") + "'></input>"
                + "</div>"

                + "<div class='contenedorInputFormulario'>"
                + "<label>¿Solicitado por?</label>"
                + "<select id='selectUsuarioSolicitadoPor' class='inputModificar' name='id_usuario_solicitado_por'> <option value=null>Usuario</option>  </select>"
                + "</div>"
        
                + "<div class='contenedorInputFormulario ajustadoAtextArea'>"
                + "<label>Observaciones</label>"
                + "<textarea  class='inputModificar' name='observaciones'>" + observaciones + "</textarea>"
                + "</div>";
        
                if( $(e.relatedTarget).data("¿prestamofinalizado?") != "---" ){
                    
                    formularioEditarMovimiento +=
                    "<div class='contenedorInputFormulario'>"
                    + "<label>¿Prestamo finalizado?</label>"
                    + "<select  class='inputModificar' name='ya_devuelto'>  <option value=1 selected=''>Sí</option> <option value=0>No</option>  </select>"
                    + "</div>";                
                }
        
                formularioEditarMovimiento +=

                "<hr/>"
                + "<button class='btn_guardar_cambios' id='btn_guardar_cambios_movimiento'  type='button'> Guardar Cambios </button>"

                + "</form> ";


        
        $("#modalSGTbody").append(formularioEditarMovimiento);

        llenarSelect("/personas_arreglo_llave_valor", "selectUsuarioSolicitadoPor");

        let this_context_component = this;

        //Enlazamos los eventos DESPUÉS DE CREAR EL FORMULARIO
        $("#btn_guardar_cambios_movimiento").click(function () {
            this_context_component.guardarModificacionesMovimiento();
        });    
        
    },

     guardarModificacionesMovimiento() {

        $.ajax({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization' : `Bearer ${localStorage.getItem("token_auth_api")}`
            },
            type: "PUT",
            url: "movimientos",
            data: $("#formularioEditarMovimiento").serialize(),
            success: function (response) {
                $("[data-dismiss=modal]").trigger({ type: "click" });
                location.reload();
                if(response.mensaje != null){
                    alert(response.mensaje);
                }
                
                
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                console.log(jqXHR);
                console.log(errorThrown);
                alert("Se produjo un error, por favor intenta nuevamente");
            }
        });
    },

    mostrarCamposCambiarPassword(){


        let id_user = $("#selectSolitadoPor").val();

        $.ajax({
                        
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Authorization' : `Bearer ${localStorage.getItem("token_auth_api")}`
            },
            
            type: "POST",
            url: "users/check_change_password/" + id_user,
            data: {},
            success: function (response) {
                console.log(response);

                if(response.mensaje != null){
                    alert(response.mensaje);
                }

                //Si no ha cambiado la contraseña
                if(response === false){

                    $("#password_recibido").prop('disabled', true);
                    $("#container_change_password").show();

                }
                            
            },

            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus);
                console.log(jqXHR);
                console.log(errorThrown);
                alert("Se produjo un error, por favor intenta nuevamente");
            }

        }); 

    }


},
mounted(){

    let this_context_component = this;

    $(document).on('show.bs.modal', '#modalSGT', function (e) {

        if ($(e.relatedTarget).data('id_metodo') === "registrar_movimiento") {
            this_context_component.mostrarFormularioCrearMovimiento();
        }
        
        if ($(e.relatedTarget).data('id_metodo') === "editar_movimiento") {
            this_context_component.mostrarFormularioEditarMovimiento(e);
        }        
    });
}

}
</script>

