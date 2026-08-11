<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *'); 
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

$data = file_get_contents("php://input");
$json = json_decode($data, true);

if (isset($json['admin_password'])) {
    // นำข้อมูลไปเขียนทับไฟล์ ps.json โดยจัดฟอร์แมตให้สวยงาม (JSON_PRETTY_PRINT)
    $result = file_put_contents('ps.json', json_encode($json, JSON_PRETTY_PRINT));
    
    if ($result !== false) {
        echo json_encode(["status" => "success", "message" => "เปลี่ยนรหัสผ่านเรียบร้อย"]);
    } else {
        http_response_code(500);
        echo json_encode(["status" => "error", "message" => "ไม่สามารถเขียนไฟล์ได้ กรุณาเช็ค Permission 777 ของไฟล์ ps.json"]);
    }
} else {
    http_response_code(400);
    echo json_encode(["status" => "error", "message" => "ข้อมูลรหัสผ่านไม่ถูกต้อง"]);
}
?>