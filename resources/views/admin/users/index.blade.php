@extends('layouts.app')

@section('title', '| Manage Users')

@section('content')
    <admin-users :roles="{{ $roles }}"></admin-users>
@endsection