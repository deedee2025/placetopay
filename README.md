# PlacetoPay API Wrapper by Sebas Fernandez
PHP Wrapper for PlaceToPay API integration.

## Installation
1) Make sure add `composer.json` file to project root directory
2) Run installation composer command `composer require deedee2025/placetoplay`
3) Load composer autoload file in you project as you prefer. e.g:  
`include_once __DIR__ . '/vendor/autoload.php';`

## Usage
### Authentication
Before start to use the wrapper's methods, you need authenticate via API:
```php
PlaceToPay::authenticate( $yourLogin, $yourTransactionKey );
```

### Searching
You can get information about a transaction after authentication using the method below:
```php
$transaction = PlaceToPay::getTransactionInformation($transactionID);
```

Also, if you've done any request before, you can get all information about the latest requests using the method below:
```php
$info = PlaceToPay::getStoredTransactionsInfo();
```
NOTE: The last method uses PHP session to get the latest request IDs made.

### Requesting
You can generate new transaction to PSE API using the method below:
```php
$request    = new PSETransactionRequest( $param );
$storeIds   = true; 
$result     = PlaceToPay::createTransaction( $request, $storeIds );
```

Also, you can call `PlaceToPay::printRequestForm( '/' )` method to print an automatic form to make the request and 
replacing `$params` argument by $_POST to pass the form's values to the request.