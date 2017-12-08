package com.impossible.migeon.androidapp.beans;

import com.impossible.migeon.androidapp.parsing.GSonSerializer;

import java.util.Date;

/**
 * Created by Bastien on 07/12/2017.
 */

public class Message extends GSonSerializer<Message> {

    private long id;
    private String contenu;
    private Date date;


    public Message() {
        super(Message.class);
    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public String getContenu() {
        return contenu;
    }

    public void setContenu(String contenu) {
        this.contenu = contenu;
    }

    public Date getDate() {
        return date;
    }

    public void setDate(Date date) {
        this.date = date;
    }
}
