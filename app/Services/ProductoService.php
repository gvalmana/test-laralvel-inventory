<?php
namespace App\Services;

use App\Models\Producto;
use App\Services\Services;

class ProductoService extends Services
{
    public function __construct()
    {
        parent::__construct(Producto::class);
    }
}
