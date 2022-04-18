<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $appends = ['read_time'];

    public function getReadTimeAttribute() {
        return readtime($this->body);
    }

}
