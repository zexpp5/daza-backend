<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;

use Illuminate\Http\Request;

use App\Http\Requests;

class ArticleController extends Controller
{

    public function __construct()
    {
        // 执行 auth 认证
        $this->middleware('auth', [
            'except' => [
                'index',
                'show'
            ]
        ]);
    }

    public function index(Request $request)
    {
        $query = Article::orderBy('created_at', 'asc');
        return $this->pagination($query->paginate());
    }

    public function store(Request $request)
    {
        return $this->failure();
    }

    public function show(Request $request, $article_id)
    {
        $rules = array('article' => 'exists:articles,id');
        $validator = Validator::make(['article' => $article_id], $rules);
        if ($validator->fails()) {
            return $this->failure($validator->errors()->all());
        }
        $data = Article::find($article_id);
        return $this->success($data);
    }

    public function update(Request $request)
    {
        return $this->failure();
    }

    public function destroy(Request $request)
    {
        return $this->failure();
    }

}