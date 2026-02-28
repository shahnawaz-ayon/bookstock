@extends('layouts.app')
@section('content')
    <h3>Add New Category</h3>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <label>Category Name:</label><br>
        <input type="text" name="name" required style="width:100%; margin-bottom:10px;"><br>
        
        <button type="submit" class="btn btn-primary">Save Category</button>
    </form>
@endsection