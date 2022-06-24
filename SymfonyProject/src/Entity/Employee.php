<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeeRepository::class)
 */
class Employee
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $FIO;

    /**
     * @ORM\Column(type="integer")
     */
    private $e_age;

    /**
     * @ORM\OneToOne(targetEntity=EmployeePosition::class, mappedBy="fio", cascade={"persist", "remove"})
     */
    private $employeePosition;

    /**
     * @ORM\ManyToMany(targetEntity=ProgrammLanguage::class, mappedBy="fio")
     */
    private $programmLanguages;
    
    public function __construct()
    {
        $this->employeeLanguages = new ArrayCollection();
        $this->pets = new ArrayCollection();
        $this->programmLanguages = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFIO(): ?string
    {
        return $this->FIO;
    }

    public function setFIO(string $FIO): self
    {
        $this->FIO = $FIO;

        return $this;
    }

    public function getEAge(): ?int
    {
        return $this->e_age;
    }

    public function setEAge(int $e_age): self
    {
        $this->e_age = $e_age;

        return $this;
    }

    public function __toString()
    {
        return strval($this->getFio());
    }

    public function getEmployeePosition(): ?EmployeePosition
    {
        return $this->employeePosition;
    }

    public function setEmployeePosition(EmployeePosition $employeePosition): self
    {
        // set the owning side of the relation if necessary
        if ($employeePosition->getFio() !== $this) {
            $employeePosition->setFio($this);
        }

        $this->employeePosition = $employeePosition;

        return $this;
    }

    /**
     * @return Collection<int, ProgrammLanguage>
     */
    public function getProgrammLanguages(): Collection
    {
        return $this->programmLanguages;
    }

    public function addProgrammLanguage(ProgrammLanguage $programmLanguage): self
    {
        if (!$this->programmLanguages->contains($programmLanguage)) {
            $this->programmLanguages[] = $programmLanguage;
            $programmLanguage->addFio($this);
        }

        return $this;
    }

    public function removeProgrammLanguage(ProgrammLanguage $programmLanguage): self
    {
        if ($this->programmLanguages->removeElement($programmLanguage)) {
            $programmLanguage->removeFio($this);
        }

        return $this;
    }

}
