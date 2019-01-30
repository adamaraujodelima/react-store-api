<?php

namespace App\Http\Controllers\Admin;

use Cache;
use App\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Events\UpdateEntities;

class HomeController extends Controller
{
    
    /**
     * @var PostRepository
     */
    protected $repository;

    public function __construct(PostRepository $repository){
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        try {

            if ($request->user()->profile == 2) {
                return redirect(route('user-posts-list'));
            }
            
            $repository = $this->repository;
            
            $posts = Cache::remember('admin.posts.all.recents', 60, function() use ($request, $repository) {
                $posts = $repository->scopeQuery(function($query){
                    return $query->orderBy('id','desc')->limit(5);
                })->all();
                return $posts;
            });            
            
            return view('admin.home')->with([
                'posts' => $posts,
            ]);

        } catch (\Exception $e) {
            return $this->getError($e);
        }
    }    
}
