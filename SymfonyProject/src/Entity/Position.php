<?php

namespace App\Entity;

use App\Repository\PositionRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PositionRepository::class)
 */
class Position
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
    private $post;

    /**
     * @ORM\OneToMany(targetEntity=EmployeePosition::class, mappedBy="employeePost", orphanRemoval=true)
     */
    private $employeePositions;


    public function __construct()
    {
        $this->employeePositions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPost(): ?string
    {
        return $this->post;
    }

    public function setPost(string $post): self
    {
        $this->post = $post;

        return $this;
    }

    public function __toString()
    {
        return strval($this->getPost());
    }

    /**
     * @return Collection<int, EmployeePosition>
     */
    public function getEmployeePositions(): Collection
    {
        return $this->employeePositions;
    }

    public function addEmployeePosition(EmployeePosition $employeePosition): self
    {
        if (!$this->employeePositions->contains($employeePosition)) {
            $this->employeePositions[] = $employeePosition;
            $employeePosition->setEmployeePost($this);
        }

        return $this;
    }

    public function removeEmployeePosition(EmployeePosition $employeePosition): self
    {
        if ($this->employeePositions->removeElement($employeePosition)) {
            // set the owning side to null (unless already changed)
            if ($employeePosition->getEmployeePost() === $this) {
                $employeePosition->setEmployeePost(null);
            }
        }

        return $this;
    }

}
