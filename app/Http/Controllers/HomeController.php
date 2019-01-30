<?php

namespace App\Http\Controllers;

use Cache;
use App\PostRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * @var PostRepository
     */
    protected $repository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(PostRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $repository = $this->repository;
            
        $posts = Cache::remember('posts.all.recents', 60, function() use ($repository) {
            $posts = $repository->scopeQuery(function($query){                
                return $query->where('published', true)->orderBy('id','desc');
            })->all();
            return $posts;
        });    
        
        return view('home')->with([
            'posts' => $posts
        ]);
    }
}
