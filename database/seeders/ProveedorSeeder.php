<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $proveedor = new Proveedor();
        $proveedor->nombre =  'Electronica J J E U';
        $proveedor->descripcion  =  'Instalaciones electricas';
        $proveedor->save() ;

        $proveedor2 = new Proveedor();
        $proveedor2->nombre =  'S Y E Ingenieria S A S';
        $proveedor2->descripcion  =  'Comercio al por mayor de otros tipos de maquinaria y equipo n c p';
        $proveedor2->save() ;

        $proveedor3 = new Proveedor();
        $proveedor3->nombre =  'ELECTRONICAS A H S A S';
        $proveedor3->descripcion  =  'Comercio al por menor de equipos y aparatos de sonido y de video en establecimientos especializados';
        $proveedor3->save() ;


        $proveedor4 = new Proveedor();
        $proveedor4->nombre =  'Electronicas B M Ltda';
        $proveedor4->descripcion  =  'Construccion de edificios residenciales';
        $proveedor4->save() ;


        $proveedor5 = new Proveedor();
        $proveedor5->nombre =  'Electronicas Dc Sas';
        $proveedor5->descripcion  =  'Comercio al por menor de articulos de ferreteria pinturas y productos de vidrio en establecimientos especializados';
        $proveedor5->save() ;
    }
}
