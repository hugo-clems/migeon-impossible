package com.impossible.migeon.androidapp.beans;

/**
 * Created by Bastien on 07/12/2017.
 */

public class Danger {

    private long id;
    private int nbNo;
    private String details;

    private DangerType dangerType;


    public Danger() {

    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public int getNbNo() {
        return nbNo;
    }

    public void setNbNo(int nbNo) {
        this.nbNo = nbNo;
    }

    public String getDetails() {
        return details;
    }

    public void setDetails(String details) {
        this.details = details;
    }

    public DangerType getDangerType() {
        return dangerType;
    }

    public void setDangerType(DangerType dangerType) {
        this.dangerType = dangerType;
    }
}
