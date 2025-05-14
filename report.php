<?php
require '../db.php';

$stmt = $pdo->query("SELECT * FROM system_reports ORDER BY created_at DESC LIMIT 100");
$visits = $stmt->fetchAll(PDO::FETCH_ASSOC);

header('Content-Type: application/json');
echo json_encode($visits);
?>