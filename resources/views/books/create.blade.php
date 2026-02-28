@extends('layouts.app')

@section('content')
<div style="max-width: 600px; margin: auto; padding: 20px; font-family: sans-serif;">
    <h2>Add New Book</h2>
    <hr>

    {{-- Global Error List (Optional if using individual errors below) --}}
    @if ($errors->any())
        <div style="background: #fee2e2; color: #991b1b; padding: 15px; margin-bottom: 20px; border-radius: 5px; border: 1px solid #f87171;">
            <strong>Whoops! Check the fields below.</strong>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf 

        {{-- Title --}}
        <div style="margin-bottom: 15px;">
            <label for="title">Book Title:</label><br>
            <input type="text" name="title" id="title" value="{{ old('title') }}" style="width: 100%; padding: 8px; border: 1px solid {{ $errors->has('title') ? 'red' : '#ccc' }};">
            @error('title') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        {{-- ISBN --}}
        <div style="margin-bottom: 15px;">
            <label for="isbn">ISBN:</label><br>
            <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}" style="width: 100%; padding: 8px; border: 1px solid {{ $errors->has('isbn') ? 'red' : '#ccc' }};">
            @error('isbn') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        {{-- Author --}}
        <div style="margin-bottom: 15px;">
            <label for="author_id">Author:</label>
            <select name="author_id" id="author_id" style="width: 100%; padding: 8px;">
                <option value="">-- Select Author --</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        {{-- Category --}}
        <div style="margin-bottom: 15px;">
            <label for="category_id">Category:</label>
            <select name="category_id" id="category_id" style="width: 100%; padding: 8px;">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        {{-- Cover Image --}}
        <div style="margin-bottom: 15px;">
            <label for="cover_image">Cover Image (Max 2MB):</label><br>
            <input type="file" name="cover_image" id="cover_image">
            <br>@error('cover_image') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        {{-- Published Date --}}
        <div style="margin-bottom: 15px;">
            <label for="published_at">Published Date:</label><br>
            <input type="date" name="published_at" id="published_at" value="{{ old('published_at') }}" style="width: 100%; padding: 8px;">
            @error('published_at') <small style="color: red;">{{ $message }}</small> @enderror
        </div>

        <div style="margin-top: 20px;">
            <button type="submit" style="background-color: #28a745; color: white; border: none; padding: 10px 20px; cursor: pointer; border-radius: 4px;">
                Save Book
            </button>
            <a href="{{ route('books.index') }}" style="margin-left: 10px; text-decoration: none; color: #666;">Cancel</a>
        </div>
    </form>
</div>
@endsection