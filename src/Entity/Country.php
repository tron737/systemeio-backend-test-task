<?php

namespace App\Entity;

use App\Entity\Embeddable\Tax;
use App\Repository\CountryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CountryRepository::class)]
class Country
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 2)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Embedded(class: Tax::class, columnPrefix: 'tax_')]
    private Tax $tax;

    public function __construct()
    {
        $this->tax = new Tax();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getTax(): Tax
    {
        return $this->tax;
    }

    public function setTax(Tax $tax): self
    {
        $this->tax = $tax;

        return $this;
    }
}
