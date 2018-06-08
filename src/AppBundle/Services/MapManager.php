<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 08/06/18
 * Time: 10:45
 */

namespace AppBundle\Services;

use AppBundle\Repository\TileRepository;


class MapManager
{

    public function tileExists($x, $y)
    {
        if ($x <= 0 or $x >= 11 or $y <= 0 or $y >= 5) {

            return false;
        } else {
            return true;
        }
    }
}


