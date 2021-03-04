<html>
<head>
  <title>Oh geez... What reality am I in?</title>
</head>

<!-- TODO: Remember to upgrade Azure subscription before trial ends. Company credit card is 1234-5678-1234-5678. -->

<body>
<h1> Server Information</h1>
<?php

function command_exist(string $cmd) : bool
{
    $return = exec("which " . $cmd) ;
    return !empty($return) ;
}

$OS_NAME = "";
$OS_VER = "";
$WEBPROG = "";

if (command_exist("uname"))
{
    $OS_NAME = exec("uname -r") ;
    $OS_VER = "";
}

echo "Kernel version: " . $OS_NAME . " " . $OS_VER . "<br/>";

if (command_exist("apache2"))
{
    $WEBPROG = exec("apache2 -V | grep ^Server\ version") ;
    if ($WEBPROG == "")
    {
        $WEBPROG = "Web Server: Apache (Undetermined version)" ;
    }
} elseif (command_exist("httpd"))
{
    $WEBPROG = exec("httpd -V | grep ^Server\ version") ;
    if ($WEBPROG == "")
    {
        $WEBPROG = "Web Server: Apache (Undetermined version)" ;
    }
} elseif (command_exist("nginx"))
{
    $WEBPROG = exec("nginx -V | grep ^nginx\ version") ;
    if ($WEBPROG == "")
    {
        $WEBPROG = "Web Server: NGINX (Undetermined version)";
    }
}

echo $WEBPROG . "<br/>";

echo "PHP Version: " . phpversion() . "<br/>";
?>

<h1> Running Processes </h1>
<?php
exec("ps -ef", $output);
foreach ($output as $i)
{
    echo $i . "<br/>";
}
?>
</body>
</html>
