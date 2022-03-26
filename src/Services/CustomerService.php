<?php

namespace Credsim\Services;

use Credsim\Models\CustomerEntity;

class CustomerService
{
    public function create(array $data)
    {
        $customer = new CustomerEntity($data['name'], $data['cpf'], $data['age'], $data['locale'], $data['income']);

        return $customer;
    }

    public function load()
    {
        return CustomerEntity::getInfos();
    }
}
