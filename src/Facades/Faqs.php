<?php
namespace Newelement\Faqs\Facades;

use Illuminate\Support\Facades\Facade;

class Faqs extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'faqs';
    }
}
