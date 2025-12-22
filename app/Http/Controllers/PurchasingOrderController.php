<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PO_HEADER;
use App\Models\PO_DETAIL;
use App\Models\RO_HEADER;
use App\Models\Vendor;
use App\Models\PO_LOG_STATUS;

class PurchasingOrderController extends Controller
{
    //
    public function index(Request $request)
    {
        //dd($request);
        $NoPO    = $request->input('no_po');
        $NoRO = $request->input('no_ro');
        $nm_vendor = $request->input('nama_vendor');

        $podetail = null;
        $poheader = null;
        $ROlist = null;
        $vendor = null;
        $openModal = false;
        if ($NoPO) {
            $poheader = PO_HEADER::select('PONumber','OrderStatusID','IDVendor','Vendor')
                ->where('PONumber', $NoPO)
                ->first();
            $ROlist = RO_HEADER::select('RONumber')
                ->where('PO_Number',$NoPO)
                ->get();
            if($NoRO){
                $podetail = PO_LOG_STATUS::select
                ('PO_LOG_STATUS.IDPODetail',
                'PO_LOG_STATUS.PONumber',
                'PO_LOG_STATUS.RONumber',
                'b.ItemName',
                'b.Quantity as QuantityPO',
                'b.Qty_Received as ReceiveinPODetail',
                'b.IsReceived',
                'b.OrderStatusID',
                'c.QtyReceived as ReceiveinRO'
                )
                    ->join('PO_DETAIL as b','PO_LOG_STATUS.IDPODetail','=','b.IDPODetail')
                    ->join('RO_DETAIL as c','PO_LOG_STATUS.IDRODetail','=','c.IDRODetail')
                    ->where('PO_LOG_STATUS.RONumber',$NoRO)
                    ->get();
                    //dd($podetail);
            }
        }
        if($nm_vendor){
            $openModal = true;
            $vendor = Vendor::select('IDVendor','VendorName')
                    ->where('VendorName', 'like', "%{$nm_vendor}%")
                    ->paginate(3);
            session()->flash('showModal', true);
            return view('purchasinglogistik', compact('poheader','ROlist','podetail','NoRO','vendor','openModal'));
        }
        
        return view('purchasinglogistik', compact('poheader','ROlist','podetail','NoRO','vendor','openModal'));
    }
    public function updateHeader(Request $request)
    {
        //dd($request);
        if($request->no_po == null){
        return redirect()->back()->with('error', 'Data tidak ditemukan! Silahkan cek kembali!');    
        }
        PO_HEADER::where('PONumber',$request->no_po)
            ->update(['OrderStatusID' => $request->status]);
        return redirect()->back();
    }
    public function updateDetail(Request $request)
    {
        //dd($request);
        if($request->idpodetail == null){
        return redirect()->back()->with('error', 'Data tidak ditemukan! Silahkan cek kembali!');    
        }
        PO_DETAIL::where('IDPODetail',$request->idpodetail)
            ->update([
                'OrderStatusID' => $request->status,
                'IsReceived' => $request->isreceived,
                'Qty_Received' => $request->qty_received
            ]);
        return redirect()->back()->with('success', 'Data berhasil diupdate! Silahkan cek kembali!');
    }

    public function updateVendor(Request $request)
    {
        //dd($request);
        if($request->no_po == null){
        return redirect()->back()->with('error', 'Data tidak ditemukan! Silahkan cek kembali!');    
        }
        PO_HEADER::where('PONumber',$request->no_po)
            ->update([
                'IDVendor' => $request->idvendor,
                'Vendor' => $request->nm_vendor]);
                
        return redirect()->back()->with(['showModal' => false]);
    }
}
