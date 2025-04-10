<?php

include 'index.php';

// 連線資料庫
function create_connect()
{
    $conn = mysqli_connect('localhost', 'admin', '123456', 'market');
    if (!$conn) {
        respond(false, "資料庫連線失敗");
        exit();
    }
    return $conn;
}

// 取得json輸入
function get_json_input()
{
    $data = file_get_contents("php://input");
    $input = json_decode($data, true);
    return $input;
}

// 回應json
function respond($state, $msg, $data = null)
{
    echo json_encode(["state" => $state, "msg" => $msg, "data" => $data]);
}

// 查找帳號Id
function findId($keyA, $keyB)
{
    $conn = create_connect();
    $stmt = $conn->prepare("SELECT * FROM authkey WHERE KeyValueA=? AND KeyValueB=?");
    $stmt->bind_param("ss", $keyA, $keyB);
    if ($stmt->execute()) {
        $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
        if (count($result) == 1) {
            $stmt->close();
            $conn->close();
            return $result[0]['UserId'];
        } else {
            return null;
        }
    } else {
        return null;
    }
}

// 檢查手機號碼是否存在
function checkphone()
{
    $input = get_json_input();
    $phone = $input['phone'] ?? '';
    if ($phone != '') {
        $conn = create_connect();
        $stmt = $conn->prepare("SELECT * FROM users WHERE Phone = ?");
        $stmt->bind_param("s", $phone);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($result) == 1) {
                respond(true, "轉登入", $result);
            } else {
                respond(true, "轉註冊");
            }
        }
        $stmt->close();
        $conn->close();
    } else {
        respond(false, "資料為空");
    }
}

// 新增使用者
function adduser()
{
    $input = get_json_input();
    $name = $input['name'] ?? '';
    $phone = $input['phone'] ?? '';
    $pwd = $input['pwd'] ?? '';
    $email = $input['email'] ?? '';
    $date = $input['date'] ?? '';
    $add = $input['add'] ?? '';
    if ($name != '' && $phone != '' && $pwd != '' && $email != '' && $date != '' && $add != '') {
        try {
            $pwd = password_hash($pwd, PASSWORD_DEFAULT);
            $conn = create_connect();
            $stmt = $conn->prepare("INSERT INTO users (UserName, Phone, Password, Email, Date, Address) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $name, $phone, $pwd, $email, $date, $add);
            if (!$stmt->execute()) {
                throw new Exception($stmt->error);
            } else {
                $last_id = $stmt->insert_id;
                $keyA = hash('sha256', time());
                $keyB = substr(hash('sha512', time()), 0, 256);
                $stmt = $conn->prepare("INSERT INTO authkey (UserId, KeyValueA, KeyValueB) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $last_id, $keyA, $keyB);
                if (!$stmt->execute()) {
                    throw new Exception($stmt->error);
                }
            }
            $data = ['keyA' => $keyA, 'keyB' => $keyB];
            respond(true, "新增成功", $data);
        } catch (Exception $e) {
            respond(false, "新增失敗", $e->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, "資料有誤");
    }
}

// 檢查金鑰
function checkkey()
{
    $input = get_json_input();
    $keyA = $input['keyA'] ?? '';
    $keyB = $input['keyB'] ?? '';
    $userId = $input['Id'] ?? '';
    if ($keyA != '' && $keyB != '' && $userId != '') {
        try {
            $conn = create_connect();
            $stmt = $conn->prepare("SELECT * FROM authkey WHERE UserId = ? AND KeyValueA=? AND KeyValueB=?");
            $stmt->bind_param("sss", $userId, $keyA, $keyB);
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if (count($result) == 1) {
                    $keyA = bin2hex(random_bytes(16));  // 32 字元 (128-bit)
                    $keyB = bin2hex(random_bytes(32));  // 64 字元 (256-bit)
                    $stmt = $conn->prepare("UPDATE authkey SET KeyValueA=?, KeyValueB=? WHERE UserId=?");
                    $stmt->bind_param("sss", $keyA, $keyB, $userId);
                    if ($stmt->execute()) {
                        $data = ['keyA' => $keyA, 'keyB' => $keyB, 'userId' => $result[0]['UserId']];
                        respond(true, "檢查成功金鑰已更新", $data);
                    } else {
                        throw new Exception($stmt->error);
                    }
                } else {
                    throw new Exception("數量有誤");
                }
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            respond(false, "檢查失敗", $e->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, "資料為空");
    }
}

// 登入檢查
function userlogin()
{
    $input = get_json_input();
    $pwd = $input['pwd'] ?? '';
    $tel = $input['tel'] ?? '';
    if ($pwd != '' && $tel != '') {
        try {
            $conn = create_connect();
            $stmt = $conn->prepare("SELECT * FROM users WHERE Phone = ?");
            $stmt->bind_param("s", $tel);
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if (count($result) == 1) {
                    if ($result[0]['Phone'] == $tel && password_verify($pwd, $result[0]['Password'])) {
                        $keyA = hash('sha256', time());
                        $keyB = substr(hash('sha256', time()), 0, 256);
                        $stmt = $conn->prepare("UPDATE authkey SET KeyValueA = ?, KeyValueB = ? WHERE UserId = ?");
                        $stmt->bind_param("sss", $keyA, $keyB, $result[0]['UserId']);
                        if ($stmt->execute()) {
                            $data = ['keyA' => $keyA, 'keyB' => $keyB, 'id' => $result[0]['UserId']];
                            respond(true, "登入成功", $data);
                        } else {
                            throw new Exception($stmt->error);
                        }
                    } else {
                        respond(false, "登入失敗");
                    }
                } else {
                    throw new Exception("帳號數量有誤" . count($result));
                }
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            respond(false, "登入失敗", $e->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, "資料為空");
    }
}

// 新增購物車
function addcart()
{
    $input = get_json_input();
    $keyA = $input['keyA'] ?? '';
    $keyB = $input['keyB'] ?? '';
    $userId = findId($keyA, $keyB);
    $productId = $input['productid'] ?? '';
    $colorId = $input['colorid'] ?? '';
    $sizeId = $input['sizeid'] ?? '';
    $amount = $input['many'] ?? '';
    if ($userId != '' && $productId != '' && $colorId != '' && $sizeId != '' && $amount != '') {
        try {
            $conn = create_connect();
            $stmt = $conn->prepare("SELECT * FROM shopcart WHERE UserId=? AND ProductId=? AND ColorId=? AND SizeId=?");
            $stmt->bind_param("iiii", $userId, $productId, $colorId, $sizeId);
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if (count($result) == 1) {
                    $stmt = $conn->prepare("UPDATE shopcart SET Count=? WHERE Id=?");
                    $many = $result[0]['Count'] + $amount;
                    $stmt->bind_param("ii", $many, $result[0]['Id']);
                    if (!$stmt->execute()) {
                        throw new Exception($stmt->error);
                    } else {
                        respond(true, "新增成功");
                    }
                } else {
                    $stmt = $conn->prepare("INSERT INTO shopcart (UserId, ProductId, ColorId, SizeId, Count) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("iiiii", $userId, $productId, $colorId, $sizeId, $amount);
                    if ($stmt->execute()) {
                        respond(true, "新增成功");
                    } else {
                        throw new Exception($stmt->error);
                    }
                }
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            respond(false, "新增失敗", $e->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, "資料為空");
    }
}

// 更新訂單數量
function updateorder()
{
    $input = get_json_input();
    $Id = $input['id'] ?? '';
    $count = $input['count'] ?? '';
    if ($Id != '' && $count != '') {
        try {
            $conn = create_connect();
            $stmt = $conn->prepare("UPDATE shopcart SET Count=? WHERE Id=?");
            $stmt->bind_param("ii", $count, $Id);
            if ($stmt->execute()) {
                respond(true, "更新成功");
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            respond(false, "更新失敗", $e->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, "資料為空");
    }
}

// 刪除訂單
function delorder()
{
    $input = get_json_input();
    $Id = $input['id'] ?? '';
    if ($Id != '') {
        try {
            $conn = create_connect();
            $stmt = $conn->prepare("DELETE FROM shopcart WHERE Id=?");
            $stmt->bind_param("i", $Id);
            if ($stmt->execute()) {
                respond(true, "刪除成功");
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            respond(false, "刪除失敗", $e->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, "資料為空");
    }
}

/* get */
// 獲取商品系列跟種類
function getseries_type()
{
    try {
        $conn = create_connect();
        $stmt = $conn->prepare("SELECT Id, Name FROM series");
        $data = [];
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            $data['series'] = $result;
            $stmt = $conn->prepare("SELECT Id, SeriesId, TypeName FROM producttype");
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $data['type'] = $result;
                respond(true, "獲取成功", $data);
            } else {
                throw new Exception($stmt->error);
            }
        } else {
            throw new Exception($stmt->error);
        }
    } catch (Exception $e) {
        respond(false, "請求失敗", $e->getMessage());
    } finally {
        $stmt->close();
        $conn->close();
    }
}

// 獲取系列跟種類的商品
function getseries_type_product()
{
    $seriesId = $_GET['seriesId'] ?? '';
    $typeId = $_GET["typeId"] ?? '';

    if ($seriesId != '' && $typeId != '') {
        try {
            $conn = create_connect();
            $stmt = $conn->prepare("SELECT * FROM product WHERE SeriesId=? AND TypeId=?");
            $stmt->bind_param("ii", $seriesId, $typeId);
            if ($stmt->execute()) {
                $result = [];
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt = $conn->prepare("SELECT * FROM productcolor WHERE ProductId=?");
                foreach ($result as $pKey => $pdata) {
                    $stmt->bind_param("i", $pdata['Id']);
                    if ($stmt->execute()) {
                        $colors = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                        $result[$pKey]['color'] = $colors;
                        $stmt = $conn->prepare("SELECT * FROM productsize WHERE ProductColorId=?");
                        foreach ($colors as $cKey => $cdata) {
                            $stmt->bind_param("i", $cdata['Id']);
                            if ($stmt->execute()) {
                                $sizes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                                $result[$pKey]['color'][$cKey]['size'] = $sizes;
                            } else {
                                throw new Exception($stmt->error);
                            }
                        }
                    } else {
                        throw new Exception($stmt->error);
                    }
                    $stmt = $conn->prepare("SELECT * FROM productphoto WHERE ProductId=?");
                    $stmt->bind_param("i", $pdata['Id']);
                    if ($stmt->execute()) {
                        $photos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                        $result[$pKey]['photo'] = $photos;
                    }
                }


                respond(true, "搜尋成功", $result);
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            respond(false, "搜尋失敗", $e->getMessage());
        } finally {
            $conn->close();
            $stmt->close();
        }
    } else {
        respond(false, "資料為空");
    }
}

// 獲取商品資料
function getproduct()
{
    $Id = $_GET['id'] ?? '';
    if ($Id != '') {
        $conn = create_connect();
        try {
            $stmt = $conn->prepare("SELECT * FROM product WHERE Id=?");
            $stmt->bind_param("i", $Id);
            if ($stmt->execute()) {
                $result = [];
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt = $conn->prepare("SELECT * FROM productcolor WHERE ProductId=?");
                $stmt->bind_param("i", $Id);
                if ($stmt->execute()) {
                    $colors = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    $result[0]['color'] = $colors;
                    $stmt = $conn->prepare("SELECT * FROM productsize WHERE ProductColorId=?");
                    foreach ($colors as $cKey => $cdata) {
                        $stmt->bind_param("i", $cdata['Id']);
                        if ($stmt->execute()) {
                            $sizes = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                            $result[0]['color'][$cKey]['size'] = $sizes;
                        } else {
                            throw new Exception($stmt->error);
                        }
                    }
                } else {
                    throw new Exception($stmt->error);
                }
                $stmt = $conn->prepare("SELECT * FROM productphoto WHERE ProductId=?");
                $stmt->bind_param("i", $Id);
                if ($stmt->execute()) {
                    $photos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    $result[0]['photo'] = $photos;
                }
                respond(true, "搜尋成功", $result);
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            respond(false, "搜尋失敗", $e->getMessage());
        }
    } else {
        respond(false, "內容為空");
    }
}

// 獲取訂單資料
function getorder()
{
    $keyA = $_GET['keyA'] ?? '';
    $keyB = $_GET['keyB'] ?? '';
    try {
        $conn = create_connect();
        $Id = findId($keyA, $keyB);
        $stmt = $conn->prepare("SELECT * FROM shopcart WHERE UserId=?");
        $stmt->bind_param("i", $Id);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($result) > 0) {
                $allcart = [];
                foreach ($result as $key => $data) {
                    $allcart[$key]['id'] = $data['Id'];
                    $allcart[$key]['count'] = $data['Count'];
                    $stmt = $conn->prepare("SELECT * FROM product WHERE Id=?");
                    $stmt->bind_param("i", $data['ProductId']);
                    if ($stmt->execute()) {
                        $product = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                        $allcart[$key]['product'] = $product[0];
                        $stmt = $conn->prepare("SELECT * FROM productcolor WHERE Id=?");
                        $stmt->bind_param("i", $data['ColorId']);
                        if ($stmt->execute()) {
                            $color = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                            $allcart[$key]['color'] = $color[0];
                            $stmt = $conn->prepare("SELECT * FROM productsize WHERE Id=?");
                            $stmt->bind_param("i", $data['SizeId']);
                            if ($stmt->execute()) {
                                $size = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                                $allcart[$key]['size'] = $size[0];
                            } else {
                                throw new Exception($stmt->error);
                            }
                        } else {
                            throw new Exception($stmt->error);
                        }

                        $stmt = $conn->prepare("SELECT * FROM productphoto WHERE ProductId=?");
                        $stmt->bind_param("i", $data['ProductId']);
                        if ($stmt->execute()) {
                            $photos = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                            $allcart[$key]['photo'] = $photos;
                        } else {
                            throw new Exception($stmt->error);
                        }
                    } else {
                        throw new Exception($stmt->error);
                    }
                }
                respond(true, "搜尋成功", $allcart);
            } else {
                respond(false, "沒有資料");
            }
        } else {
            throw new Exception($stmt->error);
        }
    } catch (Exception $e) {
        respond(false, "搜尋失敗", $e->getMessage());
    } finally {
        $stmt->close();
        $conn->close();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';
    switch ($action) {
        // 檢查手機號碼是否存在
        case 'checkphone':
            checkphone();
            break;
        // 新增使用者
        case 'adduser':
            adduser();
            break;
        // 登入檢查
        case 'userlogin':
            userlogin();
            break;
        // 檢查金鑰
        case 'checkkey':
            checkkey();
            break;
        // 新增購物車
        case 'addcart':
            addcart();
            break;
        // 更新訂單數量
        case 'updateorder':
            updateorder();
            break;
        // 刪除訂單
        case 'delorder':
            delorder();
            break;
        default:
            respond(false, "無此動作");
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';
    switch ($action) {
        // 找商品系列的資料
        case 'getseries_type':
            getseries_type();
            break;
        // 獲取系列跟種類的商品
        case 'getseries_type_product':
            getseries_type_product();
            break;
        // 獲取商品資料
        case 'getproduct':
            getproduct();
            break;
        // 獲取訂單資料
        case 'getorder':
            getorder();
            break;

        default:
            respond(false, "無此動作");
    }
}
