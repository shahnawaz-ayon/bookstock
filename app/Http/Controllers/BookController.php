<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function create()
    {
        $categories = DB::table('categories')->get();
        $authors = DB::table('authors')->get();

        return view('books.create', [
            'categories' => $categories,
            'authors' => $authors
        ]);
    }

    public function edit($id)
    {
        $book = DB::table('books')->where('id', $id)->first();
        $categories = DB::table('categories')->get();
        $authors = DB::table('authors')->get();

        if (!$book) {
            abort(404);
        }

        return view('books.edit', compact('book', 'categories', 'authors'));
    }

    public function index()
    {
        $books = DB::table('books')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->leftJoin('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.*', 'authors.name as author_name', 'categories.name as category_name')
            ->get();

        return view('books.index', compact('books'));
    }

  public function store(Request $request)
{
    // ensure PHP has somewhere writable for temporary uploads
    $tempDir = storage_path('app/temp');
    if (!file_exists($tempDir)) {
        mkdir($tempDir, 0777, true);
    }
    @ini_set('upload_tmp_dir', $tempDir);

    // 1. Initial Debugging - Logs what fields were sent in the form
   \Log::debug('Upload debug', [
    'hasFile' => request()->hasFile('cover_image'),
    'file' => request()->file('cover_image'),
    'error' => request()->file('cover_image')?->getError(),
]);

    // 2. Standard Validation
    $request->validate([
        'title' => 'required',
        'isbn' => 'required|unique:books,isbn',
        'author_id' => 'required',
        'category_id' => 'required',
        'published_at' => 'required|date',
        'cover_image' => 'nullable|image|max:2048',
    ]);

    $imagePath = null;

    // 3. Detailed File Debugging
    if ($request->hasFile('cover_image')) {
        $file = $request->file('cover_image');
        
        \Log::debug('store() received', [
    'hasFile'   => $request->hasFile('cover_image'),
    'all'       => array_keys($request->all()),
    'allFiles'  => array_keys($request->allFiles()),
    'raw_files' => isset($_FILES)
        ? array_map(fn($f)=>['error'=>$f['error'],'size'=>$f['size']], $_FILES)
        : null,
]);

        if ($file->isValid()) {
            $imagePath = $file->store('covers', 'public');
            \Log::debug('file stored path', ['path' => $imagePath]);
        } else {
            \Log::error('file was invalid');
            return back()->withErrors(['cover_image' => 'The file upload was corrupted or interrupted. Check your server temp folder.']);
        }
    }

    // 4. Save to Database
    DB::table('books')->insert([
        'title' => $request->title,
        'isbn' => $request->isbn,
        'author_id' => $request->author_id,
        'category_id' => $request->category_id,
        'cover_image' => $imagePath,
        'published_at' => $request->published_at,
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('books.index')->with('success', 'Book created successfully!');
}
    // Brace was correctly here, but the one below it was extra!

    public function destroy($id)
    {
        $book = DB::table('books')->where('id', $id)->first();

        if ($book) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            DB::table('books')->where('id', $id)->delete();
        }

        return redirect()->route('books.index')->with('success', 'Book deleted successfully!');
    }

    public function update(Request $request, $id)
{
    // 1. Validation (Same as store, but ISBN unique check ignores current ID)
    $request->validate([
        'title' => 'required',
        'isbn' => 'required|unique:books,isbn,' . $id,
        'author_id' => 'required',
        'category_id' => 'required',
        'cover_image' => 'nullable|image|max:2048',
    ]);

    // 2. Find the existing book to get the old image name
    $book = DB::table('books')->where('id', $id)->first();
    $imagePath = $book->cover_image;

    // 3. Handle New Image Upload (The fix you made to php.ini applies here too!)
    if ($request->hasFile('cover_image')) {
        // Optional: Delete the old image file from storage if a new one is uploaded
        if ($imagePath && \Storage::disk('public')->exists($imagePath)) {
            \Storage::disk('public')->delete($imagePath);
        }
        
        // Store the new image
        $imagePath = $request->file('cover_image')->store('covers', 'public');
    }

    // 4. Update the database
    DB::table('books')->where('id', $id)->update([
        'title' => $request->title,
        'isbn' => $request->isbn,
        'author_id' => $request->author_id,
        'category_id' => $request->category_id,
        'cover_image' => $imagePath,
        'updated_at' => now(),
    ]);

    return redirect()->route('books.index')->with('success', 'Book updated successfully!');
}

    // --- AUTHOR METHODS ---
    public function createAuthor() {
        return view('authors.create');
    }

    public function storeAuthor(Request $request) {
        DB::table('authors')->insert([
            'name' => $request->name,
            'bio' => $request->bio,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('books.create')->with('success', 'Author added!');
    }

    // --- CATEGORY METHODS ---
    public function createCategory() {
        return view('categories.create');
    }

    public function storeCategory(Request $request) {
        DB::table('categories')->insert([
            'name' => $request->name,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return redirect()->route('books.create')->with('success', 'Category added!');
    }

    public function show($id)
    {
        $book = DB::table('books')
            ->leftJoin('authors', 'books.author_id', '=', 'authors.id')
            ->leftJoin('categories', 'books.category_id', '=', 'categories.id')
            ->select('books.*', 'authors.name as author_name', 'categories.name as category_name')
            ->where('books.id', $id)
            ->first();

        if (!$book) {
            abort(404);
        }

        return view('books.show', compact('book'));
    }
} // Final Class Brace