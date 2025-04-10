<?php
// 允許所有來源
header("Access-Control-Allow-Origin: *");
// 允許得方法 OPRIONS 是瀏覽器發送的預檢請求
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
// 允許的標頭
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// 處理 OPTIONS 預檢請求
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("HTTP/1.1 200 OK");
    exit();  // 終止後續處理
}

// 獲得請求的路徑
$request_url = $_SERVER['REQUEST_URI'];

// 如果是根目錄，則導向登入頁面
if ($request_url === '/') {
    header("Location: http://192.168.50.10:84");
    exit();
}