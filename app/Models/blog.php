<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;

    protected $table = 'blog';
    protected $primaryKey = 'id';
    //public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['title','description','doctor','dates_upload','views'];
}
