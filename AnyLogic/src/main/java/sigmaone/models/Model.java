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

    // Method to get all the custom model's attributemodel's. Is needed for ModelItem class
    Map<String, Object> getPropertiesMap();
}
