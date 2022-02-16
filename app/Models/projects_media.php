<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projects_media extends Model
{
    use HasFactory;

    protected $table = 'projects_media';
    protected $primaryKey = 'id';
    //public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['project','media'];
}
