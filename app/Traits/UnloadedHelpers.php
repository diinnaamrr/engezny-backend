<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait UnloadedHelpers
{
    public static function setEnvironmentValue($envKey, $envValue)
    {
        $envFile = app()->environmentFilePath();

        if (!is_file($envFile) || !is_writable($envFile)) {
            Log::warning('Unable to write to environment file.', [
                'file' => $envFile,
                'key' => $envKey,
            ]);

            return $envValue;
        }

        try {
            $str = file_get_contents($envFile);
            $oldValue = env($envKey);
            if (strpos($str, $envKey) !== false) {
                $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);
            } else {
                $str .= "{$envKey}={$envValue}\n";
            }

            file_put_contents($envFile, $str, LOCK_EX);
        } catch (\Throwable $exception) {
            Log::warning('Failed to update environment file.', [
                'file' => $envFile,
                'key' => $envKey,
                'message' => $exception->getMessage(),
            ]);
        }

        return $envValue;
    }
}
