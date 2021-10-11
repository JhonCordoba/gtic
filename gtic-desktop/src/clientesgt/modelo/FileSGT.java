package clientesgt.modelo;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileReader;
import java.io.FileWriter;
import java.io.PrintWriter;
import vista.OptionPane;

public class FileSGT {
    
    public static boolean  escribirArchivo(String nombreArchivo, String contenido){
        
        boolean seGuardoElNumeroInventario = false;
        FileWriter fichero = null;
        PrintWriter pw = null;
        try
        {
            fichero = new FileWriter(nombreArchivo);
            pw = new PrintWriter(fichero);
            pw.println(contenido);
            
            seGuardoElNumeroInventario = true;

        } catch (Exception e) {
            e.printStackTrace();
        } finally {
           try {
           // Nuevamente aprovechamos el finally para 
           // asegurarnos que se cierra el fichero.
           if (null != fichero)
              fichero.close();
           } catch (Exception e2) {
              e2.printStackTrace();
           }
        }
                 
        return seGuardoElNumeroInventario;
        
    }
    
    public static String  leerArchivo(String nombreArchivo){
        
      File archivo = null;
      FileReader fr = null;
      BufferedReader br = null;
      boolean seLeyoElArchivo = false;
      String lineas = "";
      
      try {
         // Apertura del fichero y creacion de BufferedReader para poder
         // hacer una lectura comoda (disponer del metodo readLine()).
         archivo = new File (nombreArchivo);
         fr = new FileReader (archivo);
         br = new BufferedReader(fr);

         // Lectura del fichero
         String linea;
         while((linea=br.readLine())!=null)
            lineas += linea;
         
         seLeyoElArchivo = true;
        }
      catch(Exception e){
         e.printStackTrace();
      }finally{
         // En el finally cerramos el fichero, para asegurarnos
         // que se cierra tanto si todo va bien como si salta 
         // una excepcion.
         try{                    
            if( null != fr ){   
               fr.close();     
            }                  
         }catch (Exception e2){ 
            e2.printStackTrace();
         }
      }         
        
      return lineas;
    }
     
    
}
