<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RegistrationRepository")
 */
class Registration
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $payment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\lesson", inversedBy="registrations")
     */
    private $lesson_id;

    /**
     * @ORM\ManyToOne(targetEntity="person", inversedBy="registrations")
     */
    private $person_id;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPayment(): ?int
    {
        return $this->payment;
    }

    public function setPayment(?int $payment): self
    {
        $this->payment = $payment;

        return $this;
    }

    public function getLessonId(): ?lesson
    {
        return $this->lesson_id;
    }

    public function setLessonId(?lesson $lesson_id): self
    {
        $this->lesson_id = $lesson_id;

        return $this;
    }

    public function getPersonId(): ?person
    {
        return $this->person_id;
    }

    public function setPersonId(?person $person_id): self
    {
        $this->person_id = $person_id;

        return $this;
    }

}
