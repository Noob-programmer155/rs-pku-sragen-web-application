<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute, department, doctor_schedule};
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Utils\AutoModifableText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use DateTime;

class DoctorController extends Controller {
  public function getDoctorAll(Request $req) {
    if($req -> session() -> has('gl') && $req -> session() -> has('sg') &&
      $req -> session() -> has('tw')) {
        $global = json_decode($req -> session() -> get('gl'));
        $social_global = json_decode($req -> session() -> get('sg'));
        $time_work = json_decode($req -> session() -> get('tw'));
    } else {
      $gl = global_attribute::select('name', 'description')
        -> whereIn('name', ['email', 'telp', 'location']) -> get();
      $sg = global_attribute::select('name', 'description')
        -> whereIn('name', [...DataList::social]) -> get();
      $tw = global_attribute::select('name', 'description')
        -> where('name', 'work-hours') -> get();
      session(['gl' => json_encode($gl)]);
      session(['sg' => json_encode($sg)]);
      session(['tw' => json_encode($tw)]);
      $global = $gl;
      $social_global = $sg;
      $time_work = $tw;
    }
    $department = department::select('name', 'icon') -> get()
      -> map(function ($data) {
        $data -> icon = DataList::department_icon[$data -> icon];
        return $data;
    });
    $doctor = collect(DB::select("select b.title as profession, a.id as id,
      a.username as username, a.image as image, c.name as department
      from doctor as a inner join doctor_profession as b
      on a.profession = b.id inner join department as c on a.department = c.id")
    );
    return view('User/Component/Doctor/DoctorAll', [
      'global' => $global, 'social_global' => $social_global
      , 'time_works' => $time_work, 'doctors'
      => ['department' => $department, 'doctor' => $doctor]
    ]);
  }
  public function getDoctor(Request $req, $name) {
    if($req -> session() -> has('gl') && $req -> session() -> has('sg') &&
      $req -> session() -> has('tw')) {
        $global = json_decode($req -> session() -> get('gl'));
        $social_global = json_decode($req -> session() -> get('sg'));
        $time_work = json_decode($req -> session() -> get('tw'));
    } else {
      $gl = global_attribute::select('name', 'description')
        -> whereIn('name', ['email', 'telp', 'location']) -> get();
      $sg = global_attribute::select('name', 'description')
        -> whereIn('name', [...DataList::social]) -> get();
      $tw = global_attribute::select('name', 'description')
        -> where('name', 'work-hours') -> get();
      session(['gl' => json_encode($gl)]);
      session(['sg' => json_encode($sg)]);
      session(['tw' => json_encode($tw)]);
      $global = $gl;
      $social_global = $sg;
      $time_work = $tw;
    }
    $doctor = DB::select("select a.username as username, a.wise_words,
      b.name as department, a.experience as experience, a.phone as phone,
      a.email as email, a.address as address, a.biography as biography,
      c.title as doctor_specialty, a.conditions as conditions, a.image as image,
      d.title as profession from doctor as a inner join department as b
      on a.department = b.id inner join doctor_specialty as c
      on a.doctor_specialty = c.id inner join doctor_profession as d
      on a.profession = d.id where a.id = ?", [$req -> iddoc]);
    $doctor[0] -> biography = AutoModifableText::getText($doctor[0]
      -> biography);
    $social = collect(DB::select("select a.social as social, a.link as link
      from social as a inner join doctor_social as b on a.id = b.social
      where b.doctor = ?", [$req -> iddoc]));
    $education = collect(DB::select("select a.name_place as name_place
      from education as a inner join doctor_education as b
      on a.id = b.education where b.doctor = ?", [$req -> iddoc]));
    $awards = collect(DB::select("select a.title as title, a.years as years
      from awards_honour as a inner join doctor_awards_honour as b
      on a.id = b.awards_honour where b.doctor = ?", [$req -> iddoc]));
    $organization = collect(DB::select("select a.name as name, a.link as link
      from social_group as a inner join doctor_social_group as b
      on a.id = b.social_group where b.doctor = ?", [$req -> iddoc]));
    $schedule = doctor_schedule::where('doctor', $req -> iddoc) -> get()
      -> map(function ($data) {
        $data -> timestart = DateTime::createFromFormat('H:i:s',  $data
          -> timestart) -> format('H.i');
        $data -> timeend = DateTime::createFromFormat('H:i:s',  $data
          -> timeend) -> format('H.i');
        return $data;
    });
    return view('User/Component/Doctor/DoctorDetail', [
      'global' => $global, 'social_global' => $social_global
      , 'time_works' => $time_work, 'doctor' => ['data' => $doctor
      , 'social' => $social, 'educations' => $education, 'awards' => $awards
      , 'organization' => $organization, 'schedule' => $schedule]
    ]);
  }
  public function doctorsTableWorking(Request $req){
    if($req -> session() -> has('gl') && $req -> session() -> has('sg') &&
      $req -> session() -> has('tw')) {
        $global = json_decode($req -> session() -> get('gl'));
        $social_global = json_decode($req -> session() -> get('sg'));
        $time_work = json_decode($req -> session() -> get('tw'));
    } else {
      $gl = global_attribute::select('name', 'description')
        -> whereIn('name', ['email', 'telp', 'location']) -> get();
      $sg = global_attribute::select('name', 'description')
        -> whereIn('name', [...DataList::social]) -> get();
      $tw = global_attribute::select('name', 'description')
        -> where('name', 'work-hours') -> get();
      session(['gl' => json_encode($gl)]);
      session(['sg' => json_encode($sg)]);
      session(['tw' => json_encode($tw)]);
      $global = $gl;
      $social_global = $sg;
      $time_work = $tw;
    }
    $timeTable = collect(DB::select('select b.username as username,
      c.title as profession, a.timestart as timestart, a.timeend as timeend,
      a.days as days from doctor_schedule as a inner join doctor as b
      on a.doctor = b.id inner join doctor_profession as c
      on b.profession = c.id order by timestart'));
    $arr = [];
    $arrTime = [];
    $weekArr = [];
    $time = null;
    foreach ($timeTable as $key => $data) {
      $helperStart = array();
      $helperEnd = array();
      $data -> time = DateTime::createFromFormat('H:i:s',  $data -> timestart)
        -> format('H.i') . ' - ' . DateTime::createFromFormat('H:i:s',  $data
        -> timeend) -> format('H.i');
      $dayRange = explode('-', $data -> days);
      $dayStr = trim($dayRange[0]);
      $dayEd = $dayStr;
      if(count($dayRange) > 1){
        $dayEd = trim($dayRange[1]);
      }
      $weekDays = ['senin', 'selasa', 'rabu', 'kamis', 'jum`at', 'sabtu'
        , 'minggu'];
      $dayStart = array_search(strtolower($dayStr), $weekDays);
      $dayEnd = array_search(strtolower($dayEd), $weekDays);
      $timeRange = $data -> time;
      if($key !== 0) {
        if($time !== $timeRange) {
          array_push($arr, $weekArr);
          $time = $timeRange;
          $weekArr = [];
          array_push($arrTime, $time);
        }
      } else {
        $time = $timeRange;
        array_push($arrTime, $time);
      }
      $tr = $dayEnd-$dayStart;
      if($tr < 0) {
        $tr = $tr + 7;
      }
      for ($i=0; $i <= $tr; $i++) {
        $clone = $data;
        if($dayStart+$i > 6) {
          if(!array_key_exists($dayStart+$i-6, $weekArr)) {
            $weekArr[$dayStart+$i-6] = array();
          }
          $clone -> daystart = $dayStart;
          $clone -> dayend = $dayEnd;
          array_push($weekArr[$dayStart+$i-6], $clone);
        } else {
          if(!array_key_exists($dayStart+$i, $weekArr)) {
            $weekArr[$dayStart+$i] = array();
          }
          $clone -> daystart = $dayStart;
          $clone -> dayend = $dayEnd;
          array_push($weekArr[$dayStart+$i], $clone);
        }
      }
    }
    return view('User/Component/Doctor/DoctorTimeTable', [
        'global' => $global, 'social_global' => $social_global
        , 'time_works' => $time_work, 'timetable'
        => ['item' => $arr, 'time' => $arrTime]
    ]);
  }
}
