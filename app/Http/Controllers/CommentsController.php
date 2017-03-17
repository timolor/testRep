<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

#use Illuminate\Support\Facades\Request;

use App\Article;

use App\Comment;

class CommentsController extends Controller
{
    

    public function store(Request $request)
    {

   	   $input = $request->all();

   	   #dd($segment = Request::segment(2));

   	   #dd($input = $request->all());

        Comment::create($input);

        \Session::flash('flash_message', 'Your story has been published successfully!!!');

        return redirect()->back();
    }
}
