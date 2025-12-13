@extends('layouts.app')

@section('header', 'ElementDetail')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/table1.css') }}">
    <link rel="stylesheet" href="{{ asset('css/search1.css') }}">
@endpush

@section('content')
@if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 border border-green-300 rounded">
            {{ session('success') }}
        </div>
@endif

<!-- Content -->
 <div>   
    <div class="search-box">
        <form method="GET" action="{{ url('/elementdetail') }}">
            <input type="text" name="search" placeholder="Cari detail data..." value="{{ request('search') }}">
            <button type="submit">Search</button>
        </form>
    </div>
    <div class="table-wrapper">
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Detail</th>
                <!--<th>GetDokter</th>-->
                <th>GetDokter</th>
            </tr>
        </thead>
        <tbody>
            
            @forelse($data as $row)
                <tr>
                    <td>{{ $row->ElementDetailKey }}</td>
                    <td>{{ $row->Detail }}</td>
                    <!--<td>{{ $row->GetDokter }}</td>-->
                    <td>@if($row->GetDokter == 0)
                      <form action="{{ route('elementdetail.update', $row->ElementDetailKey) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn-action">Activate</button>
                      </form>
                            @else
                                <span style="status-active">Active</span>
                            @endif</td>
                </tr>
            @empty
                <tr>
                    <td colspan="2" style="text-align:center;">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
  </div>
<div class="pagination">
    {{ $data->links() }}
</div>
</div>
<!-- End -->
@endsection