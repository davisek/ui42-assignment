# ui42-assignment
Urobenie zadanie pre spoločnosť https://www.ui42.sk/ podľa šablón a úloh

Autor: Dávid Barta

## Inštalácia
1. Naklonujte repozitár: `git clone https://github.com/davisek/ui42-assignment.git`
2. Inštalácia balíčkov: `composer install`
3. Nakonfigurujte .env súbor a spustite migrácie: `php artisan migrate --path=database/custom_migrations`
4. Spustenie príkazu na importovanie dát: `php artisan data:import`
5. Vykonanie príkazu na prepojenie obrázkov storage: `php artisan storage:link`

## Použítie
Spustite Laravel development server: `php artisan serve`
Otvorte aplikáciu vo webovom prehliadači: http://localhost:8000
