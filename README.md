# Simontasi Unhasy

Simontasi Unhasy is a web-based application developed for managing and monitoring academic activities at Unhasy University.

## Features

- User authentication and authorization
- Course management
- Student enrollment
- Grade tracking
- Reporting and analytics

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/yourusername/simontasi-unhasy.git
    ```
2. Navigate to the project directory:
    ```bash
    cd simontasi-unhasy
    ```
3. Install the dependencies:
    ```bash
    composer install
    npm install
    ```
4. Set up the environment variables by copying `.env.example` to `.env` and updating the necessary values:
    ```bash
    cp .env.example .env
    ```
5. Generate the application key:
    ```bash
    php artisan key:generate
    ```
6. Run the database migrations:
    ```bash
    php artisan migrate
    ```
7. Start the development server:
    ```bash
    php artisan serve
    ```

## Usage

1. Access the application at `http://localhost:8000`.
2. Register a new account or log in with existing credentials.
3. Navigate through the dashboard to manage courses, enroll students, and track grades.

## Contributing

Contributions are welcome! Please fork the repository and create a pull request with your changes.

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Contact

For any inquiries or support, please contact [yourname@unhasy.ac.id](mailto:yourname@unhasy.ac.id).
