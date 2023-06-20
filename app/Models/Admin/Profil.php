<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Profil extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $table = 'profils';

    protected $fillable = [
        'content'
    ];
}
