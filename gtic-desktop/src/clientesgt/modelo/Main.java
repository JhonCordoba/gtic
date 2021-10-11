package clientesgt.modelo;

import java.io.File;
import vista.OptionPane;

public class Main {
    
    public static void main(String[] args) {
        
        //Verificamos si es la primer vez que se ejecuta con base al archivo
        //que tiene el número de inventario del PC
        //más adelante lo correcto, no es sacar el número de inventario de un archivo
        //sino del nombre del equipo, el cual debe tener el número de inventario del pc
        File file_SGT = new File("sistemaGestionTecnologica");     
        
        //Si no existe es la primera vez que se ejecuta...
        //por lo tanto se pide el número de inventario
        //y se guarda en el archivo
        if (!file_SGT.exists()) { 
            
            OptionPane optionPane = new OptionPane();
            String numeroInventario = optionPane.leerEntrada(null, "Ingresa el número de Inventario del PC");             
            
            String confirmarNumeroInventario = optionPane.leerEntrada(null, "Confirma el número de Inventario del PC");             
            
            if(numeroInventario.equals(confirmarNumeroInventario))
                FileSGT.escribirArchivo("SistemaGestionTecnologica", numeroInventario);
            else{
                optionPane.mostrarMensajeError(null, "Ingresaste mal el número de inventario");
                return;
            }
                
        }
        
        ClienteSGT clienteSGT = new ClienteSGT();
        clienteSGT.sendInfoProgramasInstalados("http://192.168.103.5/api/reporte/software", FileSGT.leerArchivo("sistemaGestionTecnologica"));
        
    }    
    
}
