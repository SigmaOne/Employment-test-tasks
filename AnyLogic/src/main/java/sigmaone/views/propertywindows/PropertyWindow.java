package sigmaone.views.propertywindows;

import javax.swing.*;
import java.awt.event.ActionListener;
import java.util.HashMap;

public interface PropertyWindow extends RootPaneContainer {
    void addAcceptButtonListener(ActionListener listener);
    void addCancelButtonListener(ActionListener listener);

    HashMap<String, String> getFormValues();
}
