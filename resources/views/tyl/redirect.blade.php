<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting to Payment</title>
    <style>
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: #f9f9f9;
        }

        .spinner-container {
            text-align: center;
        }

        .spinner {
            border: 8px solid #f3f3f3;
            border-top: 8px solid #007bff;
            border-radius: 50%;
            width: 80px;
            height: 80px;
            animation: spin 1s linear infinite;
            margin: 0 auto 20px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg);}
            100% { transform: rotate(360deg);}
        }

        .message {
            font-size: 1.2rem;
            color: #333;
        }

        .amount {
            font-size: 1.5rem;
            font-weight: bold;
            color: #007bff;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="spinner-container">
        <div class="spinner"></div>
        <div class="message">
            Please stay on this page while we redirect you to the secure payment page.
        </div>
        <div class="amount">
            Payable Amount: £{{ number_format($params['chargetotal'], 2) }}
        </div>

        <form id="tylForm" action="https://test.ipg-online.com/connect/gateway/processing" method="post">
            @foreach($params as $key => $value)
                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
            @endforeach
            <noscript>
                <button type="submit">Click here to proceed</button>
            </noscript>
        </form>
    </div>

    <script>
        // Auto-submit form after page loads
        window.addEventListener('load', function() {
            document.getElementById('tylForm').submit();
        });
    </script>
</body>
</html>