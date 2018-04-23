<?php

namespace Test\CustomGenerator;

use CountrylistCsv\CustomGenerator\CsvGenerator;
use Test\TestCase;

/**
 * Class CsvGeneratorTest
 * Classe responsável por testar o gerador de CSV.
 *
 * @package Test\CustomGenerator
 */
class CsvGeneratorTest extends TestCase
{
    /**
     * Testa se o CSV foi gerado em formato correto
     * @dataProvider generatedCsvDataProvider
     */
    public function testIfCsvGeneratedRightFormat($rawDataCsv, $expectedCsv, $enclosure, $delimiter)
    {
        $generatorCsv = new CsvGenerator();

        $generatedCsv = $generatorCsv
            ->setEnclosure($enclosure)
            ->setDelimiter($delimiter)
            ->setDownloadFile(false)
            ->setRawData($rawDataCsv)
            ->generate();

        $this->assertEquals($expectedCsv, $generatedCsv);
    }

    /**
     * Testa se os headers de download estão corretos.
     */
    public function testFileDownloadHeader()
    {
        $generatorCsv = new CsvGenerator();

        $generatedCsv = $generatorCsv
            ->setDownloadFile(true)
            ->setFileNameDownload('test')
            ->setRawData([
                [
                    'Nome', 'Idade', 'Email'
                ],
                [
                    'Gabriel', '25', 'anhaia.gabriel@gmail.com'
                ]
            ]);

        $expectedHeaders = [
            'Content-Disposition: attachment; filename="test.csv"',
            'Content-Type: text/plain',
            'Connection: close'
        ];

        $generatedHeaders = $generatedCsv->getHeadersDownload();

        $this->assertEquals($expectedHeaders, $generatedHeaders);
    }

    /**
     * Provedor de dados para os testes de geração de CSV.
     */
    public function generatedCsvDataProvider()
    {
        return [
            [
                'rawDataCsv' => [
                    [
                        'Nome', 'Idade', 'Email'
                    ],
                    [
                        'Gabriel', '25', 'anhaia.gabriel@gmail.com'
                    ]
                ],
                'expectedCsv' => "`Nome`,`Idade`,`Email`\n`Gabriel`,`25`,`anhaia.gabriel@gmail.com`\n",
                'enclosure' => '`',
                'delimiter' => ','
            ],
            [
                'rawDataCsv' => [
                    [
                        'a', 'B', 'c'
                    ],
                    [
                        'X', 'y', 'z'
                    ],
                    [
                        'a1', 'b1', 'c1'
                    ]
                ],
                'expectedCsv' => "|a|9|B|9|c|\n|X|9|y|9|z|\n|a1|9|b1|9|c1|\n",
                'enclosure' => '|',
                'delimiter' => '9'
            ],
        ];
    }
}