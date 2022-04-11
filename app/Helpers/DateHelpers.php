<?php

namespace App\Helpers;
use Carbon\Carbon;

class DateHelpers{
    public static function formatDateInggris($string){
        $date = Carbon::parse($string);

        $day = $date->day;
        $month = $date->englishMonth;
        $year = $date->year;

        return $month." ".$day.", ".$year;
    }

    public static function formatDateInggrisWithTime($string){
        $dateTime = Carbon::parse($string);

        $day = $dateTime->day;
        $month = $dateTime->englishMonth;
        $year = $dateTime->year;

        $hour = $dateTime->hour;
        $minute = $dateTime->minute;
        $second = $dateTime->second;

        return $month." ".$day.", ".$year.".  ".$hour.":".$minute.":".$second;
    }

    public static function formatDateLocal($string){
        $date = Carbon::parse($string);

        $day = $date->day;
        $month = $date->locale('id')->monthName;
        $year = $date->year;

        return $day." ".$month." ".$year;
    }

    public static function formatDateLocalWithTime($string){
        $dateTime = Carbon::parse($string);

        $day = $dateTime->day;
        $month = $dateTime->locale('id')->monthName;
        $year = $dateTime->year;

        $hour = $dateTime->hour;
        $minute = $dateTime->minute;
        $second = $dateTime->second;

        return $day." ".$month." ".$year.",  ".$hour.":".$minute.":".$second;
    }
}

?>