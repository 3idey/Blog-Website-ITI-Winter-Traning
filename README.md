# Blog Application

Welcome to the Blog Application! This is a simple yet powerful blog platform built with Laravel. It allows users to create, edit, delete, and view blog posts. Users can also register and log in to manage their own posts.

## Features

- 📝 **User Registration and Authentication**: Securely register and log in to manage your blog posts.
- 🖼️ **Image Upload**: Easily upload images for your blog posts.
- 🗑️ **Soft Delete and Restore**: Soft delete posts and restore them when needed.
- 📄 **Pagination**: Paginate through blog posts for a better user experience.
- 🔗 **Unique Slugs**: Automatically generate unique slugs for your blog posts.

## Prerequisites

Before running this project, ensure you have the following installed:

- [PHP](https://www.php.net/downloads) (version 7.4 or higher)
- [Composer](https://getcomposer.org/download/)
- [Node.js](https://nodejs.org/en/download/) (version 12 or higher)
- [npm](https://www.npmjs.com/get-npm)
- [MySQL](https://dev.mysql.com/downloads/installer/) or any other supported database

## Installation

1. **Clone the repository**:

```bash
git clone https://github.com/your-username/blog-application.git
cd blog-application
```

2. **Install PHP dependencies**:

```bash
composer install
```

3. **Install JavaScript dependencies**:

```bash
npm install
```

4. **Copy the `.env.example` file to `.env`**:

```bash
cp .env.example .env
```

5. **Generate the application key**:

```bash
php artisan key:generate
```

6. **Configure your database settings in the `.env` file**:

```dotenv
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password
```

7. **Run the database migrations and seed the database**:

```bash
php artisan migrate --seed
```

8. **Start the development server**:

```bash
php artisan serve
```


## Usage

- **Register** a new user account.
- **Log in** with your account.
- **Create**, **edit**, **delete**, and **view** blog posts.
- **Upload images** for your blog posts.

## Contributing

We welcome contributions! Please fork the repository and submit a pull request with your changes. Make sure to follow the coding standards and write tests for your code.

## License

This project is open-source and available under the [MIT License](LICENSE).

## Contact

If you have any questions or feedback, feel free to reach out:

- **Email**: elaidya225@gmail.com

Happy blogging! 🚀
