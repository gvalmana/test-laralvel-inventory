<!DOCTYPE html>
<html>
<head>
    <title>Laravel 9 Generate PDF Example - ItSolutionStuff.com</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <h1>REPORTE</h1>
    <p>Fecha: {{ $date }}</p>
    <p>Reporte de los estados de las ventas clasificados por categorías.</p>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th colspan="2" >Gama Baja</th>
                <th colspan="2" >Gama Media</th>
                <th colspan="2" >Gama Alta</th>
                <th colspan="2" >Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td >Total vendido</td>
                <td >Utilidad</td>
                <td >Total vendido</td>
                <td >Utilidad</td>
                <td >Total vendido</td>
                <td >Utilidad</td>
                <td >Total vendido</td>
                <td >Utilidad</td>
            </tr>
            <tr>
                <td >${{ round($data["baja_total"], 2) }}</td>
                <td >${{ round($data["baja_utilidad"], 2)}}</td>
                <td >${{ round($data["media_total"], 2) }}</td>
                <td >${{ round($data["media_utilidad"], 2)}}</td>
                <td >${{ round($data["alta_total"], 2) }}</td>
                <td >${{ round($data["alta_utilidad"], 2)}}</td>
                <td >${{ round($data["total"], 2) }}</td>
                <td >${{ round($data["utilidades"], 2) }}</td>
            </tr>
        </tbody>
    </table>  
</body>
<style>
    .page-break {
        page-break-after: always;
    }
</style>