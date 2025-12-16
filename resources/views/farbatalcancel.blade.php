@extends('layouts.app')

@section('header', 'Pembatalan Cancel Farmasi')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/search1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/boxcard1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/switch1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/btndetail1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dropdown1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/inputnumber1.css') }}">
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
    <form method="GET" action="{{ url('/farbatalcancel') }}">
        <input type="text" name="no_po" placeholder="Masukan Nomor PO" value="{{ request('no_po') }}">
        <!--<input type="text" name="no_ro" placeholder="Masukan Nomor RO" value="{-{ request('no_ro') }}">-->
        <button type="submit">Search</button>
    </form>
</div>
<!-- ================================================================ Purchasing Order Header =============================================================== -->
@if($poheader)
<h1 class="flag-title">Purchasing Order</h1>
<div class="box-container">

    <!-- RO_HEADER -->
    <div class="box-card">
        <h2>
             {{ $poheader->PONumber }} 
        </h2>
    <form action="{{ route('farmasipo.updateHeader', $poheader->PONumber) }}" method="POST">
        @csrf
        @method('PUT')
        <select name="status" id="status" onchange="this.form.submit()">
            <option value="0" {{ $poheader->OrderStatusID == 0 ? 'selected' : '' }}>Work Sheet</option>
            <option value="1" {{ $poheader->OrderStatusID == 1 ? 'selected' : '' }}>On Order</option>
            <option value="2" {{ $poheader->OrderStatusID == 2 ? 'selected' : '' }}>Completed</option>
            <option value="3" {{ $poheader->OrderStatusID == 3 ? 'selected' : '' }}>Cancel</option>
            <option value="4" {{ $poheader->OrderStatusID == 4 ? 'selected' : '' }}>Revisi</option>
            <option value="5" {{ $poheader->OrderStatusID == 5 ? 'selected' : '' }}>Partial Completed</option>
            <option value="6" {{ $poheader->OrderStatusID == 6 ? 'selected' : '' }}>Partial Receive</option>
            <option value="7" {{ $poheader->OrderStatusID == 7 ? 'selected' : '' }}>Partial Canceled</option>
        </select>
        <input type="hidden" name="no_po" value="{{ $poheader->PONumber }}">
        <input type="hidden" name="idpoheader" value="{{ $poheader->IDPOHeader }}">                
    </form><br>
    </div>
</div>
<!-- ================================================================ End Purchasing Order Header =============================================================== -->
@else
<h1 class="flag-title">Purchasing Order</h1>
<div class="box-card">
    <h2>Purchasing Order Farmasi</h2>
</div>
@endif
<!-- ============================================================================ Detail ================================================================ -->
@if($podetail)
<h1 class="flag-title">Detail</h1>
<div class="box-container">
    <!-- RO_HEADER -->
@forelse($podetail ?? [] as $row)
    <div class="box-card">
    <h2>{{$row->ItemName}}</h2>
    <form action="{{ route('farmasipo.updateDetail', $row->PONumber) }}" method="POST">
        @csrf
        @method('PUT') 
        <select name="status" id="status">
            <option value="0" {{ $row->OrderStatusID == 0 ? 'selected' : '' }}>Work Sheet</option>
            <option value="1" {{ $row->OrderStatusID == 1 ? 'selected' : '' }}>On Order</option>
            <option value="2" {{ $row->OrderStatusID == 2 ? 'selected' : '' }}>Completed</option>
            <option value="3" {{ $row->OrderStatusID == 3 ? 'selected' : '' }}>Cancel</option>
            <option value="4" {{ $row->OrderStatusID == 4 ? 'selected' : '' }}>Revisi</option>
            <option value="5" {{ $row->OrderStatusID == 5 ? 'selected' : '' }}>Partial Completed</option>
            <option value="6" {{ $row->OrderStatusID == 6 ? 'selected' : '' }}>Partial Receive</option>
            <option value="7" {{ $row->OrderStatusID == 7 ? 'selected' : '' }}>Partial Canceled</option>
        </select><br><br>
        <div class="table2">
            <div class="t2-item"><strong>Quantity (PO)</strong></div>
            <div class="t2-item"><strong>Received</strong></div>
            <div class="t2-item">{{intval($row->Quantity)}}</div>
            <div class="t2-item">{{ intval($row->Qty_Received) }}</div>
            <div class="t2-item"><strong>Quantity Cancelled</strong></div>
            <div class="t2-item"><input type="number" name="qty_cancel" value="{{ intval($row->Qty_Cancelled) }}"></div>
            <div class="t2-item"><strong>Sub Total Cancelled</strong></div>
            <div class="t2-item"><input type="number" step="any" name="subtotal_cancel" value="{{ intval($row->SubTotal_Cancelled) }}"></div>
        </div> <br>
        <input type="hidden" name="idpodetail" value="{{ $row->IDPODetail }}"> 
        <button type="submit" class="btn-action">Update</button>              
    </form>
    </div>
    
@empty
@endforelse
</div>
@else
@endif
<!-- ========================================================================== End Detail =============================================================== -->
@endsection