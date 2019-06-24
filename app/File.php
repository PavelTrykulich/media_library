<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    protected $fillable = [
        'user_id', 'title', 'type_file', 'description',
        'short_description', 'date_last_eval', 'path_to_file', 'size'
    ];

        public function user()
        {
            return $this->belongsTo('App\User');
        }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function ratings()
    {
        return $this->hasMany('App\Rating');
    }

    public function audio()
    {
        return $this->hasOne('App\Audio');
    }

    public function video()
    {
        return $this->hasOne('App\Video');
    }

    public function photo()
    {
        return $this->hasOne('App\Photo');
    }


    public function getType()
    {
        return trim($this->type_file);
    }

    public function getFormat()
    {
        switch ($this->getType()) {
            case 'audio':
                /*if ($this->audio->format != null) {
                    return $this->audio->format->title;
                } else {
                    return '';
                }*/

                try{
                    return $this->audio->format->title;
                }catch (\Exception $e){
                    return 'Not found';
                }
                break;
            case 'photo':
                /*if ($this->photo->format->title != null) {
                    return $this->photo->format->title;
                } else {
                    return '';
                }*/

                try{
                    return $this->photo->format->title;
                }catch (\Exception $e){
                    return 'Not found';
                }
                break;
            case 'video':
                /*if ($this->video->format->title != null) {
                    return $this->video->format->title;
                } else {
                    return '';
                }*/

                try{
                    return $this->video->format->title;
                }catch (\Exception $e){
                    return 'Not found';
                }
                break;
        }
    }

    public function getGenres()
    {
        switch ($this->getType()) {
            case 'audio':
                if (isset($this->audio->genres)) {
                    return $this->audio->genres;
                } else {
                    return '';
                }
                break;
            case 'photo':
                if (isset($this->photo->genres)) {
                    return $this->photo->genres;
                } else {
                    return '';
                }
                break;
            case 'video':
                if (isset($this->video->genres)) {
                    return $this->video->genres;
                } else {
                    return '';
                }

                break;
        }
    }

    public function getGenresInString()
    {
        if (null != $this->getGenres()) {

            $genres = $this->getGenres();
            $genres_str = '';
            foreach ($genres as $genre) {
                $genres_str .= $genre->title;
                if ($genre !== $genres->last()) {
                    $genres_str .= ',';
                }
            }
            return $genres_str;
        } else {
            return '';
        }

    }

    public function scopeGenreForSelect($query, $type, $genre)
    {
        $genre = trim($genre);
        $type = trim($type);
        switch ($type) {
            case 'audio':
                return $query->select('files.*')->join('audios', 'files.id', 'audios.file_id')
                    ->join('genre_for_audios', 'audios.id', 'genre_for_audios.audio_id')
                    ->join('genre_audios', 'genre_for_audios.genre_audio_id', 'genre_audios.id')
                    ->where('genre_audios.title', $genre);
                break;
            case 'photo':
                return $query->select('files.*')->join('photos', 'files.id', 'photos.file_id')
                    ->join('genre_for_photos', 'photos.id', 'genre_for_photos.photo_id')
                    ->join('genre_photos', 'genre_for_photos.genre_photo_id', 'genre_photos.id')
                    ->where('genre_photos.title', $genre);
                break;
            case 'video':
                return $query->select('files.*')->join('videos', 'files.id', 'videos.file_id')
                    ->join('genre_for_videos', 'videos.id', 'genre_for_videos.video_id')
                    ->join('genre_videos', 'genre_for_videos.genre_video_id', 'genre_videos.id')
                    ->where('genre_videos.title', $genre);
                break;
        }
    }


    public function scopeFormatForSelect($query, $type, $format)
    {
        $format = trim($format);
        $type = trim($type);
        switch ($type) {
            case 'audio':
                return $query->select('files.*')->join('audios', 'files.id', 'audios.file_id')
                    ->join('format_audios', 'audios.format_audio_id', 'format_audios.id')
                    ->where('format_audios.title', $format);
                break;
            case 'photo':
                return $query->select('files.*')->join('photos', 'files.id', 'photos.file_id')
                    ->join('format_photos', 'photos.format_photo_id', 'format_photos.id')
                    ->where('format_photos.title', $format);
                break;
            case 'video':
                return $query->select('files.*')->join('videos', 'files.id', 'videos.file_id')
                       ->join('format_videos', 'videos.format_video_id', 'format_videos.id')
                    ->where('format_videos.title', $format);
                break;
        }
    }

    public function getPathToFile()
    {
        return Storage::url('files/' . $this->getType() . 's/' . $this->path_to_file);
    }

    public function getPathToPhotoForAudio()
    {
        return $this->audio->photos->first()->file->getPathToFile();
    }

    public function getPathToPhotoForVideo()
    {
        return $this->video->photos->first()->file->getPathToFile();
    }

    public function getSize()
    {
        if ($this->size < 1000 * 1024) {
            return number_format($this->size / 1024, 2) . " KB";
        } elseif ($this->size < 1000 * 1048576) {
            return number_format($this->size / 1048576, 2) . " MB";
        } elseif ($this->size < 1000 * 1073741824) {
            return number_format($this->size / 1073741824, 2) . " GB";
        } else {
            return number_format($this->size / 1099511627776, 2) . " TB";
        }

    }

    public function avgRatingFile()
    {
        return $this->ratings->avg('rating');
    }

    public function userScoreFile()
    {
        $rating = $this->ratings->where('user_id', Auth::id())->where('file_id', $this->id)->first();

        if ($rating != null) {
            return $rating->rating;
        }else {
            return 0;
        }
    }

    public function getAttachedFiles()
    {
        switch ($this->getType()) {
            case 'audio':
                if ($this->audio->photos->isNotEmpty())
                return $this->audio->photos;
                break;
            case 'photo':
                if ($this->photo->audios->isNotEmpty() && $this->photo->videos->isNotEmpty()){
                    return $this->photo->videos->merge($this->photo->audios);
                }elseif($this->photo->videos->isNotEmpty()) {
                    return  $this->photo->videos;
                }elseif ($this->photo->audios->isNotEmpty()){
                    return $this->photo->audios;
                }else{
                    return 0;
                }
                break;
            case 'video':
                if ($this->video->photos->isNotEmpty())
                return $this->video->photos;
                break;
        }
        return 0;
    }
}