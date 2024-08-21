<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Resources\search as searchResource;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\items as itemsResource;
use App\Http\Resources\homeItems as HomeItemsResource;

class HomeController extends BaseController
{

    public function index()
    {
        $itemsNewDate =
        DB::table('itemsNewDate')
        ->select('*')
        ->orderByDesc('items_date')
        ->limit(30)
        ->get();
        return $this->sendResponse(HomeItemsResource::collection($itemsNewDate ) , 'this is home items' );
    }

    public function search(request $request )
    {
        $userId = $request['usersid'];
        $categoryId = $request ['id'];
        $requestSearch = $request['search'];

        $search =
        DB::table('items1view')
        ->select('*')
        ->where(
            'items_name', 'LIKE' ,'%'.$requestSearch.'%' ,)->orWhere(
            'items_name_ar', 'LIKE' ,'%'.$requestSearch.'%',)->orWhere(
            'items_name_ru', 'LIKE' ,'%'.$requestSearch.'%',)
        ->get();
        return $this->sendResponse(searchResource::collection($search ) , 'this is home search' );
        
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
