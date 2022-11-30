<?php

declare(strict_types=1);

namespace CodelyTV\FinderKata\Algorithm;

use CodelyTV\FinderKata\DTO\PairDTO;
use CodelyTV\FinderKata\Enums\Options;

interface FinderInterface
{
    public function __construct(array $personList);
    public function find(Options $option): PairDTO;
}
