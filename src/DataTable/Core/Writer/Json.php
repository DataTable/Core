<?php

namespace DataTable\Core\Writer;


class Json
{

    public function write($table)
    {
        $rows = array();

        $i = 0;
        foreach($table->getRows() as $row) {
            $rowdata = array();

            $i2=0;
            foreach($table->getColumns() as $c) {
                $cell = $row->getCellByIndex($i2);
                $value = $cell->getValue();
                $rowdata[$c->getName()] = $value;
                $i2++;
            }
            $rows[] = $rowdata;
            $i++;
        }

        $json = json_encode($rows, JSON_PRETTY_PRINT);

        return $json;
    }



}