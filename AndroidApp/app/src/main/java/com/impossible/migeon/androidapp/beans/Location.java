package com.impossible.migeon.androidapp.beans;

import com.impossible.migeon.androidapp.parsing.GSonSerializer;

import java.util.List;

/**
 * Created by Bastien on 07/12/2017.
 */

public class Location extends GSonSerializer<Location> {

    private long id;
    private double longitude, latitude;
    private String city;
    private String country;

    private List<Danger> dangers;


    public Location() {
        super(Location.class);
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public double getLongitude() {
        return longitude;
    }

    public void setLongitude(double longitude) {
        this.longitude = longitude;
    }

    public double getLatitude() {
        return latitude;
    }

    public void setLatitude(double latitude) {
        this.latitude = latitude;
    }

    public String getCity() {
        return city;
    }

    public void setCity(String city) {
        this.city = city;
    }

    public String getCountry() {
        return country;
    }

    public void setCountry(String country) {
        this.country = country;
    }

    public List<Danger> getDangers() {
        return dangers;
    }

    public void setDangers(List<Danger> dangers) {
        this.dangers = dangers;
    }
}
