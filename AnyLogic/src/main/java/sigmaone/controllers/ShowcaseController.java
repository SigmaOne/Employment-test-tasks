package sigmaone.controllers;

import sigmaone.models.Oval;
import sigmaone.models.Plane;
import sigmaone.models.Rectangle;
import sigmaone.models.Model;
import sigmaone.views.MainWindow;
import sigmaone.views.PropertiesWindow;

import javax.swing.*;
import java.awt.event.*;
import java.util.ArrayList;

public class ShowcaseController {
    private MainWindow mainWindow;      // View
    private ArrayList<Model> shapes;    // Model

    public ShowcaseController() {
        shapes = prepareTestShapes();

        mainWindow = new MainWindow("AnyLogic test task", shapes);
        addViewListeners(mainWindow);
        addModelMenuItems(mainWindow);

        mainWindow.setVisible(true);
    }

    private void addViewListeners(MainWindow mainWindow) {
        // Global exit
        mainWindow.addWindowListener(new WindowAdapter() {
            public void windowClosing(WindowEvent windowEvent) {
                System.exit(0);
            }
        });

        // Add menu handlers
        mainWindow.setExitMenuActionListener(
            actionEvent -> System.exit(0)
        );
        mainWindow.setRemoveMenuActionListener(
            actionEvent -> {
                int selectedRow = this.mainWindow.getSelectedRowIndex();
                shapes.remove(selectedRow);
                this.mainWindow.removeRow(selectedRow);
            }
        );
        mainWindow.setTableClickListener(
            new MouseAdapter() {
                 public void mousePressed(MouseEvent me) {
                     JTable table =(JTable) me.getSource();

                     // Point p = me.getPoint();
                     // int rowIndex = table.rowAtPoint(p);

                     if (me.getClickCount() == 2) {
                         int i = ShowcaseController.this.mainWindow.getSelectedRowIndex();
                         Model model = shapes.get(i);
                         new PropertiesWindow("Edit '" + model.getName() + "'", model).setVisible(true);
                     }
                 }
             }
        );
    }
    private void addModelMenuItems(MainWindow mainWindow) {
        ArrayList<Model> models = new ArrayList() {{
            add(new Oval("My new model", 0, 0, 0, 0));
            add(new Rectangle("My new model", 0, 0, 0, 0));
            add(new Plane("My new model", 0, 0));
        }};

        for(Model model : models) {
            JMenuItem menuItem = new JMenuItem("Create new " + model.getType() + " model");

            menuItem.addActionListener(
                new ActionListener() {
                    @Override
                    public void actionPerformed(ActionEvent actionEvent) {
                        new PropertiesWindow("Create new '" + model.getName() + "'", model).setVisible(true);
                    }
                }
            );

            mainWindow.addModelMenuItem(menuItem);
        }
    }

    private ArrayList<Model> prepareTestShapes() {
        return new ArrayList() {{
            add(new Oval("Earth", 2.2432, 3.23497923, 501653543.307, 501653543.307));
            add(new Oval("Douel's head", 2, 3, 11, 6.2));
            add(new Rectangle("My monitor", 0, 0, 11.28, 20.05));
        }};
    }
}
