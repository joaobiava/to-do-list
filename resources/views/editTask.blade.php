@extends('layouts.base')

@section('title', 'edit Task')

@section('body')
<form action="{{ route(tasks.edit) }}"></form>
    @csrf
    <label for="name">Title</label>
    <input type="text" name="title" required>

    <label for="description">Description</label>
    <input type="text" name="description" required>

    <label for="category">Category</label>
    <input type="text" name="category" required>

    <button type="submit">Submit</button>
@endsection