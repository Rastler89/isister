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

## Docker Setup

This project is fully containerized for both development and production environments.

### Development Environment

1.  **Clone the repository:**
    ```bash
    git clone <repository_url>
    cd isister-backend
    ```

2.  **Create Environment File:**
    ```bash
    cp .env.example .env
    ```
    *Note: The default `DB_HOST` is `db`, which is the name of the database service in `docker-compose.dev.yml`.*

3.  **Build and Run Containers:**
    ```bash
    docker-compose -f docker-compose.dev.yml up -d --build
    ```

4.  **Install Dependencies and Set Up Application:**
    ```bash
    docker-compose -f docker-compose.dev.yml exec app composer install
    docker-compose -f docker-compose.dev.yml exec app php artisan key:generate
    docker-compose -f docker-compose.dev.yml exec app php artisan migrate
    docker-compose -f docker-compose.dev.yml exec app php artisan db:seed
    docker-compose -f docker-compose.dev.yml exec app php artisan passport:install
    docker-compose -f docker-compose.dev.yml exec app php artisan storage:link
    ```

5.  **Access the Application:**
    -   **Web:** http://localhost:8000
    -   **Vite HMR:** http://localhost:5173

### Production Environment (Dokploy)

1.  **Build and Push the Image:**
    Build the production Docker image and push it to a container registry (e.g., Docker Hub, GitHub Container Registry).
    ```bash
    docker build -t your-registry/isister-backend .
    docker push your-registry/isister-backend
    ```

2.  **Dokploy Configuration:**
    -   In your Dokploy dashboard, create a new application.
    -   Use the `your-registry/isister-backend` image.
    -   Set up the necessary environment variables (from your `.env` file).
    -   For the database, you can use a managed database service or another Docker container linked to your application.
    -   Configure your domain and SSL.

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
