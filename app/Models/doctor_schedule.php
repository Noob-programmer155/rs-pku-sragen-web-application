<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctor_schedule extends Model
{
    use HasFactory;

    protected $table = 'doctor_schedule';
    protected $primaryKey = 'id';
    //public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['doctor','days','timestart','timeend'];
}
