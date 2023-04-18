<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    public function sendResponse( $result , $massage  )
    {
        $response =[
            'success' => true ,
            'data' => $result ,
            'massage' => $massage 
        ];
        return response()->json($response , 200);
    }


    public function sendError($error , $errorMassage=[] , $code = 404 )
    {
        $response =[
            'success' => false ,
            'data' => $error ,
        ];
        if(!empty($errorMassage)){
            $response['data'] = $errorMassage ;
        }
        return response()->json($response , $code);
    }
}
