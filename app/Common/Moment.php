<?php

namespace App\Common;

use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;

/*
    Just a handy wrapper for Carbon
*/
class Moment
{
    public const SQL_DATETIME_FORMAT = 'Y-m-d H:i:s';
    public const SQL_DATE_FORMAT = 'Y-m-d';

    public const MONTHS = [
        1  => 'January',
        2  => 'February',
        3  => 'March',
        4  => 'April',
        5  => 'May',
        6  => 'June',
        7  => 'July',
        8  => 'August',
        9  => 'September',
        10 => 'October',
        11 => 'November',
        12 => 'December',
    ];

    public static function now($tz = null)
    {
        return Carbon::now($tz);
    }

    public static function today()
    {
        return Carbon::today();
    }

    public static function parse($value, $tz = null)
    {
        return Carbon::parse($value, $tz);
    }

    public static function fromParts($year = null, $month = null, $day = null, $hour = null, $minute = null, $second = null)
    {
        $datetime = self::now();

        if ($year) {
            $datetime->year($year);
        }

        if ($month) {
            $datetime->month($month);
        }

        if ($day) {
            $datetime->day($day);
        }

        if ($hour) {
            $datetime->hour($hour);
        }

        if ($minute) {
            $datetime->minute($minute);
        }

        if ($second) {
            $datetime->second($second);
        }

        return $datetime;
    }

    public static function createFromTimestamp($timestamp)
    {
        return Carbon::createFromTimestamp($timestamp);
    }

    public static function getTimeRange($lower = 0, $upper = 86400, $step = 3600, $format = 'g:i A')
    {
        foreach (range($lower, $upper, $step) as $increment) {
            $increment = gmdate('H:i', $increment);

            $date = self::parse($increment);

            $times[$increment] = $date->format($format);
        }

        return $times;
    }

    public static function getMonthString($integer)
    {
        return self::MONTHS[$integer];
    }
    
    public static function getMonthNumber(string $monthName): int
    {
        return array_flip(self::MONTHS)[$monthName];
    }

    public static function getNextMonth($integer)
    {
        return array_key_exists($integer + 1, self::MONTHS) ? self::MONTHS[$integer + 1] : self::MONTHS[1];
    }

    public static function addMonth($date)
    {
        $old = self::parse($date);
        $new = self::parse($date)->addMonthNoOverflow();
        if ($old->isLastOfMonth()) {
            while (! $new->isLastOfMonth()) {
                $new->addDay();
            }
        }
        return $new;
    }

    public static function getYearString($timestamp)
    {
        return $timestamp->format('Y');
    }

    public static function isInPast($timestamp)
    {
        if (!$timestamp) {
            return true;
        }
        if (is_string($timestamp)) {
            $timestamp = self::parse($timestamp, self::getCurrentUserTimezone());
        }
        return $timestamp->isAfter(self::now(self::getCurrentUserTimezone()));
    }

    public static function createFromFormat($format, $string)
    {
        return Carbon::createFromFormat($format, $string);
    }

    public static function convertHoursToMinutes($hours)
    {
        return bcmul($hours, Carbon::MINUTES_PER_HOUR);
    }
    
    public static function getCurrentUserTimezone()
    {
        return (Auth::user()->timezone) ?? config('app.timezone');
    }
}
