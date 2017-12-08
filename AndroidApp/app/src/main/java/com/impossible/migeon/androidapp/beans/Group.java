package com.impossible.migeon.androidapp.beans;

import com.impossible.migeon.androidapp.parsing.GSonSerializer;

import java.util.Set;

/**
 * Created by Bastien on 07/12/2017.
 */

public class Group extends GSonSerializer<Group> {

    private long id;
    private Set<User> users;


    public Group() {
        super(Group.class);
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
