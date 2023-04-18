<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\book;
use App\Models\auther;
use App\Models\genres;
use Illuminate\Support\Facades\DB;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $book = book::all();
        return view('admin.book.index', compact('book'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = genres::all();
        $auther= auther::all();
        return view('admin.book.create',compact('auther'),compact('genres'));
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
            'cover'=>"required|image",
            'title'=>"required",
            'content'=>"required",
            'price'=>"required",
            'price_after'=>"required",
            'quantity'=>"required",
        ]);

        $cover = $request->cover;
        $newphoto = time().$cover->getClientOriginalName();
        $cover->move('uploads/image',$newphoto);
        $book = book::create([ 
            'cover'=>'uploads/image/'.$newphoto,
            'title'=> $request->title,
            'content'=> $request->content,
            'price'=> $request->price,
            'price_after'=> $request->price_after,
            'quantity'=> $request->quantity,
        ]);

      // $book->genres()->attach($request->genre_id);

      DB::insert('insert into book_genres (book_id, genre_id) values (?, ?)', [$book->id, $request->genre_id]);
       
    /*    if($request->hasFile('cover')){
            $file = $this->store_file([
                'source'=>$request->cover,
                'validation'=>"cover",
                'path_to_save'=>'/uploads/articles/',
                'type'=>'ARTICLE', 
                
                'resize'=>[500,1000],
                'small_path'=>'small/',
                'visibility'=>'PUBLIC',
                'file_system_type'=>env('FILESYSTEM_DRIVER'),
                'watermark'=>true,
            //    'compress'=>'auto'
            ]); 
            $book->update(['cover'=>$file['filename']]);
        }*/
        flash()->success('تم إضافة المنتج بنجاح','عملية ناجحة');
        return redirect()->route('admin.book.index');
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
        $auther =auther::all();
        $genres =genres::all();
        $book = book::find($id);
        return view('admin.book.edit' ,compact('book','auther' , 'genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, book $book )
    {
        if(!auth()->user()->has_access_to('update',$book))abort(403);
        $request->validate([
            'cover'=>"required|image",
            'title'=>"required",
            'price'=>"required",
            'price_after'=>"required",
            'quantity'=>"required",
            'content'=>"required",
        ]);
        $cover = $request->cover;
        $newphoto = time().$cover->getClientOriginalName();
        $cover->move('uploads/image',$newphoto);

        $book->update ([
            'cover'=>'uploads/image/'.$newphoto,
            'title'=> $request->title,
            'price'=> $request->price,
            'price_after'=> $request->price_after,
            'quantity'=> $request->quantity,
            'content'=> $request->content,
        ]);
        DB::insert('insert into book_genres (book_id, genre_id) values (?, ?)', [$book->id, $request->genre_id]);
        $book->save();
        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(book $book)
    {
        if(!auth()->user()->has_access_to('delete',$book))abort(403);
        $book->delete();
        flash()->success('تم حذف القسم بنجاح','عملية ناجحة');
        return redirect()->route('admin.book.index');
    }


    public function like($book_id)
    {       
        $book = Book::find($book_id);
        $l = $book->likes + 1;
        $book->likes = $l;
        $book->save();
       return $l;
    }

    public function dislike($book_id)
    {       
        $book = Book::find($book_id);
        $l = $book->dislikes + 1;
        $book->dislikes = $l;
        $book->save();
       return $l;
    }

    public function search(Request $request){
      
            $books = DB::table('books')->where('title', 'LIKE' ,'%'.$request->title.'%')->get();

            return view('front.index' ,compact('books'));
    }

}
