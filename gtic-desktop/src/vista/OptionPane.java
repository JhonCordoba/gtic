package vista;

import java.awt.Component;
import javax.swing.ImageIcon;
import javax.swing.JOptionPane;

public class OptionPane {

    private final ImageIcon iconoMostrarMensaje;
    private final ImageIcon iconoError;
    private final ImageIcon iconoEntrada;
    private final ImageIcon iconoConfirmacion;

    public OptionPane() {

        iconoMostrarMensaje = new ImageIcon(getClass().getResource("/vista/images/Icon_mostrarMensaje.png"));
        iconoError = new ImageIcon(getClass().getResource("/vista/images/Icon_Error.png"));
        iconoEntrada = new ImageIcon(getClass().getResource("/vista/images/Icon_leerEntrada.png"));
        iconoConfirmacion = new ImageIcon(getClass().getResource("/vista/images/Icon_PedirConfirmacion.png"));

    }

    public void mostrarMensaje(Component componentePadre, final String mensaje) {
        
        JOptionPane.showMessageDialog(componentePadre, mensaje, "Sistema Gestión Tecnológica",  JOptionPane.INFORMATION_MESSAGE, iconoMostrarMensaje);

    }

    public void mostrarMensajeError(Component componentePadre, String mensaje) {

        JOptionPane.showMessageDialog(componentePadre, mensaje, "Sistema Gestión Tecnológica", JOptionPane.ERROR_MESSAGE, iconoError);

    }

    public String leerEntrada(Component componentePadre, String mensaje) {

        return (String) JOptionPane.showInputDialog(componentePadre, mensaje, "Sistema Gestión Tecnológica", JOptionPane.INFORMATION_MESSAGE, iconoEntrada, null, null);

    }

    public String leerEntrada(Component componentePadre, String mensaje, ImageIcon icon) {

        return (String) JOptionPane.showInputDialog(componentePadre, mensaje, "Sistema Gestión Tecnológica", JOptionPane.INFORMATION_MESSAGE, icon, null, null);

    }

    public int pedirConfirmacion(Component componentePadre, String mensaje) {

        return JOptionPane.showConfirmDialog(componentePadre, mensaje, "Sistema Gestión Tecnológica", JOptionPane.YES_NO_OPTION, JOptionPane.INFORMATION_MESSAGE, iconoConfirmacion);

    }

}
