<?php
/**
 * Created by PhpStorm.
 * User: vasil.dakov
 * Date: 15/06/2018
 * Time: 16:29
 */

namespace App\Bottler;

use App\Producer\Producer;


class Bottler extends Producer implements \JsonSerializable
{

    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        //
    }
}