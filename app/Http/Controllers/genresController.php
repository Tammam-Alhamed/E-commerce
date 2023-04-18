<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\genres;

class genresController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $genres = genres::all();
        return view('admin.genres.index', compact('genres'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.genres.create');
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
            'title'=>"required",
        ]);
        $genres = genres::create([
            'title'=> $request->title,
        ]);
        return redirect()->route('admin.genres.index');
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
        $genres = genres::find($id);
        return view('admin.genres.edit' ,compact('genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, genres $genres ,$id)
    {
        if(!auth()->user()->has_access_to('update',$genres))abort(403);
        $request->validate([

            'title'=>"required",

        ]);
        $genres = genres::find($id);
        $genres->update ([

            'title'=> $request->title,
            
        ]);
        $genres->save();
        return redirect()->route('admin.genres.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( genres $genres)
    {
        if(!auth()->user()->has_access_to('delete',$genres))abort(403);
        $genres->Delete();
        flash()->success('تم حذف القسم بنجاح','عملية ناجحة');
        return redirect()->route('admin.genres.index');
    }
}
