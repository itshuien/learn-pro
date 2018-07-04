@extends('layouts.app')

@section('title', '| Create Course')

@section('content')
    <admin-course-form :course="{{ $course }}" :categories="{{ $categories }}" :instructors="{{ $instructors }}"></admin-course-form>
@endsection