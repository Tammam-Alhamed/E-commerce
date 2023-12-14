<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use App\Models\color;
use App\Models\size;
use App\Models\item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{

    public function index()
    {
        
        $item = item::with('categorie')->get();
        return view('admin.item.index' , compact('item'));
    }


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
            'items_name'=>"required",
            'items_name_ar'=>"required",
            'items_desc'=>"required",
            'items_desc_ar'=>"required",
            'items_price'=>"required",
            'items_discount'=>"required",
        ]);
        $items_image = $request->items_image_main;
    $newphoto = random_int(min:50 , max:1000000).random_int(min:50 , max:1000000);
        $items_image->move('Bazar/items',$newphoto);
        $item = item::create([ 
            'items_image_main'=>$newphoto,
            'items_name'=> $request->items_name,
            'items_cat'=> $request->items_cat,
            'items_name_ar'=> $request->items_name_ar,
            'items_name_ru'=> $request->items_name_ru,
            'items_desc'=> $request->items_desc,
            'items_desc_ar'=> $request->items_desc_ar,
            'items_desc_ru'=> $request->items_desc_ru,
            'items_filter'=> $request->items_filter,
            // 'items_active'=> $request->items_active,
            'items_price'=> $request->items_price,
            'items_price_d'=> $request->items_price_d,
            'items_discount'=> $request->items_discount,
            'items_delay'=> $request->items_delay,
            'items_date' => date('Y-m-d H:i:s'),
            'items_new'=> $request->items_new,
            'items_offer'=> $request->items_offer,
            'items_sold'=> $request->items_sold,
        ]);

        $file = array();
        $file = $request->items_image;
            foreach($file as $files){
    // $items_image = $request->items_image;
    $newphoto = random_int(min:50 , max:1000000).random_int(min:50 , max:1000000);
    $files->move('Bazar/items',$newphoto);
     
     DB::table('images')->insert( [
        'images_name'=>  $newphoto,
        'images_items' => $item->items_id
        //you can put other insertion here
    ]);
            }

            DB::table('colors')->insert( [
                'colors_name'=>  "0",
                'colors_items' => $item->items_id,
            ]);

    if($request->colors_name != null){
        $color = array();
        $color = $request->colors_name;
            foreach($color as $colors){
     DB::table('colors')->insert( [
        'colors_name'=>  $colors,
        'colors_items' => $item->items_id,
    ]);}
}

            DB::table('sizes')->insert( [
                'sizes_name'=>  "0",
                'sizes_items' => $item->items_id,
            ]);

    if($request->sizes_name != null){
        $size = array();
        $size = $request->sizes_name;  
     foreach($size as $sizes){
     DB::table('sizes')->insert( [
        'sizes_name'=>  $sizes,
        'sizes_items' => $item->items_id,
    ]);}
}


        flash()->success('تم إضافة المنتج بنجاح','عملية ناجحة');
        return redirect()->route('admin.item.index');
    }


    public function show(item $item)
    {
        //
    }


    public function edit( $items_id)
    {
        $images = DB::table('images')
        ->select('*')
        ->where('images_items'  , $items_id)
        ->get();

        $categorie = categorie::all();
        $item = item::find($items_id);
        return view('admin.item.edit' , compact('item' , 'categorie' , 'images'));
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
        
        // $file = $request->file('items_image');
        $filename = $request->file('items_image_main');
        if(!auth()->user()->has_access_to('update',$item))abort(403);
        if(is_null($filename) ){
            $item->update([
                'items_name' => $request->items_name,
                'items_cat' => $request->items_cat,
                'items_name_ar' => $request->items_name_ar,
                'items_desc' => $request->items_desc,
                'items_desc_ar' => $request->items_desc_ar,
                // 'items_count' => $request->items_count,
                'items_active' => $request->items_active,
                'items_price' => $request->items_price,
                'items_price_d'=> $request->items_price_d,
                'items_discount' => $request->items_discount,
                'items_filter'=> $request->items_filter,
                'items_delay'=> $request->items_delay,
                'items_date' => date('Y-m-d H:i:s'),
                'items_new'=> $request->items_new,
                'items_offer'=> $request->items_offer,
                'items_sold'=> $request->items_sold,
                
            ]);


                $sizes = $request->input('sizes');  //here scores is the input array param 
                foreach($sizes as $row){
                    $score = size::find($row['sizes_id']); 
                    $score->sizes_name = $row['sizes_name']; 
                    $score->sizes_id = $row['sizes_id']; 
                    $score->save(); 
                }

                $colors = $request->input('colors');  //here scores is the input array param 
                foreach($colors as $row){
                    $score = color::find($row['colors_id']); 
                    $score->colors_name = $row['colors_name']; 
                    $score->colors_id = $row['colors_id']; 
                    $score->save(); 
                }
        }else{
        $items_image = $request->items_image_main;
    $newphoto = random_int(min:50 , max:1000000).random_int(min:50 , max:1000000);
        $items_image->move('Bazar/items',$newphoto);
        
        $item->update([
            'items_image_main'=>$newphoto,
            'items_name' => $request->items_name,
            'items_cat' => $request->items_cat,
            'items_name_ar' => $request->items_name_ar,
            'items_name_ru' => $request->items_name_ru,
            'items_desc' => $request->items_desc,
            'items_desc_ar' => $request->items_desc_ar,
            'items_desc_ru' => $request->items_desc_ru,
            // 'items_count' => $request->items_count,
            'items_active' => $request->items_active,
            'items_price' => $request->items_price,
            'items_price_d'=> $request->items_price_d,
            'items_discount' => $request->items_discount,
            'items_filter'=> $request->items_filter,
            'items_delay'=> $request->items_delay,
            'items_date' => date('Y-m-d H:i:s'),
            'items_new'=> $request->items_new,
            'items_offer'=> $request->items_offer,
            'items_sold'=> $request->items_sold,
        ]);

        $sizes = $request->input('sizes');  //here scores is the input array param 
        foreach($sizes as $row){
            $score = size::find($row['sizes_id']); 
            $score->sizes_name = $row['sizes_name']; 
            $score->sizes_id = $row['sizes_id']; 
            $score->save(); 
        }

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
