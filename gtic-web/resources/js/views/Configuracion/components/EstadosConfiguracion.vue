<template>
    <div class="seccion_configuracion">
        <p
            class="titulo_seccion_configuracion"
            title="Lista de estados para los activos"
        >
            Estados de los Activos
        </p>
        <div class="botones_seccion_configuracion">
            <i
                class="material-icons"
                data-toggle="modal"
                data-target="#modalSGT"
                data-id_metodo="agregar_estado_activo"
                id="btn-getFormulario-addEstado"
                title="Agregar Estado"
                >add_circle</i
            >
        </div>
        <crudtable-component
            fetch-url="/estados"
            :columns="['nombre', 'descripcion']"
            :botonesporelemento="[
                '<i class=\'material-icons\' title=\'Editar\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'editar_dependencia\' >edit</i>'
            ]"
            name="Estados"
        >
        </crudtable-component>
    </div>
</template>

<script>
export default {
    name: 'estados-configuracion'
}
</script>
