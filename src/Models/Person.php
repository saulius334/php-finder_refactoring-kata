<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Models;

use DateTime;

final class Person
{
    public function __construct(private string $name, private DateTime $birthDate)
    {
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getBirthDate(): int
    {
        return $this->birthDate->getTimestamp();
    }

    public function setBirthDate(DateTime $birthDate): void
    {
        $this->birthDate = $birthDate;
    }
}
