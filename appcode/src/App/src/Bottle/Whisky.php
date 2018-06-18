<?php
/**
 * Created by PhpStorm.
 * User: vasil.dakov
 * Date: 15/06/2018
 * Time: 14:36
 */

namespace Domain\Whisky;


class Whisky
{
    // Malt - made from malted barley
    // Grain - any type of grain, also a mixture
    // Blended - any mixture of different whiskies (malt, grain)
    // Irish - It may contain grain, also unmalted barley, but it is exclusively distilled in pot stills.
    // Bourbon and Tennessee
    // Rye Whiskey - contains at least 51% rye and must also be matured in oak casks for at least 2 years
    // Corn Whiskey - it must be produced from 100% corn

    /* const TYPE_SINGLE_MALT = 1;
    const TYPE_BLENDED_MALT = 2;
    const TYPE_BLENDED = 3;
    const TYPE_CASK_STRENGTH = 4;
    const TYPE_SINGLE_CASK = 5; */


    const TYPE_SCOTCH = 1;



    public function __construct($id, $name)
    {

    }
}
