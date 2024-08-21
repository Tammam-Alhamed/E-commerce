<?php

namespace App\Http\Controllers\Api;


use Illuminate\Http\Request;
use App\Http\Resources\favorite;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\items as itemsResource;
use App\Http\Controllers\Api\BaseController as BaseController ;

class itemsController extends BaseController
{

    public function index(request $request )
    {
        // $input = $request->all();
        $userId = $request['usersid'];
        $categoryId = $request ['id'];
        $limit = $request['limit'];

        return $this->items(
            'categories_id',
            '=',
            $categoryId,
            'items_filter',
            'ASC',
            $userId,
     
        );
    


        // return $this->sendResponse(itemsResource::collection($items ) , 'this is items' );
    }

    public function newItems(request $request )
    {
        
        // $input = $request->all();
        $userId = $request['usersid'];
        $categoryId = $request ['id'];
        $limit = $request['limit'];

        return $this->items(
            'items_new',
            '=',
            '1',
            'items_filter',
            'asc',
            $userId,
     
        );


    }

    public function discountItems(request $request )
    {
        // $input = $request->all();
        $userId = $request['usersid'];
        $categoryId = $request ['id'];
        $limit = $request['limit'];

        return $this->items(
            'items_discount',
            '>',
            '0',
            'items_filter',
            'asc',
            $userId,
     
        );


    }

    public function offerItems(request $request )
    {
        // $input = $request->all();
        $userId = $request['usersid'];
        $categoryId = $request ['id'];
        $limit = $request['limit'];

        return $this->items(
            'items_offer',
            '=',
            '1',
            'items_filter',
            'asc',
            $userId,
        );


    }

    public function favorite(request $request)
    {
        $id = $request ['id'];
        $favorite = DB::table('myfavorite')
        ->select('*')
        ->where('favorite_usersid' ,$id )
        ->get();
        return $this->sendResponse(favorite::collection($favorite ) , 'this is favorite' );
    }

    public function A_to_Z(request $request )
    {
        // $input = $request->all();
        $userId = $request['usersid'];
        $categoryId = $request ['id'];
        $limit = $request['limit'];
        $lang = $request['lang'];

        if($lang == 'en'){
            return $this->items(
                'categories_id',
                '=',
                $categoryId,
                'items_name',
                'asc',
                $userId,
            );
        }elseif($lang == "ar"){
            return $this->items(
                'categories_id',
                '=',
                $categoryId,
                'items_name_ar',
                'asc',
                $userId,
            );
        }else{
            return $this->items(
                'categories_id',
                '=',
                $categoryId,
                'items_name_ru',
                'asc',
                $userId,
            );
        }
        

    }

    public function Z_to_A(request $request)
    {
        $userId = $request['usersid'];
        $categoryId = $request ['id'];
        $limit = $request['limit'];
        $lang = $request['lang'];

        if($lang == 'en'){
            return $this->items(
                'categories_id',
                '=',
                $categoryId,
                'items_name',
                'DESC',
                $userId,
            );
        }elseif($lang == "ar"){
            return $this->items(
                'items_offer',
                '=',
                $categoryId,
                'items_name_ar',
                'DESC',
                $userId,
            );
        }else{
            return $this->items(
                'items_offer',
                '=',
                $categoryId,
                'items_name_ru',
                'DESC',
                $userId,
            );
        }
    }

    public function price_highest(request $request)
    {
        $userId = $request['usersid'];
        $categoryId = $request ['id'];
        $limit = $request['limit'];
        $lang = $request['lang'];

        if($lang == 'en'){
            return $this->items(
                'categories_id',
                '=',
                $categoryId,
                'itemspricedisount_d',
                'DESC',
                $userId,
            );
        }elseif($lang == "ar"){
            return $this->items(
                'categories_id',
                '=',
                $categoryId,
                'itemspricedisount_d',
                'DESC',
                $userId,
            );
        }else{
            return $this->items(
                'categories_id',
                '=',
                $categoryId,
                'itemspricedisount_d',
                'DESC',
                $userId,
            );
        }
    }

    public function price_lowest(request $request)
    {
        $userId = $request['usersid'];
        $categoryId = $request ['id'];
        $limit = $request['limit'];
        $lang = $request['lang'];

        if($lang == 'en'){
            return $this->items(
                'categories_id',
                '=',
                $categoryId,
                'itemspricedisount_d',
                'ASC',
                $userId,
            );
        }elseif($lang == "ar"){
            return $this->items(
                'categories_id',
                '=',
                $categoryId,
                'itemspricedisount_d',
                'ASC',
                $userId,
            );
        }else{
            return $this->items(
                'categories_id',
                '=',
                $categoryId,
                'itemspricedisount_d',
                'ASC',
                $userId,
            );
        }
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
