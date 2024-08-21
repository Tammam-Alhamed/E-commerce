<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\items as itemsResource;



class BaseController extends Controller
{
    public function sendResponse( $result , $massage , $data_2 = null  )
    {
        $response =[
            'status' => "success" ,
            'data' => $result ,
            'data_2' => $data_2,
            'massage' => $massage 
        ];
        return response()->json($response , 200);
    }


    public function sendError($error , $errorMassage=[] , $code = 404 )
    {
        $response =[
            'status' => "false" ,
            'data' => $error ,
        ];
        if(!empty($errorMassage)){
            $response['data'] = $errorMassage ;
        }
        return response()->json($response , $code);
    }

    public function items($where1 ,$op ,$where2 , $order, $by ,$userId   )
    {
        $items = DB::table('items1view')
        ->select([
            'items1view.*',
            DB::raw('1 as favorite'),
            DB::raw('round((items_price_d) * price.price, -3) as itemsprice'),
            DB::raw('round((items_price_d - (items_price_d * items_discount / 100)) * price.price, -3) as itemspricediscount_d'),
        ])
        ->join('favorite', function ($join) use ($userId) {
            $join->on('favorite.favorite_itemsid', '=', 'items1view.items_id')
                ->where('favorite.favorite_usersid', '=', $userId);
        })
        ->join('price', function ($join) {
            $join->on('items1view.items_id', '=', 'items1view.items_id');
        })
        ->where($where1 , $op ,$where2)
        ->unionAll(function ($query) use ($userId , $where1 , $where2 , $op) {
            $query->select([
                'items1view.*',
                DB::raw('0 as favorite'),
                DB::raw('round((items_price_d) * price.price, -3) as itemsprice'),
                DB::raw('round((items_price_d - (items_price_d * items_discount / 100)) * price.price, -3) as itemspricediscount_d'),
            ])
                ->from('items1view')
                ->join('price', function ($join) {
                    $join->on('items1view.items_id', '=', 'items1view.items_id');
                })
                ->where($where1 ,$op , $where2)
                ->whereNotIn('items1view.items_id', function ($subQuery) use ($userId) {
                    $subQuery->select('items1view.items_id')
                        ->from('items1view')
                        ->join('favorite', function ($join) use ($userId) {
                            $join->on('favorite.favorite_itemsid', '=', 'items1view.items_id')
                                ->where('favorite.favorite_usersid', '=', $userId);
                        })
                        ->join('price', function ($join) {
                            $join->on('items1view.items_id', '=', 'items1view.items_id');
                        });
                });
        })
        ->orderBy($order , $by)
        ->get();
        return $this->sendResponse(itemsResource::collection($items ) , 'this is items' );
    }
}
