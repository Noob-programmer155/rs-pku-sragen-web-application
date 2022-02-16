<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class doctor_social extends Model
{
    use HasFactory;

    protected $table = 'doctor_social';
    protected $primaryKey = 'id';
    //public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['social','doctor'];
}
