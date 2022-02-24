<?php
namespace App\Http\Controllers\Department;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute,department,department_rating_services,media,};
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Utils\AutoModifableText;
use Illuminate\Http\Request;

class DepartmentController extends Controller{
  public function getAllDepartment(){
    $global = global_attribute::select('name','description') -> whereIn('name',['email','telp','location']) -> get();
    $social_global = global_attribute::select('name','description') -> whereIn('name',[...DataList::social]) -> get();
    $departments = department::all() -> map(function ($data)
    {
      $data -> description = AutoModifableText::getText($data -> description);
      $data -> icon = DataList::department_icon[$data -> icon];
      $rate = department_rating_services::where('department',$data -> id) -> avg('score');
      $total = department_rating_services::where('department',$data -> id) -> count('department');
      $rating = number_format($rate, 1, '.', '');
      return [$data, 'rating' => ['rating'=>$rating,'total'=>$total]];
    });
    return view('User/Component/Department/DepartmentAll',[
        'global' => $global,'social_global' => $social_global,'department' => $departments
    ]);
  }
  public function getDepartment(Request $request,$name){
    $global = global_attribute::select('name','description') -> whereIn('name',['email','telp','location']) -> get();
    $social_global = global_attribute::select('name','description') -> whereIn('name',[...DataList::social]) -> get();
    $departments = department::where('id',$request -> iddep) -> where('name',$name) -> get() -> map(function ($data) use ($request){
      $data -> description = AutoModifableText::getText($data -> description);
      $data -> icon = DataList::department_icon[$data -> icon];
      $rate = department_rating_services::where('department',$data -> id) -> avg('score');
      $total = department_rating_services::where('department',$data -> id) -> count('department');
      $rating = number_format($rate, 1, '.', '');
      $serv = DB::select("select b.id as id,b.name as name,b.description_title as description_title,b.icon as icon
        from service as b inner join department_services as a on b.id = a.service where a.department = ?",[$request -> iddep]);
      $services = collect($serv) -> map(function ($data){
        $data -> icon = DataList::department_icon[$data -> icon];
        return $data;
      });
      $image = DB::select("select c.media as media from media as c inner join services_image as b on c.id = b.media
        inner join department_services as a on a.service = b.service where a.department = ? limit 5",[$request -> iddep]);
      return [$data, 'rating' => ['rating'=>$rating,'total'=>$total],'services'=>$services,'image'=>collect($image)];
    });
    return view("User/Component/Department/DepartmentDetail",[
      'dep_name'=>$name,'global' => $global,'social_global' => $social_global,'department'=>$departments
    ]);
  }
}
