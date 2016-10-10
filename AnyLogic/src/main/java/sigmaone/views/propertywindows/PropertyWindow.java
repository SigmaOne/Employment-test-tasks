package sigmaone.views.propertywindows;

import javax.swing.*;
import java.awt.event.ActionListener;
import java.util.HashMap;

/*
    Todo: make every PropertyWindow pluggable(customizable)
    For that there should be pluggable classes which are just a JFrames with 1-2 property inside.
    The we can create PropertyWindows just like that:
    "propertyWindow.addElement(new ConditionalPlug(conditionName, new PluggableJFrameForFalse(), new PluggableJFrameForTrue())"
    Plug example: JFrame which hides his "Width" and "Height" properties and shows only "radius" if "isCircle" checkbox is on
*/

public interface PropertyWindow extends RootPaneContainer {
    void addAcceptButtonListener(ActionListener listener);
    void addCancelButtonListener(ActionListener listener);

    HashMap<String, String> getFormValues();
}
