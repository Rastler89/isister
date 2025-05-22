# Isister Backend

Isister Backend is a comprehensive web platform designed for efficient data administration. It serves as both a user-friendly admin panel for managing application data and a robust API to support web and mobile applications. This platform is ideal for developers and administrators looking for a centralized system to control and distribute data.

## Features

### Admin Panel (Filament PHP)
The administration panel provides a comprehensive interface for managing all aspects of the platform:

*   **User Management:** Manage registered users and their roles/permissions.
*   **Pet Management:** Add, edit, and view pet profiles, including their specific details, images, and history.
*   **Geographic Data:** Manage countries, states, and towns.
*   **Veterinary Data:**
    *   Manage species and breeds.
    *   Maintain a database of diseases.
    *   Manage types of medical tests and surgeries.
*   **Content Management:** Create and manage articles for the platform.
*   **Subscription Management:** (Implied by `CheckSubscription` middleware and `app/Models/Subscription.php`) Oversee user subscriptions and access levels.

### API (Laravel)
The platform exposes a RESTful API (`/api`) to support web and mobile applications, featuring:

*   **User Operations:** User registration, profile retrieval and updates, password changes.
*   **Pet Operations:** Full CRUD (Create, Read, Update, Delete) for pet data, including image uploads, and management of pet-specific information like size, weight, and status. Publicly accessible pet profiles via a unique hash.
*   **Data Retrieval:**
    *   Fetch lists of countries, states, and towns.
    *   Retrieve species and associated breeds.
    *   Get information on various diseases.
    *   Access articles by ID, slug, or category.
*   **Pet Health Records:**
    *   Manage vaccines, allergies, diets, and walk routines for pets.
    *   Record and retrieve surgeries, medical tests, treatments, and vet visits.
    *   Fetch available types for medical tests and surgeries.
*   **Authentication:** Secure API access (details to be provided in API Documentation section).
*   **Subscription-based Access:** Certain API functionalities are protected based on user subscription status.

## Technologies Used

*   **Backend:** PHP
*   **Framework:** Laravel
*   **Admin Panel:** Filament PHP
*   **Database:** MySQL (default). Supports PostgreSQL, SQLite, and SQL Server.
*   **API:** RESTful API
*   **API Authentication:** Laravel Passport (OAuth2)
*   **Web Server:** (User should add their web server, e.g., Nginx or Apache)
*   **Version Control:** Git

## Installation/Setup

Follow these steps to get the Isister Backend project up and running on your local development environment.

### Prerequisites
*   PHP (version as per `composer.json` - e.g., ^8.1 - will use a generic placeholder for now)
*   Composer
*   Node.js & NPM (for frontend assets)
*   MySQL (or your chosen database)
*   Git

### Steps
1.  **Clone the repository:**
    ```bash
    git clone <repository_url> # Replace <repository_url> with the actual URL
    cd isister-backend
    ```

2.  **Install PHP Dependencies:**
    ```bash
    composer install
    ```

3.  **Install Frontend Dependencies:**
    ```bash
    npm install
    ```

4.  **Build Frontend Assets:**
    ```bash
    npm run dev
    ```
    *(Or `npm run build` for production assets)*

5.  **Create Environment File:**
    Copy the example environment file and customize it:
    ```bash
    cp .env.example .env
    ```
    Update your database credentials (`DB_HOST`, `DB_PORT`, `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`) and other environment-specific settings in the `.env` file.

6.  **Generate Application Key:**
    ```bash
    php artisan key:generate
    ```

7.  **Run Database Migrations:**
    This will create the necessary tables in your database.
    ```bash
    php artisan migrate
    ```

8.  **Run Database Seeders (Optional but Recommended):**
    This will populate the database with initial data (e.g., admin user, default settings).
    ```bash
    php artisan db:seed
    ```
    *(Check `database/seeders/` for available seeders. You might need to run specific seeders if applicable.)*

9.  **Set Up Laravel Passport:**
    Install Passport and create encryption keys.
    ```bash
    php artisan passport:install
    ```

10. **Link Storage Directory (if not already handled by deployment scripts):**
    ```bash
    php artisan storage:link
    ```

11. **Serve the Application:**
    ```bash
    php artisan serve
    ```
    The application should now be accessible at `http://localhost:8000` (or another port if specified).

### Admin Panel Access
*   Access the admin panel at `/admin` (default for Filament, please verify).
*   Default admin credentials might be available from the database seeders (e.g., check `UserSeeder.php`).

## API Documentation

The Isister Backend provides a comprehensive RESTful API for integration with web and mobile applications.

### Base URL
All API endpoints are prefixed with:
`/api`

For example, to get a list of articles, the endpoint would be `/api/articles`.

### Authentication
The API uses **Laravel Passport (OAuth2)** for authentication. Clients must obtain an access token and include it in the `Authorization` header of their requests as a Bearer token.

Example:
`Authorization: Bearer <your_access_token>`

Refer to the Laravel Passport documentation for details on how to implement the OAuth2 flow (e.g., password grant or authorization code grant depending on your application type). After installation (`php artisan passport:install`), clients (like mobile apps or other services) need to be created using `php artisan passport:client --personal` or `php artisan passport:client --password` depending on the grant type you intend to use.

### Endpoints
A detailed list of available API endpoints, request parameters, and response formats can be found by:

1.  **Exploring the API routes definition:** `routes/api.php`
2.  **Accessing the auto-generated API documentation (powered by Scramble):**
    *   The documentation is typically available at `/docs/api`.
    *   An OpenAPI specification file (`api.json`) is also generated, which can be used with various API testing and documentation tools.

### Example Request (Conceptual)
To fetch a list of pets (assuming a `/api/pets` endpoint exists and requires authentication):

**Request:**
```http
GET /api/pets
Host: yourdomain.com
Accept: application/json
Authorization: Bearer <your_access_token>
```

**Response (Conceptual):**
```json
{
  "data": [
    {
      "id": 1,
      "name": "Buddy",
      "species": "Dog",
      "breed": "Golden Retriever",
      // ... other pet attributes
    },
    {
      "id": 2,
      "name": "Whiskers",
      "species": "Cat",
      "breed": "Siamese",
      // ... other pet attributes
    }
  ],
  // ... pagination or other meta info
}
```
*(Note: Actual endpoint details, request/response structures may vary. Please refer to the Scramble documentation or `routes/api.php` for precise information.)*
