<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraint as Assert;

class Contact {

    #[Assert\NotBlank]
    #[Assert\Length(min:2, max:100)]
    private ?string $firstname = null;

    #[Assert\NotBlank]
    #[Assert\Length(min:2, max:100)]
    private ?string $lastname = null;

    #[Assert\NotBlank]
    #[Assert\Regex('/[0-9]{10}/')]
    private ?string $phone = null;

    #[Assert\NotBlank]
    #[Assert\Email]
    private ?string $email = null;

    #[Assert\NotBlank]
    #[Assert\Length(min:10)]
    private ?string $message = null;

    private $property = null;

    /**
     * @return string|null
     */
    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    /**
     * @param string|null $firstname
     * @return Contact
     */
    public function setFirstname(?string $firstname): Contact
    {
        $this->firstname = $firstname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    /**
     * @param string|null $lastname
     * @return Contact
     */
    public function setLastname(?string $lastname): Contact
    {
        $this->lastname = $lastname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string|null $phone
     * @return Contact
     */
    public function setPhone(?string $phone): Contact
    {
        $this->phone = $phone;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string|null $email
     * @return Contact
     */
    public function setEmail(?string $email): Contact
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return Contact
     */
    public function setMessage(?string $message): Contact
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return null
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param null $property
     * @return Contact
     */
    public function setProperty($property)
    {
        $this->property = $property;
        return $this;
    }
}
