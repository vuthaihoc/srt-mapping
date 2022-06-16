<?php

namespace Hocvt\MapSub;

use Carbon\Carbon;

class SrtMapper
{
    public static function map($file1, $file2){
        $paragraphs1 = SrtReader::parse($file1);
        $paragraphs2 = SrtReader::parse($file2);

        /** @var Paragraph $paragraph */
        foreach ($paragraphs1 as $paragraph){
            if($translation = self::findByTime($paragraph->start_time, $paragraph->end_time, $paragraphs2)){
                dump("=====================", $paragraph->content, $translation->content);
            }
        }
    }

    protected static function findByTime(Carbon $start, Carbon $end, array $paragraphs) : ?Paragraph{
        /** @var Paragraph $paragraph */
        foreach ($paragraphs as $paragraph){
            if(
                ($start->isAfter($paragraph->start_time) && $start->isBefore($paragraph->end_time)) ||
                ($end->isAfter($paragraph->start_time) && $end->isBefore($paragraph->end_time)) ||
                ($start->isBefore($paragraph->start_time) && $start->isAfter($paragraph->end_time)) ||
                ($start->isAfter($paragraph->start_time) && $start->isBefore($paragraph->end_time))
            ){
                return $paragraph;
            }
        }
        return null;
    }

}