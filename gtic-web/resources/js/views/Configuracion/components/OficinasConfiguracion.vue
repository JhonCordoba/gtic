<template>
    <div class="seccion_configuracion">
        <p
            class="titulo_seccion_configuracion"
            title="Lista de oficinas de la empresa"
        >
            Oficinas
        </p>
        <div class="botones_seccion_configuracion">
            <i
                class="material-icons"
                data-toggle="modal"
                data-target="#modalSGT"
                data-id_metodo="agregar_oficina"
                id="btn-getFormulario-addOficina"
                title="Agregar Oficina"
                >add_circle</i
            >
        </div>
        <crudtable-component
            fetch-url="/oficinas"
            :columns="['id', 'edificio', 'oficina']"
            :botonesporelemento="[
                '<i class=\'material-icons\' title=\'Editar\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'editar_dependencia\' >edit</i>'
            ]"
            name="oficinas"
        >
        </crudtable-component>
    </div>
</template>

<script>
export default {
    name: 'oficinas-configuracion'
}
</script>