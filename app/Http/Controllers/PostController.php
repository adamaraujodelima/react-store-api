<?php

namespace App\Http\Controllers;

use Cache;
use App\PostRepository;
use Illuminate\Http\Request;

class PostController extends Controller
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
    public function index(Request $request, $id = 0)
    {
        $repository = $this->repository;            

        $post = Cache::remember('post.entity.' . $id, 60, function() use ($repository, $id) {
            return $repository->find($id);
        });    

        return view('post')->with([
            'post' => $post
        ]);
    }
}
