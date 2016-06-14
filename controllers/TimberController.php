<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 14.06.16
 * Time: 14:57
 */

namespace Bunch\Controllers;


class TimberController
{
    public function addLocation($loc){
        array_push($loc, BWP_PLUGIN_PATH.'/views');
        return $loc;
    }

    public function changeTwig($twig){
        return $twig;
    }
}