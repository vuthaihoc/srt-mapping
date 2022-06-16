<?php

namespace Hocvt\MapSub;

use Carbon\Carbon;

class Paragraph
{
    public function __construct(
        public $id,
        public $content = '',
        public $start_time = null,
        public $end_time = null,
    )
    {
    }

    public static function parse($block){
        $lines = explode("\n", $block, 3);
        if(count($lines) < 3){
            return null;
        }
        [$start, $end] = self::parseTimes($lines[1]);
        return new self(
            id: trim($lines[0]),
            content: trim($lines[2]),
            start_time: $start,
            end_time: $end,
        );
    }

    public static function parseTimes($times){
        list($start, $end) = explode(" --> ", $times);
        return [
            Carbon::parse(preg_replace("/\,.*$/", "", $start)),
            Carbon::parse(preg_replace("/\,.*$/", "", $end)),
        ];
    }

}