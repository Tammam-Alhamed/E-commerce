<?php

namespace App\Http\Controllers;

use App\Models\categorie;
use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\User;
use App\Models\item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class searchController extends Controller
{
public function search(Request $request ){ 
 

        
        $order = orders::where('orders_status', 'LIKE' ,'%'.$request->state.'%')->get();
        return view('admin.order.index' ,compact('order'));
          
}

public function searchItem(Request $request ){

        $items = item::where(
               'items_name', 'LIKE' ,'%'.$request->name.'%' ,)->orWhere(
               'items_name_ar', 'LIKE' ,'%'.$request->name.'%',)->orWhere(
               'items_name_ru', 'LIKE' ,'%'.$request->name.'%',)->orWhereHas('categorie', function($q) use ($request) {
                return $q->where('categories_name', 'LIKE', '%' . $request->name . '%');
            })->Paginate(100);


        return view('admin.item.index' ,compact('items'));
}
}
?>