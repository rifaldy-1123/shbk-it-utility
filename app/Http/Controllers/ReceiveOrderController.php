<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistic2017\INLogger;
use App\Models\Logistic2017\RO_HEADER;
use App\Models\Logistic2017\RO_DETAIL;
use App\Models\Logistic2017\PO_LOG_STATUS;

class ReceiveOrderController extends Controller
{
    public function index(Request $request)
    {
        //dd($request);
        $NoPO    = $request->input('no_po');
        $NoRO = $request->input('no_ro');
        $ScBy = $request->input('sc_by');

        $rodetail = null;
        $roheader = null;
        if ($NoRO) {
            $rodetail = RO_DETAIL::select('RONumber','Quantity','ItemName','Keterangan','GCRecord')
                                  ->where('RONumber', $NoRO)
                                  ->get();
        return view('rologistik', compact('rodetail','NoPO','roheader','ScBy'));
        }

        
        if ($NoPO) {
            if($ScBy == 1){
                $roheader = RO_HEADER::select('RONumber','PO_Number','GCRecord','Vendor')
                ->where('PO_Number', $NoPO)
                ->get();
            }
            else{
                $roheader = RO_HEADER::select('RONumber','PO_Number','GCRecord','Vendor')
                ->where('RONumber', $NoPO)
                ->get();
            }
            return view('rologistik', compact('roheader','rodetail','ScBy','NoPO'));
        }
        return view('rologistik', compact('roheader','rodetail','ScBy','NoPO'));
    }

    public function roShow(Request $request)
    {
        //dd($request);
        if($request->no_ro == null){
        return redirect()->back()->with('error', 'Data tidak ditemukan! Silahkan cek kembali!');    
        }
        $gcRO = ($request->ro_gc == 0)?1:0;
        RO_HEADER::where('RONumber',$request->no_ro)
                            ->update(['GCRecord' => $gcRO]);

        RO_DETAIL::where('RONumber',$request->no_ro)
                            ->update(['GCRecord' => $gcRO]);

        INLogger::where('NoDokumen',$request->no_ro)
                            ->update(['GCRecord' => $gcRO]);
        PO_LOG_STATUS::where('RONumber',$request->no_ro)
                            ->update(['GCRecord' => $gcRO]);
        return redirect()->back();
    }
}
