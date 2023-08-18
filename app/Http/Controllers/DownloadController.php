<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DownloadController extends Controller
{
    public function downloadFile($filename)
{
    $filePath = storage_path("app/public/files/{$filename}");

    if (file_exists($filePath)) {
        return response()->download($filePath, $filename, [], 'inline');
    } else {
        abort(404);
    }
}

}
