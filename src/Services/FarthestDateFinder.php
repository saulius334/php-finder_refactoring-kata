<?php

declare(strict_types=1);

class FarthestDateFinder
{
    public function __construct(private array $personList)
    {
    }
    public function findFarthest(): array
    {
        $oldest = $this->personList[0]->getBirthDate();
        $youngest = $this->personList[0]->getBirthDate();
        foreach ($this->personList as $person) {
            if ($oldest > $person->getBirthDate())
            $oldest = $person->getBirthDate();
            if ($youngest < $person->getBirthDate()) {
                $youngest = $person->getBirthDate();
            }
        }
        return [$youngest, $oldest];
    }
    public function findClosest(): array
    {
        
    }
}