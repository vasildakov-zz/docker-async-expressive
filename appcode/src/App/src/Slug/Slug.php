<?php

namespace App\Slug;


final class Slug
{
    public function __invoke(string $string) : string
    {
        $search  = ['Ș', 'Ț', 'ş', 'ţ', 'Ş', 'Ţ', 'ș', 'ț', 'î', 'â', 'ă', 'Î', 'Â', 'Ă', 'ë', 'Ë'];
        $replace = ['s', 't', 's', 't', 's', 't', 's', 't', 'i', 'a', 'a', 'i', 'a', 'a', 'e', 'E'];

        $string = str_ireplace($search, $replace, strtolower(trim($string)));
        $string = preg_replace('/[^\w\d\-\ ]/', '', $string);
        $string = str_replace(' ', '-', $string);

        return preg_replace('/\-{2,}/', '-', $string);
    }
}
