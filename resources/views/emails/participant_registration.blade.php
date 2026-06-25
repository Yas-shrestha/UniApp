<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Registration Confirmation</title>
</head>
<body>
    <h2>You're registered for {{ $event->title }}</h2>

    <p>Hi {{ $registration->name }},</p>

    <p>Thank you for registering for <strong>{{ $event->title }}</strong> on {{ $event->formatted_date }} at {{ $event->time }}.</p>

    <p>Your registration code: <strong>{{ $registration->registration_code }}</strong></p>

    @if($registration->phone)
    <p>Phone: {{ $registration->phone }}</p>
    @endif

    <p>We will contact you with more details soon.</p>

    <p>Regards,<br>{{ config('app.name') }}</p>
</body>
</html>
