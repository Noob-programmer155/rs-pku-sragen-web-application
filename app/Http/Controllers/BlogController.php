<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute, blog, tag, blog_comments};
use App\Http\Controllers\Utils\AutoModifableText;
use App\Http\Controllers\Utils\DataList;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use DateTime, IntlDateFormatter;

class BlogController extends Controller {
  public function getDataBlog(Request $req, $startDate, $endDate) {
    $sign = '<';
    $item = '';
    if($startDate === '0' && $endDate === '0') {
      $item = date('Y-m-d', strtotime(blog::select('dates_upload')
        -> max('dates_upload'))+864E5);
    } elseif($startDate === '0') {
      $item = $endDate;
      $sign = '<';
    } elseif($endDate === '0') {
      $item = $startDate;
      $sign = '>';
    }
    $dataQuery = [$item, $req -> mount];
    if($req -> tag) {
      if($req -> tag === 'all') {
        $blog = collect(DB::select('select a.id as id, a.title as title,
          a.description as description, a.dates_upload as date, a.views as views
          , a.image_home as image, b.id as doc_id, b.username as doc_username,
          b.image as doc_image from blog as a inner join doctor as b
          on a.doctor = b.id where a.dates_upload ' . $sign . ' ? order by
          a.dates_upload desc limit ?', [...$dataQuery]));
      } else {
        $item = date('Y-m-d', strtotime(blog::select('dates_upload')
          -> max('dates_upload'))+864E5);
        $dataQuery = [$req -> tag, $item, $req -> mount];
        $blog = collect(DB::select('select a.id as id, a.title as title,
          a.description as description, a.dates_upload as date, a.views as views
          , a.image_home as image, b.id as doc_id, b.username as doc_username,
          b.image as doc_image from blog as a inner join doctor as b
          on a.doctor = b.id inner join blog_tag as c on c.blog = a.id
          inner join tag as d on d.id = c.tag where d.name = ? &&
          a.dates_upload ' . $sign . ' ? order by a.dates_upload desc limit ?'
          , [...$dataQuery])
        );
      }
    } else {
      $blog = collect(DB::select('select a.id as id, a.title as title,
        a.description as description, a.dates_upload as date, a.views as views,
        a.image_home as image, b.id as doc_id, b.username as doc_username,
        b.image as doc_image from blog as a inner join doctor as b
        on a.doctor = b.id where a.dates_upload ' . $sign . ' ? order by
        a.dates_upload desc limit ?', [...$dataQuery])
      );
    }
    $blog -> map(function ($data) {
      $matches = array();
      preg_match('/p->(.*?)<-p/s', $data -> description, $matches);
      $data -> description = AutoModifableText::getText($matches[0]);
      $tags = collect(DB::select('select a.name as name from tag as a
        inner join blog_tag as b on a.id = b.tag where b.blog = ?'
        , [$data -> id]));
      $data -> tags = $tags;
      return $data;
    });
    return $blog;
  }
  public function getItemDynamic(Request $req) {
    $blog = blog::select('title') -> where('title',  'like',  '%'.$req -> q.'%')
      -> take(10) -> get();
    return $blog;
  }
  public function getBlogInAll(Request $req) {
    $blog = collect(DB::select('select a.id as id, a.title as title,
      a.description as description, a.dates_upload as date, a.views as views,
      a.image_home as image, b.id as doc_id, b.username as doc_username,
      b.image as doc_image from blog as a inner join doctor as b
      on a.doctor = b.id where a.title = ?',  [$req -> s]))
      -> map(function ($data) {
        $matches = array();
        preg_match('/p->(.*?)<-p/s',  $data -> description,  $matches);
        $data -> description = AutoModifableText::getText($matches[0]);
        $tags = collect(DB::select('select a.name as name from tag as a
          inner join blog_tag as b on a.id = b.tag where b.blog = ?'
          , [$data -> id]));
        $data -> tags = $tags;
        return $data;
      });
    return $blog;
  }
  public function getBlogAll(Request $req) {
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
    $datePattern -> setPattern('dd MMMM Y');
    $count = ceil(blog::count('id')/7);
    $popular_blogs = blog::select('id', 'title', 'dates_upload', 'image_home')
      -> orderBy('views', 'DESC') -> take(3) -> get()
      -> map(function ($data) use($datePattern) {
        $dateItem = new DateTime($data -> dates_upload);
        $data -> dates_upload = $datePattern -> format($dateItem);
        return $data;
      });
    $popular_tags = tag::orderBy('use_count', 'DESC') -> take(10) -> get();
    return view('User/Component/Blog/BlogAll', [
      'global' => $global, 'social_global' => $social_global
      , 'time_works' => $time_work, 'popular_tags' => $popular_tags
      , 'count_page' => $count, 'popular_blogs' => $popular_blogs
    ]);
  }
  public function getBlogComments($id) {
    $root = array();
    $r = ['id'=>-1, 'name'=>'', 'i'=>-1];
    $comments = blog_comments::where('blog', $id) -> orderBy('replays') -> get()
     -> map(function ($data) use(&$r, &$root) {
      if($data -> replays !== null) {
        $r['i'] = -1;
        if($data -> replays !== $r['id']) {
          foreach ($root as $key => $rt) {
            if($key > $r['i']) {
              if($rt -> id === $data -> replays) {
                $r = [
                  'id' => $rt -> id,  'name'=>$rt -> username,  'i' => $key
                ];
              }
            }
          }
          $r['i'] += 1;
          $data -> replays = $r['name'];
          array_splice($root, $r['i'], 0, [$data]);
        } else {
          $r['i'] += 1;
          $data -> replays = $r['name'];
          array_splice($root, $r['i'], 0, [$data]);
        }
      } else {
        $data -> replays = "";
        array_push($root, $data);
      }
    });
    return $root;
  }
  public function getBlog(Request $req, $name) {
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
    $datePattern -> setPattern('dd MMMM Y');
    $blog = collect(DB::select('select a.id as id, a.title as title,
      a.description as description, a.dates_upload as date, a.views as views,
      a.image_home as image, b.id as doc_id, b.username as doc_username,
      b.image as doc_image from blog as a inner join doctor as b
      on a.doctor = b.id where a.title = ? && a.id = ?'
      , [$name, $req -> idbl])) -> map(function ($data) use($datePattern) {
        $data -> description = AutoModifableText::getText($data -> description
          , 'lni lni-checkmark');
        $dateItem = new DateTime($data -> date);
        $data -> date = $datePattern -> format($dateItem);
        $tags = collect(DB::select('select a.name as name from tag as a
          inner join blog_tag as b on a.id = b.tag where b.blog = ?'
          , [$data -> id]));
        $data -> tags = $tags;
        $sosmed_doctor = collect(DB::select('select a.social as social,
          a.link as link from social as a inner join doctor_social as b
          on a.id = b.social where b.doctor = ?', [$data -> doc_id]))
          -> map(function ($data) {
            $item = explode('/', $data -> link);
            $data -> helper = $item[count($item) - 1];
            return $data;
          });
        $data -> doc_social = $sosmed_doctor;
        $media = collect(DB::select('select a.media as media from media as a
          inner join blog_media as b on a.id = b.media where b.blog = ?'
          , [$data -> id]));
        return [$data, $media];
      }
    );
    return view('User/Component/Blog/Blog', [
      'global' => $global, 'social_global' => $social_global
      , 'time_works' => $time_work, 'blog'=>$blog[0]
    ]);
  }
  // post
  public function postBlogComment(Request $req){
    $blog = json_decode($req -> getContent());
    try {
      // blog_comments::
    } catch (Exception $e) {

    }

    return 'success';
  }
}
