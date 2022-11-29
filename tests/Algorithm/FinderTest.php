<?php

declare(strict_types=1);

namespace CodelyTV\FinderKataTest\Algorithm;

use PHPUnit\Framework\TestCase;
use CodelyTV\FinderKata\Models\Person;
use CodelyTV\FinderKata\Algorithm\Finder;
use CodelyTV\FinderKata\Algorithm\Options;
use InvalidArgumentException;

final class FinderTest extends TestCase
{
    private Person $sue;
    private Person $greg;
    private Person $sarah;
    private Person $mike;
    protected function setUp(): void
    {
        $this->sue = new Person("Sue", new \DateTime("1950-01-01"));
        $this->greg = new Person("Greg", new \DateTime("1952-05-01"));
        $this->sarah = new Person("Sarah", new \DateTime("1982-01-01"));
        $this->mike = new Person("Mike", new \DateTime("1979-01-01"));
    }
    public function testShouldReturnEmptyWhenGivenEmptyList(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $list   = [];
        $finder = new Finder($list);

        $result = $finder->find(Options::CLOSEST);
        $this->assertEquals(null, $result->getPerson1());
        $this->assertEquals(null, $result->getPerson2());
    }

    public function testShouldReturnEmptyWhenGivenOnePerson(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $list   = [];
        $list[] = $this->sue;
        $finder = new Finder($list);

        $result = $finder->find(Options::CLOSEST);

        $this->assertEquals(null, $result->getPerson1());
        $this->assertEquals(null, $result->getPerson2());
    }

    public function testShouldReturnClosestTwoForTwoPeople(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Options::CLOSEST);
        $this->assertEquals($this->sue, $result->getPerson1());
        $this->assertEquals($this->greg, $result->getPerson2());
    }

    public function testShouldReturnFurthestTwoForTwoPeople(): void
    {
        $list   = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Options::FURTHEST);

        $this->assertEquals($this->greg, $result->getPerson1());
        $this->assertEquals($this->mike, $result->getPerson2());
    }

    public function testShouldReturnFurthestTwoForFourPeople(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Options::FURTHEST);

        $this->assertEquals($this->sue, $result->getPerson1());
        $this->assertEquals($this->sarah, $result->getPerson2());
    }

    public function testShouldReturnClosestTwoForFourPeople(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Options::CLOSEST);

        $this->assertEquals($this->sue, $result->getPerson1());
        $this->assertEquals($this->greg, $result->getPerson2());
    }
}
