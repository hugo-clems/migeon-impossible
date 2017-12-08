package com.impossible.migeon.androidapp;

import android.app.Activity;
import android.app.ProgressDialog;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.media.AudioManager;
import android.media.MediaPlayer;
import android.os.AsyncTask;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;

import com.impossible.migeon.androidapp.beans.RadioInfo;

import java.io.IOException;
import java.net.URL;

public class RadioActivity extends Activity {

    private ImageButton btn;
    /**
     * help to toggle between play and pause.
     */
    private boolean playPause;
    private MediaPlayer mediaPlayer;
    /**
     * remain false till media is not completed, inside OnCompletionListener make it true.
     */
    private boolean intialStage = true;

    private RadioInfo radioInfo;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_radio);
        btn = (ImageButton) findViewById(R.id.buttonPlayPause);
        mediaPlayer = new MediaPlayer();
        mediaPlayer.setAudioStreamType(AudioManager.STREAM_MUSIC);
        btn.setOnClickListener(pausePlay);
        radioInfo = new RadioInfo();
        radioInfo = radioInfo.deserialize("https://www.radioking.com/widgets/currenttrack.php?radio=116593&format=json");
        ((TextView) findViewById(R.id.scrollingDescription)).setText(radioInfo.getTitle() + "\n" + radioInfo.getArtist());
        try {
            ((ImageView) findViewById(R.id.cover)).setImageBitmap(new RetrieveBitmap().execute(radioInfo.getCover()).get());
        } catch (Exception e) {

        }
    }

    private class RetrieveBitmap extends AsyncTask<String, Void, Bitmap> {

        protected Bitmap doInBackground(String... urls) {
            try {
                URL url = new URL(radioInfo.getCover());
                Bitmap bmp = BitmapFactory.decodeStream(url.openConnection().getInputStream());
                return bmp;
            } catch (IOException e) {
                return null;
            }
        }
    }

    private View.OnClickListener pausePlay = new View.OnClickListener() {

        @Override
        public void onClick(View v) {
            if (!playPause) {
                btn.setImageResource(R.drawable.button_pause);
                if (intialStage)
                    new Player()
                            .execute("http://listen.radioking.com/radio/116593/stream/155905");
                else {
                    if (!mediaPlayer.isPlaying())
                        mediaPlayer.start();
                }
                playPause = true;
            } else {
                btn.setImageResource(R.drawable.button_play);
                if (mediaPlayer.isPlaying())
                    mediaPlayer.pause();
                playPause = false;
            }
        }
    };
    /**
     * preparing mediaplayer will take sometime to buffer the content so prepare it inside the background thread and starting it on UI thread.
     * @author piyush
     *
     */

    class Player extends AsyncTask<String, Void, Boolean> {
        private ProgressDialog progress;

        @Override
        protected Boolean doInBackground(String... params) {
            Boolean prepared;
            try {

                mediaPlayer.setDataSource(params[0]);

                mediaPlayer.setOnCompletionListener(new MediaPlayer.OnCompletionListener() {

                    @Override
                    public void onCompletion(MediaPlayer mp) {
                        intialStage = true;
                        playPause=false;
                        btn.setBackgroundResource(R.drawable.button_play);
                        mediaPlayer.stop();
                        mediaPlayer.reset();
                    }
                });
                mediaPlayer.prepare();
                prepared = true;
            } catch (IllegalArgumentException e) {
                prepared = false;
            } catch (SecurityException e) {
                prepared = false;
            } catch (IllegalStateException e) {
                prepared = false;
            } catch (IOException e) {
                prepared = false;
            }
            return prepared;
        }

        @Override
        protected void onPostExecute(Boolean result) {
            super.onPostExecute(result);
            if (progress.isShowing()) {
                progress.cancel();
            }
            mediaPlayer.start();

            intialStage = false;
        }

        public Player() {
            progress = new ProgressDialog(RadioActivity.this);
        }

        @Override
        protected void onPreExecute() {
            // TODO Auto-generated method stub
            super.onPreExecute();
            this.progress.setMessage("Buffering...");
            this.progress.show();

        }
    }

    @Override
    protected void onPause() {
        super.onPause();
        if (mediaPlayer != null) {
            mediaPlayer.reset();
            mediaPlayer.release();
            mediaPlayer = null;
        }
    }

}
