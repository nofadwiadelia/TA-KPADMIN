<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Sesiwaktu;
class SesiwaktuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Sesiwaktu::get();
            return datatables()->of($data)->addIndexColumn()
                ->addColumn('action', function($sesi){
                    $btn = '<a href="javascript:void(0)"  data-toggle="tooltip" data-id="'.$sesi->id_sesiwaktu.'" data-original-title="Edit" class="edit btn btn-sm btn-info editSesi"><i class="fas fa-pencil-alt"></i></a>';
                    
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<button type="button" name="delete" data-id="'.$sesi->id_sesiwaktu.'" class="btn btn-danger btn-sm deleteSesi" ><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

            return view('admin.master.sesiwaktu');
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
        Sesiwaktu::updateOrCreate(['id_sesiwaktu' => $request->id_sesiwaktu],
                ['sesi' => $request->sesi]);        

        return response()->json(['success'=>'Sesi saved successfully.']);

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
    public function edit($id_sesiwaktu)
    {
        $sesi = Sesiwaktu::find($id_sesiwaktu);
        return response()->json($sesi);
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
    public function destroy($id_sesiwaktu)
    {
        $sesi = Sesiwaktu::find($id_sesiwaktu);
        $sesi->delete();
        return response()->json(['message' => 'Sesi deleted successfully.']);
    }
}
