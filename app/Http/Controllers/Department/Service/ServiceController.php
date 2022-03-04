<?php
namespace App\Http\Controllers\Department\Service;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute,service};
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Utils\AutoModifableText;
use Illuminate\Http\Request;

class ServiceController extends Controller{
  public function getAllService(){
    $global = global_attribute::select('name','description') -> whereIn('name',['email','telp','location']) -> get();
    $social_global = global_attribute::select('name','description') -> whereIn('name',[...DataList::social]) -> get();
    $services = service::select('id','name','description_title','icon') -> get() -> map(function ($data){
      $data -> icon = DataList::department_icon[$data -> icon];
      return $data;
    });
    $count = count($services);
    return view('User/Component/Department/Service/ServiceAll',[
      'global' => $global,'social_global' => $social_global,'services' => ['data' => $services,'count_item' => $count]
    ]);
  }
  public function getService(Request $req,$name){
    $global = global_attribute::select('name','description') -> whereIn('name',['email','telp','location']) -> get();
    $social_global = global_attribute::select('name','description') -> whereIn('name',[...DataList::social]) -> get();
    $services = service::where('id', $req -> idserv) -> where('name',$name) -> get() -> map(function ($data) use ($req){
      $data -> icon = DataList::department_icon[$data -> icon];
      $data -> description = AutoModifableText::getText($data -> description);
      $image = DB::select("select a.media as media from media as a inner join services_image as b on a.id = b.media
        where b.service = ?",[$req -> idserv]);
      $departmentRaw = DB::select("select a.location as location,a.telp_department as telp_department,a.name as name,a.icon as icon from department as a
        inner join department_services as b on a.id = b.department where b.service = ?",[$req -> idserv]);
      $department = collect($departmentRaw) -> map(function ($data){
        $data -> icon = DataList::department_icon[$data -> icon];
        return $data;
      });
      $allServices = service::select('id','name') -> take(10) -> get();
      return [$data, 'image'=> collect($image), 'department' => $department, 'allServices' => $allServices];
    });
    return view('User/Component/Department/Service/ServiceDetail',[
      'global' => $global,'social_global' => $social_global,'services' =>  $services, 'serv_name' => $name
    ]);
  }
}
