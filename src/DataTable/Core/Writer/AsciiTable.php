<?php

namespace DataTable\Core\Writer;


class AsciiTable
{
    private function autoPad($value, $width, $padcharacter = ' ')
    {
        $value = substr($value, 0, $width);
        $value = str_pad($value, $width, $padcharacter);
        return $value;

    }

    private function asciiSeperator($table)
    {
        $o = '';
        $o .= '+------+-';
        foreach($table->getColumns() as $c) {
            $o .= $this->autoPad('', $c->getDisplayWidth(), '-') . '-+-';
        }
        $o .= "\n";
        return $o;
    }

    public function write($table)
    {
        $o = 'Table: "' . $table->getName() . "\"\n";

        $o .= $this->asciiSeperator($table);

        $o .= '| Row# | ';
        foreach($table->getColumns() as $c) {
            $o .= $this->autoPad($c->getName(), $c->getDisplayWidth()) . ' | ';
        }
        $o .= "\n";

        $o .= $this->asciiSeperator($table);


        $i = 0;
        foreach($table->getRows() as $row) {
            $o .= "| " . str_pad($i, 4, '0', STR_PAD_LEFT) . ' | ';
            $i2=0;
            foreach($table->getColumns() as $c) {
                $cell = $row->getCellByIndex($i2);
                $value = $cell->getValue();
                $value = $this->autoPad($value, $c->getDisplayWidth());
                $o .= $value . ' | ';
                $i2++;
            }
            $i++;
            $o .= "\n";
        }
        $o .= $this->asciiSeperator($table);

        return $o;
    }



}