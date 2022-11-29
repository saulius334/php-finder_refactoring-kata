<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use CodelyTV\FinderKata\Services\ConcretePairService;
use CodelyTV\FinderKata\Services\PersonDTO;
use CodelyTV\FinderKata\Services\ListOfPairsService;
use InvalidArgumentException;

final class Finder
{
    public function __construct(private array $personList)
    {
        $this->listService = new ListOfPairsService($this->personList);
    }

    public function find(int $option): PersonDTO
    {
        $listOfAllPairs = $this->listService->getPairList();

        if (count($listOfAllPairs) < 1) {
            throw new InvalidArgumentException('Not enough people in list.');
        }

        $concretePair = new ConcretePairService($listOfAllPairs);
        return $concretePair->getPair($option);
    }
}
