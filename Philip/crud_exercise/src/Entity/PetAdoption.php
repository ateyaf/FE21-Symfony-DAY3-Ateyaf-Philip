<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PetAdoption
 *
 * @ORM\Table(name="pet_adoption", indexes={@ORM\Index(name="fk_user_id", columns={"fk_user_id"}), @ORM\Index(name="fk_animal_id", columns={"fk_animal_id"})})
 * @ORM\Entity
 */
class PetAdoption
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false, options={"unsigned"=true})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="date", type="date", nullable=true)
     */
    private $date;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_user_id", referencedColumnName="id")
     * })
     */
    private $fkUser;

    /**
     * @var \Animals
     *
     * @ORM\ManyToOne(targetEntity="Animals")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_animal_id", referencedColumnName="id")
     * })
     */
    private $fkAnimal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(?\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getFkUser(): ?User
    {
        return $this->fkUser;
    }

    public function setFkUser(?User $fkUser): self
    {
        $this->fkUser = $fkUser;

        return $this;
    }

    public function getFkAnimal(): ?Animals
    {
        return $this->fkAnimal;
    }

    public function setFkAnimal(?Animals $fkAnimal): self
    {
        $this->fkAnimal = $fkAnimal;

        return $this;
    }


}
