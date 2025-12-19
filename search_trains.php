<?php
include('../db.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(['error' => 'Method not allowed. Use POST instead.']);
  exit;
}

header('Content-Type: application/json; charset=utf-8');
ini_set('display_errors', 1); error_reporting(E_ALL);

require_once __DIR__ . '/../db.php';

$body = json_decode(file_get_contents('php://input'), true) ?? $_POST;
$from = trim($body['from'] ?? '');
$to   = trim($body['to'] ?? '');
$date = trim($body['date'] ?? ''); // yyyy-mm-dd

if (!$from || !$to) {
  http_response_code(400);
  echo json_encode(['error' => 'Please provide both "from" and "to".']);
  exit;
}

$likeFrom = "%$from%";
$likeTo = "%$to%";

if ($date !== '') {
    $stmt = $conn->prepare("SELECT * FROM trains WHERE source LIKE ? AND destination LIKE ? AND travel_date = ?");
    $stmt->bind_param("sss", $likeFrom, $likeTo, $date);
} else {
    $stmt = $conn->prepare("SELECT * FROM trains WHERE source LIKE ? AND destination LIKE ?");
    $stmt->bind_param("ss", $likeFrom, $likeTo);
}

$stmt->execute();
$res = $stmt->get_result();
$rows = [];
while ($r = $res->fetch_assoc()) $rows[] = $r;

echo json_encode(['trains' => $rows]);
$stmt->close();
$conn->close();
