<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function Index(Request $request)
    {
        $var = "Univ. Ciputra";
        $page = $request->input("a");
        
       return view('coba',[
        'name' =>$var,
        'p' =>$page
       ]);
    }
}
