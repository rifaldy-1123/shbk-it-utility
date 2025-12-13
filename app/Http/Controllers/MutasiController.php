<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\INMutasi;
use App\Models\INMutasiD;
use App\Models\INLogger;

class MutasiController extends Controller
{
    // Controller Mutasi
    public function index(Request $request)
    {
        $NoMutasi    = $request->input('no_mutasi');
        //$NoPO = $request->input('no_po');
        

        $mutasi = null;
        if ($NoMutasi) {
            $mutasi = INMutasi::select('NoInvoice', 'GCRecord')
                            ->where('NoInvoice', $NoMutasi)
                            ->first();
        }
        //dd($mutasi);
        $mutasiD = null;
        if ($NoMutasi) {
            $mutasiD = INMutasiD::select('NoInvoice','GCRecord','NoUrut','ItemDesc','Qty')
                                  ->where('NoInvoice', $NoMutasi)
                                  ->get();
        }
        return view('mutasilogistik', compact('mutasi', 'mutasiD'));
    }
    public function mutasiShow(Request $request)
    {
        if($request->mutasi_noinvoice == null){
        return redirect()->back()->with('error', 'Data tidak ditemukan! Silahkan cek kembali!');    
        }
        $gcMutasi = ($request->mutasi_gc == 0)?1:0;
        $mutasi = INMutasi::where('NoInvoice',$request->mutasi_noinvoice)->firstOrFail();
        $mutasi->GCRecord = $gcMutasi;
        $mutasi->save();
        
        return redirect()->back();
    }
    public function mutasiDShow(Request $request)
    {
        //dd($request);
        if($request->mutasid_noinvoice == null){
        return redirect()->back()->with('error', 'Data tidak ditemukan! Silahkan cek kembali!');    
        }
        $gcMutasid = ($request->mutasid_gc == 0)?1:0;
        //$mutasid = 
        INMutasiD::where('NoInvoice',$request->mutasid_noinvoice)
                            //->where('NoUrut',$request->mutasid_nourut)
                            ->update(['GCRecord' => $gcMutasid]);

        INLogger::where('NoDokumen',$request->mutasid_noinvoice)
                            //->where('NoUrut',$request->mutasid_nourut)
                            ->update(['GCRecord' => $gcMutasid]);
        //dd($mutasi);
        //$mutasid->GCRecord = $gcMutasid;
        //$mutasid->save();
        
        return redirect()->back();
    }
}
