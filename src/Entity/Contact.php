<?php


namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class Contact
{
    /**
     * @return string|null
     */
    public function getIdea(): ?string
    {
        return $this->idea;
    }

    /**
     * @param string|null $idea
     * @return Contact
     */
    public function setIdea(?string $idea): Contact
    {
        $this->idea = $idea;
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
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=100)
     */
    private $idea;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;
}