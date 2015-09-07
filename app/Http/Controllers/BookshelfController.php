<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Services\BookshelfService;
use Illuminate\Http\Request;

class BookshelfController extends Controller
{
    /**
     * @var BookshelfService
     */
    private $service;

    public function __construct(BookshelfService $service)
    {
        $this->middleware('auth');
        $this->service = $service;
    }

    public function index()
    {
        $books = $this->service->getAllBooks();
        return view('bookshelf/index', compact('books'));
    }

    public function checkout(Request $request)
    {
        $bookId = $request->get('book_id');
        $this->service->checkoutBookById($bookId);
        return redirect('/');
    }

    public function returnBook(Request $request)
    {
        $bookId = $request->get('book_id');
        $this->service->returnBookById($bookId);
        return redirect('/');
    }
}
