package sigmaone.controllers;

import sigmaone.models.*;
import sigmaone.views.*;
import sigmaone.views.propertywindows.DefaultPropertyWindow;
import sigmaone.views.propertywindows.OvalPropertyWindow;
import java.awt.event.*;
import javax.swing.*;
import java.util.*;

/**
 * Main controller to control everything in this application
 */
public class MainController {
    private MainWindow mainWindow; // View in MVC
    private ArrayList<Model> addedModels; // Model in MVC

    public MainController() {
        addedModels = prepareTestShapes();

        mainWindow = new MainWindow("AnyLogic test task", addedModels);
        addViewListeners(mainWindow);
        addModelMenuItems(mainWindow);
    }

    public void run() {
        mainWindow.setVisible(true);
    }
    private ArrayList<Model> prepareTestShapes() {
        return new ArrayList() {{
            add(new Oval("Earth", 2.2432, 3.23497923, 501653543.307, 501653543.307));
            add(new Oval("Douel's head", 2, 3, 11, 6.2));
            add(new Rectangle("My monitor", 0, 0, 11.28, 20.05));
        }};
    }

    private void addViewListeners(MainWindow mainWindow) {
        // Add process's death after window close
        mainWindow.addWindowListener(
            new WindowAdapter() {
                public void windowClosing(WindowEvent windowEvent) {
                    System.exit(0);
                }
            }
        );

        // Add menu handlers
        mainWindow.setExitMenuActionListener(
            exitEvent -> System.exit(0)
        );
        mainWindow.setRemoveMenuActionListener(
            removeModelEvent -> {
                int selectedRow = this.mainWindow.getSelectedRowIndex();
                addedModels.remove(selectedRow);
                mainWindow.removeRow(selectedRow);
                mainWindow.pack();
            }
        );

        // Add table event handlers
        mainWindow.setTableClickListener(
            new MouseAdapter() {
                @Override
                public void mousePressed(MouseEvent event) {
                    if (event.getClickCount() == 2) {
                        int i = MainController.this.mainWindow.getSelectedRowIndex();
                        Model model = addedModels.get(i);
                        DefaultPropertyWindow propertiesWindow = new DefaultPropertyWindow("Edit '" + model.getName() + "'", model);

                        // Add listeners to newly created Properties Window
                        propertiesWindow.addCancelButtonListener(
                            cancelEvent -> {
                                    propertiesWindow.dispose();
                                    mainWindow.setEnabled(true);
                                }
                        );
                        propertiesWindow.addAcceptButtonListener(
                            acceptEvent -> {
                                // Update Model
                                HashMap<String, String> formValues = propertiesWindow.getFormValues();
                                for(Map.Entry pair : formValues.entrySet()) {
                                    model.updateProperty((String) pair.getKey(), (String) pair.getValue());
                                }
                                addedModels.set(i, model);

                                // Update View
                                mainWindow.updateTable(addedModels);
                                propertiesWindow.dispose();
                                mainWindow.setEnabled(true);
                            }
                        );

                        mainWindow.setEnabled(false);
                        propertiesWindow.setVisible(true);
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
                createNewModelEvent -> {
                    DefaultPropertyWindow propertiesWindow = new DefaultPropertyWindow("Create '" + model.getName() + "'", model);

                    // Add listeners to newly created Properties Window
                    propertiesWindow.addCancelButtonListener(
                        cancelEvent -> {
                            propertiesWindow.dispose();
                            mainWindow.setEnabled(true);
                        }
                    );
                    propertiesWindow.addAcceptButtonListener(
                        acceptEvent -> {
                            // Update Model
                            HashMap<String, String> formValues = propertiesWindow.getFormValues();
                            for (Map.Entry pair : formValues.entrySet()) {
                                model.updateProperty((String) pair.getKey(), (String) pair.getValue());
                            }
                            addedModels.add(model);

                            // Update View
                            mainWindow.updateTable(addedModels);
                            propertiesWindow.dispose();
                            mainWindow.pack();
                            mainWindow.setEnabled(true);
                        }
                    );

                    mainWindow.setEnabled(false);
                    propertiesWindow.setVisible(true);
                }
            );
            mainWindow.addCreateModelMenuItem(menuItem);
        }
    }
}
