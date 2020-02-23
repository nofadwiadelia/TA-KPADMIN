<?php

namespace App\Http\Controllers;

use App\Pengumuman;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Image;

class PengumumanController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Pengumuman::get();
        return view('admin.pengumuman.indexpengumuman',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Pengumuman::all();
        return view('admin.pengumuman.add_pengumuman',compact('data'));
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
            'detail' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg',
        ]);
        try {
            $photo = null;
            if ($request->hasFile('photo')) {
                $photo = $this->saveFile($request->name, $request->file('photo'));
            }

            $data = Pengumuman::create([
                'judul' => $request->judul,
                'detail' => $request->detail,
                'photo' => $photo
            ]);
            return redirect(route('pengumuman.index'))
                ->with('alert-success','Berhasil Menambahkan Data!');
                // with(['success' => '<strong>' . $data->judul . '</strong> Ditambahkan']);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
    }

    private function saveFile($judul, $photo)
    {
        $images = str_slug($judul) . time() . '.' . $photo->getClientOriginalExtension();
        $path = public_path('uploads/file');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true, true);
        } 
        Image::make($photo)->save($path . '/' . $images);
        return $images;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman)
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
            'detail' => 'nullable|string|max:100',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg'
        ]);

        try {
            $data = Pengumuman::findOrFail($id_pengumuman);
            $photo = $data->photo;

            if ($request->hasFile('photo')) {
                !empty($photo) ? File::delete(public_path('uploads/file/' . $photo)):null;
                $photo = $this->saveFile($request->judul, $request->file('photo'));
            }

            $data->update([
                'judul' => $request->judul,
                'detail' => $request->detail,
                'photo' => $photo
            ]);

            return redirect(route('pengumuman.index'))
            ->with('alert-success','Data berhasil diubah!');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with(['error' => $e->getMessage()]);
        }
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
        if (!empty($data->photo)) {
            File::delete(public_path('uploads/file/' . $data->photo));
        }
        $data->delete();
        return redirect()->back()->with(['success' => '<strong>' . $data->judul . '</strong> Telah Dihapus!']);
    }
}
