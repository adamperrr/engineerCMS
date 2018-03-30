<html>
<head>

</head>
<body>
    <p>Nadawca: {{ $email['fromName'] }} &lt;<a href="mailto:{{ $email['fromEmail'] }}">{{ $email['fromEmail'] }}</a>&gt;</p>
    <p>Temat: <b>{{ $email['subject'] }}</b></p>
    <p>{{ $email['content'] }}</p>
</body>
</html>


