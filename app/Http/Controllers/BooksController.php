<?php

namespace App\Http\Controllers;

use App\Models\Books;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isJson;

class BooksController extends Controller
{
    public function index(){
        $books=Books::all();
        $data=compact('books');
        return view('books-view')->with($data);
    }

    public function store(Request $request){
        $b=new Books;
        $b->title=$request['title'];
        $b->author=$request['author'];
        $b->price=$request['price'];
        $b->save();

        return redirect('/books');
    }

    public function delete($id){
        $book=Books::find($id);
        if(!is_null($book)){
            $book->delete();
        }
        return redirect()->back();
    }

    public function edit(){
        return view('welcome');
    }
}
