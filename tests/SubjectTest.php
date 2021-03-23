<?php

declare(strict_types=1);

namespace Ngmy\Observer\Tests;

use Ngmy\Observer\Observer;

class SubjectTest extends TestCase
{
    /**
     * @return array<int, mixed>
     *
     * @phpstan-return list<mixed>
     */
    public function attachProvider(): array
    {
        return [
            [
                [Data\ConcreteObserver::class],
            ],
            [
                [Data\ConcreteObserver::class, Data\ConcreteObserver::class],
            ],
            [
                [],
            ],
        ];
    }

    /**
     * @param array<int, string> $observerClasses
     * @dataProvider attachProvider
     *
     * @phpstan-param list<class-string<Observer>> $observerClasses
     */
    public function testAttach(array $observerClasses): void
    {
        $subject = new Data\ConcreteSubject();
        \assert(\method_exists($subject, 'getObservers'));
        $expected = [];
        foreach ($observerClasses as $observerClass) {
            $expected[] = new $observerClass($subject);
        }
        $actual = $subject->getObservers();
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array<int, mixed>
     *
     * @phpstan-return list<mixed>
     */
    public function detachProvider(): array
    {
        return [
            [
                [Data\ConcreteObserver::class],
            ],
            [
                [Data\ConcreteObserver::class, Data\ConcreteObserver::class],
            ],
            [
                [],
            ],
        ];
    }

    /**
     * @param array<int, string> $observerClasses
     * @dataProvider detachProvider
     *
     * @phpstan-param list<class-string<Observer>> $observerClasses
     */
    public function testDetach(array $observerClasses): void
    {
        $subject = new Data\ConcreteSubject();
        \assert(\method_exists($subject, 'getObservers'));
        $observers = [];
        foreach ($observerClasses as $observerClass) {
            $observers[] = new $observerClass($subject);
        }
        foreach ($observers as $observer) {
            $subject->detach($observer);
        }
        $actual = $subject->getObservers();
        $this->assertEmpty($actual);
    }

    /**
     * @return array<int, mixed>
     *
     * @phpstan-return list<mixed>
     */
    public function notifyProvider(): array
    {
        return [
            [
                [Data\ConcreteObserver::class],
            ],
            [
                [Data\ConcreteObserver::class, Data\ConcreteObserver::class],
            ],
            [
                [],
            ],
        ];
    }

    /**
     * @param array<int, string> $observerClasses
     * @dataProvider notifyProvider
     *
     * @phpstan-param list<class-string<Observer>> $observerClasses
     */
    public function testNofity(array $observerClasses): void
    {
        $subject = new Data\ConcreteSubject();
        \assert(\method_exists($subject, 'getObservers'));
        $observers = [];
        foreach ($observerClasses as $observerClass) {
            $observers[] = new $observerClass($subject);
        }
        $state = 'Test the observer pattern';
        $expected = \str_repeat($state . \PHP_EOL, \count($observers));
        \ob_start();
        $subject->setState($state);
        $actual = \ob_get_clean();
        $this->assertEquals($expected, $actual);
    }
}
