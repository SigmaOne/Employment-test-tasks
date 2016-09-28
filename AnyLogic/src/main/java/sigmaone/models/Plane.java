package sigmaone.models;

import java.util.HashMap;
import java.util.Map;

public class Plane implements Model {
    private HashMap<String, Object> properties = new HashMap<>();

    public Plane(String name, double x, double y) {
        properties.put("name", name);
        properties.put("type", this.getClass().getSimpleName());
        properties.put("x", x);
        properties.put("y", y);

        properties.put("MaxSpeed", 100500);
        properties.put("Weight", 1560);
        properties.put("People capasity", 60);
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
