<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Exception\ValidatorException;

class LoginValidator
{
    /**
     * @param  string  $email
     * @param  string  $password
     * @return bool
     */
    public function validate(string $email, string $password): bool
    {
        // Validate email
        $errors = Validation::createValidator()->validate(
            $email,
            [
                new Assert\NotBlank(),
                new Assert\Email(),
            ]
        );
        if (count($errors) > 0) {
            throw new ValidatorException((string) $errors);
        }

        // Validate password
        $errors = Validation::createValidator()->validate(
            $password,
            [
                new Assert\NotBlank(),
                new Assert\Length(['min' => 8]),
            ]
        );
        if (count($errors) > 0) {
            throw new ValidatorException((string) $errors);
        }

        return true;
    }
}
