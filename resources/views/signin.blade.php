@extends('layouts.base')

@section('title', 'sign in')

@section('body')
<link rel="stylesheet" type="text/css" href="css/signin.css" media="screen" />
    <form action="{{ route('login') }}" method="post">
        @csrf

        <label for="email">email</label>
        <input type="email" name="email">


        <label for="password">password</labe>
        <input type="password" name="password">

        <button type="submit">Submit</button>
    </form>
@endsection