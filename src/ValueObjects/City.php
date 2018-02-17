<?php

namespace Dykyi\ValueObjects;

/**
 * Class CityName
 * @package Dykyi\ValueObjects
 */
class City
{
    const MIN_LENGTH = 3;
    const MAX_LENGTH = 250;

    private $name;

    /**
     * CityName constructor.
     *
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->setName(trim($name));
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    private function setName(string $name)
    {
        $this->assertNotEmpty($name);
        $this->assertFitsLength($name);
        $this->name = $name;
    }

    private function assertNotEmpty(string $name)
    {
        if (empty($name)) {
            throw new \DomainException('Empty city name');
        }
    }

    private function assertFitsLength(string $name)
    {
        if (strlen($name) < self::MIN_LENGTH) {
            throw new \DomainException('City name is too sort');
        }

        if (strlen($name) > self::MAX_LENGTH) {
            throw new \DomainException('City name is too long');
        }
    }
}