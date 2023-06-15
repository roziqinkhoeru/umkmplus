<?php

namespace App\Helpers;

use Carbon\Carbon;

/**
 * Format response.
 */
class CustomDate
{
    public static function setDate($param)
    {
        return $param ? date("d-m-Y", strtotime($param)) : '-';
    }

    public static function hari($date)
    {
        $day = date('D', strtotime($date));
        $dayList = array(
            'Sun' => 'Minggu',
            'Mon' => 'Senin',
            'Tue' => 'Selasa',
            'Wed' => 'Rabu',
            'Thu' => 'Kamis',
            'Fri' => 'Jumat',
            'Sat' => 'Sabtu'
        );
        return $dayList[$day];
    }

    public static function pukul($date)
    {
        $d = substr($date, 11, 5);
        return $d;
    }

    public static function tanggal($date)
    {
        $d = substr($date, 8, 2);
        return $d;
    }

    public static function bulan($date)
    {
        $m = substr($date, 5, 2);
        switch ($m) {
            case 1:
                return "Januari";
            case 2:
                return "Februari";
            case 3:
                return "Maret";
            case 4:
                return "April";
            case 5:
                return "Mei";
            case 6:
                return "Juni";
            case 7:
                return "Juli";
            case 8:
                return "Agustus";
            case 9:
                return "September";
            case 10:
                return "Oktober";
            case 11:
                return "November";
            case 12:
                return "Desember";
        }
    }

    public static function bulanDariAngka($angka)
    {
        switch ($angka) {
            case 1:
                return "Januari";
            case 2:
                return "Februari";
            case 3:
                return "Maret";
            case 4:
                return "April";
            case 5:
                return "Mei";
            case 6:
                return "Juni";
            case 7:
                return "Juli";
            case 8:
                return "Agustus";
            case 9:
                return "September";
            case 10:
                return "Oktober";
            case 11:
                return "November";
            case 12:
                return "Desember";
        }
    }

    public static function month($date)
    {
        $m = substr($date, 5, 2);
        switch ($m) {
            case 1:
                return "Jan";
            case 2:
                return "Feb";
            case 3:
                return "Mar";
            case 4:
                return "Apr";
            case 5:
                return "Mei";
            case 6:
                return "Jun";
            case 7:
                return "Jul";
            case 8:
                return "Aug";
            case 9:
                return "Sep";
            case 10:
                return "Oct";
            case 11:
                return "Nov";
            case 12:
                return "Des";
        }
    }

    public static function bulanAngka($date)
    {
        $y = substr($date, 5, 2);
        return $y;
    }

    public static function tahun($date)
    {
        $y = substr($date, 0, 4);
        return $y;
    }

    public static function tglIndo($date)
    {
        $d = self::tanggal($date);
        $m = self::bulan($date);
        $y = self::tahun($date);
        return $d . " " . $m . " " . $y;
    }

    public static function indoDate($date)
    {
        $d = self::tanggal($date);
        $m = self::month($date);
        $y = self::tahun($date);
        return $d . " " . $m . " " . $y;
    }

    public static function bulanTahun($date)
    {
        return self::bulan($date) . ' ' . self::tahun($date);
    }

    public static function tglWaktu($date)
    {
        return self::tglIndo($date) . ' pukul ' . self::pukul($date);
    }

    public static function hariTglWaktu($date)
    {
        return self::hari($date) . ', ' . self::tglIndo($date) . ' pukul ' . self::pukul($date);
    }

    public static function hariTgl($date)
    {
        return self::hari($date) . ', ' . self::tglIndo($date);
    }

    public static function tglDefault($date)
    {
        $d = self::tanggal($date);
        $m = self::bulanAngka($date);
        $y = self::tahun($date);
        return $d . "/" . $m . "/" . $y;
    }

    public static function getFormatDurationFromTwoTime($t0, $t1, $seconds)
    {
        $d = $t0 != null && $t1 != null ? ((Carbon::create($t1)) - (Carbon::create($t0))) : $seconds * 1000;
        $weekdays = floor($d / 1000 / 60 / 60 / 24 / 7);
        $days = floor($d / 1000 / 60 / 60 / 24 - $weekdays * 7);
        $hours = floor($d / 1000 / 60 / 60 - $weekdays * 7 * 24 - $days * 24);
        $minutes = floor($d / 1000 / 60 - $weekdays * 7 * 24 * 60 - $days * 24 * 60 - $hours * 60);
        $seconds = floor($d / 1000 - $weekdays * 7 * 24 * 60 * 60 - $days * 24 * 60 * 60 - $hours * 60 * 60 - $minutes * 60);
        $milliseconds = floor($d - $weekdays * 7 * 24 * 60 * 60 * 1000 - $days * 24 * 60 * 60 * 1000 - $hours * 60 * 60 * 1000 - $minutes * 60 * 1000 - $seconds * 1000);
        $t = [];
        $times = ['weekdays' => $weekdays, 'days' => $days, 'hours' => $hours, 'minutes' => $minutes, 'seconds' => $seconds, 'milliseconds' => $milliseconds];
        foreach ($times as $key => $value) {
            if ($value > 0) {
                $t[$key] = $value;
            }
        }
        return $t;
    }

    public static function getDiffTwoTime($startTime, $endTime, $seconds)
    {
        $formatDuration = self::getFormatDurationFromTwoTime($startTime, $endTime, $seconds);
        $text = '';
        $weekdays = array_key_exists("weekdays", $formatDuration) ? $formatDuration['weekdays'] : null;
        $days = array_key_exists("days", $formatDuration) ? $formatDuration['days'] : null;
        $hours = array_key_exists("hours", $formatDuration) ? $formatDuration['hours'] : null;
        $minutes = array_key_exists("minutes", $formatDuration) ? $formatDuration['minutes'] : null;
        $seconds = array_key_exists("seconds", $formatDuration) ? $formatDuration['seconds'] : null;
        if ($weekdays == null && $days == null && $hours == null && $minutes == null && $seconds == null)
            return '-';
        if ($weekdays != null)
            $text .= ($weekdays . ' minggu ');
        if ($days != null)
            $text .= ($days . ' hari ');
        if ($hours != null)
            $text .= ($hours . ' jam ');
        if ($minutes != null)
            $text .= ($minutes . ' menit ');
        if ($seconds != null)
            $text .= ($seconds . ' detik ');
        return $text;
    }

    public static function convertToYearMonth($months)
    {
        $years = floor($months / 12);
        $remainingMonths = $months % 12;

        $yearString = ($years > 0) ? $years . ' tahun' : '';
        $monthString = ($remainingMonths > 0) ? $remainingMonths . ' bulan' : '';

        // Tambahkan "dan" jika keduanya memiliki nilai
        if ($yearString && $monthString) {
            $yearString .= ' dan ';
        }

        return $yearString . $monthString;
    }
}
