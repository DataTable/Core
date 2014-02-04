<?php

namespace DataTable\Core\Reader;

class Xml
{

    public function loadFile($table, $filename)
    {
        $xml = file_get_contents($filename);
        $root = simplexml_load_string($xml);
        $i = 0;
        foreach ($root->account as $node) {
            $row = $table->getRowByIndex($i);
            foreach($node->attributes() as $key=>$value) {
                $column = $table->getColumnByName($key);
                $cell = $row->getCellByColumnName($column->getName());
                $cell->setValue($value);
            }
            $i++;
        }
    }
}