$config = parse_ini_file('config.ini');
$db = new PDO($config['dsn'], $config['dbuser'], $config['dbpassword']);