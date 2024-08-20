<?php

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for DocumentScan data
 *
 * @author iucto.cz
 */
class DocumentScan extends RawData
{
    /**
     * ID položky
     *
     * @var int(11)
     */
    private $id;

    /**
     * Název souboru
     *
     * @var string(255)
     */
    private $filename;

    /**
     * Status zpracování
     *
     * @var string(255)
     */
    private $status;

    /**
     * Formát souboru
     *
     * @var string
     */
    private $format;

    /**
     * Datum vytvoření
     *
     * @var string
     */
    private $created;

    public function __construct(array $rawData)
    {
        parent::__construct($rawData);
        $this->id = Utils::getValueOrNull($rawData, 'id');
        $this->filename = Utils::getValueOrNull($rawData, 'filename');
        $this->status = Utils::getValueOrNull($rawData, 'status');
        $this->format = Utils::getValueOrNull($rawData, 'format');
        $this->created = Utils::getValueOrNull($rawData, 'created');
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getCreated(): string
    {
        return $this->created;
    }

}
