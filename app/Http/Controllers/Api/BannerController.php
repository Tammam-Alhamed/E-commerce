<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\auther;
use Validator;
use App\Http\Resources\Banner as BannerResource;
use App\Http\Controllers\Api\BaseController as BaseController ;


class BannerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auther = auther::all();
        return $this->sendResponse(BannerResource::collection($auther) , 'this is banner');

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $Validator = Validator::make($input , 
        [
            'name' => this->name
        ]);

        if ($Validator->fails()) {
            return $this->sendError('plase validate error' , $Validator->errors());
        }

        $product= auther::create($input);
        return $this->sendResponse(new BannerResource($product) , 'User created  successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $auther = auther::find($id);
        return view('admin.auther.edit',compact('auther'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, auther $auther ) 
    {
        $input = $request->all();
        $Validator = Validator::make($input , 
        [
            'name' => this->name
        ]);

        if ($Validator->fails()) {
            return $this->sendError('plase validate error' , $Validator->errors());
        }

        $auther ->name = $input['name'];
        return $this->sendResponse(new BannerResource() , 'User created  successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( auther $auther)
    {
        $auther->delete();
        return $this->sendResponse(new BannerResource() , 'User deleted  successfully');
    }
}
