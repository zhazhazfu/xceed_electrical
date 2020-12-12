<h1>Read Me - SCS220-2</h1>
<p>Hi, If you are reading this you have been selected to continue development of this project for Xceed Electrical.</p>
<p>This project utilises the Laravel 7 framework for back-end functionality and Bootstrap for front-end CSS. This project has been developed with Laravel Model-View-Controller standard in mind.
The View (examplefilename.blade.php) files are where you build your pages with HTML.</p>
<p>The Model files in the app directory (Category.php, Customer.php, Quote.php, etc.) determine what columns of a table in the database are required, the table name, key, and relationships to other tables. These relationships can be varied, but for the purposes of getting the Quote functionality working, will primarily be One-to-Many and Many-to-One. Examples of these two relationships can be seen on the Customer.php and Discount.php Models.
Controllers are where all the functionality of the framework comes together. Controllers can do many things such as simply generate a page with a unique page heading, or even view, store, edit, update and delete records from a database.</p>

<p>You may notice that there are no delete functions in this project. This is because deleting of records such as products, materials, and customers from the database will break any quotes that may reference these deleted records. Instead we opted for archiving, so that even though a product or material may not be used or viewed anymore, an older quote or other record may still be referenced with all necessary data. For a similar reason, this is why snapshots of other table records are taken and saved into tables such as QuoteItem (migration file: database\migrations\2020_09_07_000015_create_quoteitems_table.php). This will enable a created quote item to maintain a record of the pricing at the time the quote was generated, even if the material price, name, description, etc. is changed in the future.<p>

<p>We highly recommend the Laravel documentation. While daunting at first, it does provide some great information (most of the time..). Links to the documentation can be found below.</p>

<p>In addition, we found the Coder's Tape YouTube (https://www.youtube.com/c/CodersTape) video series on Laravel 6 very helpful when starting the project. While most of the functionality explained early in the videos has been completed, you will get a lot out of watching the tutorials to understand the basics of routing through web.php, along with blade templating, and how controllers work.</p>

<p>Good luck!</p>

<p>David & Jason.</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
