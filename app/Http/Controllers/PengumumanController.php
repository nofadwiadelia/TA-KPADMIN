<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Pengumuman;
use App\Periode;
use File;
use DB;
use Image;

class PengumumanController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $periode = DB::table('periode')->where('isDeleted', 0)->get();
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Pengumuman::select('id_pengumuman','judul', 'deskripsi', 'lampiran')
                ->where('isDeleted', 0)
                ->where('id_periode', $request->id_periode)
                ->get();
            }else{
                $data = Pengumuman::select('id_pengumuman','judul', 'deskripsi', 'lampiran')
                                    ->where('isDeleted', 0)
                                    ->get();
            }
            return datatables()->of($data)
            ->addColumn('lampiran', function($pengumuman){
                $lamp = '<a href="javascript:void(0)"  id="'.$pengumuman->id_pengumuman.'" class="btn btn-warning btn-sm showlamp"><i class="fas fa-eye"></i></a>';
                return $lamp;
            })
            ->addColumn('action', function($pengumuman){

                $btn = '<a href="/admin/pengumuman/'.$pengumuman->id_pengumuman.'/edit" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>';
                $btn .= '&nbsp;&nbsp;';
                $btn .= '<button type="button" name="delete" id="'.$pengumuman->id_pengumuman.'" class="btn btn-danger btn-sm deletePengumuman" ><i class="fas fa-trash"></i></button>';
                return $btn;
            })
            ->addIndexColumn()
            ->rawColumns(['lampiran','action'])
            ->make(true);
        }   
        return view('admin.pengumuman.indexpengumuman', compact('periode'));
    }

    public function detaillampiran($id_pengumuman)
    {
        $pengumuman = Pengumuman::find($id_pengumuman);
        return response()->json($pengumuman);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = Auth::id();
        $periode = Periode::where('status', 'open')->first();
        return view('admin.pengumuman.add_pengumuman',compact('periode', 'userId'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:500',
            'lampiran' => 'nullable|mimes:jpg,png,jpeg,pdf',
            'id_periode' => 'required',
        ],
        [
            'judul.required' => 'judul tidak boleh kosong !',
            'deskripsi.required' => 'deskripsi tidak boleh kosong !',
            'lampiran.mimes' => 'format file tidak sesuai !'
        ]);

        $lampiran = null;
        if($request->hasFile('lampiran')){
            $files=$request->file('lampiran');
            $lampiran=str_slug($request->judul) . time() . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/pengumuman'),$lampiran);
        }

        $data = Pengumuman::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lampiran' => $lampiran,
            'id_periode' => $request->id_periode,
            'created_by' => $request->created_by
        ]);
        return response()->json(['message' => 'Pengumuman berhasil ditambahkan.']);
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $id_pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit($id_pengumuman)
    {
        $data = Pengumuman::findOrFail($id_pengumuman);
        return view('admin.pengumuman.edit_pengumuman', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_pengumuman)
    {
        $this->validate($request, [
            'judul' => 'required|string|max:100',
            'deskripsi' => 'required|string|max:500',
            'lampiran' => 'nullable|mimes:jpg,png,jpeg,pdf',
        ],
        [
            'judul.required' => 'judul tidak boleh kosong !',
            'deskripsi.required' => 'deskripsi tidak boleh kosong !',
            'lampiran.mimes' => 'format file tidak sesuai !'
        ]);
       
        $data = Pengumuman::findOrFail($id_pengumuman);
        $lampiran = $data->lampiran;

        if ($request->hasFile('lampiran')) {
            !empty($lampiran) ? File::delete(public_path('uploads/pengumuman/' . $lampiran)):null;

            $files=$request->file('lampiran');
            $lampiran=str_slug($request->judul) . time() . '.' . $files->getClientOriginalExtension();
            $files->move(public_path('uploads/pengumuman'),$lampiran);
        }

        $data->update([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'lampiran' => $lampiran
        ]);
        

        return response()->json(['message' => 'Pengumuman berhasil diubah.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_pengumuman)
    {
        $data = Pengumuman::findOrFail($id_pengumuman);
        if (!empty($data->lampiran)) {
            File::delete(public_path('uploads/file/' . $data->lampiran));
        }
        $data->delete();
        return response()->json(['message' => 'Pengumuman berhasil dihapus.']);
    }
}
