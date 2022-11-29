<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use CodelyTV\FinderKata\Services\ConcretePairService;
use CodelyTV\FinderKata\Services\PersonDTO;
use CodelyTV\FinderKata\Services\ListOfPairsService;

final class Finder
{
    public function __construct(private array $personList)
    {
    }

    public function find(int $option): PersonDTO
    {
        $dateFinder = new ListOfPairsService($this->personList);
        $listOfAllPairs = $dateFinder->getPairList();

        if (count($listOfAllPairs) < 1) {
            return new PersonDTO();
        }

        $concretePair = new ConcretePairService($listOfAllPairs);
        return $concretePair->getPair($option);
    }
}
