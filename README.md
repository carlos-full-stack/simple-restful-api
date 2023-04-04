# Simple restful api

This project is a Symfony API that allows users to perform CRUD (Create, Read, Update, and Delete) operations on products and categories. The API supports various HTTP methods such as GET, POST, PUT, and DELETE, allowing users to retrieve, add, modify, and delete product and category information. Additionally, the API has a 'DataGenerator service' that generates all data required by controllers.

## Tecnologies

* Symfony 6

### Installation

```
# Clone the repository
$ git clone https://github.com/carlos-full-stack/simple-restful-api.git
$ cd simple-restful-api

# Install dependecies
$ composer install

# Set up .env file

# Generate database
$ php bin/console doctrine:database:create
$ php bin/console doctrine:migrations:migrate
$ php bin/console doctrine:fixtures:load

# Run server
$ symfony serve

```

### Endpoints

| HTTP Request | Request URL                 | Description           |
|--------------|-----------------------------|-----------------------|
| **GET**      | /api/products               | Products index        |
| **POST**     | /api/product/new            | Create product        |
| **POST**     | /api/product/{id}           | Show product by id    |
| **PUT**      | /api/product/{id}           | Edit product          |
| **DELETE**   | /api/product/{id}           | Delete product        |
| **GET**      | /api/categories             | Categories index      |
| **POST**     | /api/category/new           | Create category       |
| **POST**     | /api/category/{id}          | Show category by id   |
| **PUT**      | /api/category/{id}          | Edit category         |
| **DELETE**   | /api//category/{id}         | Delete category       |



## Authors

 [Carlos Martinez](https://carlosfullstack.es/)

## License

[MIT](https://opensource.org/licenses/MIT)
