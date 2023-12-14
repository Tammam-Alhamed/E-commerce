<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\orders;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class searchController extends Controller
{
public function search(Request $request ){ 
 

        
        $order = orders::where('orders_status', 'LIKE' ,'%'.$request->state.'%')->get();
        return view('admin.order.index' ,compact('order'));

        
          
}
}
?>