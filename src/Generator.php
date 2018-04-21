<?php

namespace CountrylistCsv;

/**
 * Class Generator
 * Classe responsável pela geração de arquivos.
 *
 * @package CountrylistCsv
 */
abstract class Generator
{
    /** @var array $rawData Dados brutos para a geração do relatório. **/
    protected $rawData;

    /** @var mixed $generatedData Dados gerados. */
    protected $generatedData;

    /** @var string $fileNameDownload Nome do arquivo a ser baixado. */
    protected $fileNameDownload;

    /** @var bool $downloadFile Define se o arquivo gerado será baixado */
    protected $downloadFile;

    public function generate()
    {
        if ($this->downloadFile) {
            if (empty($this->getFileNameDownload())) {
                throw new FileNameNotFoundException('Nome de arquivo não definido para o download.');
            }

            $this->defineHeadersDownload();
        }

        return $this->generaFile();

    }

    abstract protected function defineHeadersDownload();

    abstract protected function generaFile();

    /**
     * @return bool
     */
    public function isDownloadFile(): bool
    {
        return $this->downloadFile;
    }

    /**
     * @param bool $downloadFile
     * @return Generator
     */
    public function setDownloadFile(bool $downloadFile): Generator
    {
        $this->downloadFile = $downloadFile;
        return $this;
    }

    /**
     * @return string
     */
    public function getFileNameDownload(): string
    {
        return $this->fileNameDownload;
    }

    /**
     * @param string $fileNameDownload
     * @return Generator
     */
    public function setFileNameDownload(string $fileNameDownload): Generator
    {
        $this->fileNameDownload = $fileNameDownload;
        return $this;
    }
}