<?php
namespace App\Contracts;

interface UserRepositoryInterface{
    public function getWithSameNameAndEmail(string $name);
}