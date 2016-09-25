package sigmaone.models;

import sun.reflect.generics.reflectiveObjects.NotImplementedException;

import java.awt.*;
import java.util.Map;

public class Rectangle implements Shape {
    private String name;
    private Point center;
    private double width, height;

    public Rectangle(String name, int x, int y, double width, double height) {
        this.name = name;
        center = new Point(x, y);
        this.width = width;
        this.height = height;
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
