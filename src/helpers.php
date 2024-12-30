<?php

use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Wilaya;

if (! function_exists('communes')) {

    /**
     * Get list of communes
     *
     * @param  int<1, 58>|null  $wilaya_id  wilaya_id the id of wilaya
     * @param  bool  $withWilaya  withWilaya if you need to include the wilaya
     * @param  string  $name  name the default name user arabic_name to get arabic name
     * @return array<mixed> # should be array<int, non-empty-string>
     */
    function communes(?int $wilaya_id = null, bool $withWilaya = false, string $name = 'name'): array
    {
        $communes = Commune::query();

        if ($wilaya_id) {
            $communes->where('wilaya_id', $wilaya_id);
        }

        if ($withWilaya) {
            $communes->withWilaya($name);
        }

        return $communes->pluck('name', 'id')->toArray();
    }
}

if (! function_exists('wilayas')) {

    /**
     * Get list of wilayas
     *
     * @param  non-empty-string  $name  default name use arabic_name to get wilayas in arabic
     * @return array<mixed> # should be array<int<1, 58>, string>
     */
    function wilayas(string $name = 'name'): array
    {
        return wilaya::pluck($name, 'id')->toArray();
    }
}

if (! function_exists('commune')) {

    /**
     * Get single commune
     *
     * @param  positive-int  $id  id The ID of commune
     * @param  bool  $withWilaya  withWilaya True if you need to include wilaya
     */
    function commune(int $id, bool $withWilaya = false): Commune
    {
        $commune = Commune::findOrFail($id);

        if ($withWilaya) {
            $commune->load('wilaya');
        }

        return $commune;
    }
}

if (! function_exists('wilaya')) {

    /**
     * Get single wilaya
     *
     * @param  int<1, 58>  $id  id The ID of wilaya
     */
    function wilaya(int $id): Wilaya
    {
        return wilaya::findOrFail($id);
    }
}
