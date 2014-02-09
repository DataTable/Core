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

## How to load data into a Table from code:

```php
use DataTable\Core\Table;
use DataTable\Core\Writer\Csv as CsvWriter;

$table = new Table();
$table->setName("My data"); // Give it a user-friendly name

$namecolumn = $table->getColumnByName("name");
$emailcolumn = $table->getColumnByName("email");

// get the first row (index 0)
$row = $table->getRowByIndex(0);

// get a cell by columnname:
$cell = $row->getCellByColumnName("name");
// assign value to the cell
$cell->setValue("Joe Johnson");

// do the same for the second cell (email)
$cell = $row->getCellByColumnName("email");
$cell->setValue("joe@johnson.web");


// do the same for a second row (index 1)
$row = $table->getRowByIndex(1);

$cell = $row->getCellByColumnName("name");
$cell->setValue("John Jackson");

$cell = $row->getCellByColumnName("email");
$cell->setValue("john@jackson.web");


// use a writer to export the datatable to a .csv file
$writer = new CsvWriter();
$output = $writer->write($table);
echo $output;

```

## How to read data from code:

```php
use DataTable\Core\Table;
use DataTable\Core\Reader\Csv as CsvReader;

// Create the DataTable\Core\Table object
$table = new Table();
$table->setName("My user data"); // Give it a user-friendly name
$reader->loadFile($table, "users.csv");

// Loop through all the rows in $table

foreach($table->getRows() as $row) {

  // Read field contents from the row by columnname    
  $name = $row->getValueByColumnName("name");
  $email = $row->getValueByColumnName("email");
    
  // use the data, for example:
  // ensure database record for user with name+email
}
```


## How to use the readers and writers for importing/exporting data

```php
use DataTable\Core\Table;
use DataTable\Core\Reader\Csv as CsvReader;
use DataTable\Core\Writer\AsciiTable as AsciiTableWriter;

// Create the DataTable\Core\Table object
$table = new Table();
$table->setName(basename($inputfile)); // Give it a user-friendly name

// Instantiate a Reader, in this case a .csv file reader
$reader = new CsvReader();
$reader->setSeperator(',');
$reader->loadFile($table, $inputfile);

// The $table now contains data from the .csv file

// Instantiate a Writer, in this case an Ascii table writer
$writer = new AsciiTableWriter();
$output = $writer->write($table);
echo $output;

```

As you can see, the `DataTable\Core\Table` object is used to load, and then export data.

If you need to export data from your system into different formats, then all you need to do is

1. Load the data from your system into a DataTable
2. Use one of the many Writers to export the data into different formats

If you need to import data into your system from diffent formats, then all you need to do is:

1. Use one of the many Readers to import the data from any supported format into a DataTable
2. Write an importer for data from a DataTable into your system



