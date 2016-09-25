package sigmaone.views;

import sigmaone.models.Shape;
import sigmaone.views.components.ModelItem;

import javax.swing.*;
import java.awt.*;
import java.util.ArrayList;

/**
 * Main window, which shows all the added figures and their main properties
 */
public class ShowcaseWindow extends JFrame {
    private ArrayList<Shape> addedShapes;

    public ShowcaseWindow(String headerText, ArrayList<Shape> addedShapes) {
        super(headerText);
        this.setSize(600, 600);
        this.setLayout(new GridLayout(3, 3));

        // Construct menu
        this.setJMenuBar(constructMenu());

        // Construct models table
        this.addedShapes = addedShapes;
        for(Shape shape: addedShapes) {
            ModelItem item = new ModelItem(shape);
            this.add(item);
        }
    }

    private JMenuBar constructMenu() {
        JMenuBar menuBar = new JMenuBar();

        // Create and add "File" menu item
        JMenu fileMenu = new JMenu("File");
        ArrayList<JMenuItem> fileMenuItems = new ArrayList() {{
            add(new JMenuItem("Exit"));
        }};
        for(JMenuItem menuItem: fileMenuItems)
            fileMenu.add(menuItem);
        menuBar.add(fileMenu);

        // Create and add "Model" menu item
        JMenu modelMenu = new JMenu("Model");
        ArrayList<JMenuItem> modelMenuItems = new ArrayList() {{
            add(new JMenuItem("Create Rectangle Model"));
            add(new JMenuItem("Create Oval Model"));
            add(new JMenuItem("Remove"));
        }};
        for(JMenuItem menuItem: modelMenuItems)
            modelMenu.add(menuItem);
        menuBar.add(modelMenu);

        return menuBar;
    }
}
