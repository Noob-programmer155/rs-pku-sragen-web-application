<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute,social,carousel_home,about_us,media,department,department_rating_services,service,
  doctor, patient, category_research, patient_response, doctor_profession};
use App\Http\Controllers\Utils\AutoModifableText;
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;
use DateTime;

class HomeController extends Controller
{
  public function init()
  {
    // global_attribute::Create([
    // 'name' => 'email',
    // 'description' => 'rijal.amar29@gmail.com'
    // ]);
    // global_attribute::Create([
    // 'name' => 'telp',
    // 'description' => '089-8868-4379'
    // ]);
    // global_attribute::Create([
    // 'name' => 'instagram',
    // 'description' => 'https://www.instagram.com/rspkumuhammadiyahsragen/'
    // ]);
    // global_attribute::Create([
    //   'name' => 'facebook',
    //   'description' => 'https://m.facebook.com/pkumuhsragen/'
    // ]);
  }
  public function home()
  {
    // HomeController::init();
    $global = global_attribute::select('name','description') -> whereIn('name',['email','telp']) -> get();
    $social = global_attribute::select('name','description') -> whereIn('name',[...DataList::social]) -> get();
    $carousel_main = carousel_home::select('title','description','image') -> take(5) -> get();
    $about_image = media::select('name','media') -> whereIn('name',['about_img','about_media']) -> get();
    $about_us = about_us::select('title','description') -> get() -> map(function ($data)
    {
      $data -> description = AutoModifableText::getText($data -> description);
      return $data;
    });
    $department = department::all() -> map(function ($data)
    {
      $data -> description = AutoModifableText::getText($data -> description);
      $data -> icon = DataList::department_icon[$data -> icon];
      $rate = department_rating_services::where('department',$data -> id) -> avg('score');
      $total = department_rating_services::where('department',$data -> id) -> count('department');
      $rating = number_format($rate, 1, '.', '');
      return [$data, 'rating' => ['rating'=>$rating,'total'=>$total]];
    });
    $service = service::select('id','name','description_title','icon') -> take(9) -> get() -> map(function ($data)
    {
      $data -> icon = DataList::department_icon[$data -> icon];
      return $data;
    });
    $achivement = global_attribute::select('name','description') -> whereIn('name',['total_rooms','year_experience']) -> orderBy('name','ASC') -> get();
    $doc_count = doctor::select('id') -> count('id');
    $pat_count = patient::select('id') -> count('id');
    $projects = DB::select('select projects.id,title,description,image_init,b.name as name from projects inner join category_research as b on category = b.id order by project_date limit 6');
    $init_projects = category_research::select('name') -> get();
    $testimony = patient_response::select('name','patient_type','description','image') -> orderBy('id', 'desc') -> take(15) -> get();
    $doctors = doctor::select('id','image','username','profession') -> take(4) -> get() -> map(function ($data)
    {
      $data -> profession = doctor_profession::select('title') -> where('id',$data -> profession) -> get() -> map(
        function ($item)
        {
          return $item -> title;
        }
      )[0];
      $social = DB::select('select a.social as social,a.link as link from social as a '.
      'inner join doctor_social as b on a.id = b.social where b.doctor = ?',[$data -> id]);
      return [$data,$social];
    });
    $vblog = DB::select('select a.id as id,a.title as title,a.description as description,a.dates_upload as date,a.views as views,b.username as doc_username,b.image as doc_image from blog as a'.
      ' inner join doctor as b on a.doctor = b.id order by a.views desc limit 1');
    $vblogId = null;
    $viewsblog = collect($vblog) -> map(function ($data) use(&$vblogId)
      {
        $vblogId = $data -> id;
        $matches = array();
        preg_match('/p->(.*?)<-p/s', $data -> description, $matches);
        $data -> description = AutoModifableText::getText($matches[0]);
        $data -> date = DateTime::createFromFormat('Y-m-d H:m:s',$data -> date) -> format('d F Y');
        $image = DB::select('select a.media as media from media as a '.
          'inner join blog_media as b on a.id = b.media where b.blog = ? limit 1',[$data -> id]);
        return [$data, $image];
      });
    $latestblog = null;
    if($vblogId != null){
      $lblog = DB::select('select a.id as id,a.title as title,a.description as description,a.dates_upload as date,a.views as views,b.username as doc_username,b.image as doc_image from blog as a'.
      ' inner join doctor as b on a.doctor = b.id where a.id != ? order by a.dates_upload desc limit 5',[$vblogId]);
    $latestblog = collect($lblog) -> map(function ($data,$i) use(&$viewsblog)
      {
        $matches = [];
        preg_match('/p->(.*?)<-p/s', $data -> description, $matches);
        $data -> description = AutoModifableText::getText($matches[0]);
        $data -> date = DateTime::createFromFormat('Y-m-d H:m:s',$data -> date) -> format('d F Y');
        $image = DB::select('select a.media as media from media as a '.
          'inner join blog_media as b on a.id = b.media where b.blog = ? limit 1',[$data -> id]);
        if($i <= 0){
          $viewsblog -> push([$data, $image]);
          return null;
        }
        return [$data, $image];
      });}
    return view('User/Component/home',['global' => $global,'social' => $social, 'carousel_main' => $carousel_main,
      'aboutUs' => [$about_us, $about_image],'department' => $department, 'service' => $service,
      'achivement' => ['total_rooms' => (int)$achivement[0] -> description,'year_exp' => (int)$achivement[1] -> description,
      'doc_count'=>$doc_count,'patient_count'=>$pat_count],'projects' => [$init_projects,$projects],'testimony'=>
      $testimony,'our_doctors'=>$doctors,'blogs'=>[$viewsblog,$latestblog]]);
  }
  public function login()
  {
    return view('User/Component/login',[]);
  }
  public function signIn()
  {
    return view('User/Component/signIn',[]);
  }
}
