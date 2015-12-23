<?php

namespace DataTable\Core\Reader;

use PHPExcel_Reader_Excel2007;
use PHPExcel_Reader_Excel5;

class Xls
{

    public function loadFile($table, $filename, $limit = 9999)
    {
        $PHPReader = new PHPExcel_Reader_Excel2007();
        if (!$PHPReader->canRead($filename)) {
            $PHPReader = new PHPExcel_Reader_Excel5();
            if (!$PHPReader->canRead($filename)) {
                exit('File does not exist, or it is not readable');
            }
        }
        $PHPExcel = $PHPReader->load($filename);
        $currentSheet = $PHPExcel->getSheet(0);
        $allColumn = $currentSheet->getHighestColumn();
        $allRow = $currentSheet->getHighestRow();
        $i = 1;
        while ($i <= $allRow && $i <= $limit+1) {
            $j = 'A';
            $z = 0;
            while ($j <= $allColumn) {
                $value = $currentSheet->getCell($j.$i)->getValue();
                if ($i == 1) {
                    $table->getColumnByName($value);
                } else {
                    $row = $table->getRowByIndex($i-2);
                    $cell = $row->getCellByIndex($z);
                    $cell->setValue($value);
                    $z++;
                }
                $j++;
            }
            $i++;
        }
    }
}
