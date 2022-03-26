<?php

namespace Credsim\Models;

class LoanEntity
{
    public $typeOfLoan;

    public function __construct($typesOfLoan)
    {
        $this->typeOfLoan = $typesOfLoan;
    }
}
