<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class research extends Model
{
    use HasFactory;

    protected $table = 'research';
    protected $primaryKey = 'id';
    //public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['title','client','category','dates','location'];
}
