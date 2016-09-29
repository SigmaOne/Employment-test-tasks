package sigmaone.models;

import java.util.Map;

/**
 * Generic interface for all the models
 */
public interface Model {
    String getName();
    String getType();
    double getX();
    double getY();

    // Method to get all the custom model's attributes. Is needed for PropertyWindow class
    Map<String, Object> getPropertiesMap();
    void updateProperty(String key, String value);
}
