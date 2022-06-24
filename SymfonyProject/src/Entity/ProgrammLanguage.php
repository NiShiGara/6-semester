<?php

namespace App\Entity;

use App\Repository\ProgrammLanguageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProgrammLanguageRepository::class)
 */
class ProgrammLanguage
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity=Employee::class, inversedBy="programmLanguages")
     */
    private $fio;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $language;

    public function __construct()
    {
        $this->fio = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Employee>
     */
    public function getFio(): Collection
    {
        return $this->fio;
    }

    public function addFio(Employee $fio): self
    {
        if (!$this->fio->contains($fio)) {
            $this->fio[] = $fio;
        }

        return $this;
    }

    public function removeFio(Employee $fio): self
    {
        $this->fio->removeElement($fio);

        return $this;
    }

    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function __toString()
    {
        return strval($this->getLanguage());
    }
}
