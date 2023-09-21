<?php

namespace App\Http\Controllers;

use App\Models\shope;
use Illuminate\Http\Request;

class ShopeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shope = shope::all();
        return view('admin.shope.index' , compact('shope'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
            'shopes_image' => 'ecommercecourse-PHP--177/upload/shopes'.$newphoto
        ]);
        return redirect()->route('admin.shope.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\shope  $shope
     * @return \Illuminate\Http\Response
     */
    public function show(shope $shope)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\shope  $shope
     * @return \Illuminate\Http\Response
     */
    public function edit(shope $shope)
    {
        $shope = shope::find($shopes_id);
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
        $shopes_image = $request->shopes_image;
        if(!auth()->user()->has_access_to('update',$shope))abort(403);
        if(is_null( $shopes_image->getClientOriginalName() ) ){
            $shope->update([
                'shopes_name' => $request->shopes_name,
                'shopes_name_ar' => $request->shopes_name_ar,
            ]);
        }

        
        $newphoto = time().$shopes_image->getClientOriginalName();
        $shopes_image->move('../../ecommercecourse-PHP--177/upload/shopes',$newphoto);
        
        $shope->update([
            'shopes_name' => $request->shopes_name,
            'shopes_name_ar' => $request->shopes_name_ar,
            'shopes_image' => 'ecommercecourse-PHP--177/upload/shopes'.$newphoto
        ]);
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
