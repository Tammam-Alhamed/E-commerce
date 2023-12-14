<?php

namespace App\Http\Controllers;

use App\Models\slide;
use Illuminate\Http\Request;

class SlideController extends Controller
{

    public function index()
    {
        $slide = slide::all();
        return view('admin.slide.index' , compact('slide'));
    }


    public function create()
    {
        return view('admin.slide.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'slides_image' => "required|image",
        ]);

        $slides_image = $request->slides_image;
        $newphoto = random_int(min:50 , max:1000000).random_int(min:50 , max:1000000);
        $slides_image->move('Bazar/slides',$newphoto);
        
        $slide = slide::create([
            'slides_image' => $newphoto
        ]);

        return redirect()->route('admin.slide.index');
    }

    public function show(slide $slide)
    {
        //
    }


    public function edit($slide)
    {
        $slide = slide::find($slide);
        return view('admin.slide.edit' , compact('slide'));
    }


    public function update(Request $request, slide $slide)
    {
        $slide_image = $request->slide_image;
        $newphoto = random_int(min:50 , max:1000000).random_int(min:50 , max:1000000);
        $slide_image->move('Bazar/slides',$newphoto);
        
        $slide->update([
            'slides_image' => $newphoto
        ]);
    
        return redirect()->route('admin.slide.index');
    }


    public function destroy(slide $slide)
    {
        if(!auth()->user()->has_access_to('delete',$slide))abort(403);
        $slide->delete();
        flash()->success('تم حذف الاعلان بنجاح','عملية ناجحة');
        return redirect()->route('admin.slide.index');
    }
}
