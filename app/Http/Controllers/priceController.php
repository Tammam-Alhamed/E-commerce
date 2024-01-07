<?php

namespace App\Http\Controllers;

use App\Models\price ;
use Illuminate\Http\Request;

class PriceController extends Controller
{

    public function index()
    {
        $price = price::all();
        return view('admin.price.index' ,compact('price'));
    }




    public function edit($id)
    {
        $price = price::find($id);
        return view('admin.price.edit' , compact('price'));
    }


    public function update(Request $request, price $price)
    {
        $price->update([
            'price' => $request->price
        ]);

        return redirect()->route('admin.price.index');
    }

}
