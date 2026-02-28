@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 700px; margin-top: 50px;">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h2>Edit Book: {{ $book->title }}</h2>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to List</a>
    </div>

    {{-- Error Alert --}}
    @if ($errors->any())
        <div style="background: #fee2e2; color: #991b1b; padding: 15px; margin-bottom: 20px; border-radius: 5px;">
            <strong>Check the following errors:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data" style="background: #fff; padding: 25px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
        @csrf
        @method('PUT') {{-- This tells Laravel to treat the POST request as a PUT request --}}

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Book Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $book->title) }}" required>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>ISBN</label>
            <input type="text" name="isbn" class="form-control" value="{{ old('isbn', $book->isbn) }}" required>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Author</label>
            <select name="author_id" class="form-control" required>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ $book->author_id == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Category</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $book->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group" style="margin-bottom: 15px;">
            <label>Published Date</label>
            <input type="date" name="published_at" class="form-control" value="{{ old('published_at', $book->published_at) }}">
        </div>

        <div class="form-group" style="margin-bottom: 20px;">
            <label>Cover Image</label><br>
            
            @if($book->cover_image)
                <div style="margin-bottom: 10px;">
                    <small style="color: #666;">Current Image:</small><br>
                    <img src="{{ asset('storage/' . $book->cover_image) }}" style="width: 100px; height: 130px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                </div>
            @endif

            <input type="file" name="cover_image" class="form-control">
            <small class="text-muted">Leave empty to keep the current image.</small>
        </div>

        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px;">Update Book Records</button>
    </form>
</div>
@endsection