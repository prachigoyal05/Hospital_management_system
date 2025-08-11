@extends('layouts.admin')

@section('content')
    @include('admin.patients.form', ['patient' => $patient])
@endsection