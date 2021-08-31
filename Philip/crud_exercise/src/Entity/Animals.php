<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Animals
 *
 * @ORM\Table(name="animals")
 * @ORM\Entity
 */
class Animals
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
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=100, nullable=false)
     */
    private $picture;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=100, nullable=false)
     */
    private $location;

    /**
     * @var string|null
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=true, options={"default"="Lorem ipsum dolor sit amet."})
     */
    private $description = 'Lorem ipsum dolor sit amet.';

    /**
     * @var string|null
     *
     * @ORM\Column(name="size", type="string", length=255, nullable=true, options={"default"="small"})
     */
    private $size = 'small';

    /**
     * @var int
     *
     * @ORM\Column(name="age", type="integer", nullable=false, options={"unsigned"=true})
     */
    private $age;

    /**
     * @var string|null
     *
     * @ORM\Column(name="hobbies", type="text", length=65535, nullable=true, options={"default"="Consetetur sadipscing elitr, sed diam."})
     */
    private $hobbies = 'Consetetur sadipscing elitr, sed diam.';

    /**
     * @var string
     *
     * @ORM\Column(name="breed", type="string", length=100, nullable=false)
     */
    private $breed;

    /**
     * @var string|null
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=true, options={"default"="free"})
     */
    private $status = 'free';

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(?string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getHobbies(): ?string
    {
        return $this->hobbies;
    }

    public function setHobbies(?string $hobbies): self
    {
        $this->hobbies = $hobbies;

        return $this;
    }

    public function getBreed(): ?string
    {
        return $this->breed;
    }

    public function setBreed(string $breed): self
    {
        $this->breed = $breed;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }


}
