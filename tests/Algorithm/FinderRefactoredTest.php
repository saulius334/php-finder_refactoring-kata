<?php

declare(strict_types=1);

namespace CodelyTV\FinderKataTest\Algorithm;

use Generator;
use PHPUnit\Framework\TestCase;
use CodelyTV\FinderKata\Models\Person;
use CodelyTV\FinderKata\Algorithm\Finder;
use CodelyTV\FinderKata\Algorithm\Options;
use InvalidArgumentException;

final class FinderRefactoredTest extends TestCase
{
    /**
     * @dataProvider ExceptionDataProvider
     */
    public function testFinderExceptions(array $listOfPersons, int $option, $expected): void
    {
        $this->expectException($expected);
        $finder = new Finder($listOfPersons);
        $finder->find($option);
    }
    public function ExceptionDataProvider(): Generator
    {
        yield 'test_should_return_empty_when_given_empty_list' => [
            [],
            Options::CLOSEST,
            InvalidArgumentException::class
        ];
        yield 'test_should_return_empty_when_given_one_person' => [
            [new Person("Mike", new \DateTime("1979-01-01"))],
            Options::CLOSEST,
            InvalidArgumentException::class
        ];
    }
    /**
     * @dataProvider FinderDataProvider
     */
    public function testFinder(array $listOfPersons, int $option, $expected): void
    {
        $finder = new Finder($listOfPersons);
        $result = $finder->find($option);
        $this->assertEquals($expected[0], $result->getPerson1());
        $this->assertEquals($expected[1], $result->getPerson2());
    }
    public function FinderDataProvider(): Generator
    {
        yield 'should_return_closest_two_for_two_people' => [
            [
                new Person("Sue", new \DateTime("1950-01-01")),
                new Person("Greg", new \DateTime("1952-05-01"))
            ],
            Options::CLOSEST,
            [
                new Person("Sue", new \DateTime("1950-01-01")),
                new Person("Greg", new \DateTime("1952-05-01"))
            ]
        ];
        yield 'should_return_furthest_two_for_two_people' => [
            [
                new Person("Mike", new \DateTime("1979-01-01")),
                new Person("Greg", new \DateTime("1952-05-01"))
            ],
            Options::FURTHEST,
            [
                new Person("Greg", new \DateTime("1952-05-01")),
                new Person("Mike", new \DateTime("1979-01-01"))
            ]
        ];
        yield 'should_return_furthest_two_for_four_people' => [
            [
                new Person("Sue", new \DateTime("1950-01-01")),
                new Person("Greg", new \DateTime("1952-05-01")),
                new Person("Sarah", new \DateTime("1982-01-01")),
                new Person("Mike", new \DateTime("1979-01-01")),
            ],
            Options::FURTHEST,
            [
                new Person("Sue", new \DateTime("1950-01-01")),
                new Person("Sarah", new \DateTime("1982-01-01"))
            ]
        ];

        yield 'should_return_closest_two_for_four_people' => [
            [
                new Person("Sue", new \DateTime("1950-01-01")),
                new Person("Greg", new \DateTime("1952-05-01")),
                new Person("Sarah", new \DateTime("1982-01-01")),
                new Person("Mike", new \DateTime("1979-01-01")),
            ],
            Options::CLOSEST,
            [
                new Person("Sue", new \DateTime("1950-01-01")),
                new Person("Greg", new \DateTime("1952-05-01"))
            ]
        ];

    }
}
