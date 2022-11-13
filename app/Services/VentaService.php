<?php
namespace App\Services;

use App\Models\Venta;
use App\Services\Services;

class VentaService extends Services
{
    public function __construct()
    {
        parent::__construct(Venta::class);
    }
}
