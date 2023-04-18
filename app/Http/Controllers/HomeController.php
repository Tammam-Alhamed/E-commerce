<?php

namespace App\Http\Controllers;

use App\Models\book;
use Illuminate\Http\Request;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(book $book)
    {
        $books = book::latest()->paginate(2);
        return view('front.index' ,compact('books'));
    }
}
