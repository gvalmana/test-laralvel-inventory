<?php
namespace App\Adapters;

use App\Contracts\CountriesService;
use Illuminate\Support\Facades\Http;

class RestCountriesAdapter implements CountriesService
{
    protected string $enpoint;

    public function __construct()
    {
        $this->enpoint = "https://restcountries.com/v3.1/";
    }

    public function getCountriers()
    {
        $response = Http::retry(3,5)->timeout(15)->get("{$this->enpoint}all");
        return $response->json();        
    }

    public function getCountriersByName(string $name)
    {
        $response = Http::get("{$this->enpoint}name/{$name}");
        return $response->json();
    }

    public function getCountriersByCapital(string $capital)
    {
        $response = Http::get("{$this->enpoint}capital/{$capital}");
        return $response->json();
    }
}
