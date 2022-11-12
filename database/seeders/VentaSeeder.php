<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VentaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        #Venta::factory(10)->hasProducto(Producto::make());
    }
}
