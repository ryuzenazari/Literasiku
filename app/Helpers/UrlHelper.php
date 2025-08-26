<?php

namespace App\Helpers;

class UrlHelper
{
    /**
     * Get the current application URL dynamically
     */
    public static function getAppUrl(): string
    {
        $url = config('app.url');
        
        // If running in console, try to detect from request
        if (app()->runningInConsole()) {
            return $url;
        }
        
        // If we have a request, use it to build the URL
        if (request()) {
            $scheme = request()->getScheme();
            $host = request()->getHost();
            $port = request()->getPort();
            
            // Only add port if it's not standard (80 for HTTP, 443 for HTTPS)
            $portString = ($port == 80 || $port == 443) ? '' : ":$port";
            
            return "{$scheme}://{$host}{$portString}";
        }
        
        return $url;
    }
    
    /**
     * Get the current host dynamically
     */
    public static function getHost(): string
    {
        if (request()) {
            return request()->getHost();
        }
        
        return config('app.host', 'localhost');
    }
    
    /**
     * Get the current port dynamically
     */
    public static function getPort(): int
    {
        if (request()) {
            return request()->getPort();
        }
        
        return (int) config('app.port', 8000);
    }
    
    /**
     * Check if running on localhost
     */
    public static function isLocalhost(): bool
    {
        $host = self::getHost();
        return in_array($host, ['localhost', '127.0.0.1', '::1']);
    }
    
    /**
     * Check if running on ngrok
     */
    public static function isNgrok(): bool
    {
        $host = self::getHost();
        return str_contains($host, 'ngrok');
    }
    
    /**
     * Get environment type
     */
    public static function getEnvironment(): string
    {
        if (self::isNgrok()) {
            return 'ngrok';
        }
        
        if (self::isLocalhost()) {
            return 'local';
        }
        
        return 'production';
    }
    
    /**
     * Generate asset URL with proper scheme
     */
    public static function asset(string $path): string
    {
        $baseUrl = self::getAppUrl();
        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }
    
    /**
     * Generate secure asset URL
     */
    public static function secureAsset(string $path): string
    {
        $baseUrl = self::getAppUrl();
        
        // Force HTTPS for non-localhost environments
        if (!self::isLocalhost()) {
            $baseUrl = str_replace('http://', 'https://', $baseUrl);
        }
        
        return rtrim($baseUrl, '/') . '/' . ltrim($path, '/');
    }
}
