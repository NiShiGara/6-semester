<?php

namespace App\Entity;

use App\Repository\EmployeePositionRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=EmployeePositionRepository::class)
 */
class EmployeePosition
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Employee::class, inversedBy="employeePosition", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $fio;

    /**
     * @ORM\ManyToOne(targetEntity=Position::class, inversedBy="employeePositions")
     * @ORM\JoinColumn(nullable=false)
     */
    private $employeePost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFio(): ?Employee
    {
        return $this->fio;
    }

    public function setFio(Employee $fio): self
    {
        $this->fio = $fio;

        return $this;
    }

    public function getEmployeePost(): ?Position
    {
        return $this->employeePost;
    }

    public function setEmployeePost(?Position $employeePost): self
    {
        $this->employeePost = $employeePost;

        return $this;
    }
}
