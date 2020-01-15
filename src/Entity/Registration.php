<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $payment;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\lesson", inversedBy="registrations")
     */
    private $lesson_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\user", inversedBy="registrations")
     */
    private $user;


    public function __construct()
    {
        $this->user = new ArrayCollection();
    }



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

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }
//    public function __toString()
//    {
//        // TODO: Implement __toString() method.
//        return $this->
//    }


}
