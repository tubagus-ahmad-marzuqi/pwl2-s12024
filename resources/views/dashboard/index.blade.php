@extends('layouts.app')

@section('title','Dashboard')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div>
                    <h3 class="text-center my-4">Selamat Datang, {{ auth()->user()->name }}</h3>
                    <hr>
                </div>
            </div>
        </div>
    </div>
@endsection
