<?php

namespace App\Http\Controllers\Api;

use Validator;
use App\Models\User;
use App\Models\auther;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Banner as BannerResource;
use App\Http\Controllers\Api\BaseController as BaseController ;


class BannerController extends BaseController
{

    public function index()
    {
        $auther = User::all();
        return $this->sendResponse(BannerResource::collection($auther) , 'this is banner');

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $Validator = Validator::make($input , 
        [
            'name' => $this
        ]);

        if ($Validator->fails()) {
            return $this->sendError('plase validate error' , $Validator->errors());
        }

        $product= auther::create($input);
        return $this->sendResponse(new BannerResource($product) , 'User created  successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $auther = auther::find($id);
        return view('admin.auther.edit',compact('auther'));
    }


    public function update(Request $request, auther $auther ) 
    {
        $input = $request->all();
        $Validator = Validator::make($input , 
        [
            'name' => $this
        ]);

        if ($Validator->fails()) {
            return $this->sendError('plase validate error' , $Validator->errors());
        }

        $auther ->name = $input['name'];
        return $this->sendResponse(new BannerResource($auther) , 'User created  successfully');
    }


    public function destroy( auther $auther)
    {
        $auther->delete();
        return $this->sendResponse(new BannerResource( $auther) , 'User deleted  successfully');
    }
}
