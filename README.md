# ui42-assignment
Urobenie zadanie pre spoločnosť https://www.ui42.sk/ podľa šablón a úloh

Autor: Dávid Barta

## Inštalácia
1. Naklonujte repozitár: `git clone https://github.com/davisek/ui42-assignment.git`
2. Inštalácia balíčkov: `composer install`
3. Nakonfigurujte .env súbor a spustite migrácie: `php artisan migrate --path=database/custom_migrations`
4. Spustenie príkazu na importovanie dát: `php artisan data:import`
5. Pokiaľ chcete v aplikácii zobrazovať geolokáciu, tak navštívte stránku `https://opencagedata.com/` a zaregistrujte sa, aby ste mohli získať API KEY.
6. Otvorte v priečinku app/Console/Commands súbor StoreLocation.php a vložte do premennej apiKey svoj API kľúč.
7. Spustenie príkazu na vloženie geolokácie k obciam: `php artisan store:location`
5. Vykonanie príkazu na prepojenie obrázkov storage: `php artisan storage:link`

## Použítie
- Vygenerovanie kľúča: `php artisan key:generate`
- Spustite Laravel development server: `php artisan serve`
- Otvorte aplikáciu vo webovom prehliadači: http://localhost:8000
- Do Vyhľadávacieho poľa píšte meno obce a cez autocomplete to nájde požadovanú obec. Po kliknutí na zobrazenú obec sa presuniete na stránku s jej informáciami.
