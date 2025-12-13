<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ACT;
use App\Models\OEFarmasi;

class UpdateSEPController extends Controller
{
    //
    public function index(Request $request)
    {
        //dd($request);
        $NoSEP    = $request->input('nosep');
        $NoTransaksi = $request->input('notransaksi');

        
        $act = null;
        if ($NoSEP) {
            $act = ACT::select('NoTrx', 'NoSEP','Person.FullName as Nama','NoMR')
                            ->where('NoSEP', $NoSEP)
                            ->leftJoin('Person', 'Person.RecordKey', '=', 'Act.RecordKey')
                            ->first();
        }

       
        $oefarmasi = null;
        if ($NoTransaksi) {
            $oefarmasi = OEFarmasi::select('NoInvoice','NoTrxRefKunjungan', 'NoSEP','PasienDesc','PasienMR')
                                  ->where('NoInvoice', $NoTransaksi)
                                  ->first();
        }

        return view('updatesep', compact('act', 'oefarmasi'));
    }
    public function update(Request $request)
    {
        //dd($request->oefarmasi_noinvoice);
        if($request->oefarmasi_noinvoice == null){
        return redirect()->back()->with('error', 'Data tidak ditemukan! Silahkan cek kembali!');    
        }
        $oefarm = OEFarmasi::where('NoInvoice',$request->oefarmasi_noinvoice)->firstOrFail();
        $oefarm->NoTrxRefKunjungan = $request->act_notrx;
        $oefarm->NoSEP = $request->act_nosep;
        $oefarm->save();
        return redirect()->back()->with('success', 'Data berhasil diupdate! Silahkan cek kembali data!');
    }
}
