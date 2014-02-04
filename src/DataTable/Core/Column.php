<?php

namespace DataTable\Core;

class Column
{
    private $table;
    private $name;

    public function __construct($table, $name)
    {
        $this->table = $table;
        $this->name = $name;
    }
    /*
    public function setName($name)
    {
        $this->name = $name;
    }
    */

    public function getName()
    {
        return $this->name;
    }
    
    public function getTable()
    {
        return $this->table;
    }
    
    private $caption;
    public function setCaption($caption)
    {
        $this->caption = $caption;
    }

    public function getCaption()
    {
        return $this->caption;
    }


    private $index;
    public function setIndex($index)
    {
        $this->index = $index;
    }

    public function getIndex()
    {
        return $this->index;
    }



    private $displayWidth = 10;
    
    public function setDisplayWidth($displayWidth)
    {
        $this->displayWidth = $displayWidth;
    }

    public function getDisplayWidth()
    {
        return $this->displayWidth;
    }
    
}