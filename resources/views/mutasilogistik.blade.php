@extends('layouts.app')

@section('header', 'Revisi RO Logistik')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/search1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxcard1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/switch1.css') }}">
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
<!--  ================================================================== Mutasi =========================================================================================   -->

    <div class="search-box">
        <form method="GET" action="{{ url('/mutasilogistik') }}">
            <input type="text" name="no_mutasi" placeholder="Masukan Nomor Mutasi" value="{{ request('no_mutasi') }}">
            <!--<input type="text" name="notransaksi" placeholder="Masukan Nomor Transaksi" value="{s{ request('notransaksi') }s}">-->
            <button type="submit">Search</button>
        </form>
    </div>
<h1 class="flag-title">Mutasi</h1>
<!--<form action="{-{ route('/revisilogistik') }}" method="POST">
    @-csrf-->
<div class="box-container">
    <!-- INMutasi -->
    <div class="box-card">
        @if($mutasi)
        
            <h2>Header</h2> 
            
        <form action="{{ route('mutasi.show') }}" method="POST" class="switch-form">
            @csrf
            @method('PATCH')
            <p><h3 class="flag-subtitle">{{ $mutasi->NoInvoice }} </h3> 
                <label class="switch">
                    <input type="checkbox" name="GCRecord" class="gcrecord-switch"
                        {{ $mutasi->GCRecord == 0 ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
                <input type="hidden" name="mutasi_noinvoice" value="{{ $mutasi->NoInvoice }}">
                <input type="hidden" name="mutasi_gc" value="{{ $mutasi->GCRecord }}">
        @else
                <h2>Mutasi</h2>
        @endif
        </form>
        
    </div>
</div>
@if($mutasiD)
<h1 class="flag-title">Detail</h1>
@else
@endif
<div class="box-container">
    <!-- INMutasiD -->
@forelse($mutasiD ?? [] as $row)
<form action="{{ route('mutasiD.show') }}" method="POST" class="switch-form">
            @csrf
            @method('PATCH')
    <div class="box-card">
        <h2>Mutasi - {{ $row->ItemDesc }}</h2>
        <h3 class="flag-subtitle2"> {{ intval($row->Qty) }} </h3> 
                <label class="switch">
                    <input type="checkbox" name="GCRecord" class="gcrecord-switch"
                        {{ $row->GCRecord == 0 ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
                <input type="hidden" name="mutasid_noinvoice" value="{{ $row->NoInvoice }}">
                <input type="hidden" name="mutasid_nourut" value="{{ $row->NoUrut }}">
                <input type="hidden" name="mutasid_itemdesc" value="{{ $row->ItemDesc }}">
                <input type="hidden" name="mutasid_gc" value="{{ $row->GCRecord }}">
    </div>
    </form>
@empty
@endforelse
</div>
<!-- ===================================================================== End Mutasi ========================================================================= -->


<script>
    // Auto-submits form ketika switch diganti
    const switches = document.querySelectorAll('.gcrecord-switch');

    switches.forEach(s => {
    s.addEventListener('change', function () {
        // submit form yang paling dekat dengan switch ini
        this.closest('form').submit();
    });
});
</script>
@endsection