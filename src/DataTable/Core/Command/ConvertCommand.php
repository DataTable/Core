<?php

namespace DataTable\Core\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use DataTable\Core\Table;
use DataTable\Core\Reader\Csv as CsvReader;
use DataTable\Core\Reader\Xml as XmlReader;
use DataTable\Core\Writer\Csv as CsvWriter;
use DataTable\Core\Writer\AsciiTable as AsciiTableWriter;
use DataTable\Core\Writer\Json as JsonWriter;
use DataTable\Core\Writer\Xml as XmlWriter;
use InvalidArgumentException;
use RuntimeException;

class ConvertCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('datatable:convert')
            ->setDescription('Convert from one table format into another')
            ->addArgument(
                'inputfile',
                InputArgument::REQUIRED,
                'Input filename'
            )
            ->addArgument(
                'outputfile',
                InputArgument::REQUIRED,
                'Output filename'
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $inputfile = $input->getArgument('inputfile');
        $outputfile = $input->getArgument('outputfile');


        $t = new Table();
        $t->setName(basename($inputfile));

        $reader = new CsvReader();
        $reader->setSeperator(',');

        $reader = new XmlReader();

        $reader->loadFile($t, $inputfile);

        $writer = new AsciiTableWriter();
        //$writer = new JsonWriter();
        //$writer = new XmlWriter();
        $output = $writer->write($t);
        //$output = $writer->write($t, 'accounts', 'account');
        echo $output;
        exit();

    }
}
