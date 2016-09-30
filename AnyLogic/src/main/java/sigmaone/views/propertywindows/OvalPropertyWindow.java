package sigmaone.views.propertywindows;

import sigmaone.models.Oval;
import javax.swing.*;
import java.awt.*;
import java.awt.event.ActionListener;
import java.util.ArrayList;
import java.util.HashMap;
import java.util.Map;

/**
 * Window to edit Oval models
 */
public class OvalPropertyWindow extends JFrame implements PropertyWindow {
    private ArrayList<JLabel> keyLabels = new ArrayList<>();
    private ArrayList<JTextField> valueTextields = new ArrayList<>();

    private JButton acceptButton = new JButton("Save");
    private JButton cancelButton = new JButton("Cancel");

    // Todo: make all fields have fixed ordering
    public OvalPropertyWindow(String headerText, Oval model) {
        super(headerText);
        this.setSize(600, 600);
        this.setLayout(new GridBagLayout());

        GridBagConstraints gbc = new GridBagConstraints();

        // Add header
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

        // Add default String properties
        for(Map.Entry<String, Object> entry : model.getPropertiesMap().entrySet()) {
            if(entry.getKey().equals("weight") || entry.getKey().equals("height")) {
                continue;
            }

            // Add key label
            JLabel keyLabel = new JLabel(entry.getKey());
            keyLabels.add(keyLabel);
            gbc.gridx = 0;
            this.add(keyLabel, gbc);

            // Add value textField
            JTextField valueField = new JTextField(entry.getValue().toString());
            valueTextields.add(valueField);
            gbc.gridx = 1;
            this.add(valueField, gbc);

            gbc.gridy++;
        }

        // Add custom "is_circle?" behaviour
        JPanel isCirclePanel = new JPanel();
        isCirclePanel.setBorder(BorderFactory.createLineBorder(Color.black));
        isCirclePanel.add(new JButton("sht"));
        isCirclePanel.add(new JButton("sht"));
        gbc.gridwidth = 2;
        this.add(isCirclePanel, gbc);

        gbc.gridwidth = 1;
        gbc.gridy++;

        // Add accept and cancel buttons
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

    public HashMap<String, String> getFormValues() {
        HashMap<String, String> formValues = new HashMap();

        for(int i = 0; i < this.keyLabels.size(); i++)
            formValues.put(keyLabels.get(i).getText(), valueTextields.get(i).getText());

        return formValues;
    }

    @Override
    public void setVisible(boolean key) {
        // if (acceptButton.getActionListeners().length == 0 )
        //     throw new Exception("No Listener fo Accept Button provided");
        // if (cancelButton.getActionListeners().length == 0)
        //     throw new Exception("No Listener fo Cancel Button provided");

        super.setVisible(key);
    }
}
