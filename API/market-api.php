<?php

include 'index.php';

// 連線資料庫
function create_connect()
{
    $conn = mysqli_connect('db', 'root', '123456', 'market', 3306);
    if (!$conn) {
        respond(false, "資料庫連線失敗");
        exit();
    }
    // 設定連線字元編碼
    mysqli_set_charset($conn, 'utf8mb4');
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
    if ($keyA != '' && $keyB != '') {
        try {
            $conn = create_connect();
            $stmt = $conn->prepare("SELECT * FROM authkey WHERE KeyValueA=? AND KeyValueB=?");
            $stmt->bind_param("ss", $keyA, $keyB);
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if (count($result) == 1) {
                    if ($stmt->execute()) {
                        respond(true, "檢查成功金鑰已更新");
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
                        $keyB = substr(hash('sha512', time()), 0, 256);
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

// 刪除購物車
function delshopcart()
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

// 新增訂單
function addorder()
{
    $input = get_json_input();
    $keyA = $input['keyA'] ?? '';
    $keyB = $input['keyB'] ?? '';
    $name = $input['name'] ?? '';
    $tel = $input['tel'] ?? '';
    $add = $input['add'] ?? '';
    $other = $input['other'] ?? '';
    $discount = $input['discount'] ?? '';
    $shopcart = $input['shopcart'] ?? '';
    $howsend = $input['howsend'] ?? '';
    $sendch = $input['sendch'] ?? '';
    $userId = findId($keyA, $keyB);
    if ($userId != '' && $name != '' && $tel != '' && $add != '' && $shopcart != '' && $howsend != '') {
        try {
            $conn = create_connect();
            $conn->begin_transaction();
            // 把是否付款轉換為固定格式，貨到付款為0，轉帳刷卡等為1
            if ($howsend == 0) {
                $howsend = 0;
            } else {
                $howsend = 1;
            }
            // 先檢查購物車是否有資料，並對每個商品進行查詢做預處理
            $totalprice = 0;
            foreach ($shopcart as $data) {
                $stmt = $conn->prepare("SELECT ProductName,Price FROM product WHERE Id=?");
                $stmt->bind_param("i", $data['productId']);
                if ($stmt->execute()) {
                    // 商品
                    $product = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
                    // 總價格
                    $totalprice += $data['count'] * $product['Price'];
                    // 商品顏色
                    $stmt = $conn->prepare("SELECT ColorSample FROM productcolor WHERE Id=?");
                    $stmt->bind_param("i", $data['color']);
                    if ($stmt->execute()) {
                        $color = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['ColorSample'];
                    } else {
                        throw new Exception("商品顏色錯誤" . $stmt->error);
                    }
                    // 商品尺寸
                    $stmt = $conn->prepare("SELECT Size FROM productsize WHERE Id=?");
                    $stmt->bind_param("i", $data['size']);
                    if ($stmt->execute()) {
                        $size = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['Size'];
                    } else {
                        throw new Exception("商品尺寸錯誤" . $stmt->error);
                    }
                    // 商品照片
                    $stmt = $conn->prepare("SELECT photoPath FROM productphoto WHERE ProductId=?");
                    $stmt->bind_param("i", $data['productId']);
                    if ($stmt->execute()) {
                        $photo = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['photoPath'];
                    } else {
                        throw new Exception("商品圖片錯誤" . $stmt->error);
                    }
                } else {
                    throw new Exception("商品錯誤" . $stmt->error);
                }
            }
            // 獲取優惠券，如果有的話，對總價格做折扣
            if ($discount != '') {
                $stmt = $conn->prepare("SELECT * FROM discounts WHERE DiscountValue=? AND UserId=?");
                $stmt->bind_param("si", $discount, $userId);
                if ($stmt->execute()) {
                    $discoin = 0;
                    $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0] ?? '';
                    if ($result != '') {
                        if ($result['DiscountType'] == 0) {
                            $discoin = 0;
                        } else if ($result['DiscountType'] == 1) {
                            $discoin = $totalprice * ($result['DiscountCoin'] / 100);
                            $totalprice += 49;
                        }
                        // 更新優惠券的使用狀態
                        $stmt = $conn->prepare("UPDATE discounts SET Useful=? WHERE Id=?");
                        $use = 1;
                        $stmt->bind_param("ii", $use, $result['Id']);
                        if (!$stmt->execute()) {
                            throw new Exception("優惠券使用錯誤" . $stmt->error);
                        }
                    } else {
                        throw new Exception("優惠券數量有誤" . count($result));
                    }
                } else {
                    throw new Exception("優惠券搜尋錯誤" . $stmt->error);
                }
            } else {
                $result['DiscountType'] = 1;
            }
            // 新增訂單
            $stmt = $conn->prepare("INSERT INTO orders (UserId, Name, Tel, Other, Address, HowSend, PayStatus, DiscountType, DiscountCoin, Total) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("isssssiiii", $userId, $name, $tel, $other, $add, $sendch, $howsend, $result['DiscountType'], ceil($discoin), $totalprice);
            if ($stmt->execute()) {
                $last_id = $stmt->insert_id;
                $stmt = $conn->prepare("INSERT INTO orderstatus (OrdersId, OrdersStatus) VALUES (?, ?)");
                $status = 0; // 訂單狀態
                $stmt->bind_param("ii", $last_id, $status);
                if (!$stmt->execute()) {
                    throw new Exception("訂單狀態新增錯誤" . $stmt->error);
                }
                foreach ($shopcart as $data) {
                    $stmt = $conn->prepare("SELECT ProductName,Price FROM product WHERE Id=?");
                    $stmt->bind_param("i", $data['productId']);
                    if ($stmt->execute()) {
                        // 商品
                        $product = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
                        // 商品顏色
                        $stmt = $conn->prepare("SELECT ColorSample FROM productcolor WHERE Id=?");
                        $stmt->bind_param("i", $data['color']);
                        if ($stmt->execute()) {
                            $color = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['ColorSample'];
                        } else {
                            throw new Exception("商品顏色錯誤" . $stmt->error);
                        }
                        // 商品尺寸
                        $stmt = $conn->prepare("SELECT Size FROM productsize WHERE Id=?");
                        $stmt->bind_param("i", $data['size']);
                        if ($stmt->execute()) {
                            $size = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['Size'];
                        } else {
                            throw new Exception("商品尺寸錯誤" . $stmt->error);
                        }
                        // 商品照片
                        $stmt = $conn->prepare("SELECT photoPath FROM productphoto WHERE ProductId=?");
                        $stmt->bind_param("i", $data['productId']);
                        if ($stmt->execute()) {
                            $photo = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['photoPath'];
                        } else {
                            throw new Exception("商品圖片錯誤" . $stmt->error);
                        }
                    } else {
                        throw new Exception("商品錯誤" . $stmt->error);
                    }

                    // 新增訂單商品
                    $stmt = $conn->prepare("INSERT INTO ordersproduct (OrdersId, ProductPhoto, ProductName, ProductColor, ProductSize, ProductCoin, Count) VALUES (?, ?, ?, ?, ?, ?, ?)");
                    $stmt->bind_param("issssii", $last_id, $photo, $product['ProductName'], $color, $size, $product['Price'], $data['count']);
                    if (!$stmt->execute()) {
                        throw new Exception("訂單商品新增錯誤" . $stmt->error);
                    }
                    // 刪除購物車商品
                    $stmt = $conn->prepare("DELETE FROM shopcart WHERE Id=?");
                    $stmt->bind_param("i", $data['id']);
                    if (!$stmt->execute()) {
                        throw new Exception("刪除購物車商品錯誤" . $stmt->error);
                    }
                }
            } else {
                throw new Exception("訂單新增錯誤" . $stmt->error);
            }
            $conn->commit();
            respond(true, "新增成功");
        } catch (Exception $e) {
            respond(false, "新增失敗", $e->getMessage());
            $conn->rollback();
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, "資料為空");
    }
}

// 取消訂單
function cannelorder()
{
    $input = get_json_input();
    $orderId = $input['orderId'] ?? '';
    $status = $input['status'] ?? '';
    $orderId = $input['orderId'] ?? '';
    if ($orderId != '' && $status != '') {
        try {
            $conn = create_connect();
            $stmt = $conn->prepare("INSERT INTO orderstatus (OrdersId, OrdersStatus) VALUES (?, ?)");
            $stmt->bind_param("ii", $orderId, $status);
            if ($stmt->execute()) {
                respond(true, "取消成功");
            } else {
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            respond(false, "取消失敗", $e->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, "資料為空");
    }
}

/* get */
// 搜尋商品
function searchproduct()
{
    $search = $_GET['search'] ?? '';
    if ($search != '') {
        try {
            $conn = create_connect();
            $stmt = $conn->prepare("SELECT 1 FROM product WHERE Id=?");
            $stmt->bind_param("s", $search);
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if (count($result) > 0) {
                    respond(true, "搜尋成功", $result);
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
    } else {
        respond(false, "資料為空");
    }
}

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

// 獲取購物車資料
function getshopcart()
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

// 獲取711商店
function get711store()
{
    // 接收 POST 資料
    $storeid = $_POST['storeid'] ?? '';
    $storename = urlencode($_POST['storename'] ?? '');
    $storeaddress = urlencode($_POST['storeaddress'] ?? '');
?>
    <!DOCTYPE html>
    <html lang="zh-Hant">

    <head>
        <meta charset="UTF-8">
        <title>傳送門市資料中...</title>
    </head>

    <body>
        <script>
            // 準備要傳回主視窗的資料
            const data = {
                storeid: "<?= $storeid ?>",
                storename: "<?= $storename ?>",
                storeaddress: "<?= $storeaddress ?>"
            };

            // 將資料傳回開啟地圖的原視窗
            if (window.opener) {
                window.opener.postMessage(data, "http://localhost/orderdata.php"); // 可以加上你自己的 origin
                window.close(); // 傳完關掉自己
            } else {
                document.body.innerText = "找不到主視窗";
            }
        </script>
    </body>

    </html>
<?php
}

// 從訂單獲取優惠券
function rollbackdiscount()
{
    $input = get_json_input();
    $keyA = $input['keyA'] ?? '';
    $keyB = $input['keyB'] ?? '';
    $discountvalue = $input['discount'] ?? '';
    if ($keyA != '' && $keyB != '' && $discountvalue != '') {
        try {
            $conn = create_connect();
            $Id = findId($keyA, $keyB);
            $stmt = $conn->prepare("SELECT * FROM discounts WHERE DiscountValue=? AND UserId=?");
            $stmt->bind_param("ss", $discountvalue, $Id);
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if (count($result) === 1) {
                    respond(true, "搜尋成功", $result[0]);
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
    } else {
        respond(false, "資料為空");
    }
}

// 獲取優惠券
function getdiscount()
{
    $keyA = $_GET['keyA'] ?? '';
    $keyB = $_GET['keyB'] ?? '';
    if ($keyA != '' && $keyB != '') {
        try {
            $conn = create_connect();
            $Id = findId($keyA, $keyB);
            $stmt = $conn->prepare("SELECT DiscountType,DiscountCoin,DiscountValue,StartDate,EndDate FROM discounts WHERE UserId=?");
            $stmt->bind_param("i", $Id);
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if (count($result) > 0) {
                    respond(true, "搜尋成功", $result);
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
    } else {
        respond(false, "資料為空");
        return;
    }
}

// 獲取訂單資料
function getorder()
{
    $keyA = $_GET['keyA'] ?? '';
    $keyB = $_GET['keyB'] ?? '';
    if ($keyA != '' && $keyB != '') {
        try {
            $conn = create_connect();
            $conn->begin_transaction();
            $Id = findId($keyA, $keyB);
            $stmt = $conn->prepare("SELECT * FROM orders WHERE UserId=?");
            $stmt->bind_param("i", $Id);
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                if (count($result) > 0) {
                    foreach ($result as $key => $data) {
                        $stmt = $conn->prepare("SELECT * FROM ordersproduct WHERE OrdersId=?");
                        $stmt->bind_param("i", $data['Id']);
                        if ($stmt->execute()) {
                            $result[$key]['orderproduct'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0];
                        } else {
                            throw new Exception("訂單商品獲取錯誤 " . $stmt->error);
                        }
                        $stmt = $conn->prepare("SELECT * FROM orderstatus WHERE OrdersId=?");
                        $stmt->bind_param("i", $data['Id']);
                        if ($stmt->execute()) {
                            $result[$key]['orderstatus'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC) ?? '';
                        } else {
                            throw new Exception("訂單狀態獲取錯誤 " . $stmt->error);
                        }
                    }
                    respond(true, "搜尋成功", $result);
                    $conn->commit();
                } else {
                    respond(false, "沒有訂單");
                }
            } else {
                throw new Exception("訂單獲取錯誤 " . $stmt->error);
            }
        } catch (Exception $e) {
            respond(false, "搜尋失敗", $e->getMessage());
            $conn->rollback();
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, "資料為空");
    }
}

// 獲取單筆訂單詳細資料
function getorderdetail()
{
    $keyA = $_GET['keyA'] ?? '';
    $keyB = $_GET['keyB'] ?? '';
    $orderId = $_GET['orderId'] ?? '';
    if ($keyA != '' && $keyB != '' && $orderId != '') {
        try {
            $conn = create_connect();
            $Id = findId($keyA, $keyB);
            $stmt = $conn->prepare("SELECT * FROM orders WHERE Id=? AND UserId=?");
            $stmt->bind_param("ii", $orderId, $Id);
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0] ?? '';
                if ($result != '') {
                    $stmt = $conn->prepare("SELECT * FROM orderstatus WHERE OrdersId=?");
                    $stmt->bind_param("i", $orderId);
                    if ($stmt->execute()) {
                        $result['orderstatus'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC) ?? '';
                    } else {
                        throw new Exception("訂單狀態獲取錯誤 " . $stmt->error);
                    }
                    $stmt = $conn->prepare("SELECT * FROM ordersproduct WHERE OrdersId=?");
                    $stmt->bind_param("i", $orderId);
                    if ($stmt->execute()) {
                        $result['orderproduct'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    } else {
                        throw new Exception("訂單商品獲取錯誤 " . $stmt->error);
                    }
                    respond(true, "搜尋成功", $result);
                } else {
                    respond(false, "沒有訂單");
                }
            } else {
                throw new Exception("訂單獲取錯誤 " . $stmt->error);
            }
        } catch (Exception $e) {
            respond(false, "搜尋失敗", $e->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, "資料為空");
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
        case 'delshopcart':
            delshopcart();
            break;
        // 獲取711商店
        case 'get711store':
            get711store();
            break;
        // 獲取訂單優惠券
        case 'rollbackdiscount':
            rollbackdiscount();
            break;
        // 新增訂單
        case 'addorder':
            addorder();
            break;
        // 取消訂單
        case 'cannelorder':
            cannelorder();
            break;
        default:
            respond(false, "無此動作");
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';
    switch ($action) {
        // 搜尋商品
        case 'searchproduct':
            searchproduct();
            break;
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
        case 'getshopcart':
            getshopcart();
            break;
        // 獲取優惠券
        case 'getdiscount':
            getdiscount();
            break;
        // 獲取訂單資料
        case 'getorder':
            getorder();
            break;
        // 獲取單筆訂單詳細資料
        case 'getorderdetail':
            getorderdetail();
            break;
        default:
            respond(false, "無此動作");
    }
}
