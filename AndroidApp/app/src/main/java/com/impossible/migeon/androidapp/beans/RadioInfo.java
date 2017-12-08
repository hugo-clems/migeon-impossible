package com.impossible.migeon.androidapp.beans;

import com.impossible.migeon.androidapp.parsing.GSonSerializer;

/**
 * Created by Bastien on 08/12/2017.
 */

public class RadioInfo extends GSonSerializer<RadioInfo> {

    private String artist, title;
    private String cover;


    public RadioInfo() {
        super(RadioInfo.class);
    }

    public String getArtist() {
        return artist;
    }

    public void setArtist(String artist) {
        this.artist = artist;
    }

    public String getTitle() {
        return title;
    }

    public void setTitle(String title) {
        this.title = title;
    }

    public String getCover() {
        return cover;
    }

    public void setCover(String cover) {
        this.cover = cover;
    }
}

