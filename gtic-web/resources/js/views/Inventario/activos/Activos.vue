<template>
<div>

    <div id="contenedor_opciones_activos">
        <i class="material-icons" id="btn-listar-inventario" title="Listar elementos del inventario">playlist_add_check</i>
        <i class="material-icons" id="btn-getFormulario-addActivo" title="Agregar elemento al inventario">add_circle</i>
        <i class="material-icons" id="btn-getFormulario-subir-activos" title="Cargar archivo de elementos al inventario">cloud_upload</i>
        <i class="material-icons" id="btn-filtrar_tabla_activos" title="Filtrar">search</i>
    </div>

    <div id="contenedor_tabla_activos" class="container-fluid">
    <table class="table table-striped">
        <thead class="table-primary">
        <tr>
            <th>#</th>
            <th># Inventario</th>
            <th>Nombre Marca</th>
            <th>Edificio - Oficina</th>
            <th>Responsable</th>
            <th>Usuario</th>
            <th>Observaciones</th>
            <th>Estado</th>
            <th>Última Revisión</th>
            <th></th> <!--Botón más información-->
            <th></th> <!--Botón editar activo-->
        </tr>
        </thead>

        <tbody id="cuerpo_tabla_inventario">

        </tbody>

    </table>

    </div>

</div>
</template>


<script src='./js/inventario.js' defer></script> 

<style scoped>

#contenedor_opciones_activos{
    position: fixed;
    height: 2em;
    width: 60%;
    left: 25%;
    text-align: center;
    padding: 0.5em;
}

#contenedor_tabla_activos{
    position: relative;
    top: 2.5em;
    min-height: 75vh;
}

    

</style>