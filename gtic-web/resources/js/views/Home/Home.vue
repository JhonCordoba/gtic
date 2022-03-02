<template>
    <div class="container">
        <graficosreportetareas-component> </graficosreportetareas-component>
        <tareaspendientes-component> </tareaspendientes-component>
    </div>
</template>

<script>
import { isAuthenticated } from "../../helpers/login.js";
import TareasPendientesComponent from "../../components/TareasPendientesComponent.vue";
import GraficosReporteTareas from "../../components/GraficosReporteTareasComponent.vue";

export default {
    name: "HomeView",
    data() {
        return {};
    },
    methods: {
        isAuthenticated
    },
    created() {
        (async () => {
            let isAuthenticated = await this.isAuthenticated();
            if (!isAuthenticated) {
                alert("Debes ingresar tu usuario y contraseña");
                //window.location.href = '/login';
            }
        })();
    },
    components: {
        "graficosreportetareas-component": GraficosReporteTareas,
        "tareaspendientes-component": TareasPendientesComponent
    }
};
</script>
