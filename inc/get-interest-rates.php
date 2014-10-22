<?php

$xml = 'http://www.rabodirect.co.nz/includes/figures.xml';

$handle = fopen($xml, "rb");

$contents = utf8_encode(htmlspecialchars_decode(stream_get_contents($handle)));

echo $contents;

die();