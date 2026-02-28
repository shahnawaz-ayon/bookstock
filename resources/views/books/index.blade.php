@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 30px; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    
    {{-- Header Section --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px;">
        <h2 style="color: #333; font-weight: 600;">Library Bookshelf</h2>
        <a href="{{ route('books.create') }}" class="btn-add">
            + Add New Book
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div style="background: #dcfce7; color: #166534; padding: 12px; border-radius: 6px; margin-bottom: 20px; border: 1px solid #bbf7d0;">
            {{ session('success') }}
        </div>
    @endif

    {{-- Books Table --}}
    <div style="background: white; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse; text-align: left;">
            <thead>
                <tr style="background-color: #f8fafc; border-bottom: 2px solid #e2e8f0;">
                    <th style="padding: 15px;">Cover</th>
                    <th style="padding: 15px;">Book Details</th>
                    <th style="padding: 15px;">Author</th>
                    <th style="padding: 15px;">Category</th>
                    <th style="padding: 15px; text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($books as $book)
                <tr style="border-bottom: 1px solid #f1f5f9; vertical-align: middle;">
                    {{-- 1. Cover Image --}}
                    <td style="padding: 15px; width: 80px;">
                        @if($book->cover_image)
                            <img src="{{ asset('storage/' . $book->cover_image) }}" 
                                 alt="Cover" 
                                 style="width: 60px; height: 85px; object-fit: cover; border-radius: 4px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        @else
                            <div style="width: 60px; height: 85px; background: #f1f5f9; border-radius: 4px; display: flex; align-items: center; justify-content: center; color: #94a3b8; font-size: 10px; text-align: center; border: 1px dashed #cbd5e1;">
                                No Image
                            </div>
                        @endif
                    </td>

                    {{-- 2. Title & ISBN --}}
                    <td style="padding: 15px;">
                        <div style="font-weight: 600; color: #1e293b; font-size: 16px;">{{ $book->title }}</div>
                        <div style="color: #64748b; font-size: 13px; margin-top: 4px;">ISBN: {{ $book->isbn }}</div>
                    </td>

                    {{-- 3. Author --}}
                    <td style="padding: 15px; color: #475569;">
                        {{ $book->author_name }}
                    </td>

                    {{-- 4. Category --}}
                    <td style="padding: 15px;">
                        <span style="background: #f1f5f9; color: #475569; padding: 4px 10px; border-radius: 20px; font-size: 12px; font-weight: 500;">
                            {{ $book->category_name }}
                        </span>
                    </td>

                    {{-- 5. Action Buttons (Matching Styles) --}}
                    <td style="padding: 15px; text-align: center; white-space: nowrap;">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn-action btn-edit">
                            Edit
                        </a>

                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action btn-delete" onclick="return confirm('Delete this book?')">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="padding: 40px; text-align: center; color: #94a3b8;">
                        No books found in the library. Click "+ Add New Book" to start.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<style>
    /* Add New Book Button */
    .btn-add {
        background-color: #10b981;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        transition: background 0.2s;
    }
    .btn-add:hover {
        background-color: #059669;
    }

    /* Base Action Button Style */
    .btn-action {
        display: inline-block;
        padding: 7px 16px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.2s ease;
        border: none;
        font-family: inherit;
    }

    /* Blue Edit Button */
    .btn-edit {
        background-color: #3b82f6;
        color: white;
        margin-right: 5px;
    }
    .btn-edit:hover {
        background-color: #1d4ed8;
    }

    /* Red Delete Button */
    .btn-delete {
        background-color: #ef4444;
        color: white;
    }
    .btn-delete:hover {
        background-color: #b91c1c;
    }
</style>
@endsection