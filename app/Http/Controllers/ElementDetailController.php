<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Santosacare\ElementDetail;

class ElementDetailController extends Controller
{
    //
     public function index(Request $request)
    {
        $search = $request->input('search');
        $data = ElementDetail::when($search, function($query, $search) {
            return $query->where('Detail', 'like', "%{$search}%");
        })->paginate(10);

        return view('elementdetail', compact('data'));
    }

    // update data (misalnya aktifkan GetDokter)
    public function update($id)
    {
        $element = ElementDetail::where('ElementDetailKey',$id)->firstOrFail();
        $element->GetDokter = 1;
        $element->save();

        return redirect()->back()->with('success', 'Data berhasil diupdate!');
    }
}
