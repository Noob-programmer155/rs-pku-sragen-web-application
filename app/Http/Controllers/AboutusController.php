<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute,department,doctor,about_us,media,patient,
  doctor_profession,patient_response};
use App\Http\Controllers\Utils\AutoModifableText;
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;
use DateTime;

class AboutusController extends Controller{
  public function aboutUs(){
    $global = global_attribute::select('name','description') -> whereIn('name',['email','telp','location']) -> get();
    $social_global = global_attribute::select('name','description') -> whereIn('name',[...DataList::social]) -> get();
    $about_image = media::select('name','media') -> whereIn('name',['about_img','about_media']) -> get();
    $about_us = about_us::select('title','description') -> get() -> map(function ($data)
    {
      $data -> description = AutoModifableText::getText($data -> description);
      return $data;
    });
    $achivement = global_attribute::select('name','description') -> whereIn('name',['total_rooms','year_experience']) -> orderBy('name','ASC') -> get();
    $doc_count = doctor::select('id') -> count('id');
    $pat_count = patient::select('id') -> count('id');
    $doctors = doctor::select('id','image','username','profession') -> take(4) -> get() -> map(function ($data)
    {
      $data -> profession = doctor_profession::select('title') -> where('id',$data -> profession) -> get() -> map(
        function ($item)
        {
          return $item -> title;
        }
      )[0];
      $social_doc = DB::select('select a.social as social,a.link as link from social as a '.
      'inner join doctor_social as b on a.id = b.social where b.doctor = ?',[$data -> id]);
      return [$data,$social_doc];
    });
    $testimony = patient_response::select('name','patient_type','description','image') -> orderBy('id', 'desc') -> take(15) -> get();
    return view('User/Component/Aboutus/Aboutus',[
      'global' => $global,'social_global' => $social_global,'aboutUs' => [$about_us, $about_image],
      'achivement' => ['total_rooms' => (int)$achivement[0] -> description,'year_exp' => (int)$achivement[1] -> description,
      'doc_count'=>$doc_count,'patient_count'=>$pat_count],'our_doctors'=>$doctors,'testimony'=>
      $testimony,
    ]);
  }
}
