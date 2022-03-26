<?php
namespace App\Http\Controllers\Utils;

class AutoModifableText
{
  public static function getText($text ='', $list = 'lni lni-checkbox')
  {
    $box = "col-lg-6 col-12";
    $pattern1 = preg_replace("/p->/m", '<p>', $text);
    $pattern2 = preg_replace("/<-p/m", '</p>', $pattern1);
    $arr = null;
    preg_match_all('/<-l[\s]*l->/m',  $pattern2,  $arr);
    if(count($arr[0]) <= 0){
      $box = "col-12";
    }
    $pattern3 = preg_replace("/<-l[\s]*l->/m", '</li></ul></div><div class="'
      . $box . '"><ul class="list"><li><i class="' . $list . '"></i>'
      , $pattern2);
    $pattern4 = preg_replace("/l->/m", '<div class="row"><div class="' . $box
      . '"><ul class="list"><li><i class="' . $list . '"></i>', $pattern3);
    $pattern5 = preg_replace("/,,/m", '</li><li><i class="' . $list
      . '"></i>', $pattern4);
    $pattern6 = preg_replace("/<-l/m", '</li></ul></div></div>', $pattern5);
    $pattern7 = preg_replace("/q->/m", '<blockquote><div class="icon"><i
      class="lni lni-quotation"></i></div><h4>', $pattern6);
    $pattern8 = preg_replace("/--->/m", '</h4><span>', $pattern7);
    $pattern9 = preg_replace("/<---/m", '</span><h4>', $pattern8);
    $pattern10 = preg_replace("/<-q/m", '</h4></blockquote>', $pattern9);
    $pattern11 = preg_replace("/t->/m", '<h2 class="post-title">', $pattern10);
    return preg_replace("/<-t/m", '</h2>', $pattern11);
  }
}
