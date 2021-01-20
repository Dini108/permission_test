# Permission_test
Permission_test feladat

Futtatáshoz szükséges parancsok:

`git clone https://github.com/Dini108/permission_test.git`
(A projekt klónozása)

`cd todotest`
(Projekt gyökér mappájába jutás)

`composer install`
(Composer dependenciák telepítése)

`npm i`
(NPM dependenciák telepítése)

`cp .env.example .env`
(Példa config fájl másolása és átnevezése)

`php artisan key:generate`
(Projekt kulcs generálása)

`npm run dev`
(app.js,app.css fájlok generálása)

A .env fájlban megadott adatbázis nevével készíteni kell egy adatbázist a .env fájlban tárolt host-ra.

`php artisan migrate`
(Adatbázis struktúra migrálása a config fájlban megadott adatbázisba)

`php artisan db:seed`
(Első kategória felvitele adatbázisba)

Ezek után a projekt a http://localhost/permission_test/public/ címen lesz elérhető.

A kategóriák lenyithatóak ha van benne legalább egy gyerek kategória.
A kategória műveletekhez a kategória nevére kell kattintani és abban az esetben ha van az adott kategóriára feltöltési jogosultság megjelennek a műveletek.
