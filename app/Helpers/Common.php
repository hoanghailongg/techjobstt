<?php

namespace App\Helpers;

class Common
{
    public static function number_shorten($number, $precision = 0, $divisors = null)
    {

        // Setup default $divisors if not provided
        if (!isset($divisors)) {
            $divisors = array(
                pow(1000, 0) => '', // 1000^0 == 1
                pow(1000, 1) => 'K', // Thousand
                pow(1000, 2) => 'M', // Million
                pow(1000, 3) => 'B', // Billion
                pow(1000, 4) => 'T', // Trillion
                pow(1000, 5) => 'Qa', // Quadrillion
                pow(1000, 6) => 'Qi', // Quintillion
            );
        }

        // Loop through each $divisor and find the
        // lowest amount that matches
        foreach ($divisors as $divisor => $shorthand) {
            if (abs($number) < ($divisor * 1000)) {
                // We found a match!
                break;
            }
        }

        // We found our match, or there were no matches.
        // Either way, use the last defined value for $divisor.
        return number_format($number / $divisor, $precision) . $shorthand;
    }

    public static function getStatusFollow($status)
    {
        switch ($status) {
            default:
            case 0:
                return 'Đang chờ duyệt';
            case 1:
                return 'Đã duyệt';
            case 2:
                return 'Bị từ chối';
        }
    }

    public static function showStatus($active = 0): string
    {
        switch ($active) {
            case 0:
            default:
                return '<span class="d-block badge bg-warning p-2">Đang chờ duyệt</span>';
                case 1:
                    return '<span class="d-block badge bg-success p-2">Đã duyệt</span>';
                    case 2:
                        return '<span class="d-block badge bg-danger p-2">Bị từ chối</span>';
        }
    }

    public static function getGender($code)
    {
        return match ($code) {
            1 => 'Nam',
            2 => 'Nữ',
            default => '',
        };
    }

    public static function cleanString($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }

    public static function getStatusCompany($status = 0): string
    {
        switch ($status) {
            case 1:
                $html = '<span class="badge badge-success">Hoạt động</span>';
                break;
            case 2:
                $html = '<span class="badge badge-danger">Huỷ</span>';
                break;
            case 0:
            default:
                $html = '<span class="badge badge-warning">Đang chờ duyệt</span>';
                break;
        }

        return $html;
    }

    public static function getStatusCompanyOnlyText($status = 0): string
    {
        switch ($status) {
            case 1:
                $html = 'Hoạt động';
                break;
            case 2:
                $html = 'Huỷ';
                break;
            case 0:
            default:
                $html = 'Đang chờ duyệt';
                break;
        }

        return $html;
    }
}
