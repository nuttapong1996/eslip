# macOS requirements

Install [Homebrew](https://brew.sh/) first if it is not already installed. Then install these packages:

| Package | Purpose | Install command |
| --- | --- | --- |
| PHP 8.3 | Runs the application. This version satisfies the PHP limits in `composer.lock`. | `brew install php@8.3` |
| Composer 2 | Installs the PHP libraries in `composer.json`: mPDF and PHPMailer. | `brew install composer` |
| PostgreSQL | Provides the project database. Install it locally if you do not already have access to a PostgreSQL server. | `brew install postgresql@16` |

To install everything for a local setup:

```sh
brew install php@8.3 composer postgresql@16
```

PHP must have these extensions enabled: `pdo_pgsql`, `gd`, `mbstring`, `zip`, and `zlib`. Check them with `php -m` and make sure `php -v` reports PHP 8.3; Homebrew may also install another PHP version as a Composer dependency.

From the project directory, run `composer install` to install the PHP libraries. No Node.js or npm installation is needed; the browser assets are included in the repository.

The app also needs an existing project PostgreSQL database or its backup. This repository does not include a database schema.

## Run the project locally

1. Start PostgreSQL if you installed it locally:

   ```sh
   brew services start postgresql@16
   ```

   Create or restore the project database and a user that can access it. You need an existing project schema or backup; this repository does not contain one.

2. From the project directory, create the database settings file:

   ```sh
   cp .env.example includes/.env
   ```

   Edit `includes/.env` and set `DB_HOST`, `DB_USERNAME`, `DB_PASSWORD`, `DB_DATABASE`, and `DB_PORT` for your PostgreSQL database. For a local database, `DB_HOST=localhost` and `DB_PORT=5432` are typical. The application reads **`includes/.env`**, not the `.env` in the project root.

3. Run `composer install` in the project directory if you have not already done so.

4. From the project directory, start PHP's built-in server with the included router:

   ```sh
   $(brew --prefix)/opt/php@8.3/bin/php -S localhost:8000 .dev/router.php
   ```

   Open **http://localhost:8000/**. The router handles extensionless links such as `/login`. The site redirects visitors who are not signed in to the login page. You need an account in the restored project database to sign in. Press `Ctrl+C` to stop the server. Apache configuration is not needed for this local setup.
