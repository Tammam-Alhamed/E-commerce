<?php
/** 
 * ال auther
 * هي البنر 
 * 
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\auther;

class autherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auther = auther::all();
        return view('admin.auther.index', compact('auther'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.auther.create');
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
            'name'=>"required|image",
        ]);
        $name = $request->name;
        $newphoto = time().$name->getClientOriginalName();
        $name->move('uploads/image',$newphoto);
        $auther = auther::create([
            'name'=>'uploads/image/'.$newphoto,
        ]);

        return redirect()->route('admin.auther.index');
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
        $auther = auther::find($id);
        return view('admin.auther.edit',compact('auther'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, auther $auther ) 
    {
        if(!auth()->user()->has_access_to('update',$auther))abort(403);
        $request->validate([

            'name'=>"required",

        ]);

        $auther->update ([

            'name'=> $request->name,

        ]);
        $auther->save();
        return redirect()->route('admin.auther.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( auther $auther)
    {
        if(!auth()->user()->has_access_to('delete',$auther))abort(403);
        $auther->delete();
        flash()->success('تم حذف القسم بنجاح','عملية ناجحة');
        return redirect()->route('admin.book.index');
    }
}
