<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
$json = json_decode($data, true);

if ($json !== null) {
    // นำข้อมูลไปเขียนทับไฟล์ config.json
    $result = file_put_contents('config.json', json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    
    if ($result !== false) {
        echo json_encode(["status" => "success", "message" => "บันทึกการตั้งค่าเรียบร้อย"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "ไม่สามารถเขียนไฟล์ได้ กรุณาเช็ค Permission"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "ข้อมูลตั้งค่าไม่ถูกต้อง"]);
}
?>