<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use App\Models\item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $item = item::with('categorie')->get();
        return view('admin.item.index' , compact('item'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorie = categorie::all();
        return view('admin.item.create' , compact('categorie'));
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
            'items_image'=>"required|image",
            'items_name'=>"required",
            'items_name_ar'=>"required",
            'items_desc'=>"required",
            'items_desc_ar'=>"required",
            'items_price'=>"required",
            'items_discount'=>"required",
        ]);

        $items_image = $request->items_image;
        $newphoto = time().$items_image->getClientOriginalName();
        $items_image->move('../../Bazar/upload/items',$newphoto);
        $item = item::create([ 
            'items_image'=>$newphoto,
            'items_name'=> $request->items_name,
            'items_cat'=> $request->items_cat,
            'items_name_ar'=> $request->items_name_ar,
            'items_name_ru'=> $request->items_name_ru,
            'items_desc'=> $request->items_desc,
            'items_desc_ar'=> $request->items_desc_ar,
            'items_desc_ru'=> $request->items_desc_ru,
            // 'items_count'=> $request->items_count,
            // 'items_active'=> $request->items_active,
            'items_price'=> $request->items_price,
            'items_price_d'=> $request->items_price_d,
            'items_discount'=> $request->items_discount,
        ]);

       
        flash()->success('تم إضافة المنتج بنجاح','عملية ناجحة');
        return redirect()->route('admin.item.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit( $items_id)
    {
        $categorie = categorie::all();
        $item = item::find($items_id);
        return view('admin.item.edit' , compact('item' , 'categorie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, item $item)
    {
        $file = $request->file('shopes_image');
        if(!auth()->user()->has_access_to('update',$item))abort(403);
        if(is_null( $file ) ){
            $item->update([
                'items_name' => $request->items_name,
                'items_cat' => $request->items_cat,
                'items_name_ar' => $request->items_name_ar,
                'items_desc' => $request->items_desc,
                'items_desc_ar' => $request->items_desc_ar,
                'items_count' => $request->items_count,
                'items_active' => $request->items_active,
                'items_price' => $request->items_price,
                'items_price_d'=> $request->items_price_d,
                'items_discount' => $request->items_discount,
            ]);
        }else{
        $items_image = $request->items_image;
        $newphoto = time().$items_image->getClientOriginalName();
        $items_image->move('../../Bazar/upload/items',$newphoto);
        
        $item->update([
            'items_name' => $request->items_name,
            'items_cat' => $request->items_cat,
            'items_name_ar' => $request->items_name_ar,
            'items_name_ru' => $request->items_name_ru,
            'items_desc' => $request->items_desc,
            'items_desc_ar' => $request->items_desc_ar,
            'items_desc_ru' => $request->items_desc_ru,
            'items_count' => $request->items_count,
            'items_active' => $request->items_active,
            'items_price' => $request->items_price,
            'items_price_d'=> $request->items_price_d,
            'items_discount' => $request->items_discount,
            'items_image' => 'Bazar/upload/items'.$newphoto
        ]);
    }
        return redirect()->route('admin.item.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(item $item)
    {
        if(!auth()->user()->has_access_to('delete',$item))abort(403);
        $item->delete();
        flash()->success('تم حذف المنتج بنجاح','عملية ناجحة');
        return redirect()->route('admin.item.index');
    }
}
