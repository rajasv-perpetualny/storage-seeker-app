<?php
/**
 * Created by PhpStorm.
 * User: Volmar Machado <vmachado@sparefoot.com>
 * Date: 10/31/17
 * Time: 2:27 PM
 */

namespace App\Models;


class Calendar
{
    private $year, $list;
    const ONE_DAY = 86400; // Number of seconds in one day
    public $holidays = '[]';
    public $closures = '[]';
    public $closedDays = '[]';
    public $closingTime = '[]';

    function __construct($officeHours, $year = null)
    {
        try {

            $this->year = (is_null($year))? (int) date("Y") : (int) $year;

            if (!is_array($officeHours) || ! is_int($this->year) || $this->year < 1997) {
                throw new Exception($year.' is not a valid year. Valid values are integers greater than 1996.');
            }

            $this->officeHours = $officeHours;

            $this->setList();
            $this->setHolidaysList();
            $this->setClosedDays();
            $this->setClosingTime();
        }

        catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    private function adjustFixedHoliday($timestamp)
    {
        $weekday = date("w", $timestamp);
        if ($weekday == 0)
        {
            return $timestamp + self::ONE_DAY;
        }
        if ($weekday == 6)
        {
            return $timestamp - self::ONE_DAY;
        }
        return $timestamp;
    }

    private function setList()
    {
        $this->list = array
        (
            array
            (
                "name" => "New Year's Day",
                // January 1st, if not Saturday/Sunday
                "timestamp" => $this->adjustFixedHoliday(mktime(0, 0, 0, 1, 1, $this->year))
            ),
            array
            (
                "name" => "Birthday of Martin Luther King, Jr.",
                // 3rd Monday of January
                "timestamp" => strtotime("3 Mondays", mktime(0, 0, 0, 1, 1, $this->year))
            ),
            array
            (
                "name" => "Wasthington's Birthday",
                // 3rd Monday of February
                "timestamp" => strtotime("3 Mondays", mktime(0, 0, 0, 2, 1, $this->year))
            ),
            array
            (
                "name" => "Memorial Day ",
                // last Monday of May
                "timestamp" => strtotime("last Monday of May $this->year")
            ),
            array
            (
                "name" => "Independence day ",
                // July 4, if not Saturday/Sunday
                "timestamp" => $this->adjustFixedHoliday(mktime(0, 0, 0, 7, 4, $this->year))
            ),
            array
            (
                "name" => "Labor Day ",
                // 1st Monday of September
                "timestamp" => strtotime("first Monday of September $this->year")
            ),
            array
            (
                "name" => "Columbus Day ",
                // 2nd Monday of October
                "timestamp" => strtotime("2 Mondays", mktime(0, 0, 0, 10, 1, $this->year))
            ),
            array
            (
                "name" => "Veteran's Day ",
                // November 11, if not Saturday/Sunday
                "timestamp" => $this->adjustFixedHoliday(mktime(0, 0, 0, 11, 11, $this->year))
            ),
            array
            (
                "name" => "Thanksgiving Day ",
                // 4th Thursday of November
                "timestamp" => strtotime("4 Thursdays", mktime(0, 0, 0, 11, 1, $this->year))
            ),
            array
            (
                "name" => "Christmas ",
                // December 25 every year, if not Saturday/Sunday
                "timestamp" => $this->adjustFixedHoliday(mktime(0, 0, 0, 12, 25, $this->year))
            )
        );
    }

    public function getList()
    {
        return $this->list;
    }

    public function isHoliday($timestamp)
    {
        foreach ($this->list as $holiday)
        {
            if ($timestamp == $holiday["timestamp"]) return true;
        }

        return false;
    }

    public function setHolidaysList()
    {
        $this->holidays = json_encode(array_map(function ($index) {
            return $index['timestamp'];
        }, $this->list));
    }

    public function setClosedDays()
    {
        $mappedDays = ['Sun' => '0,', 'Mon' => '1,', 'Tue' => '2,', 'Wed' => '3,', 'Thu' => '4,', 'Fri' => '5,', 'Sat' => '6,'];
        $openDays = [0, 1, 2, 3, 4, 5, 6];
        $offcieHours = $this->officeHours;

        $closedDays = array_filter($openDays, function ($current) use ($mappedDays, $offcieHours) {
            if(strpos($offcieHours[$current], 'Closed') !== false) {
                return true;
            }

            return in_array(substr($offcieHours[$current], 0, 3), $mappedDays);
        });

        $this->closedDays = '[' . implode(",", $closedDays) . ']';
    }

    public function setClosingTime()
    {
        $officeHours =['05:00' => 0];
        $closingTime = array_reduce($this->officeHours, function ($previous, $current) use (&$officeHours) {
            $hour = substr($current, -8, 5);
            if(!$hour) return;
            if(!isset($officeHours[$hour])) {
                $officeHours = array_merge($officeHours,[$hour => 1]);
            }
            $officeHours[$hour]++;
        });

        arsort($officeHours);
        $this->closingTime = array_keys($officeHours)[0];
    }
}