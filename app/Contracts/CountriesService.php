<?php
namespace App\Contracts;

use FontLib\Table\Type\name;

interface CountriesService{
    public function getCountriers();
    public function getCountriersByName(string $name);
    public function getCountriersByCapital(string $capital);
}