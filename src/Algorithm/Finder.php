<?php

declare(strict_types = 1);

namespace CodelyTV\FinderKata\Algorithm;

use CodelyTV\FinderKata\Services\PersonDTO;

final class Finder
{
    public function __construct(private array $personList)
    {
    }

    public function find(int $option): PersonDTO
    {
        /** @var F[] $tr */
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
        print_r($tr);
        if (count($tr) < 1) {
            return new PersonDTO();
        }

        $answer = $tr[0];

        foreach ($tr as $person) {
            switch ($option) {
                case Options::CLOSEST:
                    if ($person->distance < $answer->distance) {
                        $answer = $person;
                    }
                    break;

                case Options::FURTHEST:
                    if ($person->distance > $answer->distance) {
                        $answer = $person;
                    }
                    break;
            }
        }

        return $answer;
    }
}
