package sigmaone.models;

import java.util.HashMap;
import java.util.Map;

public class Oval implements Model {
    private HashMap<String, Object> properties = new HashMap<>();
    private boolean isCircle = false;

    public Oval(String name, double x, double y, double width, double height) {
        properties.put("width", width);
        properties.put("height", height);
        isCircle = (width == height);

        properties.put("y", y);
        properties.put("x", x);
        properties.put("type", this.getClass().getSimpleName());
        properties.put("name", name);
    }

    @Override
    public String getName() {
        return (String) properties.get("name");
    }

    @Override
    public String getType() {
        return (String) properties.get("type");
    }

    @Override
    public double getX() {
        return (double) properties.get("x");
    }

    @Override
    public double getY() {
        return (double) properties.get("y");
    }

    @Override
    public Map<String, Object> getPropertiesMap() {
        return properties;
    }
}
