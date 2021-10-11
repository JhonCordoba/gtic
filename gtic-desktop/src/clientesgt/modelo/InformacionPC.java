package clientesgt.modelo;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import vista.OptionPane;

public class InformacionPC {
    
    
    public String getListaDeProgramasInstalados(){
        
        String listaDeProgramas = "";
        try {
            
            listaDeProgramas = this.execCommand("wmic product get Name, InstallDate, Vendor, Version /format:list");
            
        } catch (Exception e) {
            System.err.println(e);
        }

        return listaDeProgramas;
        
    }
    
    public String getNombreEquipo(){
        
        String nombreEquipo = "";
        try {
            
            nombreEquipo = this.execCommand("hostname");
            
        } catch (Exception e) {
            System.err.println(e);
        }

        return nombreEquipo;        
        
    }
    
    public void getInfoSistemaOperativo(){
        
        
    }    
    
    public String getNumeroInventario(){
        
       return FileSGT.leerArchivo("SistemaGestionTecnologica");
        
    }
    
    

    
    
    private static String execCommand(String command) throws IOException {
        
        String cmdOutput = "";
        Process p = Runtime.getRuntime().exec(command);
        BufferedReader bri = new BufferedReader(new InputStreamReader(p.getInputStream()));
        String tmpLine = "";
        while ((tmpLine = bri.readLine()) != null) {
            cmdOutput += tmpLine + "\n";
        }
 
        return cmdOutput;
    }     
    
}
