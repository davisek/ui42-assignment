<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\District;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Sunra\PhpSimple\HtmlDomParser;

class DataImport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data:import';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from https://www.e-obce.sk/kraj/NR.html';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Od 18:00 - 18:30, 19:00 - 22:00

        $html = $this->getHtml('https://www.e-obce.sk/kraj/NR.html');

        $districtLinks = $html->find('.okreslink');
        $imgCount = 0;
        foreach ($districtLinks as $link) {
            $districtUrl = $link->href;
            $districtName = $link->plaintext;
            District::updateOrCreate(
                ['name' => $districtName]
            );

            $this->line('  ' . $districtName);

            $htmlDis = $this->getHtml($districtUrl);
            $cityLinks = $htmlDis->find('table a');

            foreach ($cityLinks as $linkC) {
                $cityUrl = $linkC->href;
                if (str_contains($cityUrl, 'https://www.e-obce.sk/obec/') && !str_contains($cityUrl, '/fotky/')) {
                    $htmlCity = $this->getHtml($cityUrl);

                    $name = $linkC->plaintext;
                    $mayorName = "";
                    $cityHallAddress = "";
                    $phone = "";
                    $fax = "";
                    $email = "";
                    $webAddress = "";
                    $imagePath = "";

                    $this->line('----');
                    $this->line($name);
                    $tableFirst = $htmlCity->find('table', 8);
                    foreach ($tableFirst->find('tr') as $row) {
                        if (str_contains($row->find('td', 0)->plaintext, "Starosta:") || str_contains($row->find('td', 0)->plaintext, "Primátor:")) {
                            $mayorName = $row->find('td', 1)->plaintext;
                            $this->line('Mayor: ' . $mayorName);
                        }
                    }
                    $tableSecond = $htmlCity->find('table', 9);
                    foreach ($tableSecond->find('tr') as $row) {
                        if ($row->find('td strong', 0) && str_contains($row->find('td strong', 0)->plaintext, "Obecný úrad")
                            || $row->find('td strong', 0) && str_contains($row->find('td strong', 0)->plaintext, "Mestský úrad")) {
                            if (!$row->find('.obecmenutd')) {
                                $imageElement = $row->find('td img', 0);
                                $imageUrl = $imageElement ? $imageElement->src : null;

                                if ($imageUrl) {
                                    $imgCount++;
                                    $imageContents = file_get_contents($imageUrl);
                                    $imagePath = "images/{$imgCount}_image.jpg";
                                    Storage::put('public/' . $imagePath, $imageContents);
                                }
                            }
                        }
                        if ($row->find('td div', 0) && str_contains($row->find('td div', 0)->plaintext, "Tel:")) {
                            $phone = $row->find('td table tbody tr td', 0)->plaintext;
                            $this->line('Tel: ' . $phone);
                        }
                        if ($row->find('td div', 0) && str_contains($row->find('td div', 0)->plaintext, "Fax:")) {
                            $fax = $row->find('td', 2)->plaintext;
                            $this->line('Fax: ' . $fax);
                        }
                        if ($row->find('td div', 0) && str_contains($row->find('td div', 0)->plaintext, "Email:")) {
                            $cityHallAddress .= $row->find('td', 0)->plaintext . ", " . $row->next_sibling()->find('td', 0)->plaintext;
                            $email = $row->find('td a', 0)->plaintext;
                            $this->line('Address: ' . $cityHallAddress);
                            $this->line('Email: ' . $email);
                        }
                        if ($row->find('td div', 0) && str_contains($row->find('td div', 0)->plaintext, "Web:")) {
                            $webAddress = $row->find('td a', 0)->plaintext;
                            $this->line('Web: ' . $webAddress);
                        }
                    }
                    City::updateOrCreate([
                        'name' => $name,
                        'mayor_name' => $mayorName,
                        'city_hall_address' => $cityHallAddress,
                        'phone' => $phone,
                        'fax' => $fax,
                        'email' => $email,
                        'web_address' => $webAddress,
                        'district_id' => District::where('name', $districtName)->value('id')
                    ]);
                    $city = City::where('name', $name)->first();
                    if ($city && !$city->image_path) {
                        $city->image_path = $imagePath;
                        $city->save();
                        $this->line("Image path saved to database: $imagePath");
                    }

                }
            }
        }
    }

    public function getHtml($url) {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $htmlString = curl_exec($ch);
        curl_close($ch);

        return HtmlDomParser::str_get_html($htmlString);
    }
}
