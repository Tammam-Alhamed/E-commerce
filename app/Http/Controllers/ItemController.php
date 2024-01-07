<?php

namespace App\Http\Controllers;

use App\Models\item;
use App\Models\size;
use App\Models\color;
use App\Models\image;
use App\Models\categorie;
use GuzzleHttp\Psr7\Uri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{

    public function index()
    {
        
        $items = item::with('categorie')->Paginate(100);
        return view('admin.item.index' , compact('items'));
    }


    public function create()
    {
        $categorie = categorie::all();
        return view('admin.item.create' , compact('categorie'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'items_name'=>"required",
            'items_name_ar'=>"required",
            'items_desc'=>"required",
            'items_desc_ar'=>"required",
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


    public function update(Request $request, item $item)
    {
        
        $filename = $request->file('items_image_main');
        $filename_multi = $request->file('items_image');
        if(!auth()->user()->has_access_to('update',$item))abort(403);
        if(is_null($filename) ){
            $item->update([
                'items_name' => $request->items_name,
                'items_cat' => $request->items_cat,
                'items_name_ar' => $request->items_name_ar,
                'items_name_ru' => $request->items_name_ru,
                'items_desc' => $request->items_desc,
                'items_desc_ar' => $request->items_desc_ar,
                'items_desc_ru' => $request->items_desc_ru,
                'items_active' => $request->items_active,
                // 'items_price' => $request->items_price,
                'items_price_d'=> $request->items_price_d,
                'items_discount' => $request->items_discount,
                'items_filter'=> $request->items_filter,
                'items_delay'=> $request->items_delay,
                'items_date' => date('Y-m-d H:i:s'),
                'items_new'=> $request->items_new,
                'items_offer'=> $request->items_offer,
                'items_sold'=> $request->items_sold,
                
            ]);
            //size
                $sizes = $request->input('sizes');  //here scores is the input array param 
                foreach($sizes as $row){
                    $score = size::find($row['sizes_id']); 
                    $score->sizes_name = $row['sizes_name']; 
                    $score->sizes_id = $row['sizes_id']; 
                    $score->save(); 
                }
                //color
                $colors = $request->input('colors');  //here scores is the input array param 
                foreach($colors as $row){
                    $score = color::find($row['colors_id']); 
                    $score->colors_name = $row['colors_name']; 
                    $score->colors_id = $row['colors_id']; 
                    $score->save(); 
                }
                if($filename_multi != null){
                    //delete photo from folder
                    $imagePath = image::where('images_items' , '=' , $item->items_id)->get();
                    $delete = image::where('images_items' , '=' , $item->items_id);
                    $delete->delete();
                    $images = array();
                    $images = $request->items_image;
                    
                    foreach($imagePath as $image){
                        $filePath = $image->images_name;
                        
                    if(file_exists(base_path().'/Bazar/items/'.$filePath)){
                        unlink(base_path().'/Bazar/items/'.$filePath);
                    }
                   }
                   foreach($images as $img){
                    $newphoto = random_int(min:50 , max:1000000).random_int(min:50 , max:1000000);
                    $img->move('Bazar/items',$newphoto);
                    DB::table('images')->insert( [
                        'images_name'=>  $newphoto,
                        'images_items' => $item->items_id,
                    ]);
                }
            }
            
        }else{
            
            if($filename_multi != null){
            //delete photo from folder
            $imagePath = image::where('images_items' , '=' , $item->items_id)->get();
            $delete = image::where('images_items' , '=' , $item->items_id);
            $delete->delete();
            $images = array();
            $images = $request->items_image;
            
            foreach($imagePath as $image){
            $filePath = $image->images_name;
                unlink(base_path() . '/Bazar/items/'. $filePath);
           }
           foreach($images as $img){
            $newphoto = random_int(min:50 , max:1000000).random_int(min:50 , max:1000000);
            $img->move('Bazar/items',$newphoto);
            DB::table('images')->insert( [
                'images_name'=>  $newphoto,
                'images_items' => $item->items_id,
            ]);
        }
    }
            //start with photo
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
        return redirect()->back();
    }

    public function destroy(item $item)
    {
        if(!auth()->user()->has_access_to('delete',$item))abort(403);
        $item->delete();
        flash()->success('تم حذف المنتج بنجاح','عملية ناجحة');
        return redirect()->route('admin.item.index');
    }
}
