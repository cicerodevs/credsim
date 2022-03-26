<?php

namespace Credsim\Helpers;

class Cpf
{
    private $cpf;

    const REGEX_CPF = '/^(([0-9]{3}.[0-9]{3}.[0-9]{3}-[0-9]{2})|([0-9]{11}))$/';

    public function __construct(string $numberCpf)
    {
        $this->validateCpf($numberCpf);
    }

    private function validateCpf(string $numberCpf): void
    {

        if (!$numberCpf) {
            throw new \Exception('Required parameter not informed');
        }

        if (!preg_match(self::REGEX_CPF, $numberCpf)) {
            throw new \Exception('The CPF entered does not have a valid format');
        }

        $this->cpf = $numberCpf;
    }

    public function __toString(): string
    {
        return $this->cpf;
    }
}
