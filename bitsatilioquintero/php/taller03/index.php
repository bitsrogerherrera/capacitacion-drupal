<?php

require('Main.php');
use Main\Main as Main;

$program = new Main();
print("<html><head><title>Resultados</title></head><body><div>");
$program->doTask();
print("</div></body></html>");
