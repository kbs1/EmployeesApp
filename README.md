Employees App
=============
Simple application to manage your employees (or other entities) stored in a single XML file "the Laravel way"
(using Eloquent, <a href="https://github.com/ryangjchandler/orbit" target="_blank">Orbit</a> and custom `SingleFileDriver` / `Xml` driver).
Flat file XML database is stored in `storage/database`.

Requirements
============
- PHP `^7.3|^8.0`
- composer
- NodeJS `^12`

Installation
============
1. clone the repository
2. execute `composer install`
3. copy the `.env.example` file as `.env`
4. execute `php artisan key:generate`
5. execute `npm ci`
6. execute `npm run production`
7. execute `php artisan db:seed` (optional, can be executed multiple times, seeds sample data)
8. execute `php artisan serve`
9. navigate to `http://localhost:8000`

Have fun!

Customisation
=============
It is possible to easily change the flat database schema by editing any model's `schema()` function *if* the database is currently empty.

Modifying the schema with some data present can cause unintended side effects, it is advised to execute `orbit:clear` and `orbit:fresh` artisan commands before modifications.

Customising the employees listing, filtering and / or form involves editing the appropriate controllers / views / `FormRequest`s.

Filtering is implemented as a bundle of ready-made fluent filters in the `App\Support\ListingFilter` namespace.

About Orbit
===========
Orbit uses SQLite to cache all flat database data before use. This allows us to access flat file data conviniently using Eloquent as
if it was stored in a relational database.

Moreover, Orbit guarantees our flat database will be always up-to-date with any changes made, and will automatically refresh it's SQLite cache
when the underlying flat file driver indicates so.

About `SingleFileDriver` and `Xml` driver
=========================================
Normally, Orbit stores all model's data in separate files. It is trivial to implement `Xml` driver in this way, as Orbit doesn't come bundled with one.

However, when the requirement is to store all model's data in a single file, `SingleFileDriver` was implemented.

This driver implements the `Orbit\Contracts\Driver` interface and expects all subsequent file format drivers to operate on `array` of models
instead of on separate files.

With `SingleFileDriver`, any file format driver has to implement only 3 methods:
- `abstract protected function extension(): string;`
- `abstract protected function load(string $file): array;`
- `abstract protected function store(string $file, array $models): bool;`

`Xml` driver in depth
=====================
The `Xml` driver makes use of <a href="https://github.com/spatie/array-to-xml" target="_blank">spatie/array-to-xml</a> library when writing the XML
file, and uses a custom implementation to read the models back using `SimpleXMLElement`. Custom implementation had to be used since no suitable "xml-to-array" libraries were found to consistently handle our XML format.