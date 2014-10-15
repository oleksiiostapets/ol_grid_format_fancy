<?php
/*
   Selection of utilities for making thinsg fancy


   Due to date functions, this controller requries PHP5.3+
   */

namespace fancygrid;
class Controller_Grid_Format_fancy extends \AbstractController {
    function initField($dt,$now='now'){
    }
    function formatField($field){
        $g=$this->owner;

        if($g->current_row[$field] == '') {
            return $g->current_row_html[$field] = '';
        }

        $now=new \DateTime('now');
        $dt=new \DateTime(Date(DATE_ATOM,$g->model[$field]));

        $interval=$dt->diff($now);
        $rel=$dt>$now?'':' ago';

        if($interval->format('%a')){

            return $g->current_row_html[$field] = $dt->format($this->api->getConfig('locale/date','d/m/Y'));
        }

        // Zero days, show fancy format
        $h=$interval->format('%h');
        if($h>1)return $g->current_row_html[$field] = $h.' hours'.$rel;
        if($h)return $g->current_row_html[$field] = 'a hour'.$rel;


        $m=$interval->format('%i');
        if($m>1)return $g->current_row_html[$field] = $m.' minutes'.$rel;

        return $dt>$now?$g->current_row_html[$field] = 'about a minute' : $g->current_row_html[$field] = 'just now';
    }
}
