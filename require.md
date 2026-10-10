# macOS requirements

Install [Homebrew](https://brew.sh/) first if it is not already installed. Then install these packages:

| Package | Purpose | Install command |
| --- | --- | --- |
| PHP 8.3 | Runs the application. This version satisfies the PHP limits in `composer.lock`. | `brew install php@8.3` |
| Composer 2 | Installs the PHP libraries in `composer.json`: mPDF and PHPMailer. | `brew install composer` |
| PostgreSQL | Provides the project database. Install it locally if you do not already have access to a PostgreSQL server. | `brew install postgresql@16` |
| Apache HTTP Server | Runs PHP pages and supports the project's `.htaccess` URL rewrites. | `brew install httpd` |

To install everything for a local setup:

```sh
brew install php@8.3 composer postgresql@17 httpd
```

PHP must have these extensions enabled: `pdo_pgsql`, `gd`, `mbstring`, `zip`, and `zlib`. Check them with `php -m` and make sure `php -v` reports PHP 8.3; Homebrew may also install another PHP version as a Composer dependency.

From the project directory, run `composer install` to install the PHP libraries. No Node.js or npm installation is needed; the browser assets are included in the repository.

The app also needs an existing project PostgreSQL database or its backup. This repository does not include a database schema.
