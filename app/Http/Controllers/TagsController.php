<?php

namespace App\Http\Controllers;

use App\Models\tags;
use Illuminate\Http\Request;

class TagsController extends Controller
{

    public function index()
    {
        $tags = tags::all();
        return view('admin.tags.index' , compact('tags'));    
    }


    public function create()
    {
        return view('admin.tags.create');    
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => "required",
        ]);

        
        $tags = tags::create([
            'name' => $request->name
        ]);

        return redirect()->route('admin.tags.index');
    }


    public function show(tags $tags)
    {
        //
    }


    public function edit(tags $tags)
    {
        //
    }


    public function update(Request $request, tags $tags)
    {
        //
    }


    public function destroy(tags $tag)
    {
        if(!auth()->user()->has_access_to('delete',$tag))abort(403);
        $tag->delete();

        flash()->success('تم حذف التاغ بنجاح','عملية ناجحة');
        return redirect()->route('admin.tags.index');    
    }
}
