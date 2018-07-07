<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Profile extends Model
{
    use Sluggable;
    use SluggableScopeHelpers;

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'user_id', 
        'first_name', 
        'last_name', 
        'gender', 
        'date_of_birth',
        'phone',
        'country',
        'picture',
    ];

    protected $appends = [
        'username',
        'picture_path',
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sluggable() {
        return [
            'slug' => [
                'source' => 'user.username'
            ]
        ];
    }

    public function getUsernameAttribute() {
        return $this->user()->first()->username;
    }

    public function getPicturePathAttribute() {
        if ($this->picture) {
            return '/storage/profiles/' . $this->picture;
        } else {
            return '/storage/profiles/default-profile-picture.jpg';
        }
    }
}