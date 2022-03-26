<?php

use Credsim\Helpers\Cpf;
use Credsim\Services\CustomerService;
use Credsim\Services\LoanService;

require_once __DIR__ . '/vendor/autoload.php';

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$customer = new CustomerService();

// Types of loans available => ['personal', 'guaranteed', 'consigned']
$loan = new LoanService('consigned');

$customerData = [
    'name' => 'Erika',
    'cpf' => new Cpf('111.111.111-11'),
    'age' => 29,
    'locale' => 'SP',
    'income' => 10000
];

$customer->create($customerData);

$customerLoaded = $customer->load();

dump($loan->getLoan($customerLoaded));
