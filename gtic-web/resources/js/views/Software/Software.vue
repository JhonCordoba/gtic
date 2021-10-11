<template>
  <div class="div">
    <div style="position: fixed; height: 2em; width: 60%; left: 25%; text-align: center; padding: 0.5em;">
        <i class="material-icons" title="Registrar Software">add_circle</i>
        <i class="material-icons" id="bt-getReporteAutomaticoSoftwareInstalado" title="Software instalado por PC en tiempo real">assessment</i>
    </div>

    <div class="container-fluid" id="mostradorVistaSoftware" style="overflow-x: auto; margin-top: 2em;">
    </div>
  </div>
</template>


  <script>
  $(document).ready(function () {
      
      mostrarReporteSoftwareInstalado();

      $('#bt-getReporteAutomaticoSoftwareInstalado').on('click', function (e) {

          mostrarReporteSoftwareInstalado();

      });

  });

  function mostrarReporteSoftwareInstalado() {
      $.ajax({
          url: "reporte/software",
          method: "GET",
          success: function (result, status, xhr) {

              $("#mostradorVistaSoftware").html(result.html);

          },
          error: function (xhr) {
              console.log('Request Status: ' + xhr.status + ' Status Text: ' + xhr.statusText + ' ' + xhr.responseText);
          }

      });
  }
</script>

<style scoped>
  .barra_titulo_reportes_automaticos{

    font-size: 1.4em; 
    text-align: center; 
    color:white;

    border-radius: 19px 19px 19px 19px;
    -moz-border-radius: 19px 19px 19px 19px;
    -webkit-border-radius: 19px 19px 19px 19px;
    border: 0px solid #000000;	



    background: rgba(0,31,63,1);
    background: -moz-linear-gradient(left, rgba(0,31,63,1) 42%, rgba(1,33,67,1) 43%, rgba(32,103,196,0.84) 72%, rgba(36,113,214,0.84) 76%);
    background: -webkit-gradient(left top, right top, color-stop(42%, rgba(0,31,63,1)), color-stop(43%, rgba(1,33,67,1)), color-stop(72%, rgba(32,103,196,0.84)), color-stop(76%, rgba(36,113,214,0.84)));
    background: -webkit-linear-gradient(left, rgba(0,31,63,1) 42%, rgba(1,33,67,1) 43%, rgba(32,103,196,0.84) 72%, rgba(36,113,214,0.84) 76%);
    background: -o-linear-gradient(left, rgba(0,31,63,1) 42%, rgba(1,33,67,1) 43%, rgba(32,103,196,0.84) 72%, rgba(36,113,214,0.84) 76%);
    background: -ms-linear-gradient(left, rgba(0,31,63,1) 42%, rgba(1,33,67,1) 43%, rgba(32,103,196,0.84) 72%, rgba(36,113,214,0.84) 76%);
    background: linear-gradient(to right, rgba(0,31,63,1) 42%, rgba(1,33,67,1) 43%, rgba(32,103,196,0.84) 72%, rgba(36,113,214,0.84) 76%);
    filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#001f3f', endColorstr='#2471d6', GradientType=1 );

  }
</style>