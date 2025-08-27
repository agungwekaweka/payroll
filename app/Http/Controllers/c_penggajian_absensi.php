<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

use Session;
// use PDF;
use App\Http\Controllers\Controller;

// model
use App\gaji_kehadiran_absensi;
use App\kehadiran_absensi;
use App\Http\Controllers\c_classRumus;
use App\Http\Controllers\c_classHistory;

use Carbon\Carbon;
use Carbon\CarbonPeriod;

class c_penggajian_absensi extends Controller
{
    public function index() {
        return view('dashboard.penggajian.absensi-karyawan.baru');
    }

    public function list() {
        return view('dashboard.penggajian.absensi-karyawan.list');
    }

    public function GetPivotPeriode()
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
       
                $c_calass = new c_classApi;
                $_val = $c_calass->getUrlApi(); 
                $_url= $_val.'GetPivotPeriode?idPeriode='.$periode->idPeriode;
                $response = Http::get($_url);
                $jsonData = $response->json();

             
                // delete data kehadiran Absensi
                DB::table('kehadiran_absensi')
                ->where('id_periode',$periode->idPeriode)
                ->delete();
          
                $totalKaryawan=0;
                foreach($jsonData as $x => $node)
                {
                        $gajiKehadiranAbsensi = new kehadiran_absensi();
                        $gajiKehadiranAbsensi->id_periode = $periode->idPeriode;
                        $gajiKehadiranAbsensi->id_karyawan = $node['idAbsen']; 
                        $gajiKehadiranAbsensi->id_departemen = $node['departemen']; 
                        $gajiKehadiranAbsensi->id_sub_departemen = $node['sub_departemen']; 
                        $gajiKehadiranAbsensi->id_skema = $node['skema']; 
                        $gajiKehadiranAbsensi->tot_hari = $node['tot_hari']; 
                        $gajiKehadiranAbsensi->tot_libur = $node['tot_libur']; 
                        $gajiKehadiranAbsensi->tot_ph = $node['tot_ph']; 
                        $gajiKehadiranAbsensi->tot_izin = $node['tot_izin']; 
                        $gajiKehadiranAbsensi->tot_alfa = $node['tot_alfa']; 
                        $gajiKehadiranAbsensi->tot_sakit = $node['tot_sakit']; 
                        $gajiKehadiranAbsensi->tot_cuti = $node['tot_cuti']; 
                        $gajiKehadiranAbsensi->tot_terlambat = $node['tot_terlambat']; 
                        $gajiKehadiranAbsensi->tot_terlambat_dgn_form = $node['tot_terlambat_dgn_form']; 
                        $gajiKehadiranAbsensi->tot_masuk = $node['tot_masuk'];                
                        $gajiKehadiranAbsensi->reff = $userLogin;     
                        $gajiKehadiranAbsensi->save();
                        $totalKaryawan++;
                }   

              // insert history
              $_keterangan = 'Syncronise Data Absensi ' . $periode->periode . ' ('.$periode->idPeriode.')'.'  Total Data Absensi Karyawan : '. $totalKaryawan;
    
              $_requestValue['tipe'] = 0;
              $_requestValue['menu'] ='Penggajian';
              $_requestValue['module'] = 'Absensi Karyawan';
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
           
            $data['data'] =  DB::table('kehadiran_absensi')
            ->select(
            'kehadiran_absensi.id as id',
            'kehadiran_absensi.id_periode as idPeriode',
            'departemen.departemen as departemen',
            'departemen_sub.sub_departemen as subDepartemen',
            'users.pos as pos',
            'grade.level as grade',
            'kehadiran_absensi.id_karyawan as nik',
            'users.name as name',
            'users.tipe_kontrak as tipeKontrak',
            'kehadiran_absensi.id_skema as idSkema',
            'kehadiran_absensi.tot_hari as totHari',
            'kehadiran_absensi.tot_masuk as totMasuk',
            'kehadiran_absensi.tot_libur as totLibur',
            'kehadiran_absensi.tot_ph as totPh',
            'kehadiran_absensi.tot_izin as totIzin',
            'kehadiran_absensi.tot_alfa as totAlfa',
            'kehadiran_absensi.tot_sakit as totSakit',
            'kehadiran_absensi.tot_terlambat as totTerlambat',
            'kehadiran_absensi.tot_terlambat_dgn_form as totTerlambatDgnForm',
            'kehadiran_absensi.reff as reff',
            'kehadiran_absensi.updated_at as updatedAt')
            ->join('users','users.id_absen','=','kehadiran_absensi.id_karyawan')
            ->join('departemen','departemen.id_dept','=','kehadiran_absensi.id_departemen')
            ->join('departemen_sub','departemen_sub.id_subDepartemen','=','kehadiran_absensi.id_sub_departemen')
            ->join('grade','grade.id_grade','users.grade')
            ->where('kehadiran_absensi.id_periode',$periode->idPeriode)
            ->orderBy('kehadiran_absensi.id_karyawan','asc')
            ->get();
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

            $data['data'] =  DB::table('gaji_kehadiran_absensi')
            ->select(
            'gaji_kehadiran_absensi.id as id',
            'gaji_kehadiran_absensi.id_periode as idPeriode',
            'departemen.departemen as departemen',
            'departemen_sub.sub_departemen as subDepartemen',
            'users.pos as pos',
            'grade.level as grade',
            'gaji_kehadiran_absensi.id_karyawan as nik',
            'users.name as name',
            'users.tipe_kontrak as tipeKontrak',
            'skema_hari_kerja.skema as skema',
            'gaji_kehadiran_absensi.tot_hari as totHari',
            'gaji_kehadiran_absensi.upah_harian as upahHarian',
            'gaji_kehadiran_absensi.tot_masuk as totMasuk',
            'gaji_kehadiran_absensi.tot_libur as totLibur',
            DB::raw('(select nominal from gaji_karyawan_sub_variable where id_periode="'.$periode->idPeriode.'" and id_karyawan=gaji_kehadiran_absensi.id_karyawan and id_variable="VR-001" limit 1) as gajiPokok'),

            'gaji_kehadiran_absensi.tot_ph as totPh',
            'gaji_kehadiran_absensi.tot_izin as totIzin',
            'gaji_kehadiran_absensi.tot_alfa as totAlfa',
            'gaji_kehadiran_absensi.tot_sakit as totSakit',
            
            'gaji_kehadiran_absensi.reff as reff',
            'gaji_kehadiran_absensi.updated_at as updatedAt')
            ->join('users','users.id_absen','=','gaji_kehadiran_absensi.id_karyawan')
            ->join('gaji_karyawan','gaji_karyawan.id_karyawan','gaji_kehadiran_absensi.id_karyawan')
            ->join('departemen','departemen.id_dept','=','gaji_karyawan.id_departemen')
            ->join('departemen_sub','departemen_sub.id_subDepartemen','=','gaji_karyawan.id_departemen_sub')
            ->join('skema_hari_kerja','skema_hari_kerja.id_skema','gaji_karyawan.id_skema_hari_kerja')
            ->join('grade','grade.id_grade','users.grade')
            ->where('gaji_kehadiran_absensi.id_periode',$periode->idPeriode)
            ->where('gaji_karyawan.id_periode',$periode->idPeriode)
            ->orderBy('gaji_kehadiran_absensi.id_karyawan','asc')
            ->get();
       }
        return json_encode($data);
    }

    // public function submit(Request $request) {
    //     $userLogin = request()->session()->get('username');

    //     try {
    //         DB::beginTransaction();

    //         $c_classPenggajian = new c_classPenggajian;
    //         $_val = $c_classPenggajian->getPeriodeBerjalan();

    //         if (is_null($_val)) {
    //             // nothing
    //         } else {
    //             $periode = $_val;
    //             $idPeriode = $periode->idPeriode;
    //         }

    //         $dtKaryawanListGaji = DB::table('gaji_karyawan')
    //             ->select('gaji_karyawan.id_karyawan as idKaryawan',
    //                 'skema_hari_kerja.jml_hari as jmlHari',
    //                 'gaji_karyawan.skema_gaji as skemaGaji',
    //                 'users.masa_kerja as masaKerja',
    //                 'users.doj as doj')
    //             ->join('skema_hari_kerja', 'skema_hari_kerja.id_skema', 'gaji_karyawan.id_skema_hari_kerja')
    //             ->join('users', 'users.id_absen', '=', 'gaji_karyawan.id_karyawan')
    //             ->where('gaji_karyawan.id_periode', $idPeriode)
    //             ->get();

    //         foreach ($dtKaryawanListGaji as $x) {
    //             $_idKaryawan = $x->idKaryawan;
    //             $_upahHarian = $c_classPenggajian->hitungGajiHarianKaryawan($x->idKaryawan, $x->jmlHari, $idPeriode);

    //             $_dtAbsensiHarian = DB::table('kehadiran_absensi')
    //                 ->select('kehadiran_absensi.id_karyawan as idKaryawan',
    //                     'kehadiran_absensi.tot_hari as tot_hari',
    //                     'kehadiran_absensi.tot_libur as tot_libur',
    //                     'kehadiran_absensi.tot_ph as tot_ph',
    //                     'kehadiran_absensi.tot_izin as tot_izin',
    //                     'kehadiran_absensi.tot_alfa as tot_alfa',
    //                     'kehadiran_absensi.tot_sakit as tot_sakit',
    //                     'kehadiran_absensi.tot_cuti as tot_cuti',
    //                     'kehadiran_absensi.tot_masuk as tot_masuk')
    //                 ->where('kehadiran_absensi.id_periode', $idPeriode)
    //                 ->where('kehadiran_absensi.id_karyawan', $x->idKaryawan);

    //             if ($_dtAbsensiHarian->doesntExist()) {
    //                 $_requestValue['tipe'] = 0;
    //                 $_requestValue['menu'] = 'Penggajian';
    //                 $_requestValue['module'] = 'Absensi Karyawan';
    //                 $_requestValue['keterangan'] = 'Warning--ID Karyawan : ' . $x->idKaryawan . ' Tidak Mempunyai Kehadiran Absensi Periode : ' . $idPeriode;
    //                 $_requestValue['pic'] = $userLogin;
    //                 $c_class = new c_classHistory;
    //                 $c_class->insertHistory($_requestValue);
    //             } else {
    //                 $dtAbsensiHarian = $_dtAbsensiHarian->first();
    //                 DB::table('gaji_kehadiran_absensi')
    //                     ->where('id_periode', $idPeriode)
    //                     ->where('id_karyawan', $x->idKaryawan)
    //                     ->delete();

    //                 $gajiKehadiranAbsensi = new gaji_kehadiran_absensi();
    //                 $gajiKehadiranAbsensi->id_periode = $idPeriode;
    //                 $gajiKehadiranAbsensi->id_karyawan = $x->idKaryawan;
    //                 $gajiKehadiranAbsensi->tot_hari = $dtAbsensiHarian->tot_hari;
    //                 $gajiKehadiranAbsensi->upah_harian = $_upahHarian;
    //                 $gajiKehadiranAbsensi->tot_libur = $dtAbsensiHarian->tot_libur;
    //                 $gajiKehadiranAbsensi->tot_ph = $dtAbsensiHarian->tot_ph;
    //                 $gajiKehadiranAbsensi->tot_izin = $dtAbsensiHarian->tot_izin;
    //                 $gajiKehadiranAbsensi->tot_alfa = $dtAbsensiHarian->tot_alfa;
    //                 $gajiKehadiranAbsensi->tot_sakit = $dtAbsensiHarian->tot_sakit;
    //                 $gajiKehadiranAbsensi->tot_cuti = $dtAbsensiHarian->tot_cuti;
    //                 $gajiKehadiranAbsensi->tot_masuk = $dtAbsensiHarian->tot_masuk;
    //                 $gajiKehadiranAbsensi->reff = $userLogin;
    //                 $gajiKehadiranAbsensi->save();

    //                 // === Transport Calculation ===
    //                 $_valTransport = $c_classPenggajian->getTunjanganTransport($x->idKaryawan);
    //                 $_tnjTranposrt = 0;

    //                 $doj = Carbon::parse($x->doj);
    //                 $periodeAwal = Carbon::parse($periode->tgl_awal);
    //                 $periodeEnd = Carbon::parse($periode->tgl_akhir);
    //                 $anniversary2thn = $doj->copy()->addYears(2);

    //                 if ($anniversary2thn->lte($periodeEnd)) {
    //                     if ($doj->day === 15) {
    //                         $maksTransport = $x->jmlHari == 25 ? 27 : ($x->jmlHari == 21 ? 23 : $x->jmlHari);
    //                         $_tnjTranposrt = ($_valTransport->nominal) * floor($maksTransport / 2);
    //                     } else {
    //                         $startTransport = $anniversary2thn->lt($periodeAwal) ? $periodeAwal : $anniversary2thn;
    //                         $totalHariDalamPeriode = $periodeEnd->diffInDays($periodeAwal) + 1;
    //                         $lamaHariAktif = $periodeEnd->diffInDays($startTransport) + 1;
    //                         $proporsiMasuk = 0;

    //                         if ($dtAbsensiHarian->tot_masuk > 0 && $totalHariDalamPeriode > 0) {
    //                             $proporsiMasuk = round(($dtAbsensiHarian->tot_masuk / $totalHariDalamPeriode) * $lamaHariAktif);
    //                         }

    //                         $maksTransport = $x->jmlHari == 25 ? 27 : ($x->jmlHari == 21 ? 23 : $x->jmlHari);
    //                         $hariTransportFinal = min($proporsiMasuk, $maksTransport);
    //                         $_tnjTranposrt = ($_valTransport->nominal) * $hariTransportFinal;
    //                     }
    //                 }

    //                 DB::table('gaji_karyawan_sub_variable')
    //                     ->where('id_periode', $idPeriode)
    //                     ->where('id_karyawan', $x->idKaryawan)
    //                     ->where('id_variable', 'VR-004')
    //                     ->update(['nominal' => $_tnjTranposrt]);

    //                 $_nominalAlfa = 0;
    //                 $_nominalIjin = 0;

    //                 if ($x->skemaGaji != '2') {
    //                     // $_nominalAlfa = $dtAbsensiHarian->tot_alfa * $_upahHarian;
    //                     // $_nominalIjin = $dtAbsensiHarian->tot_izin * $_upahHarian;
    //                 }

    //                 DB::table('gaji_karyawan_sub_variable')
    //                     ->where('id_periode', $idPeriode)
    //                     ->where('id_karyawan', $x->idKaryawan)
    //                     ->where('id_variable', 'VR-010')
    //                     ->update(['nominal' => $_nominalAlfa]);

    //                 DB::table('gaji_karyawan_sub_variable')
    //                     ->where('id_periode', $idPeriode)
    //                     ->where('id_karyawan', $x->idKaryawan)
    //                     ->where('id_variable', 'VR-011')
    //                     ->update(['nominal' => $_nominalIjin]);
    //             }
    //         }

    //         DB::table('gaji_periode_status')
    //             ->where('id_periode', $idPeriode)
    //             ->where('id_status_gaji', 'GG-003')
    //             ->update(['status' => '1', 'reff' => $userLogin]);

    //         DB::table('kehadiran_absensi')->where('id_periode', $idPeriode)->delete();

    //         $c_classPenggajian = new c_penggajian_paycheck;
    //         $c_classPenggajian->hitungThp();

    //         DB::commit();
    //         return 'success';
    //     } catch (\Exception $ex) {
    //         DB::rollBack();
    //         return response()->json($ex);
    //     }
    // }

    // akumulasi
    public function submit(Request $request) 
    {
        $userLogin = request()->session()->get('username');
   
        try {
            DB::beginTransaction();

            // get ID Periode
            $c_classPenggajian = new c_classPenggajian;
            $_val = $c_classPenggajian->getPeriodeBerjalan(); 
            if (is_null($_val)) {
                return response()->json(['status' => false, 'message' => 'Periode belum tersedia']);
            }

            $periode = $_val;
            $idPeriode = $periode->idPeriode;
            $periodeStart = Carbon::parse($periode->tgl_awal);
            $periodeEnd = Carbon::parse($periode->tgl_akhir);

            // get kehadiran absensi
            $dtKaryawanListGaji = DB::table('gaji_karyawan')
                ->select('gaji_karyawan.id_karyawan as idKaryawan',
                    'skema_hari_kerja.jml_hari as jmlHari',
                    'gaji_karyawan.skema_gaji as skemaGaji',
                    'users.masa_kerja as masaKerja',
                    'users.doj as doj',
                    'gaji_karyawan.nik as nik',)
                ->join('skema_hari_kerja','skema_hari_kerja.id_skema','gaji_karyawan.id_skema_hari_kerja')
                ->join('users','users.id_absen','=','gaji_karyawan.id_karyawan')
                ->where('gaji_karyawan.id_periode',$idPeriode)
                // ->where('gaji_karyawan.nik','=','02-0623-045')
                ->get();
          

            foreach($dtKaryawanListGaji as $x) {
                $_idKaryawan = $x->idKaryawan;

                $_upahHarian = $c_classPenggajian->hitungGajiHarianKaryawan($x->idKaryawan, $x->jmlHari, $idPeriode);

                $_dtAbsensiHarian = DB::table('kehadiran_absensi')
                    ->select('id_karyawan', 'tot_hari', 'tot_libur', 'tot_ph', 'tot_izin', 'tot_alfa', 'tot_sakit', 'tot_cuti', 'tot_masuk')
                    ->where('id_periode', $idPeriode)
                    ->where('id_karyawan', $x->idKaryawan);

                if ($_dtAbsensiHarian->doesntExist()) {
                    $c_class = new c_classHistory;
                    $c_class->insertHistory([
                        'tipe' => 0,
                        'menu' => 'Penggajian',
                        'module' => 'Absensi Karyawan',
                        'keterangan' => 'Warning--ID Karyawan : '.$x->idKaryawan .' Tidak Mempunyai Kehadiran Absensi Periode : '. $idPeriode,
                        'pic' => $userLogin,
                    ]);
                    continue;
                }

                $dtAbsensiHarian = $_dtAbsensiHarian->first();
         
                DB::table('gaji_kehadiran_absensi')
                    ->where('id_periode', $idPeriode)
                    ->where('id_karyawan', $x->idKaryawan)
                    ->delete();

                gaji_kehadiran_absensi::create([
                    'id_periode' => $idPeriode,
                    'id_karyawan' => $x->idKaryawan,
                    'tot_hari' => $dtAbsensiHarian->tot_hari,
                    'upah_harian' => $_upahHarian,
                    'tot_libur' => $dtAbsensiHarian->tot_libur,
                    'tot_ph' => $dtAbsensiHarian->tot_ph,
                    'tot_izin' => $dtAbsensiHarian->tot_izin,
                    'tot_alfa' => $dtAbsensiHarian->tot_alfa,
                    'tot_sakit' => $dtAbsensiHarian->tot_sakit,
                    'tot_cuti' => $dtAbsensiHarian->tot_cuti,
                    'tot_masuk' => $dtAbsensiHarian->tot_masuk,
                    'reff' => $userLogin,
                ]);

                // Transport
                $_valTransport = $c_classPenggajian->getTunjanganTransport($x->idKaryawan);
                $_tnjTranposrt = 0;
               
                $doj = Carbon::parse($x->doj);
                $anniversary = $doj->copy()->addYears(2);
             
                if($x->masaKerja ==25)
                {   
                    $response = Http::get('https://lokahr.salokapark.app/api/get_jadwal_berangkat', [
                        'id_periode'   => $idPeriode,
                        'id_karyawan'  => $x->nik,
                        'date_of_join' => $x->doj,
                    ]);

                    $jsonData = $response->json();
                
                    $totalHariMasuk=0;
                    $hariMasukProporsional =$jsonData['data']['total'] ;
                   
                    $maxHariTransport = $x->jmlHari == 25 ? 27 : ($x->jmlHari == 21 ? 23 : $x->jmlHari);
                    $_tnjTranposrt = min($hariMasukProporsional, $maxHariTransport) * $_valTransport->nominal;
                }
                if($x->masaKerja > 25)
                {
                    $maxHariTransport = $x->jmlHari == 25 ? 27 : ($x->jmlHari == 21 ? 23 : $x->jmlHari);
                    $_tnjTranposrt = min($dtAbsensiHarian->tot_masuk, $maxHariTransport) * $_valTransport->nominal;
                }

                DB::table('gaji_karyawan_sub_variable')
                    ->where('id_periode', $idPeriode)
                    ->where('id_karyawan', $x->idKaryawan)
                    ->where('id_variable', 'VR-004')
                    ->update(['nominal' => $_tnjTranposrt]);

                $_nominalAlfa = 0;
                $_nominalIjin = 0;

                if ($x->skemaGaji != '2') {
                    // uncomment jika ingin hitung potongan
                    // $_nominalAlfa = $dtAbsensiHarian->tot_alfa * $_upahHarian;
                    // $_nominalIjin = $dtAbsensiHarian->tot_izin * $_upahHarian;
                }

                DB::table('gaji_karyawan_sub_variable')
                    ->where('id_periode', $idPeriode)
                    ->where('id_karyawan', $x->idKaryawan)
                    ->where('id_variable', 'VR-010')
                    ->update(['nominal' => $_nominalAlfa]);

                DB::table('gaji_karyawan_sub_variable')
                    ->where('id_periode', $idPeriode)
                    ->where('id_karyawan', $x->idKaryawan)
                    ->where('id_variable', 'VR-011')
                    ->update(['nominal' => $_nominalIjin]);
            }

            DB::table('gaji_periode_status')
                ->where('id_periode', $idPeriode)
                ->where('id_status_gaji', 'GG-003')
                ->update([
                    'status' => '1',
                    'reff' => $userLogin,
                ]);

            DB::table('kehadiran_absensi')
                ->where('id_periode', $idPeriode)
                ->delete();

            $c_classPenggajian = new c_penggajian_paycheck;
            $c_classPenggajian->hitungThp();

            DB::commit();
            return 'success';

        } catch (\Exception $ex) {
            dd($ex);
            DB::rollBack();
            return response()->json($ex);
        }
    }
}