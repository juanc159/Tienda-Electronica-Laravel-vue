<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Seeder;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $productos = ['Tarjeta grafica ','Placas','Computador','Mouse','Teclado','Telefono','Chip','Circuito','Pantalla Led','Microfono'];
        for ($i=0; $i < 10; $i++) { 
            $producto = new Producto();
            $producto->nombre =  $productos[$i];
            $producto->precio  =  random_int(10,50);
            $producto->cantidad  =  random_int(0,20);
            $producto->id_proveedor  =  random_int(1,5);;
            $producto->save() ;
        }
        



    }
}
