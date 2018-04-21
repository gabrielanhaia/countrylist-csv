<?php
require_once 'vendor/autoload.php';

$generatorCsv = new \CountrylistCsv\CustomGenerator\CsvGenerator();

$generatorCsv
    ->setEnclosure('"')
    ->setDelimiter(',')
    ->setDownloadFile(true)
    ->setFileNameDownload('test')
    ->setRawData([
        [
            'Nome', 'Idade', 'Email'
        ],
        [
            'Gabriel', '25', 'anhaia.gabriel@gmail.com'
        ]
    ])->generate();