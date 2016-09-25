package sigmaone.controllers;

import sigmaone.models.Oval;
import sigmaone.models.Rectangle;
import sigmaone.models.Shape;
import sigmaone.views.ShowcaseWindow;
import javax.swing.*;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.util.ArrayList;

public class ShowcaseController {
    public ShowcaseController() {
        ArrayList<Shape> testShapes = prepareTestShapes();
        ShowcaseWindow showcaseWindow = new ShowcaseWindow("AnyLogic test task", testShapes);
        addListeners(showcaseWindow);
        showcaseWindow.setVisible(true);
    }

    private void addListeners(JFrame panel) {
        panel.addWindowListener(new WindowAdapter() {
            public void windowClosing(WindowEvent windowEvent) {
                System.exit(0);
            }
        });
    }
    private ArrayList<Shape> prepareTestShapes() {
        return new ArrayList() {{
            add(new Oval("Earth", 2, 3, 501653543.307, 501653543.307));
            add(new Oval("Douel's head", 2, 3, 11, 6.2));
            add(new Rectangle("My monitor", 0, 0, 11.28, 20.05));
        }};
    }
}
