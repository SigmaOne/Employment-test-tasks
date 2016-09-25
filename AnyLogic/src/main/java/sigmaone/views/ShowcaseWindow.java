package sigmaone.views;

import javax.swing.*;
import java.awt.*;
import java.awt.event.WindowAdapter;
import java.awt.event.WindowEvent;
import java.util.ArrayList;

/**
 * Main window, which shows all the added figures and their main properties
 */
public class ShowcaseWindow {
    private JFrame mainFrame;

    public ShowcaseWindow() {
        mainFrame = new JFrame("AnyLogic test task");
        mainFrame.setSize(600, 600);
        mainFrame.setLayout(new GridLayout(3, 3));

        mainFrame.setJMenuBar(constructMenu());

        mainFrame.addWindowListener(new WindowAdapter() {
            public void windowClosing(WindowEvent windowEvent) {
                System.exit(0);
            }
        });
    }

    public void setVisible() {
        mainFrame.setVisible(true);
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
