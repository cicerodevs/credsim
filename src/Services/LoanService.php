<?php

namespace Credsim\Services;

use Credsim\Models\LoanEntity;

class LoanService
{
    private $typeOfLoan;

    private $loans = [];

    const TYPES_OF_LOANS = ['personal', 'guaranteed', 'consigned'];

    const INTEREST_RATES_PER_LOAN = ['personal' => 4, 'guaranteed' => 3, 'consigned' => 2];

    public function __construct(string $typeOfLoan = '')
    {
        $this->typeOfLoan = new LoanEntity($typeOfLoan);
    }

    public function getLoan(array $data)
    {
        if (!in_array($this->typeOfLoan->typeOfLoan, self::TYPES_OF_LOANS)) {
            throw new \Exception('We do not carry out this type of loan.!');
        }

        return self::returnCreditOffer($data);
    }

    private function returnCreditOffer($data)
    {
        if ((bool)self::basicRequirementsForCreditApproval($data)) {
            $proposal = [
                'customer' => $data['name'],
            ];

            $loans = [];

            foreach ($this->loans as $loan) {
                array_push($loans, [
                    'type' => $loan,
                    'taxes' => self::loanInterestRate($loan)
                ]);
            }
            $proposal['loans'] = $loans;

            return $proposal;
        }

        return ['message' => 'This type of loan is not available to you at this time!'];
    }

    private function basicRequirementsForCreditApproval(array $data)
    {
        $qualified = false;

        switch ($this->typeOfLoan->typeOfLoan) {
            case 'personal':
                if ($data['income'] >= 1000 && $data['income'] <= 3000) {
                    $qualified = true;

                    $this->loans = ['personal', 'guaranteed'];
                }
                break;

            case 'guaranteed':
                if ($data['income'] > 3000 && $data['income'] < 5000) {
                    $qualified = true;

                    $this->loans = ['personal', 'guaranteed'];
                }
                break;

            case 'consigned':
                if ($data['income'] >= 5000) {
                    $qualified = true;

                    $this->loans = self::TYPES_OF_LOANS;
                }
                break;

            default:

                break;
        }

        return $qualified;
    }

    private function loanInterestRate($loan)
    {
        return self::INTEREST_RATES_PER_LOAN["{$loan}"];
    }
}
