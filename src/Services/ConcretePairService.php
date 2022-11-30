<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Services;

use CodelyTV\FinderKata\Enums\Options;

class ConcretePairService
{
    public function __construct(private array $listOfAllPairs)
    {
    }

    public function getPair(Options $option): PairDTO
    {
        $answer = $this->listOfAllPairs[0];
        foreach ($this->listOfAllPairs as $pair) {
            $answer = $option === Options::Closest ?
            $this->getClosest($pair, $answer) : $this->getFurthest($pair, $answer);
        }
        return $answer;
    }
    private function getClosest(PairDTO $pair, PairDTO $answer): PairDTO
    {
        return $pair->getDistance() < $answer->getDistance() ? $pair : $answer;
    }

    private function getFurthest(PairDTO $pair, PairDTO $answer): PairDTO
    {
        return $pair->getDistance() > $answer->getDistance() ? $pair : $answer;
    }
}
