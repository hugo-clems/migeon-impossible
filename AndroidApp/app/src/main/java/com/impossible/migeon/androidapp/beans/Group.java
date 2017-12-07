package com.impossible.migeon.androidapp.beans;

import java.util.Set;

/**
 * Created by Bastien on 07/12/2017.
 */

public class Group {

    private long id;
    private Set<User> users;


    public Group() {

    }

    public long getId() {
        return id;
    }

    public void setId(long id) {
        this.id = id;
    }

    public Set<User> getUsers() {
        return users;
    }

    public void setUsers(Set<User> users) {
        this.users = users;
    }
}
