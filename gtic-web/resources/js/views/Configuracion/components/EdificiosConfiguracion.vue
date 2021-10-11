<template>
    <div class="seccion_configuracion">
        <p
            class="titulo_seccion_configuracion"
            title="Lista de edificios de la empresa"
        >
            Edificios
        </p>
        <div class="botones_seccion_configuracion">
            <i
                class="material-icons"
                data-toggle="modal"
                data-target="#modalSGT"
                data-id_metodo="agregar_edificio"
                id="btn-getFormulario-addEdificio"
                title="Agregar Edificio"
                >add_circle</i
            >
        </div>
        <crudtable-component
            fetch-url="/edificios"
            :columns="['nombre', 'dirección']"
            :botonesporelemento="[
                '<i class=\'material-icons\' title=\'Editar\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'editar_dependencia\' >edit</i>'
            ]"
            name="edificios"
        >
        </crudtable-component>
    </div>
</template>

<script>
export default {
    name: "edificios-configuracion"
}
</script>
