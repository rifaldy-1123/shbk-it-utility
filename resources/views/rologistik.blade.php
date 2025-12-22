@extends('layouts.app')

@section('header', 'Revisi RO Logistik')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/search1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxcard1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/switch1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/btndetail1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown2.css') }}">
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

<!-- ===================================================================== Receive Order ========================================================================= -->
    <div class="search-box">
        <form method="GET" action="{{ url('/rologistik') }}">
            <select name="sc_by" id="status" >
            <option value="0" {{ $ScBy == 0 ? 'selected' : '' }}>Nomor RO</option>
            <option value="1" {{ $ScBy == 1 ? 'selected' : '' }}>Nomor PO</option>
        </select>
            <input type="text" name="no_po" placeholder="Masukan Nomor PO/RO" value="{{ request('no_po') }}">
            <!--<input type="text" name="notransaksi" placeholder="Masukan Nomor Transaksi" value="{s{ request('notransaksi') }s}">-->
            <button type="submit">Search</button>
        </form>
    </div>

<!--<form action="{-{ route('/revisilogistik') }}" method="POST">
    @-csrf-->
@if($roheader)
<h1 class="flag-title">Receive Order</h1>
<div class="box-container">

    <!-- RO_HEADER -->
@forelse($roheader ?? [] as $row)
    <div class="box-card">
        <h2>
            <form action="{{ route('rologistik') }}" method="GET">
                @csrf
                <input type="hidden" name="no_ro" value="{{ $row->RONumber }}">
                <input type="hidden" name="no_po" value="{{ $NoPO }}">
                <input type="hidden" name="sc_by" value="{{ $ScBy }}">
                <button type="submit" class="btn-detail">Detail</button>
            </form>
        </h2>
        <form action="{{ route('ro.show') }}" method="POST" class="switch-form">
            @csrf
            @method('PATCH')
        <h3 class="flag-subtitle"> {{ $row->RONumber }} </h3> 
                <label class="switch">
                    <input type="checkbox" name="GCRecord" class="gcrecord-switch"
                        {{ $row->GCRecord == 0 ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
                <input type="hidden" name="no_ro" value="{{ $row->RONumber }}">
                <input type="hidden" name="ro_gc" value="{{ $row->GCRecord }}">
    </form>
    </div>
    
@empty
<div class="box-card">
    <h2>Receive Order</h2>
</div>
@endforelse
</div>
<!-- ===================================================================== End Receive Order ========================================================================= -->
@else
@endif

@if($rodetail)
<h1 class="flag-title">Detail</h1>
<div class="box-container">
    <!-- RO_HEADER -->
@forelse($rodetail ?? [] as $row)
    <div class="box-card">
        <h2>
            <form action="{{ route('rologistik') }}" method="GET">
                @csrf
                <input type="hidden" name="no_po" value="{{ $NoPO }}">
                <input type="hidden" name="sc_by" value="{{ $ScBy }}">
                <button type="submit" class="btn-back">Back</button>
            </form>
        </h2>
        <form action="{{ route('ro.show') }}" method="POST" class="switch-form">
            @csrf
            @method('PATCH')
            <p><strong>Nama :</strong> {{ $row->ItemName }} <br>
                <strong>Jumlah :</strong> {{ intval($row->Quantity) }} <br>
                <strong>Keterangan :</strong> {{ $row->Keterangan ?: '-'}}</p> 
                <label class="switch">
                    <input type="checkbox" name="GCRecord" class="gcrecord-switch"
                        {{ $row->GCRecord == 0 ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
                <input type="hidden" name="no_ro" value="{{ $row->RONumber }}">
                <input type="hidden" name="ro_gc" value="{{ $row->GCRecord }}">
    </form>
    </div>
    
@empty
@endforelse
</div>
@else
@if ($roheader)
@else
<h1 class="flag-title">Receive Order</h1>
<div class="box-card">
    <h2>Receive Order</h2>
</div>
@endif
@endif

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