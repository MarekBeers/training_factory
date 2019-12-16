<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use phpDocumentor\Reflection\Types\Integer;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LessonRepository")
 */
class Lesson
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $location;

    /**
     * @ORM\Column(type="integer", length=255)
     */
    private $max_persons;

    /**
     * @ORM\ManyToOne(targetEntity="person", inversedBy="lessons")
     */
    private $instructor_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\training", inversedBy="lessons")
     */
    private $training_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Registration", mappedBy="lesson_id")
     */
    private $registrations;

    public function __construct()
    {
        $this->registrations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTime(): ?\DateTimeInterface
    {
        return $this->time;
    }

    public function setTime(\DateTimeInterface $time): self
    {
        $this->time = $time;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

        return $this;
    }

    public function getMaxPersons(): ?int
    {
        return $this->max_persons;
    }

    public function setMaxPersons(Integer $max_persons): self
    {
        $this->max_persons = $max_persons;

        return $this;
    }

    public function getInstructorId(): ?person
    {
        return $this->instructor_id;
    }

    public function setInstructorId(?person $instructor_id): self
    {
        $this->instructor_id = $instructor_id;

        return $this;
    }

    public function getTrainingId(): ?training
    {
        return $this->training_id;
    }

    public function setTrainingId(?training $training_id): self
    {
        $this->training_id = $training_id;

        return $this;
    }

    /**
     * @return Collection|Registration[]
     */
    public function getRegistrations(): Collection
    {
        return $this->registrations;
    }

    public function addRegistration(Registration $registration): self
    {
        if (!$this->registrations->contains($registration)) {
            $this->registrations[] = $registration;
            $registration->setLessonId($this);
        }

        return $this;
    }

    public function removeRegistration(Registration $registration): self
    {
        if ($this->registrations->contains($registration)) {
            $this->registrations->removeElement($registration);
            // set the owning side to null (unless already changed)
            if ($registration->getLessonId() === $this) {
                $registration->setLessonId(null);
            }
        }

        return $this;
    }
}
