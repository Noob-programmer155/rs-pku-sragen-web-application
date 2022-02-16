<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient_response extends Model
{
    use HasFactory;

    protected $table = 'patient_response';
    protected $primaryKey = 'id';
    //public $incrementing = true;
    public $timestamps = false;

    protected $fillable = ['name','patient_type','description','image'];
}
