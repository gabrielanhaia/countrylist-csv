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
    protected $generatedData = '';

    /** @var string $fileNameDownload Nome do arquivo a ser baixado. */
    protected $fileNameDownload;

    /** @var bool $downloadFile Define se o arquivo gerado será baixado */
    protected $downloadFile;

    /**
     * Método template responsável por gerar/baixar os arquivos.
     *
     * @throws RawDataNotFoundException Exceção lançada quando não foram definidos os dados para gerar os arquivos.
     * @throws FileNameNotFoundException Exceção lançada quando não foi definido uma nome para o arquivo baixado.
     *
     * @return mixed
     */
    public function generate()
    {
        if (empty($this->rawData)) {
            throw new RawDataNotFoundException('Dados para a geração do arquivo não definidos.');
        }

        if ($this->downloadFile) {
            if (empty($this->getFileNameDownload())) {
                throw new FileNameNotFoundException('Nome de arquivo não definido para o download.');
            }

            $this->defineHeadersDownload();
        }

        return $this->generateFile();
    }

    /**
     * Método responsável por definir os headers caso o arquivo queira ser baixado.
     *
     * @return mixed
     */
    abstract protected function defineHeadersDownload();

    /**
     * Método responsável por gerar o arquivo de acordo com $rawData.
     * @return mixed
     */
    abstract protected function generateFile();

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

    /**
     * @param array $rawData
     * @return Generator
     */
    public function setRawData(array $rawData): Generator
    {
        $this->rawData = $rawData;
        return $this;
    }

    /**
     * @return array
     */
    public function getRawData(): array
    {
        return $this->rawData;
    }
}