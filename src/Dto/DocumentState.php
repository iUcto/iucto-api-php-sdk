<?php declare(strict_types=1);

namespace IUcto\Dto;

use IUcto\Utils;

/**
 * DTO for DocumentState data
 *
 * @author iucto.cz
 */
class DocumentState extends RawData
{
    /**
     * ID položky
     *
     * @var int(11)
     */
    private $id;

    /**
     * Název
     *
     * @var string(255)
     */
    private $name;

    /**
     * Popis
     *
     * @var string(255)
     */
    private $description;

    /**
     * Viditelnost
     *
     * @var bool
     */
    private $visibility;

    public function __construct(array $rawData)
    {
        parent::__construct($rawData);
        $this->id = Utils::getValueOrNull($rawData, 'id');
        $this->name = Utils::getValueOrNull($rawData, 'name');
        $this->description = Utils::getValueOrNull($rawData, 'description');
        $this->visibility = Utils::getValueOrNull($rawData, 'visibility');
    }

    /**
     * @return array<string, mixed>
     */
    public function toArray(): array
    {
        return get_object_vars($this);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getVisibility()
    {
        return $this->visibility;
    }
}
