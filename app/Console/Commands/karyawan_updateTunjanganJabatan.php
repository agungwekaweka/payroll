<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Controllers\c_classKaryawan;
use App\sysActivityHistory;

class karyawan_updateTunjanganJabatan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'karyawan:tunjanganJabatan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crone Update Tunjangan Jabatan karyawan Successfully!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            DB::beginTransaction();
            
            // get data user
            $dbUser = DB::table('users')
            ->select('users.id_absen','users.name','users.doj','grade.nominal_tnj_jabatan','grade.interval_bln_jabatan')
            ->join('grade','grade.id_grade','users.grade')
            ->where('status','1')
            ->get();

            foreach($dbUser as $x)
            {
                // cek masa kerja
                $c_classKaryawan = new c_classKaryawan();
                $_masaKerja = $c_classKaryawan->getMasaKerja($x->doj);
                $_name = $x->name;
                $_idKaryawan = $x->id_absen;
                $_nominalTnjJabatan = $x->nominal_tnj_jabatan;
                $_intervalBlnJabatan = $x->interval_bln_jabatan;
                
                // cek apakah di atas 13 bulan (Tunjangan Jabatan) VR-002
                if($_masaKerja >= $_intervalBlnJabatan && $_nominalTnjJabatan > 1)
                {
                    $idVariable = 'VR-002';
                    $karyawanVariable = DB::table('karyawan_group_sub_variable')
                    ->select('nominal')
                    ->where('id_karyawan','=',$_idKaryawan)
                    ->where('id_variable','=',$idVariable)
                    ->first();
                    
                    $nominalExisting = $karyawanVariable->nominal;
                    if($nominalExisting != $_nominalTnjJabatan)
                    {
                        // update Karyawan Group Sub Variable
                        DB::table('karyawan_group_sub_variable')
                        ->where('id_karyawan','=',$_idKaryawan)
                        ->where('id_variable','=',$idVariable)
                        ->update([
                            'nominal' => $_nominalTnjJabatan
                        ]);

                        // add to table log activity
                        $activity = new sysActivityHistory();
                        $activity->tipe = '1';
                        $activity->menu = 'Task';
                        $activity->module = 'Crone Job'; 
                        $activity->keterangan = 'Update Tunjangan Jabatan Karyawan '. $_name. ' ID karyawan : '. $_idKaryawan . ' Nominal : '.$_nominalTnjJabatan;
                        $activity->pic = 'Crone Job';
                        $activity->save();
                    }
                }
            }
         
            DB::commit();
            return 'success';
        } catch (\Exception $ex) {
            DB::rollBack();
            return response()->json($ex);
        }
    }
}
