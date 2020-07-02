<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Validation\Validator;
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
    public function index(Request $request)
    {
        $periode = DB::table('periode')->select('id_periode', 'tahun_periode')->get();
        if(request()->ajax()){
            if(!empty($request->id_periode)){
                $data = Pengumuman::select('id_pengumuman','judul', 'deskripsi', 'lampiran')
                ->where('id_periode', $request->id_periode)
                ->get();
            }else{
                $data = Pengumuman::select('id_pengumuman','judul', 'deskripsi', 'lampiran')
                                    ->get();
            }
            return datatables()->of($data)->addIndexColumn()
                ->addColumn('action', function($pengumuman){

                    $btn = '<a href="/admin/pengumuman/'.$pengumuman->id_pengumuman.'/edit" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>';
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<button type="button" name="delete" id="'.$pengumuman->id_pengumuman.'" class="btn btn-danger btn-sm deletePengumuman" ><i class="fas fa-trash"></i></button>';
                    return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
            
        return view('admin.pengumuman.indexpengumuman', compact('periode'));
    }

    public function indexmahasiswa()
    {
        $data = Pengumuman::get();
        return view('mahasiswa.pengumuman',compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode = Periode::where('status', 'open')->first();
        return view('admin.pengumuman.add_pengumuman',compact('periode'));
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
            'lampiran' => 'nullable|image|mimes:jpg,png,jpeg',
            'id_periode' => 'required',
        ],
        [
            'judul.required' => 'judul can not be empty !',
            'deskripsi.required' => 'deskripsi can not be empty !'
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
            'id_periode' => $request->id_periode
        ]);
        return response()->json(['message' => 'Pengumuman added successfully.']);
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
            'lampiran' => 'nullable|image|mimes:jpg,png,jpeg'
        ],
        [
            'judul.required' => 'judul can not be empty !',
            'deskripsi.required' => 'deskripsi can not be empty !'
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
        

        return response()->json(['message' => 'Pengumuman updated successfully.']);
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
        return response()->json(['message' => 'Pengumuman deleted successfully.']);
    }
}
