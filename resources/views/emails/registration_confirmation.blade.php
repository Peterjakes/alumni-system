<!DOCTYPE html>
<html>
<head>
    <title>Event Registration Confirmation</title>
</head>
<body>
    <h1>Thanks for registering!</h1>
    <p>You have successfully registered for <strong>{{ $event->title }}</strong>.</p>
    <p>Date: {{ \Carbon\Carbon::parse($event->event_date)->toFormattedDateString() }}</p>
    <p>Location: {{ $event->location }}</p>
</body>
</html>
