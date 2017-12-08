package com.impossible.migeon.androidapp.parsing;

import com.google.gson.Gson;

/**
 * Created by Bastien on 07/12/2017.
 */

public abstract class GSonSerializer<E> {

    private final Gson gson;
    private final Class<E> clazz;

    public GSonSerializer(Class<E> clazz) {
        gson = new Gson();
        this.clazz = clazz;
    }

    public E deserialize(String json) {
        return gson.fromJson(json, clazz);
    }

    public String serialize(E object) {
        return gson.toJson(object);
    }

}
