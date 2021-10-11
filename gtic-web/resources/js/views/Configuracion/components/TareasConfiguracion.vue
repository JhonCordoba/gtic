<template>
    <div class="seccion_configuracion">
        <p
            class="titulo_seccion_configuracion"
            title="Lista de tipo de actividades realizadas"
        >
            Categorías de tareas realizadas
        </p>
        <div class="botones_seccion_configuracion">
            <i
                class="material-icons"
                data-toggle="modal"
                data-target="#modalSGT"
                data-id_metodo="agregar_tipo_tarea"
                id="btn-getFormulario-addActivo"
                title="Agregar Tipo Actividad"
                >add_circle</i
            >
        </div>
        <crudtable-component
            fetch-url="/tipo_tareas"
            :columns="['Nombre', 'Descripcion']"
            :botonesporelemento="[
                '<i class=\'material-icons\' title=\'Editar\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'editar_tipo_tarea\' >edit</i>'
            ]"
            name="Tipos de tareas"
        >
        </crudtable-component>
    </div>
</template>

<script>
export default {
    name: "tareas-configuracion",

    mounted(){
    }
}
</script>
