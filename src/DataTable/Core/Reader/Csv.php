<?php

namespace DataTable\Core\Reader;

class Csv
{

    private $seperator = ';';

    public function setSeperator($seperator)
    {
        $this->seperator = $seperator;
    }

    private function lineToFields($line)
    {
        $line = trim($line,  " \n\r");
        $fields = explode($this->seperator, $line);
        return $fields;
    }

    public function loadHeaders($table, $line)
    {
        $fields = $this->lineToFields($line);
        $i=0;
        foreach($fields as $field)
        {
            $column = $table->getColumnByName($field);

            if (strlen($field)>$column->getDisplayWidth()) {
                $column->setDisplayWidth(strlen($field));
            }

            $column->setIndex($i);
            $i++;
        }

    }

    public function loadFile($table, $filename, $limit = 9999)
    {
        $handle = fopen($filename, "r");
        if ($handle) {
            $line = fgets($handle, 4096);
            $this->loadHeaders($table, $line);

            $i = 0;
            while ((($line = fgets($handle, 4096)) !== false) && ($i<$limit)) {
                $row = $table->getRowByIndex($i);
                $values = $this->lineToFields($line);
                $i2=0;
                foreach($values as $value) {
                    if ($value!='') {
                        $column = $table->getColumnByIndex($i2);
                        if (strlen($value)>$column->getDisplayWidth()) {
                            $column->setDisplayWidth(strlen($value));
                        }
                        $cell = $row->getCellByIndex($i2);
                        $cell->setValue($value);
                    }
                    $i2++;
                }
                $i++;
            }
            /*
            if (!feof($handle)) {
                echo "Error: unexpected fgets() fail\n";
            }
            */
            fclose($handle);
        }

    }
}
