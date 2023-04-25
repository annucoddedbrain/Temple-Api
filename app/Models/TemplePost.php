<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplePost extends Model
{
    use HasFactory;

    protected $table = 'temple_posts';

    protected $fillable = [
        'title',
        'description',
        'media',
        'location',
        'location_LatLng',
        'time_table',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
