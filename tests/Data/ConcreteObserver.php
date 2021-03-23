<?php

declare(strict_types=1);

namespace Ngmy\Observer\Tests\Data;

use Ngmy\Observer\Observer;
use Ngmy\Observer\Subject;

class ConcreteObserver implements Observer
{
    /** @var string */
    private $state = '';
    /** @var ConcreteSubject */
    private $subject;

    public function __construct(ConcreteSubject $subject)
    {
        $this->subject = $subject;
        $this->subject->attach($this);
    }

    public function __destruct()
    {
        $this->subject->detach($this);
    }

    public function update(Subject $changedSubject): void
    {
        if ($changedSubject === $this->subject) {
            $this->state = $this->subject->getState();
            echo $this->state . \PHP_EOL;
        }
    }

    /**
     * @param mixed $other
     */
    public function equals($other): bool
    {
        return $other === $this;
    }
}
