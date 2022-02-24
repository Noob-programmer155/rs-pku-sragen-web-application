<?php
namespace App\Http\Controllers\Department\Service;

use Illuminate\Routing\Controller;
use App\Models\{global_attribute};

class ServiceController extends Controller{
  public function getAllService(){
    $global = global_attribute::select('name','description') -> whereIn('name',['email','telp','location']) -> get();
    $social_global = global_attribute::select('name','description') -> whereIn('name',[...DataList::social]) -> get();
    return view('User/Component/Department/Service/ServiceAll',[
        'global' => $global,'social_global' => $social_global
    ]);
  }
}
