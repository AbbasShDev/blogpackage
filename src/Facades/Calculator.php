<?php

namespace AbbasShDev\BlogPackage\Facades;

use Illuminate\Support\Facades\Facade;

class Calculator extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'calculator';
    }
}