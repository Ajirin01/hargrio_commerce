<!DOCTYPE html>
<html>
<head>
    <title>{{ $subjectLine }}</title>
</head>
<body>
    <h2>{{ $subjectLine }}</h2>
    <p>{!! nl2br(e($messageBody)) !!}</p>
    <hr>
    <p>Thank you for subscribing to our newsletter!</p>
</body>
</html>