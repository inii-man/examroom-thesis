# Run Laravel App

1. **Copy the Environment File**  
   This command duplicates the `.env.example` file as `.env`, creating a file where your app’s environment settings (like database credentials) are stored.

   ```bash
   cp .env.example .env
   ```

2. **Install Dependencies**  
   Laravel relies on external packages managed by Composer. This command installs all required packages listed in `composer.json`, ensuring the app has everything it needs to run.

   ```bash
   composer install
   ```

3. **Generate an Application Key**  
   The application key secures your encrypted data (such as sessions). This command generates a unique key and stores it in the `.env` file.

   ```bash
   php artisan key:generate
   ```

4. **Run Migrations and Seed the Database**  
   This step sets up your database tables (migrations) and populates them with initial data (seeders). It’s essential for getting the database ready for use.

   ```bash
   php artisan migrate --seed
   ```

5. **Start the Development Server**  
   Laravel has a built-in server for local development. This command starts the server, allowing you to view the app at `http://localhost:8000`.

   ```bash
   php artisan serve
   ```

   Or you can try the alternative way.

   ```bash
   composer run dev
   ```

---

### Final Quick Summary:
To set up and start the application, simply run:
```bash
cp .env.example .env
composer install
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Each command is designed to get your Laravel app configured, with dependencies installed, database ready, and server running—all in just a few steps.