<?php

function getClientIP() {
    $ip = $_SERVER['HTTP_CLIENT_IP'] ?? 
          $_SERVER['HTTP_X_FORWARDED_FOR'] ?? 
          $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    return $ip;
}

function getDeviceType($userAgent) {
    $userAgent = strtolower($userAgent);

    if (strpos($userAgent, 'mobile') !== false && strpos($userAgent, 'tablet') === false) {
        return 'Mobile';
    } elseif (strpos($userAgent, 'tablet') !== false || strpos($userAgent, 'ipad') !== false) {
        return 'Tablet';
    } else {
        return 'Desktop';
    }
}
?>