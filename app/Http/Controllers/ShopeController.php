<?php

namespace App\Http\Controllers;

use App\Models\shope;
use Illuminate\Http\Request;

class ShopeController extends Controller
{

    public function index()
    {
        $shope = shope::all();
        return view('admin.shope.index' , compact('shope'));
    }


    public function create()
    {
        return view('admin.shope.create' );

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'shopes_name' => "required",
            'shopes_name_ar' => "required",
            'shopes_image' => "required|image",
        ]);

        $shopes_image = $request->shopes_image;
        $newphoto = time().$shopes_image->getClientOriginalName();
        $shopes_image->move('../../ecommercecourse-PHP--177/upload/shopes',$newphoto);
        
        $shope = shope::create([
            'shopes_name' => $request->shopes_name,
            'shopes_name_ar' => $request->shopes_name_ar,
            'shopes_name_ru' => $request->shopes_name_ru,
            'shopes_image' => $newphoto
        ]);
        return redirect()->route('admin.shope.index');
    }


    public function show(shope $shope)
    {
        //
    }


    public function edit($shope )
    {
        $shope = shope::find($shope);
        return view('admin.shope.edit' , compact('shope'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\shope  $shope
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, shope $shope)
    {
        $file = $request->file('shopes_image');
        $shopes_image = $request->shopes_image;
        if(!auth()->user()->has_access_to('update',$shope))abort(403);
        if(is_null( $file ) ){
            $shope->update([
                'shopes_name' => $request->shopes_name,
                'shopes_name_ar' => $request->shopes_name_ar,
                'shopes_name_ru' => $request->shopes_name_ru,
            ]);
        }else{

        
        $newphoto = time().$shopes_image->getClientOriginalName();
        $shopes_image->move('../../Bazar/upload/shopes',$newphoto);
        
        $shope->update([
            'shopes_name' => $request->shopes_name,
            'shopes_name_ar' => $request->shopes_name_ar,
            'shopes_name_ru' => $request->shopes_name_ru,
            'shopes_image' => $newphoto
        ]);
    }
        return redirect()->route('admin.shope.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\shope  $shope
     * @return \Illuminate\Http\Response
     */
    public function destroy(shope $shope)
    {
        if(!auth()->user()->has_access_to('delete',$shope))abort(403);
        $shope->delete();
        flash()->success('تم حذف المتجر بنجاح','عملية ناجحة');
        return redirect()->route('admin.shope.index');
    }
}
