<?php

namespace App\Http\Controllers;

use App\Adapters\RestCountriesAdapter;
use Illuminate\Http\Request;

class CountriesController extends Controller
{
    private $restCountriesAdapter;

    public function __construct(RestCountriesAdapter $restCountriesAdapter)
    {
        $this->restCountriesAdapter = $restCountriesAdapter;
    }
    public function getCountriers()
    {
        $response = $this->restCountriesAdapter->getCountriers();
        return $response;
    }

    public function getCountriersByName()
    {
        $name = request()->get("name");
        $response = $this->restCountriesAdapter->getCountriersByName($name);
        return $response;
    }

    public function getCountriersByCapital()
    {
        $capital = request()->get("capital");
        $response = $this->restCountriesAdapter->getCountriersByCapital($capital);
        return $response;
    }
}
