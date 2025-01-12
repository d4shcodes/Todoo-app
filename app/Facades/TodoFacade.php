<?php

namespace App\Facades;
use Illuminate\Support\Facades\Facade;


class TodoFacade extends Facade
{

    /**
     * Create a new class instance.
     */
    protected static function getFacadeAccessor()
    {
        return 'todoService';
    }
}



