<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute, category_research, projects, doctor_social};
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Utils\AutoModifableText;
use Illuminate\Http\Request;
use DateTime;

class ProjectsController extends Controller {
  public function getAllProject(Request $req) {
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
    $projects = DB::select("select projects.id, title, image_init,
      b.name as name from projects inner join category_research as b
      on category = b.id order by project_date");
    $init_projects = category_research::select('name') -> get();
    return view('User/Component/Projects/ProjectsAll', [
      'global' => $global, 'social_global' => $social_global
      , 'time_works' => $time_work, 'projects' => [$init_projects, $projects]
    ]);
  }
  public function getProject(Request $req, $name) {
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
    $projects = projects::where('id', $req -> idproj) -> where('title', $name)
      -> get() -> map(function ($data) use ($req){
        $data -> description = AutoModifableText::getText($data -> description);
        $socials = collect(DB::select("select a.link as link, a.social as social
          from social as a inner join doctor_social as b on a.id = b.social
          where b.doctor = ?", [$data -> researcher]));
        $data -> researcher = collect(DB::select("select a.id as id,
          a.username as username, a.wise_words as wise_words, a.image as image,
          d.title as resTitle, d.client as resClient, d.dates as resDate,
          d.location as resLocation, f.name as resCategory from doctor as a
          inner join doctor_research as c on a.id = c.doctor inner join
          research as d on c.research = d.id inner join category_research as f
          on d.category = f.id where a.id = ?", [$data -> researcher]))[0];
        $data -> researcher -> resDate = DateTime::createFromFormat('Y-m-d'
          , $data -> researcher -> resDate) -> format('d F Y');
        $images = collect(DB::select("select a.media as media from media as a
          inner join projects_media as b on a.id = b.media where b.project = ?"
          , [$req -> idproj]));
        return ['data' => $data, 'images' => $images, 'socials' => $socials];
    });
    return view('User/Component/Projects/Project', [
      'global' => $global, 'social_global' => $social_global
      , 'time_works' => $time_work, 'projects' => $projects
    ]);
  }
}
