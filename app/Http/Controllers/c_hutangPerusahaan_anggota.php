<?php

namespace App\Http\Controllers;

use App\karyawan_group;

use App\karyawan_hutang_perusahaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use DateTime;
use Session;

class c_hutangPerusahaan_anggota extends Controller
{
    // public function index() {
    //     return view('dashboard.master-data.grade.baru');
    // }

    // public function list() {
    //     return view('dashboard.master-data.grade.list');
    // }

    public function listData() {
        $data['data'] = karyawan_hutang_perusahaan::all();
        return json_encode($data);
    }

    public function data(Request $request) {
        $idHutang=''; $idKaryawan=''; $tenor=''; $total=''; $totalAngsuran=''; $status=''; $reff=''; $years='';
        if (isset($request['id_hutang']) && $request['id_hutang']!='' ) {$idHutang = $request['id_hutang'];}
        if (isset($request['id_karyawan']) && $request['id_karyawan']!='' ) {$idKaryawan = $request['id_karyawan'];}
        if (isset($request['tenor']) && $request['tenor']!='' ) {$tenor = $request['tenor'];}
        if (isset($request['total']) && $request['total']!='' ) {$total = $request['total'];}
        if (isset($request['total_angsuran']) && $request['total_angsuran']!='' ) {$totalAngsuran = $request['total_angsuran'];}
        if (isset($request['status']) && $request['status']!='' ) {$status = $request['status'];}
        if (isset($request['reff']) && $request['reff']!='' ) {$reff = $request['reff'];}
        if (isset($request['years']) && $request['years']!='' ) {$years = $request['years'];}

        $listData = DB::table('karyawan_hutang_perusahaan');
        if($idHutang!='')
        {
            $listData->where('id_hutang',$idHutang);
        }
        if($idKaryawan!='')
        {
            $listData->where('id_grade',$idKaryawan);
        }
        if($tenor!='')
        {
            $listData->where('tenor',$tenor);
        }
        if($status!='')
        {
            $listData->where('status',$status);
        }
        $data= $listData->get();

        return $data;
    }

    public function submit(Request $request) {
        $userLogin = request()->session()->get('username');
        try {
            $type = $request->type;
            DB::beginTransaction();
            if ($type == 'baru') {
             
                $idKaryawan = $request->idKaryawan;
                $nominal = $request->nominal;
                $tenor = $request->tenor;
                $note = $request->note;
                $years = Carbon::now()->format('Y');

                $idHutang = IdGenerator::generate(['table' => 'karyawan_hutang_perusahaan', 'field' => 'id_hutang', 'length' => 16, 'prefix' => 'HP-'.$years.'-'.$idKaryawan]);
            
                // get Data users 
                $user =  DB::table('users')
                ->select('users.id as id',
                'users.id_departemen as idDepartemen',
                'departemen.departemen as departemen',
                'users.id_departemen_sub as idDepartemenSub',
                'departemen_sub.sub_departemen as subDepartemen',
                'users.pos as pos',
                'users.grade as idGrade',
                'grade.level as grade',
                'users.id_absen as idAbsen',
                'users.username as nip',
                'users.name as name',
                'users.email as email',
                'users.system as system',
                'users.id_skema_hari_kerja as idSkemaHariKerja',
                'skema_hari_kerja.skema as skema',
                'skema_hari_kerja.jml_hari as jmlHari',
                'skema_hari_kerja.jam_kerja as jamKerja',
                'users.doj as doj',
                'users.masa_kerja as masaKerja',
                'users.dob as dob',
                'users.usia as usia',
                'users.status as status')
                 ->join('departemen','departemen.id_dept','=','users.id_departemen')
                 ->join('departemen_sub','departemen_sub.id_subDepartemen','=','users.id_departemen_sub')
                 ->join('skema_hari_kerja','skema_hari_kerja.id_skema','=','users.id_skema_hari_kerja')
                 ->join('grade','grade.id_grade','users.grade')
                ->where('users.id_absen',$idKaryawan)
                ->first();
               
                $request =[];
                $request['id_hutang'] = $idHutang;
                $request['id_departemen'] = $user->idDepartemen;
                $request['departemen'] = $user->departemen;
                $request['id_sub_departemen'] = $user->idDepartemenSub;
                $request['sub_departemen'] = $user->subDepartemen;
                $request['id_karyawan'] = $idKaryawan;
                $request['name'] = $user->name;
                $request['grade'] = $user->grade;
                $request['tenor'] = $tenor;
                $request['total'] = $nominal;
                $request['note'] = $note;
                $request['total_angsuran'] = 0;
                $request['status'] = 0;
                $request['reff'] = $userLogin;
                $request['years'] = $years;
                $classKaryawan = new c_classKaryawan();
    
                $resultClass = $classKaryawan->insertHutangPerusahaanKaryawan($request);
              
            } elseif ($type == 'edit') {

                $idHutang = $request->idHutang;
                $nominal = $request->nominal;
                $tenor = $request->tenor;
                $note = $request->note;
          
                $dataID = DB::table('karyawan_hutang_perusahaan')
                ->where('id_hutang',$idHutang)
                ->first();
           
                $requestClass=[];
                $requestClass['id'] = $dataID->id;
                $requestClass['id_hutang'] = $idHutang;
                $requestClass['id_karyawan'] = $dataID->id_karyawan;
                $requestClass['total'] = $nominal;
                $requestClass['tenor'] = $tenor;
                $requestClass['note'] = $note;
                $requestClass['reff'] = $userLogin;
              
                $class = new c_classKaryawan();
                $resultClass = $class->updateHutangPerusahaanKaryawan($requestClass);
          
            }
            DB::commit();
         
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }

    public function submitPelunasan(Request $request)
    {
        $userLogin = request()->session()->get('username');
        try {
            $requestClass=[];
            $requestClass['id_hutang'] = $request->id_hutang;
         
            $class = new c_classKaryawan();
            $resultClass = $class->pelunasanHutangPerusahaanKaryawan($requestClass);
          
            return $resultClass;
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }
}
