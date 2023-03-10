<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\ActivityLog;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function storeActivityLog($type, $description) {
        ActivityLog::create([
            'user_id' => auth()->id(),
            'type' => $type,
            'desc' => $description,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
    }

    protected function uploadFile($file, $path)
    {
        $filename = $this->generateUniqueFileName($file);
        $file->move($path, $filename);
        return $filename;
    }

    protected function deleteFile($path)
    {
        if (file_exists($path)) {
            unlink($path);
        }
    }

    protected function str_random($length)
    {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $result = '';
        for ($i = 0; $i < $length; $i++) {
            $result .= substr($pool, mt_rand(0, strlen($pool) - 1), 1);
        }
        return $result;
    }

    protected function generateUniqueFileName($file)
    {
        $extension = $file->getClientOriginalExtension();
        $randomString = $this->str_random(10);
        $filename = $randomString . '_' . time() . '_' . rand(0, 9999) . '.' . $extension;
        return $filename;
    }
}
