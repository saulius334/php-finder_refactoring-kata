<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

use InvalidArgumentException;
use CodelyTV\FinderKata\DTO\PairDTO;
use CodelyTV\FinderKata\Enums\Options;
use CodelyTV\FinderKata\Services\ListOfPairsService;
use CodelyTV\FinderKata\Services\ConcretePairService;

final class Finder implements FinderInterface
{
    private ListOfPairsService $listService;
    public function __construct(private array $personList)
    {
        $this->listService = new ListOfPairsService($this->personList);
    }

    public function find(Options $option): PairDTO
    {
        $listOfAllPairs = $this->listService->getPairList();

        if (count($listOfAllPairs) < 1) {
            throw new InvalidArgumentException('Not enough people in list.');
        }

        $concretePair = new ConcretePairService($listOfAllPairs);
        return $concretePair->getPair($option);
    }
}
