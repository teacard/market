📦 Market 專案 Docker 部署說明
這是一個使用 PHP 7.4 + Apache 與 MySQL 5.7 的後端 API 專案，已經打包為 Docker 映像，可直接部署使用。

📁 專案映像檔
映像名稱	說明
teacard/market-version-1.1-web	PHP + Apache API
mysql:5.7（官方）	資料庫

---

## 🚀 快速啟動（使用 Docker Compose）

### 1️⃣ 執行指令啟動容器

docker-compose up -d

### 2️⃣ 開始使用

在瀏覽器開啟：

http://localhost/

🐳 映像獨立使用（非 compose）

# 拉取映像
docker pull yourdockerid/market-version-1.1-web:latest

# 啟動 Web 容器
docker run -d -p 80:80 yourdockerid/market-version-1.1-web:latest

👨‍💻 作者

GitHub: teacard
Docker Hub: teacard
