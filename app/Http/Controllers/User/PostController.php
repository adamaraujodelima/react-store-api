<?php

namespace App\Http\Controllers\User;

use Cache;
use App\PostRepository;
use App\Service\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Events\UpdateEntities;

class PostController extends Controller
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
            
            $repository = $this->repository;

            $posts = Cache::remember('posts.all.' . $request->user()->id, 60, function() use ($request, $repository) {
                $posts = $repository->scopeQuery(function($query) use ($request){                    
                    return $query->where('author_id', $request->user()->id)->orderBy('id','desc');                    
                })->all();
                return $posts;
            });
            
            return view('user.post.list')->with([
                'posts' => $posts,
            ]);

        } catch (\Exception $e) {
            return $this->getError($e);
        }
    }

    protected function getError($e)
    {
        $jsonError = response()->json(['message' => $e->getMessage()]);
        return \Response::json($jsonError,500);
    }

    public function new(Request $request)
    {
        try {

            $errors = [];

            if ($request->all()) {
                $data = $request->all();
                $data['id'] = null;
                
                $valid = $this->validator($data);
                
                if (!$valid->fails()) {

                    $image = $this->doUpload($request);
                    
                    $post = $this->repository->create([
                        'title' => $data['title'],
                        'image' => $image,
                        'content' => $data['content'],
                        'published' => $data['published'],
                        'posted_at' => new \DateTime(),
                        'author_id' => $request->user()->id
                    ]);                   
        
                    Cache::add('post.entity.' . $post->id, $post, 60);
                    CacheService::clearCachePosts($post);
        
                    return redirect(route('user-posts-list'));   
                }                      
    
            }

            return view('user.post.new');
            
        } catch (\Exception $e) {
            return $this->getError($e);
        }
    }

    public function update(Request $request, $id = 0)
    {
        try {

            $repository = $this->repository;
            
            $post = Cache::remember('post.entity.'.$id, 60, function() use ($repository, $id) {
                return $this->repository->find($id);                
            });

            if ($request->all()) {
                $data = $request->all();
                $data['id'] = null;
                
                $valid = $this->validator($data);
                
                if (!$valid->fails()) {

                    $image = $this->doUpload($request);
                    
                    $post->title = $data['title'];
                    
                    if($image){
                        $post->image = $image;
                    }
                    
                    $post->content = $data['content'];
                    $post->published = $data['published'];
                    
                    if($data['published']){
                        $post->posted_at = new \DateTime();
                    }

                    $post->save();
        
                    Cache::put('post.entity.' . $post->id, $post, 60);
                    CacheService::clearCachePosts($post);
        
                    return redirect(route('user-posts-list'));   
                }                      
    
            }

            return view('user.post.edit')->with([ 'post' => $post ]);
            
        } catch (\Exception $e) {
            return $this->getError($e);
        }
    }

    public function delete(Request $request, int $id = 0)
    {
        try {
            $post = $this->repository->find($id);
            if ($post) {
                CacheService::clearCachePosts($post);
                $post->delete();
                return redirect(route('user-posts-list'));
            }
            
        } catch (\Exception $e) {
            return $this->getError($e);
        }
    }    

    protected function doUpload(Request $request)
    {
        $upload = '';
    
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            
            $name = uniqid(date('HisYmd'));
    
            $extension = $request->image->extension();
    
            $nameFile = "{$name}.{$extension}";
    
            $upload = $request->image->storeAs('posts', $nameFile);
    
            if ( !$upload )
                return redirect()->back()->with('error', 'Erro ao tentar enviar a imagem')->withInput();
    
        }

        return $upload;
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'published' => ['required', 'integer'],
        ]);
    }
}
