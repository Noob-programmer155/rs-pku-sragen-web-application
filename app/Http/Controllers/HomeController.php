<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute, social, carousel_home, about_us, media
  , department, department_rating_services, service, doctor, patient
  , category_research, patient_response, doctor_profession};
use App\Http\Controllers\Utils\AutoModifableText;
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use IntlDateFormatter, DateTime;

class HomeController extends Controller {
  public function home(Request $req) {
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
    $datePattern = new IntlDateFormatter('ID', IntlDateFormatter::FULL
      , IntlDateFormatter::NONE);
    $datePattern -> setPattern('EEEE, d MMMM Y');
    $carousel_main = carousel_home::select('title', 'description', 'image')
      -> take(5) -> get();
    $about_image = media::select('name', 'media')
      -> whereIn('name', ['about_img', 'about_media']) -> get();
    $about_us = about_us::select('title', 'description') -> get()
      -> map(function ($data) {
        $data -> description = AutoModifableText::getText($data -> description);
        return $data;
    });
    $department = department::all() -> take(10) -> map(function ($data) {
      $data -> description = AutoModifableText::getText($data -> description);
      $data -> icon = DataList::department_icon[$data -> icon];
      $rates = DB::select('select avg(a.score) as rate, count(a.id) as count
        from department_rating_services as a inner join
        department_services as b on a.service = b.service
        where b.department = ? group by b.department', [$data -> id]);
      $rating = number_format($rates[0] -> rate, 1, '.', '');
      return [$data, 'rating' => ['rating' => $rating
        , 'total' => $rates[0] -> count]];
    });
    $service = collect(DB::select('select a.*, avg(b.score) as score,
      count(b.id) as count from service as a inner join
      department_rating_services as b on a.id = b.service group by a.id
      having avg(b.score) >= 3 order by avg(b.score) desc limit 9'))
      -> map(function ($data) {
        $data -> icon = DataList::department_icon[$data -> icon];
        $data -> score = number_format($data -> score, 1, '.', '');
        return $data;
    });
    $achivement = global_attribute::select('name', 'description')
      -> whereIn('name', ['total_rooms', 'year_experience'])
      -> orderBy('name', 'ASC') -> get();
    $doc_count = doctor::select('id') -> count('id');
    $pat_count = patient::select('id') -> count('id');
    $projects = DB::select('select projects.id, title, image_init,
      b.name as name from projects inner join category_research as b
      on category = b.id order by project_date limit 6');
    $init_projects = category_research::select('name') -> get();
    $testimony = patient_response::select('name', 'patient_type'
      , 'description', 'image') -> orderBy('id',  'desc') -> take(15) -> get();
    $doctors = doctor::select('id', 'image', 'username', 'profession')
      -> take(4) -> get() -> map(function ($data) {
        $data -> profession = doctor_profession::select('title')
          -> where('id', $data -> profession) -> get() -> map(function ($item) {
            return $item -> title;
        })[0];
      $social_doc = DB::select('select a.social as social, a.link as link
        from social as a inner join doctor_social as b on a.id = b.social
        where b.doctor = ?', [$data -> id]);
      return [$data, $social_doc];
    });
    $vblogId = null;
    $viewsblog = collect(DB::select('select a.id as id, a.title as title,
      a.description as description, a.dates_upload as date, a.views as views,
      a.image_home as image, b.id as doc_id, b.username as doc_username,
      b.image as doc_image from blog as a inner join doctor as b
      on a.doctor = b.id order by a.views desc limit 1'))
      -> map(function ($data) use(&$vblogId, $datePattern) {
        $vblogId = $data -> id;
        $matches = array();
        preg_match('/p->(.*?)<-p/s',  $data -> description,  $matches);
        $data -> description = AutoModifableText::getText($matches[0]);
        $dateItem = new DateTime($data -> date);
        $data -> date = $datePattern -> format($dateItem);
        return $data;
    });
    $latestblog = null;
    if($vblogId != null){
      $latestblog = collect(DB::select('select a.id as id, a.title as title,
        a.description as description, a.dates_upload as date, a.views as views,
        a.image_home as image, b.id as doc_id, b.username as doc_username,
        b.image as doc_image from blog as a inner join doctor as b
        on a.doctor = b.id where a.id != ? order by a.dates_upload desc limit 6'
        , [$vblogId]))
        -> map(function ($data, $i) use(&$viewsblog, $datePattern) {
          $matches = [];
          preg_match('/p->(.*?)<-p/s',  $data -> description,  $matches);
          $data -> description = AutoModifableText::getText($matches[0]);
          $dateItem = new DateTime($data -> date);
          $data -> date = $datePattern -> format($dateItem);
          if($i <= 0){
            $viewsblog -> push($data);
            return null;
          }
          return $data;
      });
    }
    return view('User/Component/home', ['global' => $global, 'social_global'
      => $social_global, 'time_works' => $time_work , 'carousel_main'
      => $carousel_main, 'aboutUs' => [$about_us, $about_image]
      , 'department' => $department, 'service' => $service
      , 'achivement' => ['total_rooms' => (int)$achivement[0] -> description
        , 'year_exp' => (int)$achivement[1] -> description
        , 'doc_count' => $doc_count, 'patient_count' => $pat_count]
      , 'projects' => [$init_projects, $projects], 'testimony'=> $testimony
      , 'our_doctors'=>$doctors, 'blogs'=>[$viewsblog, $latestblog]]);
  }
  public function login(Request $req){
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
    return view('User/Component/login', [
      'global' => $global, 'social_global' => $social_global
      , 'time_works' => $time_work
    ]);
  }
  public function signIn(Request $req)
  {
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
    return view('User/Component/signIn', [
      'global' => $global, 'social_global' => $social_global
      , 'time_works' => $time_work
    ]);
  }
  public function ContactUs(Request $req){
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
    return view('User/Component/contactUs', [
      'global' => $global, 'social_global' => $social_global
      , 'time_works' => $time_work
    ]);
  }
  public function appointmentView(Request $req){
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
    return view('User/Component/appointment',[
      'global' => $global, 'social_global' => $social_global
      , 'time_works' => $time_work
    ]);
  }
}
