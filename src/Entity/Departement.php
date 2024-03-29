<?php

namespace App\Entity;

use App\Repository\DepartementRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Table('departments')]
#[ORM\Entity(repositoryClass: DepartementRepository::class)]
class Departement
{
    #[ORM\Id]
    #[ORM\Column(name: 'dept_no', type: 'string', length: 4)]
    private ?string $deptNo = null;

    #[ORM\Column(length: 40, unique:true)]
    private ?string $deptName = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $roi = null;

    #[ORM\OneToMany(mappedBy: 'departement', targetEntity: DeptTitle::class)]
    private Collection $deptTitles;
/*
    #[ORM\ManyToOne(inversedBy: 'departement')]
    #[ORM\JoinColumn(name: 'dept_no', referencedColumnName: 'dept_no')]
    private ?DeptManager $deptManager = null;


*/
    public function __construct()
    {
        $this->deptTitles = new ArrayCollection();
    }

    public function getDeptNo(): ?string
    {
        return $this->deptNo;
    }

    public function getDeptName(): ?string
    {
        return $this->deptName;
    }

    public function setDeptName(string $deptName): static
    {
        $this->deptName = $deptName;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getRoi(): ?string
    {
        return $this->roi;
    }

    public function setRoi(?string $roi): static
    {
        $this->roi = $roi;

        return $this;
    }

    /**
     * @return Collection<int, DeptTitle>
     */
    public function getDeptTitles(): Collection
    {
        return $this->deptTitles;
    }

    public function addDeptTitle(DeptTitle $deptTitle): static
    {
        if (!$this->deptTitles->contains($deptTitle)) {
            $this->deptTitles->add($deptTitle);
            $deptTitle->setDepartement($this);
        }

        return $this;
    }

    public function removeDeptTitle(DeptTitle $deptTitle): static
    {
        if ($this->deptTitles->removeElement($deptTitle)) {
            // set the owning side to null (unless already changed)
            if ($deptTitle->getDepartement() === $this) {
                $deptTitle->setDepartement(null);
            }
        }

        return $this;
    }
/*
    public function getDeptManager(): ?DeptManager
    {
        return $this->deptManager;
    }

    public function setDeptManager(?DeptManager $deptManager): static
    {
        $this->deptManager = $deptManager;

        return $this;
    } 
    
  */
}
