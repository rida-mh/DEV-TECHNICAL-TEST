<?php

namespace EneraTechTest\Specifications\ValueObjects;

use DateTime;
use Exception;

use PHPUnit\Framework\TestCase;

use EneraTechTest\Core\ValueObjects\Iso8601String;

class Iso8601StringTest extends TestCase
{
    public function test__ThrowExeption_If_StringMissesTime(): void
    {
        $this->expectException(Exception::class);

        $dateTimeString = "2023-01-01";

        new Iso8601String($dateTimeString);
    }

    public function test__ThrowException_If_StringMissesTimeZone(): void
    {
        $this->expectException(Exception::class);

        $dateTimeString = "2023-01-01T00:00:00";

        new Iso8601String($dateTimeString);
    }

    public function test__ProvideValidDateTime_If_StringIsCorrectUTC(): void
    {
        $dateTimeString = "2023-01-01T00:00:00Z";

        $isoDateTimeString = new Iso8601String($dateTimeString);

        $this->assertEquals("2023-01-01 00:00:00", $isoDateTimeString->asDateTime()->format("Y-m-d H:i:s"));
    }

    public function test__ProvideValidDateTime_If_StringIsCorrectWithOtherTimeZone(): void
    {
        $dateTimeString = "2023-01-01T00:00:00+06:00";

        $isoDateTimeString = new Iso8601String($dateTimeString);

        $this->assertEquals("2023-01-01 00:00:00", $isoDateTimeString->asDateTime()->format("Y-m-d H:i:s"));
    }

    public function test__ProvideValidDateTime_If_BuildWithDateTime(): void
    {
        $dateTime = new DateTime("2023-01-01 00:00:00");

        $isoDateTimeString = new Iso8601String($dateTime);

        $this->assertEquals("2023-01-01 00:00:00", $isoDateTimeString->asDateTime()->format("Y-m-d H:i:s"));
    }
}
