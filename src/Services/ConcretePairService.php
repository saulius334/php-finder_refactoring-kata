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

            switch ($option) {
                case Options::CLOSEST:
                    if ($pair->distance < $answer->distance) {
                        $answer = $pair;
                    }
                    break;

                case Options::FURTHEST:
                    if ($pair->distance > $answer->distance) {
                        $answer = $pair;
                    }
                    break;
            }
        }
        return $answer;
    }
}
