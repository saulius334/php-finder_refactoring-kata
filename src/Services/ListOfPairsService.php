<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Services;

use CodelyTV\FinderKata\DTO\PairDTO;

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
                $pair = new PairDTO();

                if ($this->personList[$i]->getBirthDate() < $this->personList[$j]->getBirthDate()) {
                    $pair->setPerson1($this->personList[$i]);
                    $pair->setPerson2($this->personList[$j]);
                } else {
                    $pair->setPerson1($this->personList[$j]);
                    $pair->setPerson2($this->personList[$i]);
                }

                $pair->setDistance($pair->getPerson2()->getBirthDate()
                - $pair->getPerson1()->getBirthDate());

                $listOfAllPairs[] = $pair;
            }
        }
        return $listOfAllPairs;
    }
}
