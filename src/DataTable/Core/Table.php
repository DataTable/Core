<?php

namespace DataTable\Core;

use DataTable\Core\Column;
use DataTable\Core\Row;
use DataTable\Core\Cell;
use InvalidArgumentException;

class Table
{
    private $row = array();
    private $column = array();
    private $name;

    private $primaryKey;

    public function setPrimaryKey($primaryKey)
    {
        $this->primaryKey = $primaryKey;
    }


    public function hasColumnName($name) {
        foreach($this->column as $c)
        {
            if ($c->getName() == $name) {
                return true;
            }
        }
        return false;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    private $autocolumnindex = 0;
    public function getColumnByName($name)
    {
        if (!isset($this->column[$name])) {
            $c = new Column($this, $name);
            $this->column[$name] = $c;
            $c->setIndex($this->autocolumnindex);
            $this->autocolumnindex++;
        }
        return $this->column[$name];
    }

    
    public function getColumnByIndex($i)
    {
        foreach($this->column as $c)
        {
            if ($c->getIndex() == $i) {
                return $c;
            }
        }
        throw new InvalidArgumentException('Columnindex not found in this table: ' . $i);
    }

    public function getRows()
    {
        return $this->row;
    }

    public function getColumns()
    {
        return $this->column;
    }

    public function getRowByIndex($i)
    {
        if (!isset($this->row[$i])) {
            $r = new Row($this);
            $this->row[$i] = $r;
        }
        return $this->row[$i];
    }
}