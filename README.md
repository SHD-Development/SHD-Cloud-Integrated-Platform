# SHD-Cloud-Integrated-Platform
SHD Cloud致力於提供免費雲端服務，SHD Cloud線上整合平台是一個將我們提供的服務發揮的淋漓盡致的專案。
此專案使用 Laravel 來進行製作。
目前還在進行開發。

我們還有很多未完成的地方，並且技術性沒到我們的最高標準，建議您先不用下載使用，這只是一個完成約 25% 的專案。
代碼可能有遺失，缺漏，累贅等等，我們將在以後進行修復。

安裝：
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
