![Screenshot](https://github.com/tomatophp/circlexo/blob/master/art/screenshot.png)

# CircleXO

Social Network To manage your profile on the web

## Installation

```bash
git clone git@github.com:tomatophp/circlexo.git
cd circlexo
cp .env.example .env
```
create new database `circlexo` and update `.env` file

```dotenv
DB_DATABASE=circlexo
DB_USERNAME=root
DB_PASSWORD=12345678
```

```bash
composer install
php artisan key:generate
php artisan config:cache
php artisan migrate
```

build assets

```
yarn
yarn build
```

## Support

you can join our discord server to get support [TomatoPHP](https://discord.gg/VZc8nBJ3ZU)

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

Please see [SECURITY](SECURITY.md) for more information about security.

## Credits

- [Fady Mondy](https://www.github.com/3x1io)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
