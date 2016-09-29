package sigmaone.views;

import sigmaone.models.Model;
import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionListener;
import java.util.Map;

/**
 * Window to edit added models
 */
public class PropertiesWindow extends JFrame {
    private Model model;
    private JButton acceptButton = new JButton("Accept");
    private JButton cancelButton = new JButton("Cancel");

    // Todo: make all fields have fixed ordering
    public PropertiesWindow(String headerText, Model model) {
        super(headerText);
        this.setSize(600, 600);
        this.setLayout(new GridBagLayout());

        this.model = model;

        GridBagConstraints gbc = new GridBagConstraints();

        // Add little separator at the top
        gbc.gridx = 0;
        gbc.gridy = 0;
        gbc.gridwidth = 2;
        gbc.insets = new Insets(10, 10, 10, 10);
        this.add(new JLabel(model.getName() + "'s properties"), gbc);

        // Add all fields
        gbc.gridwidth = 1;
        gbc.fill = GridBagConstraints.HORIZONTAL;
        gbc.insets = new Insets(1, 10, 0, 10);
        gbc.gridy++;

        for(Map.Entry<String, Object> entry : model.getPropertiesMap().entrySet()) {
            gbc.gridx = 0;
            this.add(new JLabel(entry.getKey()), gbc);
            gbc.gridx = 1;
            this.add(new JTextField(entry.getValue().toString()), gbc);

            gbc.gridy++;
        }

        // Add buttons
        gbc.insets = new Insets(20, 10, 10, 10);
        gbc.gridx = 0;

        this.add(acceptButton, gbc);
        gbc.gridx = 1;
        this.add(cancelButton, gbc);

        this.pack();
    }

    public void addAcceptButtonListener(ActionListener listener) {
        acceptButton.addActionListener(listener);
    }
    public void addCancelButtonListener(ActionListener listener) {
        cancelButton.addActionListener(listener);
    }

//    public Model getResultedModel() {
//        this.
//        return model;
//    }

    @Override
    public void setVisible(boolean key) {
//        if (acceptButton.getActionListeners().length == 0 )
//            throw new Exception("No Listener fo Accept Button provided");
//        if (cancelButton.getActionListeners().length == 0)
//            throw new Exception("No Listener fo Cancel Button provided");

        super.setVisible(key);
    }
}
