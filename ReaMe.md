# Transaction SDK

This SDK provides a class `TransactionRedirector` to process transactions and redirect to a specified URL with necessary parameters.

## Installation

1. Clone or download the repository.
2. Include the `TransactionRedirector.php` file in your project.

## Configuration

1. Set your actual `TOKEN1` and `SALTKEY` values in the `TransactionRedirector.php` file.
2. Ensure the base URL (`URL`) is configured correctly for redirection.

## Example Usage

### 1. PHP Script (Using the SDK)

```php
<?php

require_once 'TransactionRedirector.php';

// Call the processTransaction method to handle the transaction
TransactionRedirector::processTransaction();

?>
