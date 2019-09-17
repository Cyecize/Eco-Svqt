<?php

namespace App\Util;


use Symfony\Component\Yaml\Yaml;

class YamlFile
{
    private const YAML_FILES_ROOT_PATH = "../config/";

    /**
     * @var string
     */
    private $fileName;

    /**
     * @var array
     */
    private $fileContent;

    private function __construct($fileName)
    {
        $this->fileName = $fileName;
        $this->loadFile();
    }

    /**
     * @return YamlFile for currency settings.
     */
    public static function getCurrenciesFile(): YamlFile
    {
        return new YamlFile("currencies.yaml");
    }

    /**
     * @return YamlFile for location info.
     */
    public static function getLocationsFile(): YamlFile {
        return new YamlFile("locations.yaml");
    }

    public function set(string $key, $value)
    {
        $this->fileContent[$key] = $value;
    }

    public function get(string $key)
    {
        if (key_exists($key, $this->fileContent)) {
            return $this->fileContent[$key];
        }

        return null;
    }

    public function getAll()
    {
        return $this->fileContent;
    }

    public function saveChanges()
    {
        $yamlFile = YAML::dump($this->fileContent);
        file_put_contents(self::YAML_FILES_ROOT_PATH . $this->fileName, $yamlFile);
    }

    private function loadFile()
    {
        $this->fileContent = Yaml::parse(file_get_contents(self::YAML_FILES_ROOT_PATH . $this->fileName));
    }
}