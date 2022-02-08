<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute,social,carousel_home,about_us,media,department,department_rating_services,service,
  doctor, patient};
use App\Http\Controllers\Utils\AutoModifableText;
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;

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
      $title = $data -> title;
      $desc = AutoModifableText::getText($data -> description);
      return ['description'=>$desc, 'title'=>$title];
    });
    $department = department::all() -> map(function ($data)
    {
      $desc = AutoModifableText::getText($data -> description);
      $ico = DataList::department_icon[$data -> icon];
      $rate = department_rating_services::where('department',$data -> id) -> avg('score');
      $total = department_rating_services::where('department',$data -> id) -> count('department');
      $rating = number_format($rate, 1, '.', '');
      $data -> description = '';
      return [$data, 'description'=>$desc, 'icon'=>$ico, 'rating' => ['rating'=>$rating,'total'=>$total]];
    });
    $service = service::select('id','name','description_title','icon') -> take(9) -> get() -> map(function ($data)
    {
      $ico = DataList::department_icon[$data -> icon];
      return [$data, 'icon'=>$ico];
    });
    $achivement = global_attribute::select('name','description') -> whereIn('name',['total_rooms','year_experience']) -> get();
    $doc_count = doctor::all() -> count('id');
    $pat_count = patient::all() -> count('id');
    return view('User/Component/home',['global' => $global,'social' => $social, 'carousel_main' => $carousel_main,
      'aboutUs' => [$about_us, $about_image],'department' => $department, 'service' => $service,
      'achivement' => [$achivement,$doc_count,$pat_count]]);
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
