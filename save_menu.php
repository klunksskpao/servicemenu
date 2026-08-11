<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");

if ($data) {
    // นำข้อมูลที่ได้ ไปเขียนทับไฟล์ menu.json 
    $result = file_put_contents('menu.json', $data);
    
    if ($result !== false) {
        echo json_encode(["status" => "success", "message" => "บันทึกข้อมูลเรียบร้อย"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "ไม่สามารถเขียนไฟล์ได้ กรุณาเช็ค Permission 777 ของไฟล์ menu.json"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "ไม่มีข้อมูลส่งมา"]);
}
?>