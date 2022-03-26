<?php

namespace Credsim\Models;

use Credsim\Helpers\Cpf;

class CustomerEntity
{
    protected static $name;

    protected static $cpf;

    protected static $age;

    protected static $locale;

    protected static $income;


    public function __construct($name, Cpf $cpf, $age, $locale, $income)
    {
        self::$name = $name;
        self::$cpf = $cpf;
        self::$age = $age;
        self::$locale = $locale;
        self::$income = $income;
    }

    public static function getInfos()
    {
        return [
            'name' => self::$name,
            'cpf' => self::$cpf,
            'age' => self::$age,
            'locale' => self::$locale,
            'income' => self::$income,
        ];
    }
}
