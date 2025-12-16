<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SCPOHeader;
use App\Models\SCPODetail;

class FARBatalCancelController extends Controller
{
    //
     public function index(Request $request)
    {
        
        $NoPO    = $request->input('no_po');
        $podetail = null;
        $poheader = null;
        if ($NoPO) {
            $poheader = SCPOHeader::select('IDPOHeader','OrderStatusID','PONumber')
                ->where('PONumber', $NoPO)
                ->first();
            if($poheader == null){
            return redirect()->back()->with('error','Data tidak ditemukan! Silahkan cek kembali!');
            }
            $podetail = SCPODetail::select('IDPODetail','ItemName','Quantity','Qty_Received','Qty_Cancelled','SubTotal_Cancelled','OrderStatusID')
            ->where('POHeader',$poheader->IDPOHeader)
            ->get();
               
            // dd($podetail);
          
        }
        
        
        return view('farbatalcancel', compact('poheader','podetail'));
    }

    public function updateHeader(Request $request)
        {
            //dd($request);
            if($request->no_po == null){
            return redirect()->back()->with('error', 'Data tidak ditemukan! Silahkan cek kembali!');    
            }
            SCPOHeader::where('PONumber',$request->no_po)
                ->update(['OrderStatusID' => $request->status]);
            return redirect()->back();
        }

    public function updateDetail(Request $request)
        {
            //dd($request);
            if($request->idpodetail == null){
            return redirect()->back()->with('error', 'Data tidak ditemukan! Silahkan cek kembali!');    
            }
            SCPODetail::where('IDPODetail',$request->idpodetail)
                ->update([
                    'OrderStatusID' => $request->status,
                    'Qty_Cancelled' => $request->qty_cancel,
                    'SubTotal_Cancelled' => $request->subtotal_cancel
                ]);
            return redirect()->back()->with('success', 'Data berhasil diupdate! Silahkan cek kembali!');
        }
    
}
