<template>
    <div class="row" id="div_graficos_reporte_tareas_home">
        <img
            id="img_grafica_no_sufientes_datos"
            style="display: none;"
            src="/svg/grafic_falta_informacion.png"
        />

        <!--Div that will hold the pie chart-->
        <div class="col-4"></div>
        <div class="col-4" id="chart_div"></div>
        <div class="col-4"></div>
    </div>
</template>

<script>
export default {
    name: "GraficosReporteTareasComponent",
    data() {
        return {};
    },

    methods: {
        mostrarGraficaTareas: function() {
            // Load the Visualization API and the corechart package.
            google.charts.load("current", { packages: ["corechart"] });

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {
                // Create the data table.
                var data = new google.visualization.DataTable();
                data.addColumn("string", "Tipo tarea");
                data.addColumn("number", "cantidad");

                //SE DEBE HACER LA PETICIÓN CON AXIOS PORQUE VOY A ELIMINAR JQUERY
                $.ajax({
                    type: "get",
                    url: "/tareas",
                    headers: {
                        Authorization: `Bearer ${localStorage.getItem(
                            "token_auth_api"
                        )}`
                    },
                    success: function(response) {
                        let cantidadTiposTareas = [];

                        //for para contar las tareas de cada tipo de tarea
                        for (let i = 0; i < response.length; i++) {
                            let yaEstaElTipoDeTarea = false;
                            let j;
                            for (j = 0; j < cantidadTiposTareas.length; j++) {
                                if (
                                    cantidadTiposTareas[j][0].localeCompare(
                                        response[i][6]
                                    ) === 0
                                ) {
                                    yaEstaElTipoDeTarea = 1;
                                    break;
                                }
                            }
                            //si ya está el tipo de tarea en el arreglo cantidadTiposTareas se suma 1 a su contador.
                            if (yaEstaElTipoDeTarea) {
                                cantidadTiposTareas[j][1]++;
                            } else {
                                cantidadTiposTareas.push([response[i][6], 1]);
                            }
                        }

                        data.addRows(cantidadTiposTareas);

                        // Set chart options
                        var options = {
                            title: "Tareas",
                            width: 600,
                            height: 250
                        };
                        // Instantiate and draw our chart, passing in some options.
                        var chart = new google.visualization.PieChart(
                            document.getElementById("chart_div")
                        );

                        if (response.length > 0) {
                            chart.draw(data, options);
                        } else {
                            $("#img_grafica_no_sufientes_datos").fadeIn(1500);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(textStatus);
                        console.log(jqXHR);
                        console.log(errorThrown);
                        alert(
                            "Se produjo un error generando la gráfica de tareas"
                        );
                    }
                });
            }
        }
    },

    mounted() {
        this.mostrarGraficaTareas();
    },
    components: {}
};
</script>

<style scoped>
#div_graficos_reporte_tareas_home {
    margin-top: 0.7em;
    margin-bottom: 0;
    overflow: auto;
}
</style>
