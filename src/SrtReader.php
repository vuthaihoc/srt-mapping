<?php

namespace Hocvt\MapSub;

use Illuminate\Support\Collection;

class SrtReader
{
    public static function parse($file) : array {
        $content = file_get_contents($file);
        $blocks = preg_split("/\n\r?\n/ui",$content);
        $paragraphs = [];
        foreach ($blocks as $block){
            if($paragraph = Paragraph::parse($block)){
                $paragraphs[] = $paragraph;
            }
        }
        return $paragraphs;
    }
}