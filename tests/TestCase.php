<?php

namespace Kossa\AlgerianCities\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Kossa\AlgerianCities\Providers\AlgerianCitiesServiceProvider;
use stdClass;

/**
 * Override the standard PHPUnit testcase with the Testbench testcase
 *
 * @see https://github.com/orchestral/testbench#usage
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    public function getEnvironmentSetUp($app): void
    {
        /** @var stdClass $CreateCitiesTable */
        $CreateCitiesTable = include __DIR__.'/../database/migrations/2024_10_26_000000_create_cities_table.php.stub';

        // @phpstan-ignore-next-line
        $CreateCitiesTable->up();

        Artisan::call('db:seed', ['--class' => 'WilayaCommuneSeeder']);
    }

    /**
     * Include the package's service provider(s)
     **
     * @param  Application  $app
     */
    protected function getPackageProviders($app): array
    {
        return [
            AlgerianCitiesServiceProvider::class,
        ];
    }
}
