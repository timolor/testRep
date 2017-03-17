<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

 // import Article model
use App\Article;  
use App\Comment as Comments; 

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $data = array(
            'user' => Auth::user(),
            'articles' => Article::latest()->get()
            );
        return view('home')->with($data);
    }

    public function create()
    {
        $data = array(
            'user' => Auth::user(),
            'articles' => Article::latest()->get()
        );

        return view('home.details.post')->with($data);
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'title' => 'required',
            'message' => 'required'
        ]);

        $input = $request->all();

        Article::create($input);

        \Session::flash('flash_message', 'Your story has been published successfully!!!');

        return redirect()->back();
    }

    public function show($id)
    {
        // $data = array(
        //     'user' => Auth::user(),
        //     'article' => Article::findOrFail($id),
        //     'comment' => Comments::where('post_id', $id)->get()
        //     );
        return view('home.details.details')->withUser(Auth::user())->withArticle(Article::findOrFail($id))->withComment(Comments::where('post_id',$id)->get());
    }

    public function edit($id)
    {
       // $data = array(
       //      'user' => Auth::user(),
       //      'article' => Article::findOrFail($id)
       //  );
       //  return view('home.details.edit')->with($data);
        return view('home.details.edit')->withUser(Auth::user())->withArticle(Article::findOrFail($id));
    }

    public function update($id, Request $request)
    {
        $articles = Article::findOrFail($id);

        $this->validate($request, [
            'title' => 'required',
            'message' => 'required'
        ]);

        $data = $request->all();

        $articles->fill($data)->save();

        \Session::flash('flash_message', 'Records updated Successfully!!!');

        return redirect()->route('article.show', $id);

    }

    public function destroy($id)
    {
        $articles = Article::findOrFail($id);

        $articles->delete();

        \Session::flash('flash_message', 'Task successfully deleted!');

        return redirect()->route('article.index');
    }

    public function test(){
            dd(Auth::user());
    }


}
