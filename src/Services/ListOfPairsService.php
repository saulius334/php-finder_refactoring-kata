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
        $listOfAllPairs = [];
        for ($i = 0; $i < count($this->personList); $i++) {
            for ($j = $i + 1; $j < count($this->personList); $j++) {
                $result = new PersonDTO();

                if ($this->personList[$i]->getBirthDate() < $this->personList[$j]->getBirthDate()) {
                    $result->setPerson1($this->personList[$i]);
                    $result->setPerson2($this->personList[$j]);
                } else {
                    $result->setPerson1($this->personList[$j]);
                    $result->setPerson2($this->personList[$i]);
                }

                $result->setDistance($result->getPerson2()->getBirthDate()
                - $result->getPerson1()->getBirthDate());

                $listOfAllPairs[] = $result;
            }
        }
        return $listOfAllPairs;
    }
}