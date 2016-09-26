package sigmaone.views;

import sigmaone.models.Shape;
import sun.reflect.generics.reflectiveObjects.NotImplementedException;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.awt.*;
import java.awt.event.ActionListener;
import java.awt.event.MouseListener;
import java.util.ArrayList;

/**
 * Main window, which shows all the added figures and their main properties
 */
public class MainWindow extends JFrame {
    private JMenuBar menuBar;
    private JTable table;

    public MainWindow(String headerText, ArrayList<Shape> addedShapes) {
        super(headerText);
        this.setSize(600, 600);
        this.setLayout(new GridLayout(3, 3));

        // Construct menu
        menuBar = constructMenuBar();
        this.setJMenuBar(menuBar);

        // Construct models table
        table = constructTable(addedShapes);
        this.add(table);
    }

    // View constructors
    private JMenuBar constructMenuBar() {
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
    private JTable constructTable(ArrayList<Shape> shapes) {
        String[] columnNames = { "Name", "Type", "X", "Y" };
        Object[][] data = new Object[shapes.size()][columnNames.length];

        for(int i = 0; i < shapes.size(); i++) {
            data[i][0] = shapes.get(i).getName();
            data[i][1] = shapes.get(i).getType();
            data[i][2] = shapes.get(i).getX();
            data[i][3] = shapes.get(i).getY();
        }

        JTable table = new JTable(new DefaultTableModel(data, columnNames));

        // Make table readonly
        for (int c = 0; c < table.getColumnCount(); c++) {
            Class<?> col_class = table.getColumnClass(c);
            table.setDefaultEditor(col_class, null);
        }

        return table;
    }

    // Add listeners
    public void setExitMenuActionListener(ActionListener listener) {
        menuBar.getMenu(0).getItem(0).addActionListener(listener);
    }
    public void setCreateModelMenuActionListener(Class modelClass, ActionListener listener) {
        throw new NotImplementedException();
    }
    public void setRemoveMenuActionListener(ActionListener listener) {
        JMenu menu = menuBar.getMenu(1);
        menu.getItem(menu.getItemCount() - 1).addActionListener(listener);
    }
    public void setTableClickListener(MouseListener listener) {
        table.addMouseListener(listener);
    }

    // Table entry manipulation
    public int getSelectedRowIndex() {
        return table.getSelectedRow();
    }
    public void removeRow(int index) {
        ((DefaultTableModel)table.getModel()).removeRow(index);
    }
}
