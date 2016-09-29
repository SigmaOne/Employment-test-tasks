package sigmaone.views;

import sigmaone.models.Model;
import sun.reflect.generics.reflectiveObjects.NotImplementedException;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import javax.swing.table.JTableHeader;
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

    public MainWindow(String headerText, ArrayList<Model> addedShapes) {
        super(headerText);
        this.setLayout(new BoxLayout(this.getContentPane(), BoxLayout.Y_AXIS));

        // Construct menu
        menuBar = constructMenuBar();
        this.setJMenuBar(menuBar);

        // Construct models table
        table = constructTable(addedShapes);
        JTableHeader tableHeader = table.getTableHeader();
        tableHeader.setBackground(Color.LIGHT_GRAY);
        this.add(tableHeader);
        this.add(table);

        this.pack();
    }

    // View constructors
    private JMenuBar constructMenuBar() {
        JMenuBar menuBar = new JMenuBar();

        // Add "File" menu item
        JMenu fileMenu = new JMenu("File");
        ArrayList<JMenuItem> fileMenuItems = new ArrayList() {{
            add(new JMenuItem("Exit"));
        }};
        for(JMenuItem menuItem: fileMenuItems)
            fileMenu.add(menuItem);
        menuBar.add(fileMenu);

        // Add "Model" menu item
        JMenu modelMenu = new JMenu("Model");
        ArrayList<JMenuItem> modelMenuItems = new ArrayList() {{
            add(new JMenuItem("Remove"));
        }};
        for(JMenuItem menuItem: modelMenuItems)
            modelMenu.add(menuItem);
        menuBar.add(modelMenu);

        return menuBar;
    }
    private JTable constructTable(ArrayList<Model> models) {
        this.table = new JTable();
        updateTable(models);

        // Make table readonly
        for (int c = 0; c < table.getColumnCount(); c++) {
            Class<?> col_class = table.getColumnClass(c);
            table.setDefaultEditor(col_class, null);
        }

        return table;
    }
    // Add new Menu Item to Menu. e.g. "Create Rectangle model"
    public void addCreateModelMenuItem(JMenuItem menuItem) {
        menuBar.getMenu(1).add(menuItem);
    }

    // Add action listeners
    public void setExitMenuActionListener(ActionListener listener) {
        menuBar.getMenu(0).getItem(0).addActionListener(listener);
    }
    public void setRemoveMenuActionListener(ActionListener listener) {
        // Todo: move remove down
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
    public void updateTable(ArrayList<Model> models) {
        String[] columnNames = { "Name", "Type", "X", "Y" };
        Object[][] data = new Object[models.size()][columnNames.length];

        for(int i = 0; i < models.size(); i++) {
            data[i][0] = models.get(i).getName();
            data[i][1] = models.get(i).getType();
            data[i][2] = models.get(i).getX();
            data[i][3] = models.get(i).getY();
        }

        DefaultTableModel newTableModel = new DefaultTableModel(data, columnNames);
        this.table.setModel(newTableModel);
        newTableModel.fireTableDataChanged();
    }
}
