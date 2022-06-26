<?php

declare(strict_types=1);

namespace OutDriver\Domain\Driver\Car\History\Accidents;

use Exception;

final class Accidents
{
    public string $reason;
    private \DateTimeImmutable $date;

    /** @throws Exception */
    public function __construct(\DateTimeImmutable $date, string $reason)
    {
        $this->setDate($date);
        $this->setReason($reason);
    }

    /** @throws Exception */
    private function setDate(\DateTimeImmutable $date): void
    {
        if($this->date > new \DateTimeImmutable())
            throw new Exception("Invalid accident date!");

        $this->date = $date;
    }

    private function setReason(string $reason): void
    {
        $this->reason = $reason;
    }
}