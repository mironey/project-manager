<?php

function activityStatus($status) {
    if($status == 1) {
        return 'Not started';
    } elseif ($status == 2) {
        return 'In progress';
    } else {
        return 'Completed';
    }
}