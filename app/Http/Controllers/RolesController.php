<?php

namespace App\Http\Controllers;
use App\Role;
use DataTables;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($role){
                    $btn = '<a href="javascript:void(0)"  data-toggle="tooltip" data-id="'.$role->id_roles.'" data-original-title="Edit" class="edit btn btn-sm btn-info editRoles"><i class="fas fa-pencil-alt"></i></a>';
                    
                    $btn .= '&nbsp;&nbsp;';
                    $btn .= '<button type="button" name="delete" data-id="'.$role->id_roles.'" class="btn btn-danger btn-sm deleteRoles" ><i class="fas fa-trash"></i></button>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

            return view('admin.master.role');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

    public function store(Request $request)

    {

        Role::updateOrCreate(['id_roles' => $request->roles_id],
                ['roles' => $request->roles]);        

        return response()->json(['success'=>'Roles saved successfully.']);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_roles)
    {
        $role = Role::find($id_roles);
        return response()->json($role);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_roles)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_roles)
    {
        $role = Role::find($id_roles);
        $role->delete();
        return response()->json(['message' => 'Role deleted successfully.']);
    }
}
