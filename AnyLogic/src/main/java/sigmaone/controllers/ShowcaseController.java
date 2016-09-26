package sigmaone.controllers;

import sigmaone.models.Oval;
import sigmaone.models.Rectangle;
import sigmaone.models.Shape;
import sigmaone.views.MainWindow;
import sigmaone.views.PropertiesWindow;

import javax.swing.*;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.util.ArrayList;

public class ShowcaseController {
    private MainWindow mainWindow;      // View
    private ArrayList<Shape> shapes;    // Model

    public ShowcaseController() {
        shapes = prepareTestShapes();

        mainWindow = new MainWindow("AnyLogic test task", shapes);
        AddViewListeners(mainWindow);
        mainWindow.setVisible(true);
    }

    private void AddViewListeners(MainWindow showcaseWindow) {
        // Global exit
        showcaseWindow.addWindowListener(new WindowAdapter() {
            public void windowClosing(WindowEvent windowEvent) {
                System.exit(0);
            }
        });

        // Add menu handlers
        showcaseWindow.setExitMenuActionListener(
            actionEvent -> System.exit(0)
        );
        showcaseWindow.setRemoveMenuActionListener(
            actionEvent -> {
                int selectedRow = mainWindow.getSelectedRowIndex();
                shapes.remove(selectedRow);
                mainWindow.removeRow(selectedRow);
            }
        );
        showcaseWindow.setTableClickListener(
            new MouseAdapter() {
                 public void mousePressed(MouseEvent me) {
                     JTable table =(JTable) me.getSource();

                     // Point p = me.getPoint();
                     // int rowIndex = table.rowAtPoint(p);

                     if (me.getClickCount() == 2) {
                         int i = mainWindow.getSelectedRowIndex();
                         Shape model = shapes.get(i);
                         new PropertiesWindow("Edit '" + model.getName() + "'", model).setVisible(true);
                     }
                 }
             }
        );
    }

    private ArrayList<Shape> prepareTestShapes() {
        return new ArrayList() {{
            add(new Oval("Earth", 2.2432, 3.23497923, 501653543.307, 501653543.307));
            add(new Oval("Douel's head", 2, 3, 11, 6.2));
            add(new Rectangle("My monitor", 0, 0, 11.28, 20.05));
        }};
    }
}
