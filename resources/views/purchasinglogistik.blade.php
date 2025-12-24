@extends('layouts.app')

@section('header', 'Revisi RO Logistik')
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
    <form method="GET" action="{{ url('/purchasinglogistik') }}">
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
    <form action="{{ route('purchasinglogistik.updateHeader', $poheader->PONumber) }}" method="POST">
        @csrf
        @method('PUT')
        <select name="status" id="status" onchange="this.form.submit()">
            <option value="0" {{ $poheader->OrderStatusID == 0 ? 'selected' : '' }}>Work Sheet</option>
            <option value="1" {{ $poheader->OrderStatusID == 1 ? 'selected' : '' }}>On Order</option>
            <option value="2" {{ $poheader->OrderStatusID == 2 ? 'selected' : '' }}>Full Completed</option>
            <option value="3" {{ $poheader->OrderStatusID == 3 ? 'selected' : '' }}>Full Cancelled</option>
            <option value="4" {{ $poheader->OrderStatusID == 4 ? 'selected' : '' }}>Partial Received</option>
            <option value="5" {{ $poheader->OrderStatusID == 5 ? 'selected' : '' }}>Partial Cancelled</option>
            <option value="6" {{ $poheader->OrderStatusID == 6 ? 'selected' : '' }}>Partial Completed</option>
        </select>
        <input type="hidden" name="no_po" value="{{ $poheader->PONumber }}">                
    </form><br>
    <h2>Cek Detail: </h2>
    <form action="{{ route('purchasinglogistik') }}" method="GET">
                @csrf
    <select name="no_ro" id="status" onchange="this.form.submit()">
        <option value="" disabled selected>Pilih Nomor RO</option>
        @foreach ($ROlist as $row)
            <option value="{{ $row->RONumber }}" {{ $row->RONumber == $NoRO ? 'selected' : ''}} >{{ $row->RONumber }}</option>
        @endforeach
    </select>
    <input type="hidden" name="no_po" value="{{ $poheader->PONumber }}"> 
    </form>
    <br> 
    <button type="button" command="show-modal" commandfor="dialog" class="rounded-md bg-gray-950/5 px-2.5 py-1.5 text-sm font-semibold text-gray-900 hover:bg-gray-950/10">Vendor</button>
    <input type="text" value="{{ $poheader->Vendor }}"" name="vendor" readonly class="border border-gray-300 rounded-md px-3 py-2 text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
    
    </div>
</div>
<!-- ================================================================ End Purchasing Order Header =============================================================== -->
@else
<h1 class="flag-title">Purchasing Order</h1>
<div class="box-card">
    <h2>Purchasing Order</h2>
</div>
@endif
<!-- ============================================================================ Detail ================================================================ -->
@if($podetail)
<h1 class="flag-title">Detail ({{ $NoRO }})</h1>
<div class="box-container">
    <!-- RO_HEADER -->
@forelse($podetail ?? [] as $row)
    <div class="box-card">
    <h2>PO : {{$row->ItemName}} - {{intval($row->QuantityPO)}}</h2>
    <form action="{{ route('purchasinglogistik.updateDetail', $row->PONumber) }}" method="POST">
        @csrf
        @method('PUT') 
        <select name="status" id="status">
            <option value="0" {{ $row->OrderStatusID == 0 ? 'selected' : '' }}>Work Sheet</option>
            <option value="1" {{ $row->OrderStatusID == 1 ? 'selected' : '' }}>On Order</option>
            <option value="2" {{ $row->OrderStatusID == 2 ? 'selected' : '' }}>Full Completed</option>
            <option value="3" {{ $row->OrderStatusID == 3 ? 'selected' : '' }}>Full Cancelled</option>
            <option value="4" {{ $row->OrderStatusID == 4 ? 'selected' : '' }}>Partial Received</option>
            <option value="5" {{ $row->OrderStatusID == 5 ? 'selected' : '' }}>Partial Cancelled</option>
            <option value="6" {{ $row->OrderStatusID == 6 ? 'selected' : '' }}>Partial Completed</option>
        </select><br><br>
        <div class="table2">
            <div class="t2-item"><strong>RECEIVED (RO)</strong></div>
            <div class="t2-item"><strong>PO_DETAIL</strong></div>
            <div class="t2-item">{{intval($row->ReceiveinRO)}}</div>
            <div class="t2-item"><input type="number" name="qty_received" value="{{ intval($row->ReceiveinPODetail) }}"></div>
            <div class="t2-item"><strong>IsReceived</strong></div>
            <div class="t2-item">
                <select name="isreceived" id="receive">
                    <option value="0" {{ $row->IsReceived == 0 ? 'selected' : '' }}>No</option>
                    <option value="1" {{ $row->IsReceived == 1 ? 'selected' : '' }}>Yes</option>
                </select>
            </div>
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
<el-dialog>
  <dialog id="dialog" aria-labelledby="dialog-title" class="fixed inset-0 size-auto max-h-none max-w-none overflow-y-auto bg-transparent backdrop:bg-transparent">
    <el-dialog-backdrop class="fixed inset-0 bg-gray-500/75 transition-opacity data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in"></el-dialog-backdrop>

    <div tabindex="0" class="flex min-h-full items-end justify-center p-4 text-center focus:outline-none sm:items-center sm:p-0">
      <el-dialog-panel class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all data-closed:translate-y-4 data-closed:opacity-0 data-enter:duration-300 data-enter:ease-out data-leave:duration-200 data-leave:ease-in sm:my-8 sm:w-full sm:max-w-lg data-closed:sm:translate-y-0 data-closed:sm:scale-95">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mx-auto flex size-12 shrink-0 items-center justify-center rounded-full bg-yellow-100 sm:mx-0 sm:size-10">
              <svg xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="1.5"
                  class="size-6 text-yellow-500"
                  aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M11.25 11.25h1.5v4.5h1.5m-2.25-7.5h.008v.008h-.008V8.25Z" />
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75
                        0 5.385 4.365 9.75 9.75 9.75
                        5.385 0 9.75-4.365 9.75-9.75
                        0-5.385-4.365-9.75-9.75-9.75Z" /></svg>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 id="dialog-title" class="text-base font-semibold text-gray-900">Cari Vendor</h3>
              
              <div class="search-box">
                  <form method="GET" action="{{ url('/purchasinglogistik') }}">
                      <input type="text" name="nama_vendor" placeholder="Cari Nama Vendor" minlength="2" required>
                      <input type="hidden" name="no_po" value="{{ $poheader->PONumber ?? '' }}">
                      <!--<input type="text" name="no_ro" placeholder="Masukan Nomor RO" value="{-{ request('no_ro') }}">-->
                      <button type="submit">Search</button>
                  </form>
              </div>

              <div class="mt-2">
                <div class="table-wrapper">
                    @if ($vendor)
                    <table>
                        <thead>
                            <tr>
                                <th>ID Vendor</th>
                                <th>Nama Vendor</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                                @forelse($vendor as $row)
                                    <tr>
                                        <td>{{ $row->IDVendor }}</td>
                                        <td>{{ $row->VendorName }}</td>
                                        <td>
                                        <form action="{{ route('purchasinglogistik.updateVendor', $poheader->PONumber) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" name="no_po" value="{{ $poheader->PONumber ?? '' }}">
                                            <input type="hidden" name="idvendor" value="{{ $row->IDVendor ?? '' }}">
                                            <input type="hidden" name="nm_vendor" value="{{ $row->VendorName ?? '' }}">
                                            <button type="submit" command="close" commandfor="dialog" class="btn-action">Ganti</button>
                                        </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" style="text-align:center;">Tidak ada data</td>
                                    </tr>
                                @endforelse
                        </tbody>
                    </table>
                    @else
                    <p class="text-sm text-gray-500">Cari Vendor.</p>
                    @endif
                </div>
              </div>

            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:flex sm:flex-row-reverse sm:px-6">
          <button type="button" command="close" commandfor="dialog" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-red-500 sm:ml-3 sm:w-auto">Close</button>
          <!--<button type="button" command="close" commandfor="dialog" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>-->
        </div>
      </el-dialog-panel>
    </div>
  </dialog>
</el-dialog>
@if ($openModal)
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dialog = document.getElementById('dialog');
        if (dialog && !dialog.open) {
            dialog.showModal();
        }
    });
</script>
@endif
@endsection

