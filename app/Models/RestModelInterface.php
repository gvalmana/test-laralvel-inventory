<?php
namespace App\Models;

interface RestModelInterface
{
    public function getLinksAttribute();
    public function getDeletableAttribute();
}