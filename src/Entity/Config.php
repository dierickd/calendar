<?php

namespace App\Entity;

use App\Repository\ConfigRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfigRepository::class)]
class Config
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $opening = [];

    #[ORM\Column]
    private ?bool $is_open_holidays = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOpening(): array
    {
        return $this->opening;
    }

    public function setOpening(array $opening): static
    {
        $this->opening = $opening;

        return $this;
    }

    public function isIsOpenHolidays(): ?bool
    {
        return $this->is_open_holidays;
    }

    public function setIsOpenHolidays(bool $is_open_holidays): static
    {
        $this->is_open_holidays = $is_open_holidays;

        return $this;
    }
}
