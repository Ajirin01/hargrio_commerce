<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Redirecting to Tyl</title>
</head>
<body>
    <p>Redirecting to payment...</p>

    <form id="tylForm" action="https://test.ipg-online.com/connect/gateway/processing" method="post">
        @foreach($params as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <noscript>
            <button type="submit">Click here to proceed</button>
        </noscript>
    </form>

    <script>
        document.getElementById('tylForm').submit();
    </script>
</body>
</html>