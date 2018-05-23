<?php
/**
*@autor: jesusjclark
**/
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;

class PnfSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table('mpnfs') -> insert([
        'cod_pnf'=>'001',
        'nom_pnf'=>'PNF INFORMATICA',
        'cant_secc'=>1,
        'cant_uni'=>1,
        'tiempo_respaldo'=>1,
        'fecha_final'=>Carbon::now(),
        'created_at'=>Carbon::now(),
        'updated_at'=>Carbon::now()
        ]);
    }
}
