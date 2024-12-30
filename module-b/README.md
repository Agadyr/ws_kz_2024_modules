# Nomad Tour - RESTful Web Service API

## Project Description
This project is a RESTful web service API for "Nomad Tour," a local startup in Astana providing an on-demand hop-on-hop-off bus service. Users can plan itineraries, view nearby attractions, and call buses via the website. The project is implemented in Laravel with Passport for authentication.

## Features
1. **User Authentication**:
   - Login: Obtain authorization token (JWT-based via Laravel Passport).
   - Logout: Invalidate the token.
2. **Places Management**:
   - List all places.
   - Retrieve a specific place by ID.
   - Create, update, and delete places (Admin only).
3. **Schedules Management**:
   - List all schedules (Admin only).
   - Create, update, and delete schedules (Admin only).
4. **Route Management**:
   - Search for routes between two places.
   - Save user-selected routes.

## Requirements
- PHP >= 8.0
- Composer
- Laravel >= 10.x
- Laravel Passport
- MySQL
- OpenServer or any compatible server environment

## Installation

### Step 1: Clone the Repository
```bash
git clone https://github.com/your-repo/nomad-tour.git
cd nomad-tour
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Environment Configuration
1. Copy the `.env.example` file and rename it to `.env`:
   ```bash
   cp .env.example .env
   ```
2. Update the database configuration in the `.env` file:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nomad_tour
   DB_USERNAME=root
   DB_PASSWORD=yourpassword
   ```

### Step 4: Generate Application Key
```bash
php artisan key:generate
```

### Step 5: Migrate and Seed Database
Run the migrations to create the necessary tables and seed initial data:
```bash
php artisan migrate --seed
```

### Step 6: Install Laravel Passport
```bash
php artisan passport:install
```

### Step 7: Serve the Application
Start the development server:
```bash
php artisan serve
```
The application will be accessible at `http://127.0.0.1:8000`.

## API Endpoints

### Authentication
- **Login**
  - URL: `/api/v1/auth/login`
  - Method: `POST`
  - Request Body:
    ```json
    {
      "username": "admin",
      "password": "adminpass"
    }
    ```
  - Response:
    ```json
    {
      "token": "your_auth_token",
      "role": "ADMIN"
    }
    ```

- **Logout**
  - URL: `/api/v1/auth/logout`
  - Method: `GET`
  - Header: `Authorization: Bearer <token>`

### Places
- **Get All Places**
  - URL: `/api/v1/place`
  - Method: `GET`
  - Header: `Authorization: Bearer <token>`

- **Get Place by ID**
  - URL: `/api/v1/place/{ID}`
  - Method: `GET`
  - Header: `Authorization: Bearer <token>`

- **Create Place (Admin Only)**
  - URL: `/api/v1/place`
  - Method: `POST`
  - Header: `Authorization: Bearer <token>`
  - Request Body:
    ```json
    {
      "name": "Example Place",
      "type": "Attraction",
      "latitude": 51.169392,
      "longitude": 71.449074,
      "image": "image_file",
      "open_time": "08:00",
      "close_time": "18:00",
      "description": "A beautiful place."
    }
    ```

- **Update Place (Admin Only)**
  - URL: `/api/v1/place/{ID}`
  - Method: `PUT`
  - Header: `Authorization: Bearer <token>`

- **Delete Place (Admin Only)**
  - URL: `/api/v1/place/{ID}`
  - Method: `DELETE`
  - Header: `Authorization: Bearer <token>`

### Schedules
- **Get All Schedules (Admin Only)**
  - URL: `/api/v1/schedule`
  - Method: `GET`
  - Header: `Authorization: Bearer <token>`

- **Create Schedule (Admin Only)**
  - URL: `/api/v1/schedule`
  - Method: `POST`
  - Header: `Authorization: Bearer <token>`
  - Request Body:
    ```json
    {
      "line": "Line A",
      "from_place_id": 1,
      "to_place_id": 2,
      "departure_time": "09:00",
      "arrival_time": "09:30",
      "distance": 5.0,
      "speed": 50
    }
    ```

- **Update Schedule (Admin Only)**
  - URL: `/api/v1/schedule/{ID}`
  - Method: `PUT`
  - Header: `Authorization: Bearer <token>`

- **Delete Schedule (Admin Only)**
  - URL: `/api/v1/schedule/{ID}`
  - Method: `DELETE`
  - Header: `Authorization: Bearer <token>`

### Routes
- **Search Routes**
  - URL: `/api/v1/route/search/{FROM_PLACE_ID}/{TO_PLACE_ID}/[DEPARTURE_TIME]`
  - Method: `GET`
  - Header: `Authorization: Bearer <token>`

- **Store Route Selection History**
  - URL: `/api/v1/route/selection`
  - Method: `POST`
  - Header: `Authorization: Bearer <token>`
  - Request Body:
    ```json
    {
      "from_place_id": 1,
      "to_place_id": 2,
      "schedule_ids": [1, 2, 3]
    }
    ```

## Database
- **Database Dump**: The SQL dump is located in the `db-dump/XX_database.sql` file.
- **ERD**: The ERD screenshot is located in the `db-dump/XX_ERD.png` file.

## Users for Testing
- Admin:
  - Username: `admin`
  - Password: `adminpass`
- User1:
  - Username: `user1`
  - Password: `user1pass`
- User2:
  - Username: `user2`
  - Password: `user2pass`

## Notes
- The project follows Laravel's standard structure for controllers, models, and migrations.
- Authentication and role-based authorization are handled using Laravel Passport.
- All API responses adhere to the JSON format as specified.
