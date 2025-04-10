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
| ![HTML](https://img.shields.io/badge/-HTML5-E34F26?logo=html5&logoColor=fff&style=flat)| ![PHP](https://img.shields.io/badge/-PHP-777BB4?logo=php&logoColor=fff&style=flat) | ![Linux](https://img.shields.io/badge/-Linux-FCC624?logo=linux&logoColor=fff&style=flat) | ![Figma](https://img.shields.io/badge/-Figma-F24E1E?logo=figma&logoColor=fff&style=flat) |
| ![JavaScript](https://img.shields.io/badge/-JavaScript-F7DF1E?logo=javascript&logoColor=000&style=flat) | ![SQL](https://img.shields.io/badge/-MySQL-4479A1?logo=mysql&logoColor=fff&style=flat) | ![MySQL](https://img.shields.io/badge/-MySQL-4479A1?logo=mysql&logoColor=fff&style=flat) | ![Git](https://img.shields.io/badge/-Git-F05032?logo=git&logoColor=fff&style=flat)  |
| ![Vue 3](https://img.shields.io/badge/-Vue%203-4FC08D?logo=vue.js&logoColor=fff&style=flat) |![JSON](https://img.shields.io/badge/-JSON-000000?logo=json&logoColor=fff&style=flat)|![Ubuntu](https://img.shields.io/badge/-Ubuntu-E95420?logo=ubuntu&logoColor=fff&style=flat)| ![GitHub](https://img.shields.io/badge/-GitHub-181717?logo=github&logoColor=fff&style=flat) |
| ![jQuery](https://img.shields.io/badge/-jQuery-0769AD?logo=jquery&logoColor=fff&style=flat) |![RESTful API](https://img.shields.io/badge/-RESTful_API-4285F4?logo=api&logoColor=fff&style=flat)| ![Apache2](https://img.shields.io/badge/-Apache2-D22128?logo=apache&logoColor=fff&style=flat)|                                                |
| ![Bootstrap](https://img.shields.io/badge/-Bootstrap-563D7C?logo=bootstrap&logoColor=fff&style=flat) |![CORS](https://img.shields.io/badge/-CORS-008080?logo=shield&logoColor=fff&style=flat)|![FileZilla](https://img.shields.io/badge/-FileZilla-FF6600?logo=filezilla&logoColor=fff&style=flat)|
| ![Google Fonts](https://img.shields.io/badge/-Google_Fonts-4285F4?logo=googlefonts&logoColor=fff&style=flat) |![Exception](https://img.shields.io/badge/-Exception_Handling-FF5722?logo=bug&logoColor=fff&style=flat)|![Virtual Machine](https://img.shields.io/badge/-Virtual_Machine-339933?logo=vmware&logoColor=fff&style=flat)|
| ![Axios](https://img.shields.io/badge/-Axios-5A29E8?logo=axios&logoColor=fff&style=flat) |![Routing](https://img.shields.io/badge/-Dynamic_Routing-9C27B0?logo=server&logoColor=fff&style=flat)|||
| ![CSS](https://img.shields.io/badge/-CSS3-1572B6?logo=css3&logoColor=fff&style=flat) |![Security](https://img.shields.io/badge/-Security-00C853?logo=lock&logoColor=fff&style=flat)|                                          |                                                |
| ![Font Awesome](https://img.shields.io/badge/-Font_Awesome-2CAAE0?logo=font-awesome&logoColor=fff&style=flat) |![Prepared Statements](https://img.shields.io/badge/-Prepared_Statements-FFA500?logo=database&logoColor=fff&style=flat)|                                          |                                                |
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
- **虛擬機 (Virtual Machine)**：將整個部署架設於虛擬機內，提升資源彈性管理以及方便日後維護和擴充。

#### 其他技術說明

- **figma草稿圖**：
- [前往 Example 網站](https://www.example.com)

  - <a href="https://www.figma.com/proto/UCaRRbpUkeFQG8a5t8yI2c/%E7%B6%B2%E9%A0%81%E5%B0%88%E9%A1%8C-%E8%B2%B7%E9%BD%8A-?node-id=18-2&p=f&t=XMz6744mmhXX1cMY-1&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=18%3A2&show-proto-sidebar=1" target="_blank">figma草稿圖(電腦版)</a>
  - <a href="https://www.figma.com/proto/UCaRRbpUkeFQG8a5t8yI2c/%E7%B6%B2%E9%A0%81%E5%B0%88%E9%A1%8C-%E8%B2%B7%E9%BD%8A-?node-id=182-944&p=f&t=XMz6744mmhXX1cMY-1&scaling=min-zoom&content-scaling=fixed&page-id=0%3A1&starting-point-node-id=182%3A944&show-proto-sidebar=1" target="_blank">figma草稿圖(手機版)</a>

---

## 📷 畫面截圖

> 可在此放入專案畫面截圖  
> 建議圖片放在 `img/` 資料夾，再用以下語法插入：

<img src="https://github.com/teacard/market/blob/main/market/images/711Icon.png">
![商品頁面](img/product.png)
