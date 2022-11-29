<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Services;

use CodelyTV\FinderKata\Models\Person;

final class PairDTO
{
    private Person $person1;
    private Person $person2;
    private int $distance;

    public function getPerson1(): Person
    {
        return $this->person1;
    }

    public function setPerson1(Person $person): void
    {
        $this->person1 = $person;
    }

    public function getPerson2(): Person
    {
        return $this->person2;
    }

    public function setPerson2(Person $person): void
    {
        $this->person2 = $person;
    }

    public function getDistance(): int
    {
        return $this->distance;
    }

    public function setDistance(int $distance): void
    {
        $this->distance = $distance;
    }
}
