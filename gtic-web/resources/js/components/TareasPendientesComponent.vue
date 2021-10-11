<template>
    <div>
        <p style="margin-bottom: 0;  font-size: 1.5em; font-style: bold;">Notificaciones</p>
        <div class="row mb-3">
            
            <div class="col" :key="tareaPendiente.id" v-for="tareaPendiente in tareasPendientes" :id="tareaPendiente.id">
                <div class="card">
                    <div class="card-body" style="text-align: center;">
                        <h5 class="card-title"> {{ tareaPendiente.titulo }} </h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ tareaPendiente.asignadaPor }}</h6>
                        <p class="card-text">{{ tareaPendiente.descripcion }}</p>
                        <i class="material-icons card-link" :value="tareaPendiente.id" v-on:click="marcarTareaComoRealizada($event)" title="Marcar tarea como realizada">done_all</i>
                    </div>
                </div>
            </div>

        </div>
    </div>    
</template>

<script>
    import {getTareasPendientes} from '../services/TareasService';
    export default {
        name: 'TareasPendientesComponent',
        data() {
            return {
                tareasPendientes: []
            }
        },
        methods: {
            marcarTareaComoRealizada: function(e) {

                //let id_tarea = e.target.attributes.value.nodeValue;
                if(e.target.attributes.value.nodeValue == -1){
                    alert("Debes actualizar la fecha del último mantenimiento de este activo\npara quitar la notificación");
                    return;
                }

                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        Authorization: `Bearer ${localStorage.getItem("token_auth_api")}`
                    },
                    type: "post",
                    url: "marcar_tarea_realizada",
                    data: {id_tarea: e.target.attributes.value.nodeValue},
                    success: function (response) {

                        $("#" + e.target.attributes.value.nodeValue).fadeOut(500);

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
        created() {
            getTareasPendientes().then(response => {
                console.log(response);
                this.tareasPendientes = response.data;
            }).catch(err => console.log(err))
        }
    }
</script>