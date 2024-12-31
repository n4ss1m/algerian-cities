<?php

namespace Kossa\AlgerianCities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\DB;

/**
 * @property Wilaya $wilaya
 */
class Commune extends Model
{
    protected $fillable = ['name', 'arabic_name', 'post_code', 'wilaya_id', 'longitude', 'latitude'];

    /**
     * Get the validation rules that apply to the model.
     *
     * @return array<non-empty-string, non-empty-string>
     */
    public static function rules(bool $update = false, ?int $id = null): array
    {
        return [
            'name' => 'required',
            'wilaya_id' => 'required|numeric',
        ];
    }

    /*
    |------------------------------------------------------------------------------------
    | Relations
    |------------------------------------------------------------------------------------
    */
    /**
     * Get the wilaya that owns the commune.
     *
     * @param  Builder<Commune>  $q
     */
    public function scopeWithWilaya(Builder $q, string $name = 'name'): void
    {
        $q->leftJoin('wilayas', 'wilayas.id', 'communes.wilaya_id')
            ->select('communes.id', DB::raw("concat(communes.$name, ', ', wilayas.$name) as name"));
    }

    /**
     * Get the wilaya that owns the commune.
     *
     * @return BelongsTo<Wilaya, $this>
     */
    public function wilaya(): BelongsTo
    {
        return $this->belongsTo(Wilaya::class)->withDefault(); // @phpstan-ignore-line-since 8.1
    }

    /*
    |------------------------------------------------------------------------------------
    | Attribute
    |------------------------------------------------------------------------------------
    */
    /**
     * Get the wilaya name.
     */
    public function getWilayaNameAttribute(): string
    {
        return $this->wilaya->name;
    }
}
