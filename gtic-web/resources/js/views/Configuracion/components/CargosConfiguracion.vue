<template>
    <div class="seccion_configuracion">
        <p
            class="titulo_seccion_configuracion"
            title="Lista de cargos o puestos de trabajo de la empresa"
        >
            Cargos
        </p>

        <div class="botones_seccion_configuracion">
            <i
                class="material-icons"
                data-toggle="modal"
                data-target="#modalSGT"
                data-id_metodo="agregar_cargo"
                id="btn-getFormulario-addCargo"
                title="Agregar cargo"
                >add_circle</i
            >
        </div>

        <crudtable-component
            fetch-url="/cargos"
            :columns="['nombre', 'descripcion']"
            :botonesporelemento="[
                '<i class=\'material-icons\' title=\'Editar\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'editar_dependencia\' >edit</i>'
            ]"
            name="cargos"
        >
        </crudtable-component>
    </div>
</template>

<script>
export default {
    name: "cargos-configuracion"
}
</script>
