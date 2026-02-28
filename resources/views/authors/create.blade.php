@extends('layouts.app')
@section('content')
    <h3>Add New Author</h3>
    <form action="{{ route('authors.store') }}" method="POST">
        @csrf
        <label>Author Name:</label><br>
        <input type="text" name="name" required style="width:100%; margin-bottom:10px;"><br>
        
        <label>Biography:</label><br>
        <textarea name="bio" style="width:100%; margin-bottom:10px;"></textarea><br>
        
        <button type="submit" class="btn btn-primary">Save Author</button>
    </form>
@endsection

