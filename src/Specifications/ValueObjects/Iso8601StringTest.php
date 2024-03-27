<?php

namespace EneraTechTest\Specifications\ValueObjects;

use DateTime;
use Exception;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;
use EneraTechTest\Core\ValueObjects\Iso8601String;

class Iso8601StringTest extends TestCase
{
    public function test__Should_Throw_Exeption_If_String_Misses_Time(): void
    {
        $this->expectException(Exception::class);

        $dateTimeString = "2023-01-01";

        $isoDateTimeString = new Iso8601String($dateTimeString);
    }

    public function test__Should_Throw_Exception_If_String_Misses_TimeZone(): void
    {
        $this->expectException(Exception::class);

        $dateTimeString = "2023-01-01T00:00:00";

        $isoDateTimeString = new Iso8601String($dateTimeString);
    }

    public function test__Should_Provide_Valid_DateTime_If_String_Is_Correct_UTC(): void
    {
        $dateTimeString = "2023-01-01T00:00:00Z";

        $isoDateTimeString = new Iso8601String($dateTimeString);

        assertEquals("2023-01-01 00:00:00", $isoDateTimeString->asDateTime()->format("Y-m-d H:i:s"));
    }

    public function test__Should_Provide_Valid_DateTime_If_String_Is_Correct_With_Other_TimeZone(): void
    {
        $dateTimeString = "2023-01-01T00:00:00+06:00";

        $isoDateTimeString = new Iso8601String($dateTimeString);

        assertEquals("2023-01-01 00:00:00", $isoDateTimeString->asDateTime()->format("Y-m-d H:i:s"));
    }

    public function test__Should_Provide_Valid_DateTime_If_date_Is_DateTime(): void
    {
        $dateTime = new DateTime("2023-01-01 00:00:00");

        $isoDateTimeString = new Iso8601String($dateTime);

        assertEquals("2023-01-01 00:00:00", $isoDateTimeString->asDateTime()->format("Y-m-d H:i:s"));
    }
}
