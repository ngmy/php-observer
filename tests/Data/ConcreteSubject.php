<?php

declare(strict_types=1);

namespace Ngmy\Observer\Tests\Data;

use Ngmy\Observer\Observer;
use Ngmy\Observer\Subject;

class ConcreteSubject extends Subject
{
    /** @var string */
    private $state = '';

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
        $this->notify();
    }

    /**
     * @return array<int, Observer>
     *
     * @phpstan-return list<Observer>
     */
    public function getObservers(): array
    {
        return $this->observers;
    }

    /**
     * @param array<int, Observer> $observers
     *
     * @phpstan-param list<Observer> $observers
     */
    public function withObservers(array $observers): self
    {
        $new = new self();
        $new->observers = $observers;
        return $new;
    }
}
