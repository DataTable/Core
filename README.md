# The DataTable Library

Represents in-memory table data such as:

* Database tables
* Database result sets
* CSV files
* Excel files
* Data grids
* ... etc


## Why use the DataTable library?

* Do you need to import end-user data from different formats into your system?
* Do you need to export data from your system into different formats?
* Did you ever import csv data into a database, then import from excel, yaml, xml, etc?
* Did you ever export data from a database into csv, then export to excel, yaml, xml, pdf, etc?

This is where a "DataTable" comes in. It sits *in between* your importers, exporters and your application data.

It allows you to write really awesome:

* Importers, based on DataTables
* Exporters, based on DataTables

If you write your importer based on a DataTable (instead of .csv, .xls, .yaml, etc directly), then you can write your importer once, and support *all* import formats that DataTable supports.

If you write your exporter based on a DataTable (instead of .csv, .xls, .yaml, etc directly), then you can write your exporter once, and support *all* export formats that DataTable supports.

## How to use it

```php
use DataTable\Core\Table;
use DataTable\Core\Reader\Csv as CsvReader;
use DataTable\Core\Writer\AsciiTable as AsciiTableWriter;

// Create the Dataset Table object
$table = new Table();
$table->setName(basename($inputfile)); // Give it a user-friendly name

// Instantiate a Reader, in this case a .csv file reader
$reader = new CsvReader();
$reader->setSeperator(',');
$reader->loadFile($table, $inputfile, 8);

// The $table now contains data from the .csv file


// Instantiate a Writer, in this case an Ascii table writer
$writer = new AsciiTableWriter();
$output = $writer->write($table);
echo $output;

```

As you can see, the `DataTable\Core\Table` object is used to load, and then export data.

If you need to export data from your system into different formats, then all you need to do is

1. Load the data from your system into a Dataset Table
2. Use one of the many Writers to export the data into different formats

If you need to import data into your system from diffent formats, then all you need to do is:

1. Use one of the many Readers to import the data from any supported format into a Dataset Table
2. Write an importer for data from a Dataset Table into your system



