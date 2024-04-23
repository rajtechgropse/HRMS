<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Session;


use Illuminate\Http\Request;

class DesignerController extends Controller
{
    public function DesignerList()
    {
      $modules = Session::get('user_modules_' . auth()->id());
      return view(dd('hlw'));
    }
}
