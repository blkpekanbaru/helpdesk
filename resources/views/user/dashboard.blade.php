@extends('layout.user')

@section('content')
    <h1>Dashboard User</h1>
    <p>Selamat datang {{ auth()->user()->username }}</p>
@endsection
