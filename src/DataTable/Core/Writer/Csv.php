<?php

namespace DataTable\Core\Writer;

class Csv
{
    private $seperator = ';';
    private $enclosure = '"';

    public function setSeperator($seperator)
    {
        $this->seperator = $seperator;
    }

    public function setEnclosure($enclosure)
    {
        $this->enclosure = $enclosure;
    }

    public function write($table)
    {
        $o = '';
        foreach($table->getColumns() as $c) {
            $o .= $this->enclosure . $c->getName() . $this->enclosure . $this->seperator;
        }
        $o .= "\n";

        $i = 0;
        foreach($table->getRows() as $row) {
            $i2=0;
            foreach($table->getColumns() as $c) {
                $cell = $row->getCellByIndex($i2);
                $value = $cell->getValue();
                $o .= $this->enclosure . $value . $this->enclosure . $this->seperator;
                $i2++;
            }
            $i++;
            $o .= "\n";
        }

        return $o;
    }
}
