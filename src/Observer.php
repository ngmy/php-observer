<?php

declare(strict_types=1);

namespace Ngmy\Observer;

interface Observer
{
    public function update(Subject $changedSubject): void;
    /**
     * @param mixed $other
     */
    public function equals($other): bool;
}
