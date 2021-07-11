<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyPostsController extends Controller
{
    public function create(){
        return view('test.create');
    }
    public function store() {
        
    }

}
