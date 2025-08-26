<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dynamic URL Examples</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .example { margin: 20px 0; padding: 15px; border: 1px solid #ddd; border-radius: 5px; }
        .code { background: #f5f5f5; padding: 10px; border-radius: 3px; font-family: monospace; }
        .result { background: #e8f5e8; padding: 10px; border-radius: 3px; margin-top: 10px; }
        .env-info { background: #fff3cd; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>🌐 Dynamic URL Examples</h1>
    
    <div class="env-info">
        <h3>Current Environment Information</h3>
        <p><strong>Current URL:</strong> @currentUrl</p>
        <p><strong>Environment:</strong> {{ App\Helpers\UrlHelper::getEnvironment() }}</p>
        <p><strong>Host:</strong> {{ App\Helpers\UrlHelper::getHost() }}</p>
        <p><strong>Port:</strong> {{ App\Helpers\UrlHelper::getPort() }}</p>
    </div>

    <div class="example">
        <h3>1. Dynamic Asset URLs</h3>
        <div class="code">
            &lt;img src="@dynamicAsset('images/logo.png')" alt="Logo"&gt;
        </div>
        <div class="result">
            <strong>Result:</strong> <img src="@dynamicAsset('images/logo.png')" alt="Logo" style="height: 30px;">
        </div>
    </div>

    <div class="example">
        <h3>2. Dynamic Secure Asset URLs</h3>
        <div class="code">
            &lt;img src="@dynamicSecureAsset('images/logo.png')" alt="Logo"&gt;
        </div>
        <div class="result">
            <strong>Result:</strong> <img src="@dynamicSecureAsset('images/logo.png')" alt="Logo" style="height: 30px;">
        </div>
    </div>

    <div class="example">
        <h3>3. Environment-Specific Content</h3>
        
        @ifLocalhost
        <div class="result">
            <strong>Localhost Environment:</strong> This content only shows on localhost
        </div>
        @endifLocalhost

        @ifNgrok
        <div class="result">
            <strong>Ngrok Environment:</strong> This content only shows on ngrok
        </div>
        @endifNgrok

        @ifProduction
        <div class="result">
            <strong>Production Environment:</strong> This content only shows on production
        </div>
        @endifProduction
    </div>

    <div class="example">
        <h3>4. Conditional Asset Loading</h3>
        
        @ifLocalhost
        <div class="code">
            &lt;link href="@dynamicAsset('css/dev.css')" rel="stylesheet"&gt;
        </div>
        <div class="result">
            <strong>Development CSS:</strong> @dynamicAsset('css/dev.css')
        </div>
        @endifLocalhost

        @ifNgrok
        <div class="code">
            &lt;link href="@dynamicSecureAsset('css/ngrok.css')" rel="stylesheet"&gt;
        </div>
        <div class="result">
            <strong>Ngrok CSS:</strong> @dynamicSecureAsset('css/ngrok.css')
        </div>
        @endifNgrok

        @ifProduction
        <div class="code">
            &lt;link href="@dynamicSecureAsset('css/prod.css')" rel="stylesheet"&gt;
        </div>
        <div class="result">
            <strong>Production CSS:</strong> @dynamicSecureAsset('css/prod.css')
        </div>
        @endifProduction
    </div>

    <div class="example">
        <h3>5. API Endpoints</h3>
        <div class="code">
            const apiUrl = '@currentUrl/api/books';
        </div>
        <div class="result">
            <strong>API URL:</strong> @currentUrl/api/books
        </div>
    </div>

    <div class="example">
        <h3>6. WebSocket URLs</h3>
        @ifLocalhost
        <div class="code">
            const wsUrl = 'ws://localhost:6001';
        </div>
        <div class="result">
            <strong>WebSocket URL:</strong> ws://localhost:6001
        </div>
        @endifLocalhost

        @ifNgrok
        <div class="code">
            const wsUrl = 'wss://{{ App\Helpers\UrlHelper::getHost() }}';
        </div>
        <div class="result">
            <strong>WebSocket URL:</strong> wss://{{ App\Helpers\UrlHelper::getHost() }}
        </div>
        @endifNgrok
    </div>

    <div class="example">
        <h3>7. Admin Panel Links</h3>
        <div class="code">
            &lt;a href="@currentUrl/admin"&gt;Admin Panel&lt;/a&gt;
        </div>
        <div class="result">
            <strong>Admin Link:</strong> <a href="@currentUrl/admin">Admin Panel</a>
        </div>
    </div>

    <div class="example">
        <h3>8. File Upload URLs</h3>
        <div class="code">
            const uploadUrl = '@currentUrl/api/upload';
        </div>
        <div class="result">
            <strong>Upload URL:</strong> @currentUrl/api/upload
        </div>
    </div>

    <div class="example">
        <h3>9. Environment Detection in JavaScript</h3>
        <script>
            const currentUrl = '@currentUrl';
            const environment = '{{ App\Helpers\UrlHelper::getEnvironment() }}';
            
            // Environment detection for dynamic URL handling
            if (environment === 'local') {
                // Local development mode
            } else if (environment === 'ngrok') {
                // Ngrok tunnel mode
            } else if (environment === 'production') {
                // Production mode
            }
        </script>
        <div class="result">
            <strong>JavaScript Variables:</strong> Check browser console for environment info
        </div>
    </div>

    <div class="example">
        <h3>10. Meta Tags</h3>
        <div class="code">
            &lt;meta property="og:url" content="@currentUrl"&gt;
        </div>
        <div class="result">
            <strong>OG URL:</strong> @currentUrl
        </div>
    </div>

    <hr>
    
    <h2>🔧 How to Use</h2>
    
    <h3>Set URL for Different Environments:</h3>
    <div class="code">
        # Local development
        ./scripts/set-url.sh local
        
        # Ngrok tunnel
        ./scripts/set-url.sh ngrok your-ngrok-url.ngrok-free.app
        
        # Production
        ./scripts/set-url.sh production yourdomain.com
    </div>

    <h3>Available Blade Directives:</h3>
    <ul>
        <li><code>@dynamicAsset('path')</code> - Generate asset URL with current domain</li>
        <li><code>@dynamicSecureAsset('path')</code> - Generate secure asset URL</li>
        <li><code>@currentUrl</code> - Get current application URL</li>
        <li><code>@ifLocalhost</code> - Check if running on localhost</li>
        <li><code>@ifNgrok</code> - Check if running on ngrok</li>
        <li><code>@ifProduction</code> - Check if running on production</li>
    </ul>

    <p><a href="/">← Back to Home</a></p>
</body>
</html>
