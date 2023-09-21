<?php

namespace App\Http\Controllers;

use App\Models\shope;
use App\Models\categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorie = categorie::all();
        return view('admin.categorie.index' , compact('categorie'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $shope = shope::all();
        return view('admin.categorie.create' ,compact('shope') );
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
            'categories_name' => "required",
            'categories_name_ar' => "required",
            'categories_image' => "required|image",
        ]);

        $categories_image = $request->categories_image;
        $newphoto = time().$categories_image->getClientOriginalName();
        $categories_image->move('../../ecommercecourse-PHP--177/upload/categories',$newphoto);
        
        $categorie = categorie::create([
            'categories_shope' => $request->categories_shope,
            'categories_name' => $request->categories_name,
            'categories_name_ar' => $request->categories_name_ar,
            'categories_image' => 'ecommercecourse-PHP--177/upload/categories'.$newphoto
        ]);
        return redirect()->route('admin.categorie.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show(categorie $categorie)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit( $categories_id)
    {

        $shope = shope::all();
        $categorie = categorie::find($categories_id);
        return view('admin.categorie.edit' , compact('categorie') , compact('shope'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, categorie $categorie)
    {

        $categories_image = $request->categories_image;
        if(!auth()->user()->has_access_to('update',$categorie))abort(403);
        if(is_null( $categories_image->getClientOriginalName() ) ){
            $categorie->update([
                'categories_shope' => $request->categories_shope,
                'categories_name' => $request->categories_name,
                'categories_name_ar' => $request->categories_name_ar,
            ]);
        }

        
        $newphoto = time().$categories_image->getClientOriginalName();
        $categories_image->move('../../ecommercecourse-PHP--177/upload/categories',$newphoto);
        
        $categorie->update([
            'categories_name' => $request->categories_name,
            'categories_name_ar' => $request->categories_name_ar,
            'categories_image' => 'ecommercecourse-PHP--177/upload/categories'.$newphoto
        ]);
        return redirect()->route('admin.categorie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy(categorie $categorie)
    {
        if(!auth()->user()->has_access_to('delete',$categorie))abort(403);
        $categorie->delete();
        flash()->success('تم حذف القسم بنجاح','عملية ناجحة');
        return redirect()->route('admin.categorie.index');
    }
}
