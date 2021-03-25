<?php

declare(strict_types=1);

namespace Ngmy\Observer;

abstract class Subject
{
    /**
     * @var array<int, Observer>
     * @phpstan-var list<Observer>
     */
    protected $observers = [];

    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function detach(Observer $observer): void
    {
        foreach ($this->observers as $i => $o) {
            if ($o->equals($observer)) {
                unset($this->observers[$i]);
                $this->observers = \array_values($this->observers);
                return;
            }
        }
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }
}
