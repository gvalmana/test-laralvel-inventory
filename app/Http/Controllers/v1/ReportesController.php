<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use PDF;

class ReportesController extends Controller
{
    //

    public function reporte_finanzas()
    {
        $models = Producto::all();
        $data=[];
        $data["alta_total"]=0;
        $data["media_total"]=0;
        $data["baja_total"]=0;
        $data["total"]=0;
        foreach ($models as $model):
            if ($model->categoria=="Gama Alta") {
                $data["alta_total"] += $model->facturado;
            } elseif ($model->categoria == "Gama Media") {
                $data["media_total"] += $model->facturado;
            } else {
                $data["baja_total"] += $model->facturado;
            }
            $data["total"] += $model->facturado;
        endforeach;
        $pdf = PDF::loadView('reporte', ["data"=>$data,"date"=>date("d-m-Y")]);
        $pdf->setPaper('a4', 'landscape');
        return $pdf->download('itsolutionstuff.pdf');
    }
}
