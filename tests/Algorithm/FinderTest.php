<?php

declare(strict_types=1);

namespace CodelyTV\FinderKataTest\Algorithm;

use Generator;
use PHPUnit\Framework\TestCase;
use CodelyTV\FinderKata\Models\Person;
use CodelyTV\FinderKata\Algorithm\Finder;
use CodelyTV\FinderKata\Algorithm\Options;
use InvalidArgumentException;

final class FinderTest extends TestCase
{
    protected function setUp(): void
    {
        $this->sue = new Person("Sue", new \DateTime("1950-01-01"));
        $this->greg = new Person("Greg", new \DateTime("1952-05-01"));
        $this->sarah = new Person("Sarah", new \DateTime("1982-01-01"));
        $this->mike = new Person("Mike", new \DateTime("1979-01-01"));
    }
    public function test_should_return_empty_when_given_empty_list(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $list   = [];
        $finder = new Finder($list);

        $result = $finder->find(Options::CLOSEST);
        $this->assertEquals(null, $result->getPerson1());
        $this->assertEquals(null, $result->getPerson2());
    }

    /** @test */
    public function should_return_empty_when_given_one_person(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $list   = [];
        $list[] = $this->sue;
        $finder = new Finder($list);

        $result = $finder->find(Options::CLOSEST);

        $this->assertEquals(null, $result->getPerson1());
        $this->assertEquals(null, $result->getPerson2());
    }

    /** @test */
    public function should_return_closest_two_for_two_people(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Options::CLOSEST);
        $this->assertEquals($this->sue, $result->getPerson1());
        $this->assertEquals($this->greg, $result->getPerson2());
    }

    /** @test */
    public function should_return_furthest_two_for_two_people(): void
    {
        $list   = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Options::FURTHEST);

        $this->assertEquals($this->greg, $result->getPerson1());
        $this->assertEquals($this->mike, $result->getPerson2());
    }

    /** @test */
    public function should_return_furthest_two_for_four_people(): void
    {
        $list   = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Options::FURTHEST);
        // print_r($result);


        $this->assertEquals($this->sue, $result->getPerson1());
        $this->assertEquals($this->sarah, $result->getPerson2());
    }

    /**
     * @test
     */
    public function should_return_closest_two_for_four_people(): void
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
