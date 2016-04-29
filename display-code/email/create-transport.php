$transport = Swift_SmtpTransport::newInstance('smtp.example.com', 25);
$mailer = Swift_Mailer::newInstance($transport);