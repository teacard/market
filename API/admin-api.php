<?php

include 'index.php';

// 連線資料庫
function create_connect()
{
    $conn = mysqli_connect('db', 'root', '123456', 'market', 3306);
    if (!$conn) {
        respond(false, "資料庫連線失敗", mysqli_connect_error());
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

// 更新金鑰
function changeKey($account, $password)
{
    if ($account != '' || $password != '') {
        $keya = hash('sha256', time());
        $keyb = substr(hash('sha512', time()), 0, 256);
        $conn = create_connect();
        $stmt = $conn->prepare("UPDATE adminusers SET KeyA = ?, KeyB = ? WHERE Account = ? AND Password = ?");
        $stmt->bind_param("ssss", $keya, $keyb, $account, $password);
        if ($stmt->execute()) {
            return ["msg" => "金鑰已更新", "data" => ["keyA" => $keya, "keyB" => $keyb]];
        } else {
            return ["msg" => "金鑰更新失敗", "data" => null];
        };
        $stmt->close();
        $conn->close();
    } else {
        return ["msg" => "帳號或密碼為空", "data" => null];
    }
}

// 檢查金鑰
function checkKey()
{
    $input = get_json_input();
    $keyA = $input['keyA'] ?? '';
    $keyB = $input['keyB'] ?? '';
    if ($keyA != '' && $keyB != '') {
        $conn = create_connect();
        $stmt = $conn->prepare("SELECT * FROM adminusers WHERE KeyA = ? AND KeyB = ?");
        $stmt->bind_param("ss", $keyA, $keyB);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            if ($result) {
                respond(true, "金鑰正確", $result);
            } else {
                respond(false, "金鑰錯誤");
            }
        } else {
            respond(false, "執行失敗");
        }
        $stmt->close();
        $conn->close();
    } else {
        respond(false, "金鑰為空");
    }
}

// 檢查管理員帳號
function CheckAdminUser()
{
    $conn = create_connect();
    $input = get_json_input();
    $account = $input['account'] ?? '';
    $password = $input['password'] ?? '';
    if ($account != '' && $password != '') {
        $stmt = $conn->prepare("SELECT * FROM adminusers WHERE Account = ?");
        $stmt->bind_param("s", $account);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_assoc();
            if (password_verify($password, $result['Password'])) {
                $str = changeKey($account, $result['Password']);
                respond(true, "登入成功 & " . $str["msg"], $str["data"]);
            } else {
                respond(false, "帳號或密碼錯誤");
            }
        } else {
            respond(false, "執行失敗");
            exit();
        }
    } else {
        respond(false, "帳號或密碼不得為空");
        exit();
    }
    $stmt->close();
    $conn->close();
}

// 找商品系列的資料
function productseries()
{
    $conn = create_connect();
    $stmt = $conn->prepare("SELECT Id, Name FROM series");
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        respond(true, "獲取成功", $data);
    } else {
        respond(false, "獲取失敗");
    }
    $stmt->close();
    $conn->close();
}

// 找商品種類的資料
function producttype()
{
    $conn = create_connect();
    $stmt = $conn->prepare("SELECT * FROM producttype");
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $data = $result->fetch_all(MYSQLI_ASSOC);
        respond(true, "獲取成功", $data);
    } else {
        respond(false, "獲取失敗");
    }
    $stmt->close();
    $conn->close();
}

// 新增商品系列跟商品種類
function addseries_producttype()
{

    $input = get_json_input();
    $seriesname = $input['seriesName'] ?? '';
    $producttype = $input['productType'] ?? '';
    $series_flag = false;
    $producttype_flag = false;
    if ($seriesname != '' && $producttype != '') {
        $conn = create_connect();
        // series INSERT
        $stmt = $conn->prepare("INSERT INTO series (Name) VALUES (?)");
        $stmt->bind_param("s", $seriesname);
        if ($stmt->execute()) {
            $series_flag = true;
        } else {
            $series_flag = false;
        }
        // producttype INSERT
        if ($series_flag) {
            $stmt = $conn->prepare("SELECT Id FROM series WHERE Name = ?");
            $stmt->bind_param("s", $seriesname);
            if ($stmt->execute()) {
                $result = $stmt->get_result()->fetch_assoc();
                foreach ($producttype as $item) {
                    $stmt = $conn->prepare("INSERT INTO producttype (SeriesId, TypeName) VALUES (?, ?)");
                    $stmt->bind_param("ss", $result['Id'], $item);
                    if ($stmt->execute()) {
                        $producttype_flag = true;
                    } else {
                        $producttype_flag = false;
                        break;
                    }
                }
            } else {
                respond(false, "新增失敗");
            }
        } else {
            respond(false, "新增失敗");
        }

        if ($series_flag && $producttype_flag) {
            respond(true, "新增成功");
        } else {
            respond(false, "新增失敗");
        }

        $stmt->close();
        $conn->close();
    } else {
        respond(false, "資料為空");
    }
}

// 修改商品系列跟商品種類
function updateseries_producttype()
{
    $input = get_json_input();
    $seriesId = $input['seriesId'] ?? '';
    $seriesName = $input['seriesName'] ?? '';
    $AddproductType = $input['AddproductType'] ?? '';
    $DeleteProductType = $input['DeleteProductType'] ?? '';
    $series_flag = false;
    $AddType_flag = true;
    $DelType_flag = true;
    if ($seriesId != '' && $seriesName != '') {
        $conn = create_connect();
        // update series
        $stmt = $conn->prepare("UPDATE series SET Name=? WHERE Id=?");
        $stmt->bind_param("ss", $seriesName, $seriesId);
        if ($stmt->execute()) {
            $series_flag = true;
        } else {
            $series_flag = false;
        }

        // can update series then do producttype
        if ($series_flag) {
            // add producttype
            if ($AddproductType != '') {
                foreach ($AddproductType as $item) {
                    $stmt = $conn->prepare("INSERT INTO producttype (SeriesId, TypeName) VALUES (?, ?)");
                    $stmt->bind_param("ss", $seriesId, $item);
                    if (!$stmt->execute()) {
                        $AddType_flag = false;
                        break;
                    }
                }
            }

            if ($series_flag && $AddType_flag && $DelType_flag) {
                respond(true, "修改成功");
            } else {
                respond(false, "修改失敗");
            }
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, "修改失敗");
    }
}

// 刪除商品系列跟商品種類跟商品
function deleteseries_producttype_product()
{
    $input = get_json_input();
    $seriesId = $input['seriesId'] ?? '';
    if ($seriesId != '' && !empty($seriesId)) {
        try {
            $conn = create_connect();
            $conn->begin_transaction();

            foreach ($seriesId as $data) {
                $stmt = $conn->prepare("SELECT Id FROM producttype WHERE SeriesId = ?");
                $stmt->bind_param("s", $data);
                if ($stmt->execute()) {
                    $producttypeId = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    foreach ($producttypeId as $typeId) {
                        $stmt = $conn->prepare("SELECT Id FROM product WHERE SeriesId = ? AND TypeId = ?");
                        $stmt->bind_param("ss", $data, $typeId['Id']);
                        if ($stmt->execute()) {
                            $productId = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                            foreach ($productId as $pId) {
                                $stmt = $conn->prepare("SELECT Id FROM productcolor WHERE ProductId = ?");
                                $stmt->bind_param("s", $pId['Id']);
                                if ($stmt->execute()) {
                                    $productColorId = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                                    foreach ($productColorId as $pcId) {
                                        $stmt = $conn->prepare("DELETE FROM productsize WHERE ProductColorId = ?");
                                        $stmt->bind_param("s", $pcId['Id']);
                                        if (!$stmt->execute()) {
                                            throw new Exception($stmt->error);
                                        }
                                    }
                                    $stmt = $conn->prepare("DELETE FROM productcolor WHERE ProductId = ?");
                                    $stmt->bind_param("s", $pId['Id']);
                                    if (!$stmt->execute()) {
                                        throw new Exception($stmt->error);
                                    }
                                } else {
                                    throw new Exception($stmt->error);
                                }
                                $stmt = $conn->prepare("SELECT photoPath FROM productphoto WHERE ProductId = ?");
                                $stmt->bind_param("s", $pId['Id']);
                                if ($stmt->execute()) {
                                    $photopath = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                                    foreach ($photopath as $path) {
                                        if (!unlink($path['photoPath'])) {
                                            throw new Exception("照片刪除失敗");
                                        }
                                    }
                                } else {
                                    throw new Exception($stmt->error);
                                }
                                $stmt = $conn->prepare("DELETE FROM productphoto WHERE ProductId = ?");
                                $stmt->bind_param("s", $pId['Id']);
                                if (!$stmt->execute()) {
                                    throw new Exception($stmt->error);
                                }
                            }
                            $stmt = $conn->prepare("DELETE FROM product WHERE SeriesId = ? AND TypeId = ?");
                            $stmt->bind_param("ss", $data, $typeId['Id']);
                            if (!$stmt->execute()) {
                                throw new Exception($stmt->error);
                            }
                        } else {
                            throw new Exception($stmt->error);
                        }
                    }
                    $stmt = $conn->prepare("DELETE FROM producttype WHERE SeriesId = ?");
                    $stmt->bind_param("s", $data);
                    if (!$stmt->execute()) {
                        throw new Exception($stmt->error);
                    }
                } else {
                    throw new Exception($stmt->error);
                }
                $stmt = $conn->prepare("DELETE FROM series WHERE Id = ?");
                $stmt->bind_param("s", $data);
                if (!$stmt->execute()) {
                    throw new Exception($stmt->error);
                }
            }

            $conn->commit();
            $stmt->close();
            $conn->close();
            respond(true, "刪除成功");
        } catch (Exception $e) {
            $conn->rollback();
            $stmt->close();
            $conn->close();
            respond(false, "刪除失敗", $e->getMessage());
        }
    } else {
        respond(false, "資料為空");
    }
}

// 搜尋與 seriesId 跟 producttypeId 相關的商品
function searchproductlist()
{
    $seriesId = $_GET['seriesId'] ?? '';
    $producttypeId = $_GET['producttypeId'] ?? '';
    if ($seriesId != '' && $producttypeId != '') {
        $conn = create_connect();
        $stmt = $conn->prepare("SELECT * FROM product WHERE SeriesId = ? AND TypeId = ?");
        $stmt->bind_param("ss", $seriesId, $producttypeId);
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            respond(true, "搜尋成功", $result);
        } else {
            respond(false, "搜尋失敗");
        }
        $stmt->close();
        $conn->close();
    } else {
        respond(false, "搜尋失敗", $producttypeId);
    }
}

// 新增商品
function insertproduct()
{
    $product = json_decode($_POST['product'], true) ?? '';
    $color_size = json_decode($_POST['color_size'], true) ?? '';
    $photo = $_FILES['photo'] ?? '';

    $product_flag = false;
    $color_flag = false;
    $size_flag = false;
    $photo_flag = false;

    if ($product != '' && $color_size != '' && $photo != '') {
        // create set
        $upload_dir = '../uploads/';
        // Mysql 預備
        $conn = create_connect();
        $conn->begin_transaction();
        $stmtProduct = $conn->prepare("INSERT INTO product (SeriesId, TypeId, ProductName, Introduction, Price, Quantity, Status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmtColor = $conn->prepare("INSERT INTO productcolor (ProductId, Color, ColorSample) VALUES (?, ?, ?)");
        $stmtSize = $conn->prepare("INSERT INTO productsize (ProductColorId, Size) VALUES (?, ?)");
        $stmtphoto = $conn->prepare("INSERT INTO productphoto (ProductId, photoPath) VALUES (?, ?)");

        // product check value
        $seriesId = $product['seriesId'] ?? '';
        $productTypeId = $product['productTypeId'] ?? '';
        $productName = $product['productName'] ?? '';
        $productPrice = $product['price'] ?? '';
        $productQuantity = $product['quantity'] ?? '';
        $productstatus = $product['status'] ?? '';
        $productIntroduction = $product['introduction'] ?? '';
        // insert into product
        if ($productName != '' && $productPrice != '' && $productQuantity != '' && $productIntroduction != '') {
            $stmtProduct->bind_param("sssssss", $seriesId, $productTypeId, $productName, $productIntroduction, $productPrice, $productQuantity, $productstatus);
            $product_flag = $stmtProduct->execute();
        } else {
            $product_flag = false;
        }
        // insert into color&size&photo
        if ($product_flag) {
            // get product last insert Id
            $productId = $conn->insert_id;
            // run colors array
            foreach ($color_size as $data) {
                // productcolor check value
                $color = $data['colors'] ?? '';
                $colorSample = $data['colorstamp'] ?? '';
                $sizes = $data['sizes'];
                // check can insert into productcoloror not
                if ($color != '' && $colorSample != '' && !empty(array_filter($sizes))) {
                    $stmtColor->bind_param("sss", $productId, $color, $colorSample);
                    $color_flag = $stmtColor->execute();
                    // check can insert into size or not
                    if ($color_flag) {
                        // get productcolor last insert Id
                        $colorId = $conn->insert_id;
                        // fun sizes array
                        foreach ($sizes as $item) {
                            // check can insert into size or not
                            if ($item != '') {
                                $stmtSize->bind_param("ss", $colorId, $item);
                                $size_flag = $stmtSize->execute();
                                // can't do break foreach&set false
                                if (!$size_flag) {
                                    $size_flag = false;
                                    break;
                                }
                            } else {
                                $size_flag = false;
                                break;
                            }
                        }
                    }
                } else {
                    $color_flag = false;
                }
            }
            if ($product_flag && $color_flag && $size_flag) {
                // run photo array
                foreach ($photo['name'] as $key => $data) {
                    // set photo name
                    $filename = date("YmdHis" . "_") . $data;
                    // upload photo
                    $photo_flag = move_uploaded_file($photo['tmp_name'][$key], $upload_dir . $filename);
                    // can upload do insert into productphoto
                    if ($photo_flag) {
                        $stmtphoto->bind_param("ss", $productId, $filename);
                        $photo_flag = $stmtphoto->execute();
                    } else {
                        break;
                    }
                }
            }
        }

        if ($product_flag && $color_flag && $size_flag && $photo_flag) {
            $conn->commit();
            respond(true, "新增成功");
        } else {
            $conn->rollback();
            respond(false, "新增失敗");
        }
        $stmtProduct->close();
        $stmtColor->close();
        $stmtSize->close();
        $stmtphoto->close();
        $conn->close();
    } else {
        respond(false, "請確認資料是否正確");
    }
}

// 搜尋 product 的商品給 edit.php
function searcheditproduct()
{
    $productId = $_GET['productId'] ?? '';
    if ($productId != '') {
        $product = [
            'product' => [],
            'color' => [],
            'size' => [],
            'photo' => []
        ];

        $product_flag = false;
        $productcolor_flag = false;
        $productsize_flag = false;
        $productphoto_flag = false;

        $conn = create_connect();
        $stmt = $conn->prepare("SELECT * FROM product WHERE Id = ?");
        $stmt->bind_param("s", $productId);
        if ($stmt->execute()) {
            $product['product'] = $stmt->get_result()->fetch_assoc();
            $product_flag = true;
        } else {
            $product_flag = false;
        }

        if ($product_flag) {
            $stmt = $conn->prepare("SELECT * FROM productcolor WHERE ProductId = ?");
            $stmt->bind_param("s", $productId);
            if ($stmt->execute()) {
                $product['color'] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $productcolor_flag = true;
            } else {
                $productcolor_flag = false;
            }
            foreach ($product['color'] as $data) {
                $stmt = $conn->prepare("SELECT * FROM productsize WHERE ProductColorId = ?");
                $stmt->bind_param("s", $data['Id']);
                if ($stmt->execute()) {
                    foreach ($stmt->get_result()->fetch_all(MYSQLI_ASSOC) as $sizes) {
                        $product["size"][] = $sizes;
                    }
                    $productsize_flag = true;
                } else {
                    $productsize_flag = false;
                    break;
                }
            }

            $stmt = $conn->prepare("SELECT * FROM productphoto WHERE ProductId = ?");
            $stmt->bind_param("s", $productId);
            if ($stmt->execute()) {
                $product["photo"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $productphoto_flag = true;
            } else {
                $productphoto_flag = false;
            }
        }

        if ($product_flag && $productcolor_flag && $productsize_flag && $productphoto_flag) {
            respond(true, "搜索成功", $product);
        } else {
            respond(false, "搜尋失敗");
        }
    } else {
        respond(false, "搜尋失敗");
    }

    $stmt->close();
    $conn->close();
}

// 修改 product 商品
function updateproduct()
{
    $input = get_json_input();
    $productId = $input['productId'] ?? '';
    $productname = $input['productName'] ?? '';
    $price = $input['price'] ?? '';
    $quantity = $input['quantity'] ?? '';
    $status = $input['status'] ?? '';
    $introduction = $input['introduction'] ?? '';
    if ($productId != '' && $productname != '' && $price != '' && $quantity != '' && $introduction != '') {
        try {
            $conn = create_connect();
            $stmt = $conn->prepare("UPDATE product SET ProductName = ?, Introduction = ?, Price = ?, Quantity = ?, Status = ? WHERE Id = ?");
            $stmt->bind_param("ssssss", $productname, $introduction, $price, $quantity, $status, $productId);
            if (!$stmt->execute()) {
                throw new Exception($stmt->error);
            } else {
                respond(true, "更新成功");
            }
        } catch (Exception $e) {
            respond(false, "更新失敗", $e->getMessage());
        } finally {
            $stmt->close();
            $conn->close();
        }
    } else {
        respond(false, '資料為空');
    }
}

// 刪除 product 商品
function delproduct()
{
    $input = get_json_input();
    $Id = $input['Id'] ?? '';
    try {
        if ($Id != '' && !empty($Id)) {
            $conn = create_connect();
            $conn->begin_transaction();
            foreach ($Id as $id) {
                $stmt = $conn->prepare("SELECT Id FROM productcolor WHERE ProductId = ?");
                $stmt->bind_param("s", $id);
                if ($stmt->execute()) {
                    $colorId = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    foreach ($colorId as $cid) {
                        $stmt = $conn->prepare("DELETE FROM productsize WHERE ProductColorId = ?");
                        $stmt->bind_param("s", $cid['Id']);
                        if (!$stmt->execute()) {
                            throw new Exception($stmt->error);
                        }
                    }
                } else {
                    throw new Exception($stmt->error);
                }
                $stmt->prepare("DELETE FROM productcolor WHERE ProductId = ?");
                $stmt->bind_param("s", $id);
                if (!$stmt->execute()) {
                    throw new Exception($stmt->error);
                }

                $stmt->prepare("SELECT photoPath FROM productphoto WHERE ProductId = ?");
                $stmt->bind_param("s", $id);
                if (!$stmt->execute()) {
                    throw new Exception($stmt->error);
                } else {
                    $photoId = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                    foreach ($photoId as $pid) {
                        if (file_exists($pid['photoPath'])) {
                            if (!unlink($pid['photoPath'])) {
                                throw new Exception("刪除失敗");
                            }
                        }
                    }
                }
                $stmt = $conn->prepare("DELETE FROM productphoto WHERE ProductId = ?");
                $stmt->bind_param("s", $id);
                if (!$stmt->execute()) {
                    throw new Exception($stmt->error);
                }

                $stmt->prepare("DELETE FROM product WHERE Id = ?");
                $stmt->bind_param("s", $id);
                if (!$stmt->execute()) {
                    throw new Exception($stmt->error);
                }
            }
            $conn->commit();
            $stmt->close();
            $conn->close();
            respond(true, "刪除成功");
        } else {
            respond(false, "刪除失敗");
        }
    } catch (Exception $e) {
        $conn->rollback();
        $stmt->close();
        $conn->close();
        respond(false, "刪除失敗", $e->getMessage());
    } finally {
        $stmt->close();
        $conn->close();
    }
}

// 新增商品的 color&size
function addproductcolor()
{
    $input = get_json_input();
    $size = $input['color_size'] ?? '';
    $productId = $input['productId'] ?? '';
    if ($size != '' && $productId != '') {
        try {
            $conn = create_connect();
            $conn->begin_transaction();
            foreach ($size as $data) {
                $color = $data['color'] ?? '';
                $colorsample = $data['colorsample'] ?? '';
                $sizes = $data['sizes'] ?? '';
                if ($color != '' && $colorsample != '' && $sizes != '') {
                    $stmt = $conn->prepare("INSERT INTO productcolor (ProductId, Color, ColorSample) VALUES (?, ?, ?)");
                    $stmt->bind_param("sss", $productId, $color, $colorsample);
                    if ($stmt->execute()) {
                        $colorId = $conn->insert_id;
                        $stmt->close();
                        foreach ($sizes as $item) {
                            $stmt = $conn->prepare("INSERT INTO productsize (ProductColorId, Size) VALUES (?, ?)");
                            $stmt->bind_param("ss", $colorId, $item);
                            if (!$stmt->execute()) {
                                throw new Exception("新增失敗");
                            }
                        }
                        $stmt->close();
                    } else {
                        throw new Exception("新增失敗");
                    }
                } else {
                    throw new Exception("資料為空");
                }
            }
            $conn->commit();
            $conn->close();
            respond(true, "新增成功");
        } catch (Exception $e) {
            $conn->rollback();
            $conn->close();
            respond(false, "資料有誤", $e);
        }
    } else {
        respond(false, "資料為空");
    }
}

// 修改商品的 color&size
function updateproductsize()
{
    $input = get_json_input();
    $updatesize = $input['updatesize'] ?? '';
    $delsize = $input['delsize'] ?? '';
    $newsize = $input['newsize'] ?? '';
    $colorid = $input['colorid'] ?? '';
    $color = $input['color'] ?? '';
    $colorsample = $input['colorsample'] ?? '';

    if ($color != '' && $colorsample != '' && $colorid != '') {
        $conn = create_connect();
        $conn->begin_transaction();
        try {
            $stmt = $conn->prepare("UPDATE productcolor SET Color=?, ColorSample=? WHERE Id = ?");
            $stmt->bind_param("sss", $color, $colorsample, $colorid);
            if ($stmt->execute()) {
                $size_flag = false;
                if ($updatesize != '' && !empty($updatesize)) {
                    $stmt = $conn->prepare("UPDATE productsize SET Size = ? WHERE Id = ?");
                    foreach ($updatesize as $data) {
                        $stmt->bind_param("ss", $data['Size'], $data['Id']);
                        if (!$stmt->execute()) {
                            $size_flag = false;
                            throw new Exception("修改失敗upd");
                        } else {
                            $size_flag = true;
                        }
                    }
                }
                if ($delsize != '' && !empty($delsize)) {
                    $stmt = $conn->prepare("DELETE FROM productsize WHERE Id=?");
                    foreach ($delsize as $data) {
                        $stmt->bind_param("s", $data);
                        if (!$stmt->execute()) {
                            $size_flag = false;
                            throw new Exception("修改失敗del");
                        } else {
                            $size_flag = true;
                        }
                    }
                }
                if ($newsize != '' && !empty($newsize)) {
                    $stmt = $conn->prepare("INSERT INTO productsize (ProductColorId, Size) VALUES (?, ?)");
                    foreach ($newsize as $data) {
                        $stmt->bind_param("ss", $data['ProductColorId'], $data['Size']);
                        if (!$stmt->execute()) {
                            $size_flag = false;
                            throw new Exception("修改失敗new");
                        } else {
                            $size_flag = true;
                        }
                    }
                }
                if ($size_flag) {
                    respond(true, "修改成功");
                }
                $conn->commit();
            } else {
                $stmt->close();
                throw new Exception($stmt->error);
            }
        } catch (Exception $e) {
            $conn->rollback();
            $stmt->close();
            $conn->close();
            respond(true, "修改失敗", $e->getMessage());
        }
    } else {
        respond(false, "內容為空");
    }
}

// 刪除商品的 color&size
function delproductcolorsize()
{
    $input = get_json_input();
    $colorId = $input['colorId'] ?? '';
    if ($colorId != '') {
        $conn = create_connect();
        $conn->begin_transaction();
        try {
            foreach ($colorId as $id) {
                $stmt = $conn->prepare("DELETE FROM productcolor WHERE Id = ?");
                $stmt->bind_param("s", $id);
                if ($stmt->execute()) {
                    $stmt = $conn->prepare("DELETE FROM productsize WHERE ProductColorId = ?");
                    $stmt->bind_param("s", $data);
                    $stmt->execute();
                }
            }
            $conn->commit();
            $stmt->close();
            $conn->close();
            respond(true, "刪除成功");
        } catch (Exception $e) {
            $conn->rollback();
            respond(false, "刪除失敗");
        }
    } else {
        respond(false, "資料為空");
    }
}

// 新增商品的photo
function addproductphoto()
{
    $productId = $_POST['productId'] ?? '';
    $photo = $_FILES['photo'] ?? '';
    if ($photo != '' && $productId != '') {
        $upload_dir = '../uploads/';
        $conn = create_connect();
        $conn->begin_transaction();
        $stmt = $conn->prepare("INSERT INTO productphoto (ProductId, photoPath) VALUES (?, ?)");
        try {
            foreach ($photo['name'] as $key => $data) {
                // set photo name
                $filename = date("YmdHis" . "_") . $data;
                // upload photo
                $photo_flag = move_uploaded_file($photo['tmp_name'][$key], $upload_dir . $filename);
                // can upload do insert into productphoto
                if ($photo_flag) {
                    $photopath = $filename;
                    $stmt->bind_param("ss", $productId, $photopath);
                    $photo_flag = $stmt->execute();
                } else {
                    break;
                }
            }
            $conn->commit();
            $stmt->close();
            $conn->close();
            respond(true, "新增成功");
        } catch (Exception $e) {
            $conn->rollback();
            respond(false, "新增失敗");
        }
    } else {
        respond(false, "資料為空", $productId);
    }
}

// 刪除商品的photo
function delproductphoto()
{
    $input = get_json_input();
    $photoId = $input['photoId'] ?? '';
    if ($photoId != '') {
        $conn = create_connect();
        $conn->begin_transaction();
        $stmt = $conn->prepare("DELETE FROM productphoto WHERE Id = ?");
        try {
            foreach ($photoId as $data) {
                $stmtpath = $conn->prepare("SELECT photoPath FROM productphoto WHERE Id = ?");
                $stmtpath->bind_param("s", $data);
                if ($stmtpath->execute()) {
                    $result = $stmtpath->get_result()->fetch_assoc();
                    if (file_exists($result['photoPath'])) {
                        if (!unlink($result['photoPath'])) {
                            throw new Exception("檔案刪除失敗：" . $data);
                        }
                    }
                    $stmt->bind_param("s", $data);
                    $stmt->execute();
                }
            }
            $conn->commit();
            $stmt->close();
            $conn->close();
            respond(true, "刪除成功");
        } catch (Exception $e) {
            $conn->rollback();
            respond(false, "刪除失敗", $e->getMessage());
        }
    } else {
        respond(false, '資料不得為空');
    }
}

// 獲取訂單
function getorder()
{
    $conn = create_connect();
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("SELECT * FROM orders");
        if ($stmt->execute()) {
            $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            foreach ($result as $key => $data) {
                $stmt = $conn->prepare("SELECT * FROM ordersproduct WHERE OrdersId = ?");
                $stmt->bind_param("s", $data['Id']);
                if ($stmt->execute()) {
                    $result[$key]["orderproduct"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                } else {
                    throw new Exception($stmt->error);
                }
                $stmt = $conn->prepare("SELECT * FROM orderstatus WHERE OrdersId = ?");
                $stmt->bind_param("s", $data['Id']);
                if ($stmt->execute()) {
                    $result[$key]["orderstatus"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                } else {
                    throw new Exception($stmt->error);
                }
            }
            respond(true, "獲取成功", $result);
        } else {
            throw new Exception($stmt->error);
        }

        $conn->commit();
    } catch (Exception $e) {
        $conn->rollback();
        respond(false, "獲取失敗", $e->getMessage());
    } finally {
        $conn->close();
        $stmt->close();
    }
}

// 訂單出貨狀態新增
function sendorder()
{
    $input = get_json_input();
    $orderId = $input['orderId'] ?? '';
    $status = $input['status'] ?? '';
    if ($orderId != '' && $status != '') {
        try {
            $conn = create_connect();
            $stmt = $conn->prepare("INSERT INTO orderstatus (OrdersId, OrdersStatus) VALUES (?, ?)");
            $stmt->bind_param("ss", $orderId, $status);
            if ($stmt->execute()) {
                respond(true, "新增成功");
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
        respond(false, "資料不得為空");
    }
}

// 獲取圖表資料
function getdata()
{
    $conn = create_connect();
    $conn->begin_transaction();
    try {
        $stmt = $conn->prepare("SELECT SUM(Total) FROM orders");
        if ($stmt->execute()) {
            $result["ALl_Orders_Price"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['SUM(Total)'];
            $stmt = $conn->prepare("SELECT COUNT(*) FROM users");
            if ($stmt->execute()) {
                $result["All_Users"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['COUNT(*)'];
                $stmt = $conn->prepare("SELECT COUNT(*) FROM orders WHERE CreateTime >= DATE_FORMAT(CURDATE(), '%Y-%m-01') AND CreateTime < DATE_FORMAT(CURDATE() + INTERVAL 1 MONTH, '%Y-%m-01')");
                if ($stmt->execute()) {
                    $result["This_Month_Orders"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC)[0]['COUNT(*)'];
                } else {
                    throw new Exception($stmt->error);
                }
            } else {
                throw new Exception($stmt->error);
            }
            respond(true, "獲取成功", $result);
            $conn->commit();
        } else {
            throw new Exception($stmt->error);
        }
    } catch (Exception $e) {
        respond(false, "獲取失敗", $e->getMessage());
        $conn->rollback();
    } finally {
        $conn->close();
        $stmt->close();
    }
}

// 獲取月份的營業額
function getmonthdata()
{
    try {
        $conn = create_connect();
        $Months = $_GET['Months'] ?? "";
        $stmt = $conn->prepare("WITH RECURSIVE months (n, Months) AS (
                                    SELECT 0, DATE_FORMAT(CURDATE(), '%Y-%m') 
                                    UNION ALL 
                                    SELECT n + 1, DATE_FORMAT(CURDATE() - INTERVAL (n + 1) MONTH, '%Y-%m') FROM months 
                                    WHERE n + 1 < ?
                                ),order_summary AS (
                                SELECT DATE_FORMAT(CreateTime, '%Y-%m') AS Months, SUM(Total) AS TotalAmount
                                FROM orders
                                WHERE CreateTime >= DATE_SUB(CURDATE(), INTERVAL ? MONTH)
                                GROUP BY DATE_FORMAT(CreateTime, '%Y-%m')
                                )
                                SELECT m.Months, IFNULL(os.TotalAmount, 0) AS This_Month_Price FROM months m LEFT JOIN order_summary os ON m.Months = os.Months ORDER BY m.Months");
        $stmt->bind_param("ii", $Months, $Months);
        if ($stmt->execute()) {
            $result["Six_Month_Price"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            respond(true, "獲取成功", $result);
        } else {
            throw new Exception($stmt->error);
        }
    } catch (Exception $e) {
        respond(false, "獲取失敗", $e->getMessage());
    } finally {
        $stmt->close();
        $conn->close();
    }
}

// 獲取月份的新會員數
function getmonthdata_member()
{
    try {
        $conn = create_connect();
        $Months = $_GET['Months'] ?? "";
        $stmt = $conn->prepare("WITH RECURSIVE months (n, Months) AS (
                                    SELECT 0, DATE_FORMAT(CURDATE(), '%Y-%m') 
                                    UNION ALL 
                                    SELECT n + 1, DATE_FORMAT(CURDATE() - INTERVAL (n + 1) MONTH, '%Y-%m') FROM months 
                                    WHERE n + 1 < ?
                                ),member_summary AS (
                                SELECT DATE_FORMAT(CreateTime, '%Y-%m') AS Months, COUNT(*) AS members_count
                                FROM users
                                WHERE CreateTime >= DATE_SUB(CURDATE(), INTERVAL ? MONTH)
                                GROUP BY DATE_FORMAT(CreateTime, '%Y-%m')
                                )
                                SELECT m.Months, IFNULL(os.members_count, 0) AS This_Month_Member FROM months m LEFT JOIN member_summary os ON m.Months = os.Months ORDER BY m.Months");
        $stmt->bind_param("ii", $Months, $Months);
        if ($stmt->execute()) {
            $result["N_Month_Member"] = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
            respond(true, "獲取成功", $result);
        } else {
            throw new Exception($stmt->error);
        }
    } catch (Exception $e) {
        respond(false, "獲取失敗", $e->getMessage());
    } finally {
        $stmt->close();
        $conn->close();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';
    switch ($action) {
        // 檢查管理員帳號
        case 'CheckAdminUser':
            CheckAdminUser();
            break;
        // 檢查金鑰
        case 'checkKey':
            checkKey();
            break;
        // 新增商品系列跟商品種類
        case 'addseries_producttype':
            addseries_producttype();
            break;
        // 修改商品系列跟商品種類
        case 'updateseries_producttype':
            updateseries_producttype();
            break;
        // 刪除商品系列跟商品種類跟商品
        case 'deleteseries_producttype_product':
            deleteseries_producttype_product();
            break;
        // 新增商品
        case 'insertproduct':
            insertproduct();
            break;
        // 修改商品
        case 'updateproduct':
            updateproduct();
            break;
        // 刪除商品
        case 'delproduct':
            delproduct();
            break;
        // 新增商品的 color&size
        case 'addproductcolor':
            addproductcolor();
            break;
        // 修改商品的 color&size
        case 'updateproductsize':
            updateproductsize();
            break;
        // 刪除商品的 color&size
        case 'delproductcolorsize':
            delproductcolorsize();
            break;
        // 新增商品照片
        case 'addproductphoto':
            addproductphoto();
            break;
        // 刪除商品的photo
        case 'delproductphoto':
            delproductphoto();
            break;
        // 訂單出貨狀態新增
        case 'sendorder':
            sendorder();
            break;
        default:
            respond(false, "無此動作");
    }
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'] ?? '';
    switch ($action) {
        // 找商品系列的資料
        case 'productseries':
            productseries();
            break;
        // 找商品種類的資料
        case 'producttype':
            producttype();
            break;
        // 搜尋與 seriesId 跟 producttypeId 相關的商品
        case 'searchproductlist':
            searchproductlist();
            break;
        // 搜尋 product 的商品給 edit.php
        case 'searcheditproduct':
            searcheditproduct();
            break;
        // 獲取訂單
        case 'getorder':
            getorder();
            break;
        // 獲取圖表資料
        case 'getdata':
            getdata();
            break;
        // 獲取月份的營業額
        case 'getmonthdata':
            getmonthdata();
            break;
        // 獲取月份的新會員數
        case 'getmonthdata_member':
            getmonthdata_member();
            break;
        default:
            respond(false, "無此動作");
    }
}
