<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctor_awards_honour extends Model
{
    use HasFactory;

    protected $table = 'doctor_awards_honour';
    protected $primaryKey = 'id';
    //public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['awards_honour','doctor'];
}
