#!/usr/bin/env php
<?php
$json = file_get_contents('php://stdin');
echo var_export(json_decode($json, true), true);

