<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Services;

use CodelyTV\FinderKata\Algorithm\Options;

class ConcretePairService
{
    public function __construct(private array $listOfAllPairs)
    {
    }

    public function getPair(int $option): PersonDTO
    {
        $answer = $this->listOfAllPairs[0];
        foreach ($this->listOfAllPairs as $pair) {

            if ($option == Options::CLOSEST) {
                $answer = $this->getClosest($pair, $answer);
            }
            if ($option == Options::FURTHEST) {
                $answer = $this->getFurthest($pair, $answer);
            }
        }
        return $answer;
    }
    private function getClosest($pair, $answer)
    {
        return $pair->getDistance() < $answer->getDistance() ? $pair : $answer;
    }

    private function getFurthest($pair, $answer)
    {
        return $pair->getDistance() > $answer->getDistance() ? $pair : $answer;
    }
}
