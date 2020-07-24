<?php

namespace App\Http\Controllers;
use App\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Ruang::get();
            return datatables()->of($data)->addIndexColumn()
                ->addColumn('action', function($ruang){
                    $btn = '<a href="javascript:void(0)"  data-toggle="tooltip" data-id="'.$ruang->id_ruang.'" data-original-title="Edit" class="edit btn btn-sm btn-info editRuang"><i class="fas fa-pencil-alt"></i></a>';
                    
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<button type="button" name="delete" data-id="'.$ruang->id_ruang.'" class="btn btn-danger btn-sm deleteRuang" ><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

            return view('admin.master.ruang');
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
        $this->validate($request, [
            'ruang' => 'required|unique:ruang,ruang'
        ],
        [
            'ruang.required' => 'ruang can not be empty !',
            'ruang.unique' => 'ruang already exist !'
        ]);

        Ruang::updateOrCreate(['id_ruang' => $request->id_ruang],
                ['ruang' => $request->ruang]);        

        return response()->json(['success'=>'Ruang saved successfully.']);

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
    public function edit($id_ruang)
    {
        $ruang = Ruang::find($id_ruang);
        return response()->json($ruang);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_ruang)
    {
        $ruang = Ruang::find($id_ruang);
        $ruang->delete();
        return response()->json(['message' => 'Ruang deleted successfully.']);
    }
}
