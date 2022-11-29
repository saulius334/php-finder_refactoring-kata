<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Services;

use CodelyTV\FinderKata\Services\PersonDTO;

class ListOfPairsService
{
    public function __construct(private array $personList)
    {
    }

    public function getPairList(): array
    {
        $tr = [];
        for ($i = 0; $i < count($this->personList); $i++) {
            for ($j = $i + 1; $j < count($this->personList); $j++) {
                $result = new PersonDTO();

                if ($this->personList[$i]->getBirthDate() < $this->personList[$j]->getBirthDate()) {
                    $result->person1 = $this->personList[$i];
                    $result->person2 = $this->personList[$j];
                } else {
                    $result->person1 = $this->personList[$j];
                    $result->person2 = $this->personList[$i];
                }

                $result->distance = $result->person2->getBirthDate()
                    - $result->person1->getBirthDate();

                $tr[] = $result;
            }
        }
        return $tr;
    }
}