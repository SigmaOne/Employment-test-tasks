package sigmaone.views;

import sigmaone.models.Model;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.awt.*;
import java.util.Map;

/**
 * Window to edit added models
 */
public class PropertiesWindow extends JFrame {
    private JTable table;
    private Model model;

    // Todo: make all fields have fixed ordering
    public PropertiesWindow(String headerText, Model model) {
        super(headerText);
        this.setSize(200, 300);
        this.setLayout(new GridLayout(1, 1));

        this.model = model;
        this.table = constructTable(model);
        this.add(table);
    }

    private JTable constructTable(Model model) {
        Map<String, Object> properties = model.getPropertiesMap();

        String[] columnNames = { "Name", "Value" };
        Object[][] data = new Object[properties.size()][columnNames.length];

        int i = 0;
        for(Map.Entry<String, Object> entry : properties.entrySet()) {
            data[i][0] = entry.getKey();
            data[i][1] = entry.getValue();
            i++;
        }

        JTable table = new JTable(new DefaultTableModel(data, columnNames));

        // Make keys readonly
        // table.setDefaultEditor(table.getColumnClass(0), null);

        return table;
    }
}
