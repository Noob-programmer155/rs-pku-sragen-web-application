<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute,department,doctor};
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;
use DateTime;

class AppointmentController extends Controller{
  public function getAppointment(){
    $global = global_attribute::select('name','description') -> whereIn('name',['email','telp','location']) -> get();
    $social_global = global_attribute::select('name','description') -> whereIn('name',[...DataList::social]) -> get();
    $departments = department::select('id','name') -> get();
    $doctors = doctor::select('id','username','department') -> get();
    return view('User/Component/Appointment/BookAppointment',[
      'global' => $global,'social_global' => $social_global, 'department_list' => $departments,
      'doctor_list' => $doctors
    ]);
  }
  public function postAppointment(){

  }
}
