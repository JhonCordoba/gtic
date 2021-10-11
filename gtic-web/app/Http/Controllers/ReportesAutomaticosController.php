<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class ReportesAutomaticosController extends Controller {

    public function guardarReporteSoftware(Request $request) {

        Storage::disk('local')->put('reportes_automaticos/software/' . $request["numeroInventario"], $request["nombreEquipo"] .
                "\n\n\n\n\n" .
                $request["infoProgramasInstalados"]
        );
    }

    public function mostrarReportesSoftware(Request $request) {

        //files contiene todos los reportes
        $files = Storage::files("reportes_automaticos/software/");
        $reportes = array();

        foreach ($files as $file) {

            $reporteFormateado = array();
            $reporte = Storage::disk('local')->get($file);

            //Se separa por programas...
            $reporte = explode("\n\n\n\n\n", $reporte);

            //Guardamos el nombre del PC
            array_push($reporteFormateado, $reporte[0]);


            //por cada programa del reporte, se separa la información del programa...
            //se inicia en 1, porque el 0 es el nombre del PC
            for ($i = 1; $i < sizeof($reporte); $i++) {

                //Se separa la información de los programas
                $informacionPrograma = explode("\n", $reporte[$i]);

                $informacionPrograma = array_diff($informacionPrograma, [""]);

                //quitamos Vendor= Name= InstallDate= y Version= del reporte que nos entrega el cliente
                foreach ($informacionPrograma as $key => $value) {

                    $infoProgramaArray = explode("=", $informacionPrograma[$key]);

                    if (sizeof($infoProgramaArray) == 2) {
                        $informacionPrograma[$key] = $infoProgramaArray[1];
                    }
                }

                array_push($reporteFormateado, $informacionPrograma);
            }



            array_push($reportes, $reporteFormateado);
        }


        $view = view("reportes_automaticos_software", ['reportes' => $reportes])->render();
        return response()->json(['html' => $view]);
    }

}
