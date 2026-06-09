<?php
namespace App\Traits;

use Illuminate\Support\Facades\Log;

trait UnloadedHelpers
{
    public static function setEnvironmentValue($envKey, $envValue)
    {
        if (!app()->environment('local')) {
            return $envValue;
        }

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
            if ($str === false) {
                return $envValue;
            }

            $oldValue = env($envKey);
            if (strpos($str, $envKey) !== false) {
                $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);
            } else {
                $str .= "{$envKey}={$envValue}\n";
            }

            if (@file_put_contents($envFile, $str, LOCK_EX) === false) {
                Log::warning('Failed to write environment file.', [
                    'file' => $envFile,
                    'key' => $envKey,
                ]);
            }
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
