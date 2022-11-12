<?php

namespace App\Models\v1;

use CrudApiRestfull\Models\RestModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    const MODEL="Producto";
    const RELATIONS = [];
    const PARENT = [];
}
