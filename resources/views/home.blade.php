@extends('layouts.app')

@section('header', 'Utility IT')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/buttonhome1.css') }}">
@endpush

@section('content')

<img src="{{ asset('assets/logo/logo-santosa.png') }}">

<div class="menu-container flex flex-wrap justify-center items-center gap-5"">
    <a href="/elementdetail" class="menu-card">Element Detail</a>
    <a href="/updatesep" class="menu-card">Update SEP</a>
    <a href="/mutasilogistik" class="menu-card">Mutasi</a>
    <a href="/rologistik" class="menu-card">Receive Order</a>
    <a href="/purchasinglogistik" class="menu-card">Purchasing Order</a>
</div>

@endsection