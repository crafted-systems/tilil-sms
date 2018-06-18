<?php
/**
 * Created by PhpStorm.
 * User: vincent
 * Date: 12/13/17
 * Time: 6:39 AM
 */

namespace CraftedSystems\Tilil\Facades;

use Illuminate\Support\Facades\Facade;

class TililSMS extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'tilil-sms';
    }
}