<?php

namespace CountrylistCsv\CustomGenerator;

use CountrylistCsv\Generator;

/**
 * Class CsvGenerator
 * Gerador expecífico de CSV.
 *
 * @package CountrylistCsv\CustomGenerator
 * @author Gabriel Anhaia <anhaia.gabriel@gmail.com>
 */
class CsvGenerator extends Generator
{
    /** @var string $textExtension Extenção do arquivo. */
    protected $textExtension = 'csv';

    /** @var string $enclosure Caracter que fica ao redor de cada valor do CSV. */
    protected $enclosure = '';

    /** @var string $delimiter Delimitador do CSV **/
    protected $delimiter = ',';

    /**
     * @return string
     */
    public function getEnclosure(): string
    {
        return $this->enclosure;
    }

    /**
     * @param string $enclosure
     * @return CsvGenerator
     */
    public function setEnclosure(string $enclosure): CsvGenerator
    {
        $this->enclosure = $enclosure;
        return $this;
    }

    /**
     * @return string
     */
    public function getDelimiter(): string
    {
        return $this->delimiter;
    }

    /**
     * @param string $delimiter
     * @return CsvGenerator
     */
    public function setDelimiter(string $delimiter): CsvGenerator
    {
        $this->delimiter = $delimiter;
        return $this;
    }

    /**
     * Método responsável por definir os headers caso o arquivo queira ser baixado.
     *
     * @return mixed
     */
    protected function defineHeadersDownload()
    {
        header('Content-Disposition: attachment; filename="' . "{$this->fileNameDownload}.{$this->textExtension}" . '"');
        header('Content-Type: text/plain');
        header('Connection: close');
    }

    /**
     * Método responsável por gerar o arquivo de acordo com $rawData.
     * @return mixed
     */
    protected function generateFile()
    {
        foreach ($this->rawData as $line) {
            $delimiter = $this->enclosure . $this->delimiter . $this->enclosure;
            $formatedLine = implode($delimiter, $line);
            $this->generatedData .= ($this->enclosure . $formatedLine . $this->enclosure . "\n");
        }

        if ($this->downloadFile) {
            echo $this->generatedData;
        }

        return $this->generatedData;
    }
}