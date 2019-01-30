<?php

namespace App\Http\Controllers\User;

use Cache;
use App\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Events\UpdateEntities;

class ProfileController extends Controller
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
            
            $repository = $this->repository;
            
            $user = Cache::remember('user.entity.'.$request->user()->id, 60, function() use ($repository, $request) {
                return $this->repository->find($request->user()->id);                
            });

            if ($request->all()) {
                
                $data = $request->all();
                $data['id'] = $request->user()->id;
                
                $valid = $this->validator($data);
                
                if (!$valid->fails()) {

                    $user->name = $data['name'];
                    $user->email = $data['email'];

                    if ($data['password']) {
                        $user->password = Hash::make($data['password']);
                    }
                    
                    $user->save();
        
                    Cache::put('user.entity.' . $user->id, $user, 60);
                    Cache::forget('users.all');
        
                    return redirect(route('user-posts-list'));
                }

                return view('user.user.profile')->with([
                    'user' => $user
                ])->withErrors($valid);

            }

            return view('user.user.profile')->with([
                'user' => $user
            ]);
            
        } catch (\Exception $e) {
            return $this->getError($e);
        }

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$data['id']]
        ]);
    }

    protected function getError($e)
    {
        dump($e->getMessage());exit;
    }

}
