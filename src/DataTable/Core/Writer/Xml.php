<?php

namespace DataTable\Core\Writer;

use DOMDocument;
use DOMElement;

class Xml
{

    public function write($table, $rootname = 'root', $recordname='record')
    {

        $doc = new DOMDocument();
        $root = new DOMElement($rootname);
        $doc->appendChild($root);



        $i = 0;
        foreach($table->getRows() as $row) {
            $rowdata = array();
            $e = new DOMElement($recordname);
            $root->appendChild($e);

            $i2=0;
            foreach($table->getColumns() as $c) {
                $cell = $row->getCellByIndex($i2);
                $value = $cell->getValue();
                $e->setAttribute($c->getName(), $value);
                $i2++;
            }
            $i++;
        }



        // Set formatting parameters
        $doc->preserveWhiteSpace = false;
        $doc->formatOutput = true;

        // render html string (pretty printed)
        $xml = $doc->saveXml($element);
        return $xml;
    }



}