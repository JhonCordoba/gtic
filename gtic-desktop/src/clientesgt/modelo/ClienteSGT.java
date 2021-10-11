package clientesgt.modelo;

import clientesgt.modelo.InformacionPC;
import java.util.LinkedHashMap;
import java.util.Map;

public class ClienteSGT {

    private InformacionPC infoPC;
    private Requester requester;

    public ClienteSGT() {
        this.infoPC = new InformacionPC();
        this.requester = new Requester();
    }
    
    public String sendInfoProgramasInstalados(String direccionPeticion, String numeroInventario){
        
        String programasInstalados = this.infoPC.getListaDeProgramasInstalados();
        Map<String, Object> params = new LinkedHashMap<>();
        String respuesta = "";
        
        try {
            
            params.put("infoProgramasInstalados", programasInstalados);
            params.put("numeroInventario", numeroInventario);
            params.put("nombreEquipo", this.infoPC.getNombreEquipo());
            
            respuesta = requester.enviarPeticion(direccionPeticion, params);
            
            
        } catch (Exception e) {
            
            System.err.println(e);
            
        }    
        
        System.out.println(respuesta);
        return respuesta;
        
    }
    
    
}