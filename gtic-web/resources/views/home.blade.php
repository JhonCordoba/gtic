@extends('layouts.app')

@section("content")
<div id="app">

    <div id="contenedorPadrePrincipal" class="animate open_contenedorPadrePrincipal p-2 mx-0 shadow-contenedor-padre-principal" style="margin-top: 4em; float: right; width: 98%; background-color: white; opacity: 0.98;">
        <router-view>
        </router-view>
    </div>

</div>
@endsection