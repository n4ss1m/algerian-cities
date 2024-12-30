<?php

namespace Kossa\AlgerianCities\Controllers\Api;

use Illuminate\Database\Eloquent\Collection;
use Kossa\AlgerianCities\Commune;

class CommuneController
{
    /**
     * Get all Communes.
     *
     * @return Collection<int, Commune>
     */
    public function index(): Collection
    {
        return Commune::all();
    }

    /**
     * Get a specified Commune.
     *
     * @param  positive-int  $id
     */
    public function show(int $id): Commune
    {
        return Commune::findOrFail($id);
    }

    /**
     * Search wilaya by name or arabic_name
     *
     * @param  non-empty-string  $q
     * @return Collection<int, Commune>
     */
    public function search($q): Collection
    {
        return Commune::where('name', 'like', "%$q%")
            ->orWhere('arabic_name', 'like', "%$q%")
            ->get();
    }
}
