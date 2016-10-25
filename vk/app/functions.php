<?php

//Used to store different static data
$config = [
    // Todo: find out good site name
    'name' => 'test.highload.com'
];

function siteName()
{
    global $config;
    echo $config['name'];
}

?>
