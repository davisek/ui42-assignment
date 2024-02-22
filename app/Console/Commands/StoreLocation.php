<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;
use OpenCage\Geocoder\Geocoder;

class StoreLocation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'store:location';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store geolocation of every city in database';

    /**
     * Execute the console command.
     * @throws \Exception
     */
    public function handle()
    {
        $cities = City::all();

        // Tu vložte API KEY zo stránky https://opencagedata.com/
        $apiKey = '';

        $geocoder = new Geocoder($apiKey);

        foreach ($cities as $city) {
            $address = $city->city_hall_address;

            $result = $geocoder->geocode($address);

            if (!empty($result['results'][0]['geometry'])) {
                $lat = $result['results'][0]['geometry']['lat'];
                $lng = $result['results'][0]['geometry']['lng'];

                $city->update([
                    'lat' => $lat,
                    'lng' => $lng,
                ]);

                $this->line("Location for address '{$address}' stored successfully.");
            } else {
                $this->line("Unable to geocode address '{$address}'.");
            }
        }
        $this->line('Location for all cities was updated.');
    }
}
