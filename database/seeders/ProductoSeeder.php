<?php

namespace Database\Seeders;

use App\Models\Producto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('productos')->insert([
            [
                "nombre"=>"Producto 1",
                "precio_compra"=>1.0,
                "precio_venta"=>1.2,
                "serie"=>"111222333444555",
                "created_at"=>date("Y-m-d"),
                "updated_at"=>date("Y-m-d"),
            ],
            [
                "nombre"=>"Producto 2",
                "precio_compra"=>0.9,
                "precio_venta"=>5.88,
                "serie"=>"555444333222111",
                "created_at"=>date("Y-m-d"),
                "updated_at"=>date("Y-m-d"),
            ],
            [
                "nombre"=>"Producto 3",
                "precio_compra"=>5,
                "precio_venta"=>10.2,
                "serie"=>"111111111111111",
                "created_at"=>date("Y-m-d"),
                "updated_at"=>date("Y-m-d"),
            ],            
        ]);        
        ;
    }
}
