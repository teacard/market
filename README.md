## 📌 功能介紹
### 🔹 前台
- 瀏覽商品清單與詳細資訊
- 商品分類與系列篩選
- 加入商品至購物車
- 下單購買流程
### 🔹 後台
- 商品上架 / 編輯 / 刪除
- 管理商品分類與系列
- 訂單與會員資訊管理

---

## 🔧 使用技術



| 🔧 前端                                        | 🖥️ 後端                                    | 💾 資料庫                              | 🛠️ 其他工具                                  |
|------------------------------------------------|--------------------------------------------|----------------------------------------|----------------------------------------------|
| ![HTML](https://img.shields.io/badge/-HTML5-E34F26?logo=html5&logoColor=fff&style=flat)| ![PHP](https://img.shields.io/badge/-PHP-777BB4?logo=php&logoColor=fff&style=flat) | ![Linux](https://img.shields.io/badge/-Linux-FCC624?logo=linux&logoColor=fff&style=flat) | ![GitHub](https://img.shields.io/badge/-GitHub-181717?logo=github&logoColor=fff&style=flat) |
| ![JavaScript](https://img.shields.io/badge/-JavaScript-F7DF1E?logo=javascript&logoColor=000&style=flat) | ![SQL](https://img.shields.io/badge/-MySQL-4479A1?logo=mysql&logoColor=fff&style=flat) | ![MySQL](https://img.shields.io/badge/-MySQL-4479A1?logo=mysql&logoColor=fff&style=flat) | ![Git](https://img.shields.io/badge/-Git-F05032?logo=git&logoColor=fff&style=flat)  |
| ![Vue 3](https://img.shields.io/badge/-Vue%203-4FC08D?logo=vue.js&logoColor=fff&style=flat) |![JSON](https://img.shields.io/badge/-JSON-000000?logo=json&logoColor=fff&style=flat)|![Ubuntu](https://img.shields.io/badge/-Ubuntu-E95420?logo=ubuntu&logoColor=fff&style=flat)|  |
| ![jQuery](https://img.shields.io/badge/-jQuery-0769AD?logo=jquery&logoColor=fff&style=flat) |![RESTful API](https://img.shields.io/badge/-RESTful_API-4285F4?logo=api&logoColor=fff&style=flat)| ![Apache2](https://img.shields.io/badge/-Apache2-D22128?logo=apache&logoColor=fff&style=flat)|                                                |
| ![Bootstrap](https://img.shields.io/badge/-Bootstrap-563D7C?logo=bootstrap&logoColor=fff&style=flat) |![Exception](https://img.shields.io/badge/-Exception_Handling-FF5722?logo=bug&logoColor=fff&style=flat)|![FileZilla](https://img.shields.io/badge/-FileZilla-FF6600?logo=filezilla&logoColor=fff&style=flat)|
| ![Google Fonts](https://img.shields.io/badge/-Google_Fonts-4285F4?logo=googlefonts&logoColor=fff&style=flat) ||![Virtual Machine](https://img.shields.io/badge/-Virtual_Machine-339933?logo=vmware&logoColor=fff&style=flat)|
| ![Axios](https://img.shields.io/badge/-Axios-5A29E8?logo=axios&logoColor=fff&style=flat) ||![AWS](https://img.shields.io/badge/-AWS-232F3E?logo=amazon-aws&logoColor=fff&style=flat)
||
| ![CSS](https://img.shields.io/badge/-CSS3-1572B6?logo=css3&logoColor=fff&style=flat) ||                                          |                                                |
| ![Font Awesome](https://img.shields.io/badge/-Font_Awesome-2CAAE0?logo=font-awesome&logoColor=fff&style=flat) ||                                          |                                                |
| ![SweetAlert2](https://img.shields.io/badge/-SweetAlert2-FF5E5B?logo=sweetalert2&logoColor=fff&style=flat) |  |  |
| ![AJAX](https://img.shields.io/badge/-AJAX-0066FF?logo=ajax&logoColor=fff&style=flat) |  |  |
| ![Mitt](https://img.shields.io/badge/-Mitt-FF4081?logo=&logoColor=fff&style=flat) |  |  |


### 其他說明

#### 前端技術說明

- **HTML5 & CSS3**：使用標準 HTML5 撰寫網頁結構，並利用 CSS3（包含自訂 CSS）來定義樣式與排版（例如利用 CSS Grid、媒體查詢等建立響應式介面）。
- **Bootstrap**：載入 Bootstrap 提供的 CSS 與 JavaScript 插件，快速實作響應式的導航列、卡片、表單與其他常見 UI 元件，並與自訂樣式搭配使用。
- **jQuery**：載入 jQuery 庫以輔助部分 DOM 操作和事件處理（例如根據側邊欄狀態調整內容區域）。
- **Vue 3**：採用 Vue 3 建構前端應用，利用其資料綁定、指令（如 `v-for`、`v-model`）及生命週期鉤子來管理互動與表單驗證，並整合到多頁面環境中。
- **Axios**：使用 Axios 進行 AJAX 請求，與後端 API 交換 JSON 格式資料，實現新增商品、更新資料等功能。
- **SweetAlert2**：整合 SweetAlert2 當作彈出視窗，提供使用者友善的提示與錯誤訊息，改善操作體驗。
- **Font Awesome**：利用 Font Awesome 的圖示，豐富頁面元件（例如選單、按鈕）的視覺呈現，使介面更直觀。
- **Google Fonts**：載入 Google Fonts 來統一網頁字型與風格，使頁面美觀且具現代感。
- **Mitt**：採用 Mitt 實現輕量級事件總線（Event Bus），方便 Vue 組件間的通訊與事件管理。

#### 後端技術說明

- **RESTful API**：根據 HTTP 請求的方法（GET、POST 等）及 URL 參數來分派不同功能，使 API 更具彈性和擴展性。
- **CORS 處理**：透過設定 HTTP 標頭（例如 `Access-Control-Allow-Origin`、`Access-Control-Allow-Methods` 與 `Access-Control-Allow-Headers`）來允許跨域請求。
- **Exception Handling**：採用 try-catch-finally 結構捕捉並處理錯誤，提升 API 穩定性。
- **Dynamic Routing**：根據 HTTP 請求的方法（POST/GET）與 URL 中的 `action` 參數，動態分配不同 API 功能。
- **Security**：使用 `password_hash()` 與 `password_verify()` 加密與驗證密碼，確保使用者資料安全。
- **Prepared Statements**：利用 mysqli 的 prepared statements 與 `bind_param()` 來防範 SQL 注入攻擊。

#### 資料庫技術說明

- **Ubuntu**：使用 Ubuntu 作為主系統提供穩定且安全的作業環境，適合用來架設資料庫與網頁伺服器。
- **Apache2**：部署 Apache2 作為 Web 伺服器，用於處理 HTTP 請求與傳輸靜態/動態內容。
- **FileZilla**：利用 FileZilla 進行檔案傳輸，使得上傳與管理伺服器上的檔案更為便捷。
- **虛擬機(Virtual Machine)**：將整個部署架設於虛擬機內，提升資源彈性管理以及方便日後維護和擴充。
- **AWS（Amazon Web Services）**：採用 AWS 提供的雲端基礎架構，透過 EC2 虛擬機搭配彈性 IP 與安全群組，實現穩定、安全且可擴展的部署環境。

#### 其他技術說明

- **figma草稿圖**：
  - [figma草稿圖(電腦版)](https://www.figma.com/proto/UCaRRbpUkeFQG8a5t8yI2c/%E7%B6%B2%E9%A0%81%E5%B0%88%E9%A1%8C-%E8%B2%B7%E9%BD%8A-?node-id=18-2&p=f&t=Kje8GoIMzsTqv5BD-1&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=18%3A2&show-proto-sidebar=1)
  - [figma草稿圖(手機版)](https://www.figma.com/proto/UCaRRbpUkeFQG8a5t8yI2c/%E7%B6%B2%E9%A0%81%E5%B0%88%E9%A1%8C-%E8%B2%B7%E9%BD%8A-?node-id=182-944&p=f&t=XMz6744mmhXX1cMY-1&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=182%3A944&show-proto-sidebar=1)

---

## ⚙️ 功能簡介

### 1. 會員系統
- **會員註冊/登入**：用戶可創建帳號並登入系統。
- **會員資料管理**：管理基本會員資料、變更密碼等。
- **會員等級**：根據會員消費狀況提供不同等級的福利。
- **收藏功能**：用戶可以收藏商品，方便日後購買。

### 2. 商品系統
- **商品管理**：後端可新增、編輯與刪除商品。
- **商品分類**：商品可依類別進行分類，便於用戶查找。
- **商品規格管理**：商品可設置不同顏色、尺寸與規格，並對應不同價格與庫存。
- **商品優惠**：可設置商品促銷與折扣，吸引消費者購買。
- **商品評論**：用戶可對已購買商品進行評價，幫助其他用戶做出購買決策。(待更新)

### 3. 賣場系統
- **訂單管理**：後端可查看與處理訂單，更新訂單狀態。
- **購物車功能**：用戶可以將商品加入購物車，並在結帳時選擇數量和規格。
- **付款與運送方式**：支援多種付款方式與運送選項，提供用戶便捷的結帳體驗。
- **訂單歷史記錄**：用戶可查看歷史訂單，並追蹤物流狀態。

### 4. 前端功能
- **商品展示**：以視覺化方式展示商品，包含圖片、價格、顏色、尺寸等詳細信息。
- **搜尋功能**：用戶可依關鍵字或分類快速搜尋商品。
- **響應式設計**：平台支持手機與桌面設備，提供最佳的瀏覽體驗。

### 📦 後台畫面展示

#### 🔐 後台登入與錯誤訊息
<p>
  <img src="https://github.com/teacard/market/blob/main/showimages/admin-login.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/admin-login-false.jpg" width="400">
</p>

#### 🏠 後台主頁
<img src="https://github.com/teacard/market/blob/main/showimages/admin-home.jpg" width="400">

#### ➕ 後台新增商品系列
<img src="https://github.com/teacard/market/blob/main/showimages/admin-add-series.jpg" width="400">

#### ✏️ 後台修改商品系列
<img src="https://github.com/teacard/market/blob/main/showimages/admin-edit-series.jpg" width="400">

#### ❌ 後台刪除商品系列
<img src="https://github.com/teacard/market/blob/main/showimages/admin-del-series.jpg" width="400">

#### 📦 後台商品管理
<img src="https://github.com/teacard/market/blob/main/showimages/admin-product.jpg" width="400">

#### ➕ 後台新增商品
<p>
  <img src="https://github.com/teacard/market/blob/main/showimages/admin-add-product.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/admin-add-product-1.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/admin-add-product-2.jpg" width="400">
</p>

#### ✏️ 後台修改商品
<p>
  <img src="https://github.com/teacard/market/blob/main/showimages/admin-edit-product.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/admin-edit-product-1.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/admin-edit-product-2.jpg" width="400">
</p>

#### 🛠️ 後台訂單管理
<p>
  <img src="https://github.com/teacard/market/blob/main/showimages/admin-order.jpg" width="400">
</p>

---

### 🛒 前台畫面展示

#### 🔐 前台登入 / 註冊
<p>
  <img src="https://github.com/teacard/market/blob/main/showimages/market-login.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/market-login-2.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/market-submit.jpg" width="400">
</p>

#### 🏠 前台主頁
<p>
  <img src="https://github.com/teacard/market/blob/main/showimages/market-home.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/market-home-1.jpg" width="400">
</p>

#### 📦 前台商品瀏覽
<p>
  <img src="https://github.com/teacard/market/blob/main/showimages/market-product.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/market-product-1.jpg" width="400">
</p>

#### 🛍️ 前台購物車與訂單
<p>
  <img src="https://github.com/teacard/market/blob/main/showimages/market-shopcart.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/market-orderdata.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/market-orderdata-3-discount-api.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/market-orderdata-4-success.jpg" width="400">
</p>

#### 🔄 訂單 API 串接
<p>
  <img src="https://github.com/teacard/market/blob/main/showimages/market-orderdata-2-711-api.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/market-discount.jpg" width="400">
</p>

#### 🎟️ 前台優惠券頁面
<img src="https://github.com/teacard/market/blob/main/showimages/market-discount.jpg" width="400">

### 📄 訂單頁面
<p>
  <img src="https://github.com/teacard/market/blob/main/showimages/market-allorders-1-all.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/market-allorders-2-cannel.jpg" width="400">
  <img src="https://github.com/teacard/market/blob/main/showimages/market-orderdetail.jpg" width="400">
</p>


## 📬 聯絡作者
- **👤作者**：teacard
- **📧Email**: chap39672@gmail.com
