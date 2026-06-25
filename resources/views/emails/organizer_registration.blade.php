<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Event Registration</title>
</head>
<body>
    <h2>New registration for {{ $event->title }}</h2>

    <p>A new participant has registered:</p>

    <ul>
        <li>Name: {{ $registration->name }}</li>
        <li>Email: {{ $registration->email }}</li>
        @if($registration->phone)
        <li>Phone: {{ $registration->phone }}</li>
        @endif
        <li>Type: {{ $registration->participant_type }}</li>
        <li>Registration code: {{ $registration->registration_code }}</li>
    </ul>

    <p>Message:</p>
    <p>{{ $registration->message ?? '—' }}</p>

    <p>View event: {{ url('/events/' . $event->slug) }}</p>

    <p>Regards,<br>{{ config('app.name') }}</p>
</body>
</html>
