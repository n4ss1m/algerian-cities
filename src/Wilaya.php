<?php

namespace Kossa\AlgerianCities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property string $name
 */
class Wilaya extends Model
{
    protected $fillable = ['name', 'arabic_name', 'longitude', 'latitude'];

    /**
     * Get the validation rules that apply to the model.
     *
     * @return array<non-empty-string, non-empty-string>
     */
    public static function rules(bool $update = false, ?string $id = null): array
    {
        return [
            'name' => 'required',
        ];
    }

    /**
     * Get the communes for the wilaya.
     *
     * @return HasMany<Commune, $this>
     */
    public function communes(): HasMany // @phpstan-ignore-line-since 8.1
    {
        return $this->hasMany(Commune::class); // @phpstan-ignore-line-since 8.1
    }
}
