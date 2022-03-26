<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog_comments extends Model
{
    use HasFactory;

    protected $table = 'blog_comments';
    protected $primaryKey = 'id';
    //public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['blog','description','replays','dates_upload','username','image'];
}
