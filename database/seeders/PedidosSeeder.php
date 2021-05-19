<?php

namespace Database\Seeders;

use App\Models\Pedido;
use Illuminate\Database\Seeder;

class PedidosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    function fecha_aleatoria($formato = "Y-m-d", $limiteInferior = "1970-01-01", $limiteSuperior = "2038-01-01"){
        // Convertimos la fecha como cadena a milisegundos
        $milisegundosLimiteInferior = strtotime($limiteInferior);
        $milisegundosLimiteSuperior = strtotime($limiteSuperior);
    
        // Buscamos un número aleatorio entre esas dos fechas
        $milisegundosAleatorios = mt_rand($milisegundosLimiteInferior, $milisegundosLimiteSuperior);
    
        // Regresamos la fecha con el formato especificado y los milisegundos aleatorios
        return date($formato, $milisegundosAleatorios);
    }

    public function run()
    { 
            
        //
        for ($i=0; $i < 50; $i++) {

            // Convertimos la fecha como cadena a milisegundos
            $milisegundosLimiteInferior = strtotime('2021-05-01');
            $milisegundosLimiteSuperior = strtotime('2021-10-01');
        
            // Buscamos un número aleatorio entre esas dos fechas
            $milisegundosAleatorios = mt_rand($milisegundosLimiteInferior, $milisegundosLimiteSuperior);
            $fecha_aleatoria= date("Y-m-d", $milisegundosAleatorios);
            //fin fechas aleatorias


            $pedido = new Pedido();
            $pedido->id_producto =  random_int(1, 10);
            $pedido->cantidad  =  random_int(0, 20);
            $pedido->fecha_entrega  =  $fecha_aleatoria;
            $pedido->save() ;
        }
    }
}
