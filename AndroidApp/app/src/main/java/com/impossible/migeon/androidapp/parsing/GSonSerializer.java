package com.impossible.migeon.androidapp.parsing;

import android.os.AsyncTask;
import android.util.Log;

import com.google.gson.Gson;
import com.google.gson.GsonBuilder;

import org.xml.sax.InputSource;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStreamReader;
import java.net.URL;

/**
 * Created by Bastien on 07/12/2017.
 */

public abstract class GSonSerializer<E> {

    private final Gson gson;
    private final Class<E> clazz;

    public GSonSerializer(Class<E> clazz) {
        gson = new GsonBuilder().create();
        this.clazz = clazz;
    }

    public E deserialize(String jsonUrl) {
        String json = null;
        try {
            json = readUrl(jsonUrl);
        } catch (Exception e) {
            json = "";
        }
        return gson.fromJson(json, clazz);
    }

    public String serialize(E object) {
        return gson.toJson(object);
    }

    private String readUrl(String urlString) throws Exception {
        return new RetrieveFeedTask().execute(urlString).get();
    }

    private class RetrieveFeedTask extends AsyncTask<String, Void, String> {

        protected String doInBackground(String... urls) {
            URL url = null;
            try {
                url = new URL(urls[0]);
            } catch (IOException e) {
                return "";
            }
            try (BufferedReader reader = new BufferedReader(new InputStreamReader(url.openStream()))) {
                StringBuffer buffer = new StringBuffer();
                int read;
                char[] chars = new char[1024];
                while ((read = reader.read(chars)) != -1)
                    buffer.append(chars, 0, read);

                return buffer.toString();
            } catch (IOException e) {
                return "";
            }
        }
    }

}
