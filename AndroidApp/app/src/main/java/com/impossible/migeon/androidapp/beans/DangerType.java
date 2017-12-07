package com.impossible.migeon.androidapp.beans;

/**
 * Created by Bastien on 07/12/2017.
 */

public class DangerType {

    private long id;
    private String name;
    private String description;
    private double radius;
    private String linkInstructions;
    private double duration;


    public DangerType() {

    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public String getName() {
        return name;
    }

    public void setName(String name) {
        this.name = name;
    }

    public String getDescription() {
        return description;
    }

    public void setDescription(String description) {
        this.description = description;
    }

    public double getRadius() {
        return radius;
    }

    public void setRadius(double radius) {
        this.radius = radius;
    }

    public String getLinkInstructions() {
        return linkInstructions;
    }

    public void setLinkInstructions(String linkInstructions) {
        this.linkInstructions = linkInstructions;
    }

    public double getDuration() {
        return duration;
    }

    public void setDuration(double duration) {
        this.duration = duration;
    }
}
