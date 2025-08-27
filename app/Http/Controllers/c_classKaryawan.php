<?php

namespace App\Http\Controllers;

use App\karyawan_group;
use App\karyawan_group_sub;
use App\karyawan_group_sub_variable;
use App\mod_user;
use App\karyawan_group_sub_variable_bpjs;
use App\karyawan_hutang_perusahaan;
use App\karyawan_hutang_perusahaan_detail;
use Session;

use Illuminate\Support\Facades\Crypt;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Console\Command;

use Carbon\Carbon;

class c_classKaryawan extends Controller
{
    // get Masa Kerja Karyawan
    public function getMasaKerja($tanggalMasuk)
    {
        date_default_timezone_set('Asia/Jakarta');
        $date = date("Y-m-d");
        $toDate = Carbon::parse($date);
        $fromDate = Carbon::parse($tanggalMasuk);
        // $bulan = $toDate->diffInMonths($fromDate);
        $diff = $toDate->diff($fromDate);
        $bulan = ($diff->y * 12) + $diff->m; // Konversi tahun ke bulan + sisa bulan
        return $bulan;
    }

    // get Usia Karyawan
    public function getUsia($tanggalLahir)
    {
            date_default_timezone_set('Asia/Jakarta');
            $date = date("Y-m-d");
            $toDate = Carbon::parse($date);
            $fromDate = Carbon::parse($tanggalLahir);
            $tahun = $toDate->diffInYears($fromDate);
            return $tahun;
    }

    // add user karyawan 
    public function insertUsers($request)
    {
        $_idDepartemen = $request['id_departemen'];
        $_idDepartemenSub = $request['id_departemen_sub'];
        $_pos = $request['pos'];
        $_grade = $request['grade'];
        $_idAbsen = $request['id_absen'];
        $_username = $request['username'];
        $_name = $request['name'];
        $_email = $request['email'];
        $_password = Crypt::encryptString($request['password']);
        $_noHp = $request['no_hp'];
        $_idSkemaHariKerja = $request['id_skema_hari_kerja'];
        $_tanggalBergabung = $request['doj'];
        $_tanggalLahir = $request['dob'];
        $_system = $request['system'];
        $_status = $request['status'];
        try
        {
            // cek double data
            $dtUser = DB::table('users')
            ->where('id_absen','=',$_idAbsen);
            if ($dtUser->doesntExist()) {  
                $insertData = new mod_user();
                $insertData->id_departemen =  $_idDepartemen;
                $insertData->id_departemen_sub =  $_idDepartemenSub;
                $insertData->pos =  $_pos;
                $insertData->grade =  $_grade;
                $insertData->id_absen =  $_idAbsen;       
                $insertData->username = $_username;
                $insertData->name = $_name; 
                $insertData->email = $_email;
                $insertData->password =$_password; 
                $insertData->no_hp = $_noHp;
                $insertData->id_skema_hari_kerja = $_idSkemaHariKerja;
                $insertData->doj = $_tanggalBergabung;
                $insertData->masa_kerja = $this->getMasaKerja($request['doj']);
                $insertData->dob = $_tanggalLahir;
                $insertData->usia = $this->getUsia($request['dob']);
                $insertData->system = $_system;
                $insertData->status = $_status;
                $insertData->save();
                $result='success';
            }
            else
            {
                $result= $this->editUsers($request);
            }
            return $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    // Edit Data user
    public function editUsers($request)
    {
        $_idDepartemen = $request['id_departemen'];
        $_idDepartemenSub = $request['id_departemen_sub'];
        $_pos = $request['pos'];
        $_grade = $request['grade'];
        $_idAbsen = $request['id_absen'];
        $_username = $request['username'];
        $_name = $request['name'];
        $_email = $request['email'];
        $_password = Crypt::encryptString($request['password']);
        $_noHp = $request['no_hp'];
        $_idSkemaHariKerja = $request['id_skema_hari_kerja'];
        $_tanggalBergabung = $request['doj'];
        $_tanggalLahir = $request['dob'];
        $_system = $request['system'];
        $_status =  $request['status'];
        try
        {
            DB::table('users')
            ->where('id_absen',$_idAbsen)
            ->update([
                'id_departemen' => $_idDepartemen,
                'id_departemen_sub' => $_idDepartemenSub,
                'pos' => $_pos,
                'grade' => $_grade,
                'username' => $_username,
                'name' => $_name,
                'email' => $_email,
                'no_hp'=> $_noHp,
                'id_skema_hari_kerja' => $_idSkemaHariKerja,
                'doj' => $_tanggalBergabung,
                'masa_kerja' => $this->getMasaKerja($request['doj']),
                'dob' => $_tanggalLahir,
                'usia' => $this->getUsia($request['dob']),
                'system' => $_system,   
                'status'=> $_status     
            ]);
               
            // Update Grade (Tunjangan Transport & Jabatan)
            $c_classKaryawan = new c_classPenggajian();     
            $_tunjanganTransport = $c_classKaryawan->updateTunjanganTransport($_idAbsen);

            $result='success';
            return $result;
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    // Non Aktif User
    public function disableUsers($idKaryawan)
    {
        try
        {
            DB::table('users')->where('username','=',$idKaryawan)
            ->update([
                'status' => 2
            ]);

            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function activeUsers($idKaryawan)
    {
        try
        {
            DB::table('users')->where('username','=',$idKaryawan)
            ->update([
                'status' => 1
            ]);

            return 'success';
        } catch (\Exception $ex) {
            return response()->json($ex);
        }
    }

    public function insertKaryawanGroupSubVariable($idKaryawan,$nominal)
    {
        $userLogin = 'system';
        $_idKaryawan = $idKaryawan;
        $_nominal =$nominal;

        try
        {
              $groupSubVariable = DB::table('group_sub_variable')
              ->select('group_sub_variable.id as id','group_sub_variable.id_variable as idVariable','group_sub_variable.variable as variable')
              ->where('group_sub_variable.isDell','1')
              ->get();
             
              foreach($groupSubVariable as $x)
              {
                // cek double data
                $dtUser = DB::table('karyawan_group_sub_variable')
                ->where('id_karyawan','=',$_idKaryawan)
                ->where('id_variable','=',$x->idVariable);
                if ($dtUser->doesntExist()) {   

                  $karyawanGroupSubVariable = new karyawan_group_sub_variable();
                  $karyawanGroupSubVariable->id_karyawan = $_idKaryawan;
                  $karyawanGroupSubVariable->id_variable = $x->idVariable;
                  $karyawanGroupSubVariable->nominal = $_nominal;
                  $karyawanGroupSubVariable->isDell = '1';
                  $karyawanGroupSubVariable->save();

                   // insert history
                   $_keterangan = 'Menambahkan Group Sub Variable Karyawan | Data : '. json_encode($karyawanGroupSubVariable);
                   $_requestValue['tipe'] = 0;
                   $_requestValue['menu'] ='Karyawan';
                   $_requestValue['module'] = 'Class Karyawan';
                   $_requestValue['keterangan'] = $_keterangan;
                   $_requestValue['pic'] = $userLogin;

                   $c_class = new c_classHistory;
                   $c_class = $c_class->insertHistory($_requestValue);    

                   $result='success';
                }
                else
                {
                    DB::table('karyawan_group_sub_variable')
                    ->where('id_karyawan','=',$_idKaryawan)
                    ->where('id_variable','=',$idVariable)
                    ->update([
                        'nominal' =>$_nominal
                    ]);

                   // insert history
                   $_keterangan = 'Edit Group Sub Variable Karyawan | ID Karyawan : '. $_idKaryawan." ID Variable : ". $idVariable. " Nominal : ".$_nominal;
                   
                   $_requestValue['tipe'] = 0;
                   $_requestValue['menu'] ='Karyawan';
                   $_requestValue['module'] = 'Class Karyawan';
                   $_requestValue['keterangan'] = $_keterangan;
                   $_requestValue['pic'] = $userLogin;

                   $c_class = new c_classHistory;
                   $c_class = $c_class->insertHistory($_requestValue);  

                    $result='success';
                }
              }      
                return $result;
          } catch (\Exception $ex) {
                 // insert history
                 $_keterangan = 'Error--insertKaryawanGroupSubVariable--'.$ex;
                   
                 $_requestValue['tipe'] = 0;
                 $_requestValue['menu'] ='Karyawan';
                 $_requestValue['module'] = 'Class Karyawan';
                 $_requestValue['keterangan'] = $_keterangan;
                 $_requestValue['pic'] = 'system';

                 $c_class = new c_classHistory;
                 $c_class = $c_class->insertHistory($_requestValue);  
                return response()->json($ex);
          }
    }

    // update Master Upah Karyawan
    // -->> update juga Variable BPJS Karyawan Master
    public function updateUpahkaryawanMaster($_idKaryawan,$_tipeBpjs,$_tanggalBergabung,$_tipeKontrak,$_noRekening,$_statusKaryawan,$_tipeGaji)
    {
        $userLogin = request()->session()->get('username');

        try
        {
            DB::beginTransaction();
                // cek masa kerja
                $_masaKerja = $this->getMasaKerja($_tanggalBergabung);

                    DB::table('users')
                    ->where('id_absen','=',$_idKaryawan)
                    ->update([
                        'tipe_kontrak' => $_tipeKontrak,
                        'doj' =>$_tanggalBergabung,
                        'masa_kerja' => $_masaKerja,
                        'no_rekening' => $_noRekening,
                        'tipe_bpjs' => $_tipeBpjs,
                        'status_skema_gaji'=> $_statusKaryawan,
                        'skema_gaji'=> $_tipeGaji
                    ]);

                // update variable BPJS Karayawan
                $this->updateVariableBPJSKaryawan($_idKaryawan, $_tipeBpjs);
                
            $result='success'; 
            DB::commit();   
            return $result;

        } catch (\Exception $ex) {
            DB::rollBack();
                // insert history
                $_keterangan = 'Error--updateUpahkaryawanMaster--'.$ex;
                $_requestValue['tipe'] = 0;
                $_requestValue['menu'] ='Karyawan';
                $_requestValue['module'] = 'Class Karyawan';
                $_requestValue['keterangan'] = $_keterangan;
                $_requestValue['pic'] = $userLogin;

                $c_class = new c_classHistory;
                $c_class = $c_class->insertHistory($_requestValue);  
            return response()->json($ex);
        }                  
    }

     // update Variable BPJS Karyawan Master
     public function updateVariableBPJSKaryawan($_idKaryawan, $_tipeBpjs)
     {
        $userLogin = request()->session()->get('username');
         try
         {
             DB::beginTransaction();
                 // delete group_sub_variable
             
                 DB::table('karyawan_group_sub_variable_bpjs')->where('id_karyawan','=',$_idKaryawan)->delete();
         
                 // get variable bpjs
                 $varBpjs = DB::table('grouping_sub_variable_bpjs')
                 ->select('id_variable_bpjs as idVariableBpjs','id_bpjs as idBpjs',
                 'bpjs as bpjs','id_variable as idVariable','variable as variable','tipe_potongan as tipePotongan','tot_presentase as totPresentase',
                 'presentase as presentase','max_value as maxValue','max_value_nominal as maxValueNominal','nominal as nominal'
                 )
                 ->where('tipe_potongan','=',$_tipeBpjs)
                 ->where('isDell','=', '1')
                 ->get();
             
                 
                 $_nominal=0;
                 // get rumus (UPAH TETAP) code GS-001
                 $c_classRumus = new c_classRumus;
                 $_nominal = $c_classRumus->getRumus('GS-001',$_idKaryawan); 
         
                 foreach($varBpjs as $x)
                 {
                         $karGroupSubVarBpjs = new karyawan_group_sub_variable_bpjs();
                         $karGroupSubVarBpjs->id_karyawan = $_idKaryawan;
                         $karGroupSubVarBpjs->id_variable_bpjs = $x->idVariableBpjs; 
                         $karGroupSubVarBpjs->id_variable = $x->idVariable; 
                         $karGroupSubVarBpjs->variable = $x->variable; 
                         $karGroupSubVarBpjs->tipe_potongan = $x->tipePotongan; 
                     
                         $karGroupSubVarBpjs->tot_presentase = $x->totPresentase; 
                         $karGroupSubVarBpjs->presentasi = $x->presentase; 
                         $karGroupSubVarBpjs->max_value = $x->maxValue; 
                         $karGroupSubVarBpjs->max_value_nominal = $x->maxValueNominal; 
                         // nominal upah tetap
                         $karGroupSubVarBpjs->nominal = $_nominal; 
                         $karGroupSubVarBpjs->save();
                     
                         // nominal bpjs
                         $_val_bpjs=0;
                         if($_nominal >= $x->maxValue)
                         {
                             $_val_bpjs=$x->maxValueNominal;
                         }
                         else
                         {
                            $_presentase=0;
                            $_presentase = $x->presentase/100;
                            $_val_bpjs = ($_nominal*$_presentase);
                         }
                         
                         DB::table('karyawan_group_sub_variable')
                         ->where('id_karyawan','=',$_idKaryawan)
                         ->where('id_variable','=',$x->idVariable)
                         ->update([
                             'nominal' => $_val_bpjs
                         ]);
                 }
 
                 DB::commit();
                 return 'success';
             } catch (\Exception $ex) {
                 DB::rollBack();
                 // insert history
                 $_keterangan = 'Error--updateVariableBPJSKaryawan--'.$ex;
                 $_requestValue['tipe'] = 0;
                 $_requestValue['menu'] ='Karyawan';
                 $_requestValue['module'] = 'Class Karyawan';
                 $_requestValue['keterangan'] = $_keterangan;
                 $_requestValue['pic'] = $userLogin;
 
                 $c_class = new c_classHistory;
                 $c_class = $c_class->insertHistory($_requestValue);  
             return response()->json($ex);
         }                  
     }

    // update Master Variable Upah Karyawan
    public function updateUpahkaryawanVariable($idKaryawan,$idVariable,$nominal)
    {
        $userLogin = request()->session()->get('username');

        try
        {

            DB::table('karyawan_group_sub_variable')
            ->where('id_karyawan','=',$idKaryawan)
            ->where('id_variable','=',$idVariable)
            ->update([
                'nominal' => $nominal
            ]);

            $result='success';   
            return $result;
        } catch (\Exception $ex) {
                // insert history
                $_keterangan = 'Error--updateUpahkaryawanVariable--'.$ex;
                $_requestValue['tipe'] = 0;
                $_requestValue['menu'] ='Karyawan';
                $_requestValue['module'] = 'Class Karyawan';
                $_requestValue['keterangan'] = $_keterangan;
                $_requestValue['pic'] = $userLogin;

                $c_class = new c_classHistory;
                $c_class = $c_class->insertHistory($_requestValue);  
            return response()->json($ex);
        }                  
    }

    // insert Hutang Perusahaan Karyawan
    public function insertHutangPerusahaanKaryawan($request)
    {
        $idDepartemen=''; $departemen=''; $idSubDepartemen=''; $subDepartemen=''; $name=''; $grade=''; $note='-';
        $idHutang=''; $idKaryawan=''; $tenor=''; $total=''; $totalAngsuran=''; $status=''; $reff=''; $years=Carbon::now()->format('Y');
        if (isset($request['id_departemen']) && $request['id_departemen']!='' ) {$idDepartemen = $request['id_departemen'];}
        if (isset($request['departemen']) && $request['departemen']!='' ) {$departemen = $request['departemen'];}
        if (isset($request['id_sub_departemen']) && $request['id_sub_departemen']!='' ) {$idSubDepartemen = $request['id_sub_departemen'];}
        if (isset($request['sub_departemen']) && $request['sub_departemen']!='' ) {$subDepartemen = $request['sub_departemen'];}
        if (isset($request['id_hutang']) && $request['id_hutang']!='' ) {$idHutang = $request['id_hutang'];}
        if (isset($request['id_karyawan']) && $request['id_karyawan']!='' ) {$idKaryawan = $request['id_karyawan'];}
        if (isset($request['name']) && $request['name']!='' ) {$name = $request['name'];}
        if (isset($request['grade']) && $request['grade']!='' ) {$grade = $request['grade'];}
        if (isset($request['tenor']) && $request['tenor']!='' ) {$tenor = $request['tenor'];}
        if (isset($request['total']) && $request['total']!='' ) {$total = $request['total'];}
        if (isset($request['total_angsuran']) && $request['total_angsuran']!='' ) {$totalAngsuran = $request['total_angsuran'];}
        if (isset($request['note']) && $request['note']!='' ) {$note = $request['note'];}
        if (isset($request['status']) && $request['status']!='' ) {$status = $request['status'];}
        if (isset($request['reff']) && $request['reff']!='' ) {$reff = $request['reff'];}
        if (isset($request['years']) && $request['years']!='' ) {$years = $request['years'];}
       
        try
        {
            // insert Master
            $data = new karyawan_hutang_perusahaan();
            $data->id_hutang = $idHutang;
            $data->id_departemen = $idDepartemen;
            $data->departemen = $departemen;
            $data->id_sub_departemen = $idSubDepartemen;
            $data->sub_departemen = $subDepartemen;
            $data->id_karyawan = $idKaryawan; 
            $data->name = $name;
            $data->grade = $grade;
            $data->tenor = $tenor; 
            $data->total = $total; 
            $data->total_angsuran = $totalAngsuran; 
            $data->note = $note;
            $data->status = 0; 
            $data->reff = $reff; 
            $data->years = $years;
            $data->save();
          
            $nominal=0;
            $nominal = $total/$tenor;
         
            for ($i = 1; $i <= $tenor; $i++) {
                // insert Detail
                $data = new karyawan_hutang_perusahaan_detail();
                $data->id_hutang = $idHutang;
                $data->id_karyawan = $idKaryawan;
                $data->angsuran_ke = $i;
                $data->nominal = $nominal;
                $data->status_bayar = '0';
                $data->reff = $reff;
                $data->save();
            }

            // update variable master karyawan group sub variable
          
            DB::table('karyawan_group_sub_variable')
            ->where('id_karyawan','=',$idKaryawan)
            ->where('id_variable','VR-009')
            ->update([
                'nominal' => $nominal,
            ]);

            return 'success';
          } catch (\Exception $ex) {
            // insert history
            $_keterangan = 'Error--insertHutangPerusahaanKaryawan--'.$ex;
                   
            $_requestValue['tipe'] = 0;
            $_requestValue['menu'] ='Karyawan';
            $_requestValue['module'] = 'Class Karyawan';
            $_requestValue['keterangan'] = $_keterangan;
            $_requestValue['pic'] = 'system';

            $c_class = new c_classHistory;
            $c_class = $c_class->insertHistory($_requestValue);  
            return response()->json($ex);
          }
    }

    // update Hutang Perusahaan Karyawan
    public function updateHutangPerusahaanKaryawan($request)
    {
        $id = '';
        $idHutang='';

        $id = $request['id'];
        $idHutang = $request['id_hutang'];
        
        $updateData=[];
        if (isset($request['tenor']) && $request['tenor']!='' ) {$updateData['tenor'] = $request['tenor'];}
        if (isset($request['total']) && $request['total']!='' ) {$updateData['total'] = $request['total'];}
        if (isset($request['note']) && $request['note']!='' ) {$updateData['note'] = $request['note'];}
        if (isset($request['status']) && $request['status']!='' ) {$updateData['status'] = $request['status'];}
        if (isset($request['reff']) && $request['reff']!='' ) {$updateData['reff'] = $request['reff'];}
  

        $nominal=0;
        if (isset($request['total']) && $request['total']!='' ) {$nominal = $request['total'];}
        try
        {        
            if($nominal!=0)
            {
                $idKaryawan = ''; $reff =''; $tenor=0;
                if (isset($request['tenor']) && $request['tenor']!='' ) {$tenor = $request['tenor'];}
                if (isset($request['id_karyawan']) && $request['id_karyawan']!='' ) {$idKaryawan = $request['id_karyawan'];}
                if (isset($request['reff']) && $request['reff']!='' ) {$reff = $request['reff'];}
                $nominalAngsuran=0;
         
                $nominalAngsuran = $nominal/$tenor;
                DB::table('karyawan_hutang_perusahaan_detail')->where('id_hutang','=',$idHutang)->delete();
                for($i = 1; $i <= $tenor; $i++) {
                    // insert Detail
                    $data = new karyawan_hutang_perusahaan_detail();
                    $data->id_hutang = $idHutang;
                    $data->id_karyawan = $idKaryawan;
                    $data->angsuran_ke = $i;
                    $data->nominal = $nominalAngsuran;
                    $data->status_bayar = '0';
                    $data->reff = $reff;
                    $data->save();
                }

                // update variable master karyawan group sub variable
                DB::table('karyawan_group_sub_variable')
                ->where('id_karyawan','=',$idKaryawan)
                ->where('id_variable','VR-009')
                ->update([
                    'nominal' => $nominalAngsuran,
                ]);
            }

            DB::table('karyawan_hutang_perusahaan')
            ->where('id','=',$id)
            ->update($updateData);

            // cek apakah ada periode berjalan
            $classPenggajian = new c_classPenggajian;
            $resultIDPeriode = $classPenggajian->getPeriodeBerjalan();

            if( is_null($resultIDPeriode))
            {
                // nothing
            }
            else
            {
                // update gaji karyawan sub variable
                DB::table('gaji_karyawan_sub_variable')
                ->where('id_periode','=',$resultIDPeriode->idPeriode)
                ->where('id_karyawan','=',$idKaryawan)
                ->where('id_variable','VR-009')
                ->update([
                    'nominal' => $nominalAngsuran,
                ]);
            }

            return 'success';
          } catch (\Exception $ex) {         
            // insert history
            $_keterangan = 'Error--insertHutangPerusahaanKaryawan--'.$ex;
                   
            $_requestValue['tipe'] = 0;
            $_requestValue['menu'] ='Karyawan';
            $_requestValue['module'] = 'Class Karyawan';
            $_requestValue['keterangan'] = $_keterangan;
            $_requestValue['pic'] = 'system';

            $c_class = new c_classHistory;
            $c_class = $c_class->insertHistory($_requestValue);  
            return response()->json($ex);
          }
    }

    public function pelunasanHutangPerusahaanKaryawan($request)
    {
        $idHutang = $request['id_hutang'];
    
        try
        {  
            // get data 
            $dtHutang = DB::table('karyawan_hutang_perusahaan')
            ->select('id_karyawan')
            ->where('id_hutang','=',$idHutang)
            ->first();
     
            // update master karyawan hutang perusahaan
            DB::table('karyawan_hutang_perusahaan')
            ->where('id_hutang', $idHutang)
            ->update(['status' => 1]);
       
            DB::table('karyawan_group_sub_variable')
            ->where('id_karyawan', $dtHutang->id_karyawan)
            ->where('id_variable', 'VR-009')
            ->update(['nominal' => 0]);
      
            return 'success';
          } catch (\Exception $ex) {         
            // insert history
            $_keterangan = 'Error--pelunasanHutangPerusahaanKaryawan--'.$ex;
                   
            $_requestValue['tipe'] = 0;
            $_requestValue['menu'] ='Karyawan';
            $_requestValue['module'] = 'Class Karyawan';
            $_requestValue['keterangan'] = $_keterangan;
            $_requestValue['pic'] = 'system';

            $c_class = new c_classHistory;
            $c_class = $c_class->insertHistory($_requestValue);  
            return response()->json($ex);
          }
    }

}
