package sigmaone.models;

import java.util.Map;

/**
 * Generic interface for all the models
 */
public interface Shape {
    String getName();
    double getX();
    double getY();

    default String getType() {
        return this.getClass().getTypeName();
    }

    // Method to get all the custom model's attributemodel's. Is needed for ModelItem class
    Map<String, Object> getAttributesMap();
}
