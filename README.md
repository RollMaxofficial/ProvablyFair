
## Provably Fair

This Git repository provides the tools to establish a Laravel-based website dedicated to verifying provably fair outcomes.


## Prerequisites

You must have php 8.1 installed along with Composer.

## Installation

To get the provable front end up and running, follow these steps within your terminal:
<pre>
# Clone the repository
git clone https://github.com/RollMaxofficial/ProvablyFair.git

# Navigate into the project directory
cd ProvablyFair

# Install all composer dependencies
composer install

# Generate the Laravel application key
php artisan key:generate

# Start serving the application
php artisan serve
</pre>

If all steps were completed successfully, you should now be able to access the website through http://127.0.0.1:8000.