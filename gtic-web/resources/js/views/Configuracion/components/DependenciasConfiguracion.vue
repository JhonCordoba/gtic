<template>
    <div class="seccion_configuracion">
        <p
            class="titulo_seccion_configuracion"
            title="lista de dependencias o áreas de la empresa"
        >
            Dependencias
        </p>

        <div class="botones_seccion_configuracion">
            <i
                class="material-icons"
                data-toggle="modal"
                data-target="#modalSGT"
                data-id_metodo="agregar_dependencia"
                title="Agregar dependencia"
                >add_circle</i
            >
        </div>        

        <crudtable-component
            fetch-url="/dependencias"
            :columns="['nombre', 'descripcion']"
            :botonesporelemento="[
                '<i class=\'material-icons\' title=\'Editar\' data-toggle=\'modal\' data-target=\'#modalSGT\' data-id_metodo=\'editar_dependencia\' >edit</i>'
            ]"
            name="dependencias"
        >
        </crudtable-component>
    </div>
</template>

<script>
export default {
    name: "dependencias-configuracion"
};
</script>
