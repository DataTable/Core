<?php

namespace DataTable\Core;

class Row
{
    private $index;
    private $cell = array();
    private $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    public function setIndex($index)
    {
        $this->index = $index;
    }

    public function getIndex()
    {
        return $this->index;
    }

    public function getCells($cell)
    {
        return $this->cell;

    }

    public function getCellByColumnName($name)
    {
        if (!isset($this->cell[$name])) {
            $c = new Cell();
            $this->cell[$name] = $c;
        }
        return $this->cell[$name];
    }

    public function getCellByIndex($i)
    {
        $column = $this->table->getColumnByIndex($i);
        $cell = $this->getCellByColumnName($column->getName());
        return $cell;
    }

    public function getValueByColumnName($name)
    {
        $cell = $this->getCellByColumnName($name);
        return $cell->getValue();
    }
    
}