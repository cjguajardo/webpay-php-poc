
# webpay-php-poc

This repository contains a simple proof of concept (POC) implementation of a web payment (transbank webpay) system using just PHP and no extra libraries.





## Usage/Examples

To create a transaction:
```php

$tbk = new Tbk();
$result = $tbk->create_transaction(
    $amount, 
    $buy_order, 
    $session_id, 
    $return_url
);

```

To confirm the transaction status (if it was successful or not)
```php

$tbk = new Tbk();
$result = $tbk->confirm_transaction($token);

```

For more details about the flow and data, you should refer to the official transbank documentation [https://www.transbankdevelopers.cl/referencia/webpay].
## Run Locally

#### Clone the project

```bash
  git clone git@github.com:cjguajardo/webpay-php-poc.git
```

#### Go to the project directory

```bash
  cd webpay-php-poc
```

#### Start server

This project uses Docker, so if you don't have it installed, well, you should.

```bash
  docker-compose up
```


