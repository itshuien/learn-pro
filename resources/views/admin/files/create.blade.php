@extends('layouts.app')

@section('title', '| Upload Files')

@section('content')
    <admin-files-upload-form :course="{{ $course }}"></admin-files-upload-form>
@endsection