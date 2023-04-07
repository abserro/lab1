<?php

require_once 'vendor/autoload.php';

use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Validation;

class User
{

    private DateTime $dateTimeCreate;

    function __construct(private readonly string $id, private readonly string $name, private readonly string $email,
                         private readonly string $password)
    {
        $this->dateTimeCreate = new DateTime();

        $validator = Validation::createValidator();
        $idViolations = $validator->validate($id, [
            new Length([
                'min' => 8,
                'exactMessage' => "ID must contain 8 characters",
                'max' => 8,
            ]),
            new Regex([
                'message' => "ID must contain only digits",
                'pattern' => '/^\d+$/',
            ]),
        ]);

        $this->printViolations($idViolations);

        $nameViolations = $validator->validate($name, [
            new Length([
                'max' => 255,
                'maxMessage' => "Name must contain maximum 255 characters",
            ]),
            new NotBlank([
                'message' => "Name must be not empty",
            ]),
        ]);

        $this->printViolations($nameViolations);


        $emailViolations = $validator->validate($email, [
            new Email([
                'message' => "Email uncorrected",
            ]),
            new NotBlank([
                'message' => "Email must be not empty",
            ]),
        ]);

        $this->printViolations($emailViolations);

        $passwordViolations = $validator->validate($password, [
            new Length([
                'min' => 8,
                'max' => 20,
                'minMessage' => "Password must contain minimum 8 characters",
                'maxMessage' => "Password must contain maximum 8 characters",
            ]),
            new NotBlank([
                'message' => "Password must be not empty",
            ]),
        ]);

        $this->printViolations($passwordViolations);

        if (count($idViolations) === 0 && count($nameViolations) === 0 && count($emailViolations) === 0 && count($passwordViolations) === 0) {
            $this->dateTimeCreate = new DateTime('now');
        }
    }

    public function getDataTimeCreate(): DateTime
    {
        return $this->dateTimeCreate;
    }

    private function printViolations($violations): void
    {
        if (count($violations) !== 0) {
            echo "User ($this->name) failed validation: ";
            foreach ($violations as $violation) {
                echo "{$violation->getMessage()}<br>";
            }
        }
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}

