# Client Registry API

This is a Laravel API for managing client records, allowing you to save client data to a CSV file and retrieve all records from it.

## Endpoints

### Save Client Record

- **URL:** `/api/clients`
- **Method:** POST
- **Request Body:** JSON object representing the client data
- **Response:** JSON response with the saved client data or error messages if validation fails

### Retrieve All Client Records

- **URL:** `/api/clients`
- **Method:** GET
- **Response:** JSON response with an array of all client records with pagination.

## Postman Documentation

You can find the Postman documentation for this API [here](https://documenter.getpostman.com/view/16415951/2sA2xpU9pd).

## Deployment

The API is deployed on an Digital Ocean Ubuntu server with Nginx. You can access it at [http://backend.sandeep-sharma.me](http://backend.sandeep-sharma.me).

## Architecture

The API follows a modular architecture, separating concerns into services, controllers, and request classes:

- **Services:** Business logic for saving and retrieving client records. Interfaces define contract.
- **Controllers:** Responsible for handling HTTP requests, calling the appropriate service methods, and returning responses.
- **API Resources:** Used for formatting responses in a consistent and structured manner.
- **Form Requests:** Perform validation of incoming requests.

## Testing

PHPUnit test cases are included for both endpoints, ensuring the functionality works as expected.

## Packages

* ``` league\csv ``` for easier handling of CSV files. 
