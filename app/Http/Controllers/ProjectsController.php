<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute,category_research,projects};
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Utils\AutoModifableText;
use Illuminate\Http\Request;

class ProjectsController extends Controller{
  public function getAllProject(){
    $global = global_attribute::select('name','description') -> whereIn('name',['email','telp','location']) -> get();
    $social_global = global_attribute::select('name','description') -> whereIn('name',[...DataList::social]) -> get();
    $projects = DB::select("select projects.id,title,image_init,b.name as name from projects inner
      join category_research as b on category = b.id order by project_date");
    $init_projects = category_research::select('name') -> get();
    return view('User/Component/Projects/ProjectsAll',[
      'global' => $global,'social_global' => $social_global, 'projects' => [$init_projects,$projects]
    ]);
  }
  public function getProject(Request $req,$name){
    $global = global_attribute::select('name','description') -> whereIn('name',['email','telp','location']) -> get();
    $social_global = global_attribute::select('name','description') -> whereIn('name',[...DataList::social]) -> get();
    $projects = projects::where('id',$req -> idproj) -> where('title',$name) -> get() -> map(function ($data) use ($req){
      $data -> description = AutoModifableText::getText($data -> description);
      $data -> researcher = collect(DB::select("select a.id as id,a.username as username,a.wise_words,
        a.phone,a.email,a.address,a.image,b.name as department,d.title as resTitle,d.client as resClient,
        d.dates as resDate,d.location as resLocation,f.name as resCategory from doctor as a inner join
        department as b on a.department = b.id inner join doctor_research as c on a.id = c.doctor inner join
        research as d on c.research = d.id inner join category_research as f on d.category = f.id
        where a.id = ?",[$data -> researcher]))[0];
      $images = collect(DB::select("select a.media as media from media as a inner join projects_media as b
        on a.id = b.media where b.project = ?",[$req -> idproj]));
      return ['data' => $data,'images' => $images];
    });
    echo "<script>console.log($projects)</script>";
    return view('User/Component/Projects/Project',[
      'global' => $global,'social_global' => $social_global,'projects' => $projects
    ]);
  }
}
