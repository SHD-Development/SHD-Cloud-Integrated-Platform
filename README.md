# SHD-Cloud-Integrated-Platform
SHD Cloud致力於提供免費雲端服務，SHD Cloud線上整合平台是一個將我們提供的服務發揮的淋漓盡致的專案。
此專案使用 Laravel 來進行製作。
目前還在進行開發。

我們還有很多未完成的地方，並且技術性沒到我們的最高標準，建議您先不用下載使用，這只是一個完成約 25% 的專案。
代碼可能有遺失，缺漏，累贅等等，我們將在以後進行修復。

## 使用教學

### 環境需求
1. [PHP](https://php.net/) 需要至少為 8.1 或以上之版本。
2. 網頁伺服器，您可以選用 [Nginx](https://nginx.com/) 或 [Apache](https://httpd.apache.org/)。
3. 您需要 [Node.js](https://nodejs.org/) 以及 [npm](https://www.npmjs.com/) 或其他套件管理器，建議版本為第16版本或更高。
4. 您需要安裝 [Composer](https://getcomposer.org/)。
5. 您需要安裝並設定 [Mysql](https://mysql.com/) 建議您使用 [MariaDB](https://mariadb.org) 進行安裝。
6. 請安裝資料庫管理器 [phpMyAdmin](https://www.phpmyadmin.net/) 以管理資料庫，此步驟為非必要。

### 安裝
1. 首先請將原代碼下載下來。
2. 執行 `npm install`
3. 進到 `app/Providers/AppServiceProvider.php` 把 `boot` 方法下的東西全部註解起來
4. 執行 `composer install`
5. 在 `.env` 以及 `config/scip.php` 檔案更改您的設定
6. 執行 `php artisan migrate:refresh`
7. 進到 `app/Providers/AppServiceProvider.php` 把 `boot` 方法下的東西全部取消註解
8. 執行 `npm run dev`
9. 執行 `php artisan key:generate`
10. 執行 `php artisan serve`
11. 伺服器將在網頁端的 8000 Port 運行

### API 的使用
1. 您需要先在資料庫創建一個 API Key 以進行使用。
2. 請將 API Key 填入 `config/scip.php`。
3. API 分為六種中介層，內部分為讀、寫、讀與寫，外部也以此類推。
4. 您可以查看 `您的網域/api/docs` 看到目前外部的公開 API。
