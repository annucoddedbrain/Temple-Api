<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    protected $fillable = [
        'filenames'
    ];

    public function setFilenamesAttributes($value){
        $this->attributes['filenames'] = json_encode($value);
    }
}
