<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../db.php';
require __DIR__ . '/utils.php';

$data = json_decode(file_get_contents('php://input'), true);

$session_id = $data['session_id'] ?? '';
$user_agent = $_SERVER['HTTP_USER_AGENT'] ?? '';
$referrer = $_SERVER['HTTP_REFERER'] ?? '';
$ip_address = getClientIP();
$device_type = getDeviceType($user_agent);
$page = $data['page'] ?? '';

if (!empty($session_id) && !empty($page)) {
    
    $stmt = $pdo->prepare("SELECT id, visit_count FROM system_reports WHERE session_id = ? AND page = ?");
    $stmt->execute([$session_id, $page]);
    $existing = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existing) {
    
        $stmt = $pdo->prepare("UPDATE system_reports SET visit_count = visit_count + 1 WHERE id = ?");
        $stmt->execute([$existing['id']]);
    } else {
    
        $stmt = $pdo->prepare("INSERT INTO system_reports (session_id, user_agent, referrer, ip_address, device_type, page, visit_count) VALUES (?, ?, ?, ?, ?, ?, 1)");
        $stmt->execute([$session_id, $user_agent, $referrer, $ip_address, $device_type, $page]);
    }

    echo json_encode(["status" => "success"]);
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "Missing session_id or page"]);
}
?>