<?php

namespace EneraTechTest\Core\ValueObjects;

use DateTime;
use Exception;
use JsonSerializable;

class Iso8601String implements JsonSerializable
{
    private string $iso8601String;

    public function __construct(string|DateTime|int $date)
    {
        if (is_int($date)) {
            $this->set(date('Y-m-d\TH:i:s\Z', $date));
        } else if ($date instanceof DateTime) {
            $this->set($date->format('Y-m-d\TH:i:s\Z'));
        } else {
            $this->set($date);
        }
    }
    private function set(string $dateTimeString): void
    {
        if (!$this->isIso8601($dateTimeString)) {

            throw new Exception("DateTime '{$dateTimeString}' is not formated following ISO 8601 standard");
        }

        $this->iso8601String = $dateTimeString;
    }

    public function __string(): string
    {
        return $this->iso8601String;
    }

    public function asDateTime(): DateTime
    {
        return new DateTime($this->iso8601String);
    }

    private function isIso8601(string $dateTimeString)
    {
        $iso8061Regex = "/\d{4}-[01]\d-[0-3]\dT[0-2]\d:[0-5]\d:[0-5]\d(?:\.\d{1,3})?([+-][0-2]\d:[0-5]\d|Z)/";

        return preg_match($iso8061Regex, $dateTimeString);
    }

    public function jsonSerialize(): mixed
    {
        return $this->__string();
    }
}
