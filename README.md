📦 Market 專案 Docker 部署說明

這是一個使用 PHP 7.4 + Apache 與 MySQL 5.7 的後端 API 專案，已經打包為 Docker 映像，可直接部署使用。

📁 專案映像檔

映像名稱	說明

teacard/market:v1.1	PHP7.4 + Apache2

mysql:5.7（官方）	資料庫

---

## 🚀 快速啟動（使用 Docker Compose）

### 1️⃣ 使用 git clone 下載

`git clone --branch version-1.1 https://github.com/teacard/market.git`

### 2️⃣ 切換到下載好的目錄中

`cd {你下載好的目錄路徑}`

### 3️⃣ 執行指令啟動容器

`docker-compose up -d`

### 4️⃣ 開始使用

在瀏覽器開啟：

(前台)http://localhost/

(後台)http://localhost:81/

👨‍💻 作者

GitHub: teacard
Docker Hub: teacard
