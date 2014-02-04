<?php

namespace DataTable\Core\Writer;

class Csv
{
    private $seperator = ';';

    public function setSeperator($seperator)
    {
        $this->seperator = $seperator;
    }

    public function write($table)
    {
        $o = '';
        foreach($table->getColumns() as $c) {
            $o .= $c->getName() . $this->seperator;
        }
        $o .= "\n";

        $i = 0;
        foreach($table->getRows() as $row) {
            $i2=0;
            foreach($table->getColumns() as $c) {
                $cell = $row->getCellByIndex($i2);
                $value = $cell->getValue();
                $o .= $value . $this->seperator;
                $i2++;
            }
            $i++;
            $o .= "\n";
        }

        return $o;
    }
}