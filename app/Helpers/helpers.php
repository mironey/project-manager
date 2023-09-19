<?php

use Illuminate\Support\Str;

function activityStatus($status) {
    if($status == 1) {
        return 'Not started';
    } elseif ($status == 2) {
        return 'In progress';
    } elseif ($status == 3) {
        return 'In modification';
    } else {
        return 'Completed';
    }
}

function textExcerpt($text) {
    return Str::words($text, 15, '...');
}