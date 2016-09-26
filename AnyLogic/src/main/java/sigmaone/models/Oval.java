package sigmaone.models;

import sun.reflect.generics.reflectiveObjects.NotImplementedException;
import java.awt.geom.Point2D;
import java.util.Map;

public class Oval implements Shape {
    private String name;
    private Point2D.Double center;
    private double width, height;
    private boolean isCircle;

    public Oval(String name, double x, double y, double width, double height) {
        this.name = name;
        this.center = new Point2D.Double(x, y);
        this.width = width;
        this.height = height;

        if (width == height)
            isCircle = true;
    }

    @Override
    public String getName() {
        return name;
    }

    @Override
    public double getX() {
        return center.getX();
    }

    @Override
    public double getY() {
        return center.getY();
    }

    @Override
    public Map<String, Object> getAttributesMap() {
        throw new NotImplementedException();
    }
}
