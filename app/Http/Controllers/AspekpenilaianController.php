<?php

namespace App\Http\Controllers;
use App\Aspekpenilaian;
use Illuminate\Http\Request;

class AspekpenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Aspekpenilaian::select('id_aspek_penilaian', 'nama');
            return datatables()->of($data)->addIndexColumn()
                ->addColumn('action', function($aspek){
                    $btn = '<a href="javascript:void(0)"  data-toggle="tooltip" data-id="'.$aspek->id_aspek_penilaian.'" data-original-title="Edit" class="edit btn btn-sm btn-info editAspeknilai"><i class="fas fa-pencil-alt"></i></a>';
                    
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<button type="button" name="delete" data-id="'.$aspek->id_aspek_penilaian.'" class="btn btn-danger btn-sm deleteAspeknilai" ><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

            return view('admin.master.aspeknilai');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Aspekpenilaian::updateOrCreate(['id_aspek_penilaian' => $request->id_aspek_penilaian],
                ['nama' => $request->nama]);        

        return response()->json(['success'=>'Aspek nilai saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_aspek_penilaian)
    {
        $aspek = Aspekpenilaian::find($id_aspek_penilaian);
        return response()->json($aspek);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_aspek_penilaian)
    {
        $aspek = Aspekpenilaian::find($id_aspek_penilaian);
        return response()->json(['success'=>'Aspek nilai updated successfully.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_aspek_penilaian)
    {
        $aspek = Aspekpenilaian::find($id_aspek_penilaian);
        $aspek->delete();
        return response()->json(['message' => 'Aspek nilai deleted successfully.']);
    }
}
