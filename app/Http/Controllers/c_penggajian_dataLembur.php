<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Session;
// use PDF;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\penggajian_dataLembur_lemburKaryawan;
use App\Exports\export_penggajianLembur;
use App\Http\Controllers\Controller;

class c_penggajian_dataLembur extends Controller
{
    public function index() {
        return view('dashboard.penggajian.data-lembur.baru');
    }

    public function addLembur() {
        return view('dashboard.penggajian.data-lembur.baru_add');
    }

    public function importLembur() {
        return view('dashboard.penggajian.data-lembur.baru_importExcel');
    }

    public function list() {
        return view('dashboard.penggajian.data-lembur.list');
    }

    public function getKaryawanGajiPeriode(Request $request)
    {
       // get ID Periode
       $c_classPenggajian = new c_classPenggajian;
       $_val = $c_classPenggajian->getPeriodeBerjalan(); 
       if( is_null($_val))
       {
       // nothing
       }
       else
       {
           // get Data Periode
           $periode = $_val;
           $idPeriode=$periode->idPeriode;

           $data = [];
           if (isset($_GET['search'])) {
               $data['results'] = DB::table('gaji_karyawan')
               ->select('gaji_karyawan.id_karyawan as id',DB::raw('concat(users.username," | ",users.name, " --> Dept.",departemen.departemen," | Sub Dept.",departemen_sub.sub_departemen) as text'))
               ->join('users','users.id_absen','gaji_karyawan.id_karyawan')
               ->join('departemen','departemen.id_dept','=','gaji_karyawan.id_departemen')
               ->join('departemen_sub','departemen_sub.id_subDepartemen','=','gaji_karyawan.id_departemen_sub')
                   ->where('gaji_karyawan.id_karyawan', 'like', '%' . $_GET['search'] . '%')
                   ->orWhere('users.name', 'like', '%' . $_GET['search'] . '%')
                   ->where('gaji_karyawan.id_periode',$idPeriode)
                   ->orderBy('users.name','asc')
                   ->get();
           } else {
               $data['results'] = DB::table('gaji_karyawan')
               ->select('gaji_karyawan.id_karyawan as id',DB::raw('concat(users.username," | ",users.name, " --> Dept.",departemen.departemen," | Sub Dept.",departemen_sub.sub_departemen) as text'))
               ->join('users','users.id_absen','gaji_karyawan.id_karyawan')
               ->join('departemen','departemen.id_dept','=','gaji_karyawan.id_departemen')
               ->join('departemen_sub','departemen_sub.id_subDepartemen','=','gaji_karyawan.id_departemen_sub')
               ->where('gaji_karyawan.id_periode',$idPeriode)
               ->orderBy('users.name','asc')
               ->get();
           }
       }
        return $data;
    }

    public function data() {
    // get ID Periode
       $c_classPenggajian = new c_classPenggajian;
       $_val = $c_classPenggajian->getPeriodeBerjalan(); 
       if( is_null($_val))
       {
       // nothing
       }
       else
       {
           // get Data Periode
           $periode = $_val;
           $idPeriode=$periode->idPeriode;

           $data['data'] =  DB::table('gaji_lembur')
           ->select(
           'gaji_lembur.id as id',
           'gaji_lembur.id_periode as idPeriode',
           'departemen.departemen as id_departemen',
           'departemen_sub.sub_departemen as subDepartemen',
           'users.pos as pos',
           'grade.level as grade',
           'gaji_lembur.id_karyawan as id_absen',
           'users.username as username',
           'users.name as name',
           'users.tipe_kontrak as tieKontrak',
           'gaji_lembur.updated_at as updatedAt',
           'gaji_lembur.tgl as tanggal',
           'gaji_lembur.jam_lembur as jamLembur',
            DB::raw('(FORMAT((gaji_lembur.total_upah),2)) as totalUpah'),
            'gaji_lembur.total_jam as totalJam',
            DB::raw('(FORMAT((gaji_lembur.nominal),2)) as nominal'),
            'gaji_lembur.keterangan as keterangan',
            'gaji_lembur.pic as pic')
            ->join('users','users.id_absen','=','gaji_lembur.id_karyawan')
            ->join('departemen','departemen.id_dept','=','gaji_lembur.id_dept')
            ->join('departemen_sub','departemen_sub.id_subDepartemen','=','gaji_lembur.id_sub_dept')
            ->join('grade','grade.id_grade','users.grade')
            ->where('gaji_lembur.id_periode',$idPeriode)
            ->orderBy('gaji_lembur.tgl','asc')
            ->get();
   
            $data['total'] = DB::table('gaji_lembur')
            ->select(
               DB::raw("(FORMAT(SUM(gaji_lembur.nominal),2)) as nominal")
            )
            ->where('gaji_lembur.id_periode',$idPeriode)
            ->first();
       
        }
        return json_encode($data);
    }

    public function listData() {
       // get ID Periode
       $c_classPenggajian = new c_classPenggajian;
       $_val = $c_classPenggajian->getPeriodeBerjalan(); 
       if( is_null($_val))
       {
       // nothing
       }
       else
       {
           // get Data Periode
           $periode = $_val;
           $idPeriode=$periode->idPeriode;
       
           $data['data'] =  DB::table('gaji_lembur')
            ->select(
            'gaji_lembur.id as id',
            'gaji_lembur.id_periode as idPeriode',
            'departemen.departemen as id_departemen',
            'departemen_sub.sub_departemen as subDepartemen',
            'users.pos as pos',
            'users.grade as grade',
            'gaji_lembur.id_karyawan as id_absen',
            'users.username as username',
            'users.name as name',
            'users.tipe_kontrak as tieKontrak',
            'gaji_lembur.updated_at as updatedAt',
            DB::raw('(sum(gaji_lembur.jam_lembur)) as jamLembur'),
            DB::raw('(FORMAT(gaji_lembur.total_upah,2)) as totalUpah'),
            DB::raw('(sum(gaji_lembur.total_jam)) as totalJam'),
            DB::raw('(FORMAT(sum(gaji_lembur.nominal),2)) as nominal'),
            'gaji_lembur.pic as pic')
            ->join('users','users.id_absen','=','gaji_lembur.id_karyawan')
            ->join('departemen','departemen.id_dept','=','gaji_lembur.id_dept')
            ->join('departemen_sub','departemen_sub.id_subDepartemen','=','gaji_lembur.id_sub_dept')
            ->where('gaji_lembur.id_periode',$idPeriode)
            ->orderBy('gaji_lembur.id_karyawan','asc')
            ->groupBy('gaji_lembur.id_karyawan')
            ->get();

         $data['total'] = DB::table('gaji_lembur')
         ->select(
            DB::raw("(FORMAT(SUM(gaji_lembur.nominal),2)) as nominal")
         )
         ->where('gaji_lembur.id_periode',$idPeriode)
         ->first();
        }
        
        return json_encode($data);
    }

    public function dataEdit(Request $request) 
    {
        $idLembur = $request->id;
        $data =  DB::table('gaji_lembur')
        ->select(
           'gaji_lembur.id as id',
           'gaji_lembur.id_periode as idPeriode',
           'departemen.departemen as id_departemen',
           'departemen_sub.sub_departemen as subDepartemen',
           'users.pos as pos',
           'grade.level as grade',
           'gaji_lembur.id_karyawan as id_absen',
           'users.username as username',
           'users.name as name',
           'users.tipe_kontrak as tieKontrak',
           'gaji_lembur.updated_at as updatedAt',
           'gaji_lembur.tgl as tanggal',
           'gaji_lembur.jam_lembur as jamLembur',
            DB::raw('(FORMAT((gaji_lembur.total_upah),2)) as totalUpah'),
            'gaji_lembur.total_jam as totalJam',
            DB::raw('(FORMAT((gaji_lembur.nominal),2)) as nominal'),
            'gaji_lembur.keterangan as keterangan',
            'gaji_lembur.pic as pic')
            ->join('users','users.id_absen','=','gaji_lembur.id_karyawan')
            ->join('departemen','departemen.id_dept','=','gaji_lembur.id_dept')
            ->join('departemen_sub','departemen_sub.id_subDepartemen','=','gaji_lembur.id_sub_dept')
            ->join('grade','grade.id_grade','users.grade')
            ->where('gaji_lembur.id',$idLembur)
            ->orderBy('gaji_lembur.tgl','asc')
            ->first();
        return $data;
    }

    public function submit(Request $request) 
    {
        $userLogin = request()->session()->get('username');
        $type = $request->type;
        try {
            DB::beginTransaction(); 
            if ($type == 'baru') {
                $_idKaryawan = $request->idKaryawan;
                $_tglLembur = date('Y-m-d',strtotime($request->tglLembur));
                $_jamLembur = $request->jamLembur;
                $_keterangan = $request->keterangan;
                // get ID Periode
                $c_classPenggajian = new c_classPenggajian;
                $_val = $c_classPenggajian->getPeriodeBerjalan(); 
                if( is_null($_val))
                {
                // nothing
                }
                else
                {
                    // get Data Periode
                    $periode = $_val;
                    $idPeriode=$periode->idPeriode;

                    // Hitung Lembur Karyawan
                    $c_classPenggajian = new c_classPenggajian;
                    $_val = $c_classPenggajian->tambahLembur($idPeriode,$_idKaryawan,$_tglLembur,$_jamLembur, $_keterangan);

                    // insert history
                    $_keterangan = 'Tambah Lembur ID Periode : ' . $idPeriode . ' ID Karyawan : '. $_idKaryawan . ' Tanggal : '. $_tglLembur. ' Jam Lembur : '. $_jamLembur. ' Keterangan : '. $_keterangan;
            
                    $_requestValue['tipe'] = 0;
                    $_requestValue['menu'] ='Penggajian';
                    $_requestValue['module'] = 'Data Lembur';
                    $_requestValue['keterangan'] = $_keterangan;
                    $_requestValue['pic'] = $userLogin;

                    $c_class = new c_classHistory;
                    $c_class = $c_class->insertHistory($_requestValue);
                }
            } elseif ($type == 'edit') {
                $idLembur = $request->idLembur;
                $jamLembur = $request->jamLembur;
                $nominal = $request->nominal;
                $note = $request->note;
                
                $dataID = DB::table('gaji_lembur')
                ->where('id',$idLembur)
                ->first();

                if($nominal=='0' || $nominal==0)
                {
                    // hitung sistem 
                    $_idKaryawan = $dataID->id_karyawan;
                    $idPeriode = $dataID->id_periode;
                    // get rumus (Total Upah) code GS-001
                    $_totalUpah=0;
                    $c_classRumus = new c_classRumus;
                    $_totalUpah = $c_classRumus->getRumus('GS-001',$_idKaryawan); 
            
                    $_nominalLembur=$nominal;
                    $_btsNominalLembur=0;
                    $_btsNominalLembur = DB::table('utility_variable')
                    ->select('nominal')
                    ->where('id_variable','UV-002')
                    ->first();
                    $_batasNominalLembur = $_btsNominalLembur->nominal;
                    // cek apakah mempunyai tunjangan jabatan VR-002
                    $_tunjanganJabatan = 0;
                    $karyawanSubVariableGaji = DB::table('gaji_karyawan_sub_variable')
                    ->select(
                    'gaji_karyawan_sub_variable.id_variable',
                    'gaji_karyawan_sub_variable.nominal')
                    ->where('gaji_karyawan_sub_variable.id_variable','VR-002')
                    ->where('gaji_karyawan_sub_variable.id_karyawan',$_idKaryawan)
                    ->where('gaji_karyawan_sub_variable.id_periode',$idPeriode)
                    ->first();
                    $_tunjanganJabatan = $karyawanSubVariableGaji->nominal;
                    if($_totalUpah <= $_batasNominalLembur && $_tunjanganJabatan == 0)
                    {
                        // get rumus (Nominal Lembur) code LM-001
                        $_nominal=0;
                        $c_classRumus = new c_classRumus;
                        $_nominal = $c_classRumus->getRumus('LM-001',$_idKaryawan); 
                        $_nominalLembur = $_nominal*$jamLembur;
                    }
                    else
                    {
                        $_nominalLembur=0;
                    }

                    DB::table('gaji_lembur')
                    ->where('id',$idLembur)
                    ->update([
                        'total_jam' => $jamLembur,
                        'nominal' => $_nominalLembur,
                        'keterangan' => $note,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'pic' => $userLogin
                    ]);
                }
                else
                {
                    DB::table('gaji_lembur')
                    ->where('id',$idLembur)
                    ->update([
                        'total_jam' => $jamLembur,
                        'nominal' => $nominal,
                        'keterangan' => $note,
                        'updated_at' => date('Y-m-d H:i:s'),
                        'pic' => $userLogin
                    ]);
                }

                // Hitung Lembur Karyawan 
                $c_classPenggajian = new c_classPenggajian;
                $result = $c_classPenggajian->updateDataLemburKaryawanPeriode($dataID->id_periode,$dataID->id_karyawan,$jamLembur,$nominal,$note);
                
                // insert history
                $_keterangan = 'Update Lembur ID Periode : ' . $dataID->id_periode . ' ID Karyawan : '. $dataID->id_karyawan . ' Jam Lembur : '. $jamLembur. 'Nominal : '. $nominal.' Keterangan : '. $note;
            
                $_requestValue['tipe'] = 0;
                $_requestValue['menu'] ='Penggajian';
                $_requestValue['module'] = 'Data Lembur';
                $_requestValue['keterangan'] = $_keterangan;
                $_requestValue['pic'] = $userLogin;

                $c_class = new c_classHistory;
                $c_class = $c_class->insertHistory($_requestValue);
                
            }
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
                DB::rollBack();
                return response()->json($ex);
        }
    }

    public function imporDataLembur(Request $request) 
    {
            $username = request()->session()->get('username');
            try{
                // get ID Periode
                $c_classPenggajian = new c_classPenggajian;
                $_val = $c_classPenggajian->getPeriodeBerjalan(); 
                if( is_null($_val))
                {
                // nothing
                }
                else
                {
                     // get Data Periode
                     $periode = $_val;
                     $idPeriode=$periode->idPeriode;

                    // validasi
                    $this->validate($request, [
                        'file' => 'required|mimes:csv,xls,xlsx'
                    ]);
                
                    // menangkap file excel
                    $file = $request->file('file');
                
                    // membuat nama file unik
                    $nama_file = rand().$file->getClientOriginalName();

                    Excel::import(new penggajian_dataLembur_lemburKaryawan($idPeriode),$file);
                }
            
            return redirect('dashboard/penggajian/data-lembur');
            } catch (\Exception $ex) {
                return response()->json([$ex]);
            }
    }

    public function actionData (Request $request)
    {
            $userLogin = request()->session()->get('username');
            $typeActionData = $request->typeActionData;
            $idData = $request->idData;
            try {
                DB::beginTransaction();  

                        if($typeActionData=='removeCheckBox')
                        {
                            $_kar='-';
                            foreach($idData as $v)
                            {
                                $dataKaryawan = DB::table('gaji_lembur')
                                ->where('id',$v)
                                ->first();
                        
                                $c_classPenggajian = new c_classPenggajian;
                                $c_classPenggajian = $c_classPenggajian->deleteLembur($dataKaryawan->id_periode,$dataKaryawan->id_karyawan,$v);
                        
                                $_kar = 'ID Karyawan : '. $dataKaryawan->id_karyawan.' Tanggal : '. $dataKaryawan->tgl.' Jam Lembur : '.$dataKaryawan->jam_lembur.'-'. $_kar;
                            }
                            
                            $_keterangan = 'Action-Remove CheckBox Data Lembur | Data : '.$_kar;
                        }
                        // insert history
                        $_requestValue['tipe'] = 0;
                        $_requestValue['menu'] ='Penggajian';
                        $_requestValue['module'] = 'Upah Karyawan';
                        $_requestValue['keterangan'] = $_keterangan;
                        $_requestValue['pic'] = $userLogin;
    
                        $c_class = new c_classHistory;
                        $c_class = $c_class->insertHistory($_requestValue);
                      
                        DB::commit();
        
                return 'success';
            } catch (\Exception $ex) {
                dd($ex);
                return response()->json($ex);
            }
    }

    public function actionSyncronise()
    {
            try
            {
                DB::beginTransaction();
                // get ID Periode
                $c_classPenggajian = new c_classPenggajian;
                $_val = $c_classPenggajian->getPeriodeBerjalan(); 
                if( is_null($_val))
                {
                    // nothing

                }
                else
                {
                    // get Data Periode
                    $periode = $_val;
                    $idPeriode = $periode->idPeriode;
              
                    $tglAwal = $periode->tgl_awal;
                    $tglAkhir = $periode->tgl_akhir;
                  
                    $c_calass = new c_classApi;
                    $_val = $c_calass->getUrlApi(); 
                    $_url= 'https://servicelokaryawan.salokapark.app/api/get_request_overtime_karyawan?tanggal_awal='.$tglAwal.'&tanggal_akhir='.$tglAkhir.'&status=1';
                    // $_url= 'http://192.168.0.75:8092/api/get_request_overtime_karyawan?tanggal_awal='.$tglAwal.'&tanggal_akhir='.$tglAkhir;
                    $response = Http::get($_url);
                    $jsonData = $response->json();
           
                    $totalKaryawan=0;
                    foreach($jsonData['data'] as $x => $node)
                    {
                        $jamLembur=0;
                        $idOvertime = $node['id_overtime'];
                        $nik = $node['nik'];
                        $idKaryawan = $node['id_karyawan'];
                        $tglLembur = $node['tgl_lembur'];
                        $jamLembur = $node['jam_lembur'];
                        $keterangan = $node['keterangan'];
                        // Hitung Lembur Karyawan
                        $idPeriode_=0;
                        $idPeriode_ = $idPeriode -1;
                        $c_classPenggajian = new c_classPenggajian;
                        $_val = $c_classPenggajian->tambahLembur($idPeriode_,$idKaryawan,$tglLembur,$jamLembur, $keterangan); 
                    }

                     // insert history
                     $_keterangan = 'Tambah Lembur-Syncrinse From LOKARYAWAN ID Periode : ' . $idPeriode .' Periode : '. $periode->periode.' Tanggal Awal : '. $tglAwal. ' Tanggal Akhir : '. $tglAkhir;
            
                     $_requestValue['tipe'] = 0;
                     $_requestValue['menu'] ='Penggajian';
                     $_requestValue['module'] = 'Data Lembur';
                     $_requestValue['keterangan'] = $_keterangan;
                     $_requestValue['pic'] = 'system';
                    
                     $c_class = new c_classHistory;
                     $c_class = $c_class->insertHistory($_requestValue);
                    
                     DB::commit();
                    return 'success';
                }   
            } catch (\Exception $ex) {
                return response()->json($ex);
            }
    }

    public function actionExport($_typeActionData,$_idData) 
    {
            $userLogin = request()->session()->get('username');
            try {
                DB::beginTransaction();  
                // get ID Periode
                $c_classPenggajian = new c_classPenggajian;
                $_val = $c_classPenggajian->getPeriodeBerjalan(); 
                if( is_null($_val))
                {
                // nothing
                }
                else
                {
                    // get Data Periode
                    $periode = $_val;
                    $idPeriode = $periode->idPeriode;
                }
                return Excel::download(new export_penggajianLembur($idPeriode,$_typeActionData,$_idData), 'Penggajian-Lembur-'.$_typeActionData.'-'.$periode->periode.'.xlsx');
                DB::commit();
                return 'success';
            } catch (\Exception $ex) {
                DB::rollBack();
                return json_encode([$ex]);
            }
    }

    public function submitModule(Request $request)
    {
            $userLogin = request()->session()->get('username');
            $idModule = $request->idModule;
    
            try {
    
                 // get ID Periode
                 $c_classPenggajian = new c_classPenggajian;
                 $_val = $c_classPenggajian->getPeriodeBerjalan(); 
                 if( is_null($_val))
                 {
                 // nothing
                 }
                 else
                 {
                     // get Data Periode
                     $periode = $_val;
                     $idPeriode = $periode->idPeriode;
                 }
                $c_classPeriode = new c_classPeriode;
                $c_classPeriode = $c_classPeriode->updateStatusPeriode($idPeriode,$idModule,$userLogin);
                $_keterangan = 'Submit Module Lembur karyawan ID Periode : ' . $periode->idPeriode . ' ('.$periode->periode.')';

                $c_classPenggajian = new c_penggajian_paycheck;
                $c_classPenggajian = $c_classPenggajian->hitungThp();
           
                 // insert history        
                 $_requestValue['tipe'] = 0;
                 $_requestValue['menu'] ='Penggajian';
                 $_requestValue['module'] = 'Upah Karyawan';
                 $_requestValue['keterangan'] = $_keterangan;
                 $_requestValue['pic'] = $userLogin;
    
                 $c_class = new c_classHistory;
                 $c_class = $c_class->insertHistory($_requestValue);
                 return 'success';
               } catch (\Exception $ex) {
                   return response()->json($ex);
               }
    }
}