<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Gate;


class ArticleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'detail']);
    }
    public function index()
    {
        $data = Article::latest()->paginate(5);
        return view('articles.index', [
            'articles' => $data
        ]);
    }

    public function detail($id)
    {
        $article = Article::find($id);
        return view('articles.detail', [
            'article' => $article
        ]);
    }
    // public function delete($id)
    // {

    //     $article = Article::find($id);
    //     $article->delete();

    //     return redirect("/articles")->with("info", "Article deleted!");
    // }

    public function add()
    {
        return view('articles.add');
    }

    public function create()
    {
        $validator = validator(request()->all(), [
            "title" => "required",
            "body" => "required",
            "category_id" => "required",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        $article = new Article;
        $article->title = request()->title;
        $article->body = request()->body;
        $article->category_id = request()->category_id;
        $article->user_id = auth()->id();
        $article->save();

        return redirect("/articles")->with("info", "New Article added!");
    }


    public function delete($id)
    {
        $article = Article::find($id);

        if (Gate::allows('delete-article', $article)) {
            $article->delete();
            return redirect("/articles")->with("info", "Article deleted");
        }

        return back()->with("info", "Unauthorize");
    }


    public function edit($id)
    {
        $data['getRecord'] = Article::find($id);
        $data['getCategory'] = Category::all();
        return view('articles.edit', $data);
    }

    public function update($id, Request $request)
    {
        // @dd($request->all());
        $update = request()->validate([
            "title" => "required",
            "body" => "required",
            "category_id" => "required"
        ]);

        $update = Article::find($id);
        $update->title = $request->title;
        $update->body = $request->body;
        $update->category_id = $request->category_id;
        $update->save();

        return redirect("/articles/detail/$update->id")->with("success", "successfully updated");
    }


}
