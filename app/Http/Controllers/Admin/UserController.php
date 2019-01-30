<?php

namespace App\Http\Controllers\Admin;

use Cache;
use App\UserRepository;
use App\Service\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Events\UpdateEntities;

class UserController extends Controller
{
    
    /**
     * @var UserRepository
     */
    protected $repository;

    public function __construct(UserRepository $repository){
        $this->repository = $repository;        
    }

    public function index(Request $request)
    {
        try {

            if ($request->user()->profile == 2) {
                return redirect(route('user-posts-list'));
            }
            
            $repository = $this->repository;
            
            $users = Cache::remember('users.all', 60, function() use ($request, $repository) {
                $users = $repository->scopeQuery(function($query){
                    return $query->orderBy('id','asc');
                })->all();
                return $users;
            });            
            
            return view('admin.user.list')->with([
                'users' => $users,
            ]);

        } catch (\Exception $e) {
            return $this->getError($e);
        }
    }      
    
    public function new(Request $request)
    {
        try {

            if ($request->user()->profile == 2) {
                return redirect(route('user-posts-list'));
            }

            if ($request->all()) {
                $data = $request->all();
                $data['id'] = null;
                
                $valid = $this->validator($data);
                
                if (!$valid->fails()) {
                    
                    $user = $this->repository->create([
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'profile' => $data['profile'],
                        'password' => Hash::make($data['password']),
                    ]);                   
        
                    Cache::add('user.entity.' . $user->id, $user, 60);
                    CacheService::clearCacheUsers($user);
        
                    return redirect(route('admin-users-list'));   
                }     
                
                return redirect()->back()->withInput()->withErrors($valid);
    
            }

            return view('admin.user.new');
            
        } catch (\Exception $e) {
            return $this->getError($e);
        }
    }

    public function update(Request $request, $id = 0)
    {
        try {

            if ($request->user()->profile == 2) {
                return redirect(route('user-posts-list'));
            }
            
            $repository = $this->repository;
            
            $user = Cache::remember('user.entity.'.$id, 60, function() use ($repository, $id) {
                return $this->repository->find($id);                
            });

            if ($request->all()) {
                $data = $request->all();
                $data['id'] = $id;
                
                $valid = $this->validator($data);
                
                if (!$valid->fails()) {

                    $user->name = $data['name'];
                    $user->email = $data['email'];
                    $user->profile = $data['profile'];

                    if ($data['password']) {
                        $user->password = Hash::make($data['password']);
                    }
                    
                    $user->save();
        
                    Cache::put('user.entity.' . $user->id, $user, 60);
                    CacheService::clearCacheUsers($user);
        
                    return redirect(route('admin-users-list'));   
                }

                return view('admin.user.edit')->with([
                    'user' => $user
                ])->withErrors($valid);

            }

            return view('admin.user.edit')->with([
                'user' => $user
            ]);
            
        } catch (\Exception $e) {
            return $this->getError($e);
        }

    }

    public function delete(Request $request, int $id = 0)
    {
        try {

            if ($request->user()->profile == 2) {
                return redirect(route('user-posts-list'));
            }
            
            $user = $this->repository->find($id);
            if ($user) {
                CacheService::clearCacheUsers($user);
                $user->delete();
                return redirect(route('admin-users-list'));   
            }
        } catch (\Exception $e) {
            return $this->getError($e);
        }
    } 

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ($data['id']) ? ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$data['id']] : ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => (!$data['id']) ? ['required', 'string', 'min:6', 'confirmed'] : '',
        ]);
    }

    protected function getError($e)
    {
        dump($e->getMessage());exit;
    }

}
