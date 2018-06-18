<?php
/**
 * Created by PhpStorm.
 * User: vasil.dakov
 * Date: 15/06/2018
 * Time: 13:54
 */

namespace Domain;


interface TypeInterface
{
    public function equals(TypeInterface $other) : bool;
}