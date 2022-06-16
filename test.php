<?php

require __DIR__ . "/vendor/autoload.php";

//\Hocvt\MapSub\SrtReader::parse(__DIR__ . "/vie.srt");

\Hocvt\MapSub\SrtMapper::map(__DIR__ . "/vie.srt", __DIR__ . "/jpn.srt");