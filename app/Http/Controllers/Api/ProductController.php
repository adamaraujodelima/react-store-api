<?php

namespace App\Http\Controllers\Api;

use Cache;
use App\ProductRepository;
use App\Service\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use App\Http\Controllers\Controller;
use App\Events\UpdateEntities;

class ProductController extends Controller
{
    
    /**
     * @var ProductRepository
     */
    protected $repository;

    public function __construct(ProductRepository $repository){
        $this->repository = $repository;        
    }

    public function index(Request $request)
    {
        try {
            
            $repository = $this->repository;
            $products = Cache::remember('products.all', 60, function() use ($request, $repository) {
                $products = $repository->scopeQuery(function($query){
                    return $query->orderBy('id','asc');
                })->all();
                return $products;
            });            
            
            return response()->json($products, 200);

        } catch (\Exception $e) {
            return $this->getError($e);
        }
    } 
    
    public function info($id)
    {
        try {
            
            $repository = $this->repository;
            
            $product = Cache::remember('product.info' . $id, 60, function() use ($repository, $id) {
                return $repository->find($id);
            });            
            
            return response()->json($product, 200);

        } catch (\Throwable $th) {
            return $this->getError($th);
        }
    }

    protected function getError($e)
    {
        dump($e->getMessage());exit;
    }

}
