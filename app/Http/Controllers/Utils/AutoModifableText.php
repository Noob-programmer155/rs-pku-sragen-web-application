<?php
namespace App\Http\Controllers\Utils;

class AutoModifableText
{
  public static function getText($text='')
  {
    $pattern1 = preg_replace("/p->/m",'<p>',$text);
    $pattern2 = preg_replace("/<-p/m",'</p>',$pattern1);;
    $pattern3 = preg_replace("/<-l[\s]*l->/m",'</li></ul></div><div class="col-lg-6 col-12"><ul class="list"><li><i class="lni lni-checkbox"></i>',$pattern2);
    $pattern4 = preg_replace("/l->/m",'<div class="row"><div class="col-lg-6 col-12"><ul class="list"><li><i class="lni lni-checkbox"></i>',$pattern3);
    $pattern5 = preg_replace("/,,/m",'</li><li><i class="lni lni-checkbox"></i>',$pattern4);
    $pattern6 = preg_replace("/<-l/m",'</li></ul></div></div>',$pattern5);
    $pattern7 = preg_replace("/q->/m",'<blockquote><div class="icon"><i class="lni lni-quotation"></i></div><h4>',$pattern6);
    $pattern8 = preg_replace("/--->/m",'</h4><span>',$pattern7);
    $pattern9 = preg_replace("/<---/m",'</span><h4>',$pattern8);
    $pattern10 = preg_replace("/<-q/m",'</h4></blockquote>',$pattern9);
    $pattern11 = preg_replace("/t->/m",'<h2 class="post-title">',$pattern10);
    return preg_replace("/<-t/m",'</h2>',$pattern11);
  }
}
