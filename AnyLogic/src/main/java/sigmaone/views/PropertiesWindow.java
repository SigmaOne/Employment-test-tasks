package sigmaone.views;

import sigmaone.models.Shape;

import javax.swing.*;
import javax.swing.table.DefaultTableModel;
import java.awt.*;
import java.util.ArrayList;
import java.util.Map;

/**
 * Window to edit added models
 */
public class PropertiesWindow extends JFrame {
    private Shape model;

    public PropertiesWindow(String headerText, Shape model) {
        super(headerText);
        this.setSize(200, 300);

        this.model = model;
        constructTable(model);
    }

    private void constructTable(Shape model) {
        Map<String, Object> properties = model.getPropertiesMap();

        // Setup layout
        GroupLayout layout = new GroupLayout(getContentPane());
        getContentPane().setLayout(layout);
        layout.setAutoCreateGaps(true);
        layout.setAutoCreateContainerGaps(true);

        for(Map.Entry<String, Object> entry : properties.entrySet()) {
            JLabel label = new JLabel(entry.getKey());
            // Todo: consider different handlers switched by value type
            JTextField field = new JTextField(entry.getValue().toString());
            layout.setHorizontalGroup(layout.createSequentialGroup().addComponent(label).addComponent(field));
        }
    }
}
