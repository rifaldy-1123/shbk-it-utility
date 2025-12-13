@extends('layouts.app')

@section('header', 'Update SEP')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/search1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxcard1.css') }}">
@endpush

@section('content')
@if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
@endif
@if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 border border-red-300 rounded">
            {{ session('error') }}
        </div>
@endif

    <div class="search-box">
        <form method="GET" action="{{ url('/updatesep') }}">
            <input type="text" name="nosep" placeholder="Masukan SEP Baru" value="{{ request('nosep') }}">
            <input type="text" name="notransaksi" placeholder="Masukan Nomor Transaksi" value="{{ request('notransaksi') }}">
            <button type="submit">Search</button>
        </form>
    </div>

<form action="{{ route('updatesep.update') }}" method="POST">
    @csrf
<div class="box-container">
    
    <!-- ACT -->
    @method('PUT')
    <div class="box-card">
        <h2>ACT</h2>
        @if($act)
            <p><strong>Nama :</strong> {{ $act->Nama }} <br>
                <strong>NoTrx :</strong> {{ $act->NoTrx }} <br>
                <strong>NoSEP :</strong> {{ $act->NoSEP }}</p>
                <input type="hidden" name="act_notrx" value="{{ $act->NoTrx }}">
                <input type="hidden" name="act_nosep" value="{{ $act->NoSEP }}">
        @else
            <!--<p>
                <strong>Nama :</strong><br>
                <strong>NoTrx :</strong> <br>
                <strong>NoSEP :</strong></p>-->
        @endif
    </div>

    <!-- OEFarmasi -->
    <div class="box-card">
        <h2>OEFarmasi</h2>
        @if($oefarmasi)
            <p> <strong>Nama :</strong> {{ $oefarmasi->PasienDesc }} <br>
                <strong>NoTrxRefKunjungan :</strong> {{ $oefarmasi->NoTrxRefKunjungan }} <br>
                <strong>NoSEP :</strong> {{ $oefarmasi->NoSEP }}<br>
                <input type="hidden" name="oefarmasi_noinvoice" value="{{ $oefarmasi->NoInvoice }}">
        @else
            <!--<p> <strong>Nama :</strong> <br>
                <strong>NoTrxRefKunjungan :</strong>  <br>
                <strong>NoSEP :</strong> <br> -->
        @endif
    </div>
    <div class="box-card">
        <h2>Update SEP</h2>
        @if ($act && $oefarmasi && $act->NoMR == $oefarmasi->PasienMR)
        <button type="submit" class="btn-action">Update</button>
        @else
        @endif
            
    </div>
</div>
</form>
@endsection