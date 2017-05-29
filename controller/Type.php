<?php

/**
 * Created by PhpStorm.
 * User: moese
 * Date: 29-5-2017
 * Time: 21:21
 */

class Type {
    public $table = '';
    public $th = [];
    public $td = [];
    public $list = [];

    function __construct() {

    }

    /**
     *
     * $table = new table(['th' => ['ID', 'Name']],['td' => ['1', 'Rick']]);
     * echo $table->Read();
     *
     **/

    public function Table($th, $td) {
        foreach ($this->th as $th) {
            $this->table .= '<table class="table"><tr>';
            foreach($th as $r) {
                $this->table .= '<th>' . $r . '</th>';
            }
            $this->table .= '</tr>';
        }
        foreach ($this->td as $td) {
            $this->table .= '<tr>';
            foreach($td as $r) {
                $this->table .= '<td>' . $r . '</td>';
            }
            $this->table .= '</tr></table>';
        }
        return $this->table;
    }

    public function _List($list) {
        $data = '';
        $data .= '<ul>';
        foreach ($list as $ul) {
            $data .= '<li>'.$ul.'</li>';
        }
        $data .= '</ul>';
        return $data;
    }
}