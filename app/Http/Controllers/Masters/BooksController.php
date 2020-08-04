<?php

namespace App\Http\Controllers\Masters;

use App\Board;
use App\Book;
use App\BooksImage;
use App\BookTag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Language;
use App\ProductTag;
use Illuminate\Support\Facades\Storage;
use SiteHelpers;

class BooksController extends Controller
{
    //
    public function view(){

        $inject['title'] = 'Books Master';

        $inject['languages'] = Language::all();
        $inject['boards'] = Board::all();

        return view('pages.books_master',$inject);
    }

    public function datatable(){
        $books = Book::with('board','language');

        try {
            return datatables()->of($books)
            ->make(true);

        }
        catch(Exception $e){

            return \Response::json([
                'error' => true,
                'response' => $e
            ], 444);

        }
    }

    public function bookUpdate(Request $request){

        // dd($request->input('tags'));

        $book = Book::firstOrNew(['id' => $request['book_id']]);
        $book->name = $request['name'];
        if($request->hasFile('cover_image')){
            $new_file = SiteHelpers::compressFile($request->file('cover_image'),100);

            // $request->file('cover_image')->storeAs('cover_images',$request->file('cover_image')->getClientOriginalName(),'s3');

            $book->image = $new_file['file_name'];
            $new_file['file']->save('public/storage/cover_images'.'/'.$new_file['file_name']);

            // Storage::disk('s3')->put('cover_images'.'/'.$new_file['file_name'],$new_file['file']);
        }
        $book->mrp_in_rupees = $request['mrp_in_rupees'];
        $book->board_id = $request['board_id'];
        $book->subject = $request['subject'];
        $book->authors = $request['authors'];
        $book->language_id = $request['language_id'];
        $book->print_date = $request['print_date'];
        $book->standard = $request['standard'];
        $book->refurbished_available = $request['refurbished'] == 'on' ? 1 : 0;
        $book->active = $request['active'] == 'on' ? 1 : 0;
        $book->save();

        if($request->file('other_image') && count($request->file('other_image')) > 0){
            foreach($request->file('other_image') as $file){
                $image = new BooksImage;
                $image->book_id = $book->id;
                $image->image_path = $file->getClientOriginalName();
                $image->save();

                // $file->storeAs('books_other_images',$file->getClientOriginalName(),'s3');
                $new_file = SiteHelpers::compressFile($file,20);


                // $file->move('public/storage/books_other_images',$file->getClientOriginalName());

                // Storage::disk('s3')->put('public/storage/books_other_images'.'/'.$new_file['file_name'],$new_file);
                $new_file['file']->save('public/storage/books_other_images'.'/'.$new_file['file_name']);
            }
        }

        if($request->input('tags') && count($request->input('tags')) > 0){
            foreach($request->input('tags') as $tag){
                $book_tag = new ProductTag;
                $book_tag->product_id = $book->id;
                $book_tag->product_type = 1;
                $book_tag->tag = $tag;
                $book_tag->save();
            }
        }

        return redirect()->back();
    }

    public function deleteBookOtherImage($id){
        $image = BooksImage::where('id',$id)->first();
        $image->delete();

        return \Response::json([
            'error' => false,
            'response' => 'image deleted'
        ]);
    }
}
