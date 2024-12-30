<?php

namespace Kossa\AlgerianCities\Controllers\Api;

use Illuminate\Database\Eloquent\Collection;
use Kossa\AlgerianCities\Commune;
use Kossa\AlgerianCities\Wilaya;

class WilayaController
{
    /**
     * Get all wilayas.
     *
     * @return Collection<int, Wilaya>
     */
    public function index(): Collection
    {
        return Wilaya::all();
    }

    /**
     * Get a specified Wilaya.
     */
    public function show(int $id): mixed
    {
        return Wilaya::findOrFail($id);
    }

    /**
     * Get communes of wilayas_id.
     */
    public function communes(int $id): mixed
    {
        return Commune::where('wilaya_id', $id)->get();
    }

    /**
     * Search wilaya by name or arabic_name
     *
     * @param  non-empty-string  $q
     * @return Collection<int, Wilaya>
     */
    public function search(string $q): Collection
    {
        return Wilaya::where('name', 'like', "%$q%")
            ->orWhere('arabic_name', 'like', "%$q%")
            ->get();
    }
}
