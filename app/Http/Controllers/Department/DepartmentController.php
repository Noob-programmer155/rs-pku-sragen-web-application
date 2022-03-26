<?php
namespace App\Http\Controllers\Department;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute, department};
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Utils\AutoModifableText;
use Illuminate\Http\Request;

class DepartmentController extends Controller {
  public function getAllDepartment(Request $req) {
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
    $departments = collect(DB::select('select a.*, avg(d.score) as rate,
    count(d.id) as count from department as a inner join department_services
    as b on a.id = b.department inner join service as c on b.service = c.id
    inner join department_rating_services as d on c.id = d.service
    group by a.id')) -> map(function ($data) {
      $data -> description = AutoModifableText::getText($data -> description);
      $data -> icon = DataList::department_icon[$data -> icon];
      $data -> rate = number_format($data -> rate, 1, '.', '');
      return $data;
    });
    return view('User/Component/Department/DepartmentAll', [
      'global' => $global, 'social_global' => $social_global
      , 'time_works' => $time_work, 'department' => $departments
    ]);
  }
  public function getDepartment(Request $req, $name) {
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
    $departmentAll = department::select('id', 'name')
      -> whereNotIn('id', [$req -> iddep]) -> take(10) -> get();
    $departments = collect(DB::select('select a.*, avg(d.score)
      as rate from department as a inner join department_services as b on
      a.id = b.department inner join service as c on b.service = c.id
      inner join department_rating_services as d on c.id = d.service
      where a.id = ? and a.name = ? group by a.id', [$req -> iddep, $name]))
      -> map(function ($data) use ($req) {
        $data -> description = AutoModifableText::getText($data -> description
          , 'lni lni-checkmark');
        $data -> icon = DataList::department_icon[$data -> icon];
        $data -> rate = number_format($data -> rate, 1, '.', '');
        $services = collect(DB::select("select b.*, avg(c.score) as rate,
          count(c.id) as count from service as b inner join department_services
          as a on b.id = a.service inner join department_rating_services as c
          on c.service = b.id where a.department = ? group by b.id",
          [$req -> iddep])) -> map(function ($data) {
            $data -> icon = DataList::department_icon[$data -> icon];
            $data -> rate = number_format($data -> rate, 1, '.', '');
            return $data;
          });
        $image = DB::select("select c.media as media from media as c inner join
          services_image as b on c.id = b.media inner join department_services
          as a on a.service = b.service where a.department = ? limit 5"
          , [$req -> iddep]);
        return [$data, 'services'=>$services, 'image'=>collect($image)];
      });
    return view("User/Component/Department/DepartmentDetail", [
      'dep_name' => $name, 'global' => $global, 'social_global'
      => $social_global, 'time_works' => $time_work, 'department'
      => $departments, 'department_list' => $departmentAll
    ]);
  }
}
