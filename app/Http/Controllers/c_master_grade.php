<?php

namespace App\Http\Controllers;

use App\grade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class c_master_grade extends Controller
{
    public function index() {
        return view('dashboard.master-data.grade.baru');
    }

    public function list() {
        return view('dashboard.master-data.grade.list');
    }

    public function listData() {
        $data['data'] = grade::all();
        return json_encode($data);
    }

    public function data(Request $request) {
        $idGrade=''; $isDell='';
        if (isset($request['id_grade']) && $request['id_grade']!='' ) {$idGrade = $request['id_grade'];}
        if (isset($request['idDell']) && $request['idDell']!='' ) {$isDell = $request['idDell'];}

        $listData = DB::table('grade');
        if($idGrade!='')
        {
            $listData->where('id_grade',$idGrade);
        }
        if($isDell!='')
        {
            $listData->where('id_grade',$idGrade);
        }
        $data= $listData->get();

        return $data;
    }

    public function edit($id) {
        $data = DB::table('grade')->where('id','=',$id)->first();
        return view('dashboard.master-data.grade.edit')->with('data',$data);
    }

    public function submit(Request $request) {
        $type=''; $level=''; $nominalTnjTransport=''; $intervalBln=''; $nominalTnjJabatan=''; $intervalBulanJabatan='';
        if (isset($request->type) && $request->type!='' ) {$type = $request['type'];}
        if (isset($request->level) && $request->level!='' ) {$level = $request['level'];}
        if (isset($request->nominalTnjTransport) && $request->nominalTnjTransport!='' ) {$nominalTnjTransport = $request->nominalTnjTransport;}
        if (isset($request->intervalBulan) && $request->intervalBulan!='' ) {$intervalBln = $request->intervalBulan;}
        if (isset($request->nominalTnjJabatan) && $request->nominalTnjJabatan!='' ) {$nominalTnjJabatan = $request->nominalTnjJabatan;}
        if (isset($request->intervalBulanJabatan) && $request->intervalBulanJabatan!='' ) {$intervalBulanJabatan = $request->intervalBulanJabatan;}
 
        try {
            DB::beginTransaction();
            if ($type == 'baru') {
                $idGrade = IdGenerator::generate(['table' => 'grade', 'field' => 'id_grade', 'length' => 6, 'prefix' => 'LV-']);
                
                $data = new grade();
                $data->id_grade = $idGrade;
                $data->level = $level; 
                $data->nominal_tnj_transport = $nominalTnjTransport; 
                $data->interval_bln = $intervalBln; 
                $data->nominal_tnj_jabatan = $nominalTnjJabatan; 
                $data->interval_bln_jabatan = $intervalBulanJabatan; 
                $data->isDell = '1'; 
                $data->save();
            } elseif ($type == 'edit') {
                DB::table('grade')
                    ->where('id_grade','=',$request->idGrade)
                    ->update([
                        'level' => $level,
                        'nominal_tnj_transport' => $nominalTnjTransport,
                        'interval_bln' => $intervalBln,
                        'nominal_tnj_jabatan' => $nominalTnjJabatan,
                        'interval_bln_jabatan' => $intervalBulanJabatan
                    ]);
            }
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }
}
