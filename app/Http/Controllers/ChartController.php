<?php

namespace App\Http\Controllers;
use App\Models\PostUser;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index() {
        $postuser = PostUser::selectRaw('post_id, count(*) cnt')
                            ->groupBy('post_id')
                            ->orderByDesc('cnt')
                            ->take(6)->get(); // 6개만 빼낸다. 
        //dd($postuser);
        return view('chart.index')->with('postusers', $postuser);
    }
}
