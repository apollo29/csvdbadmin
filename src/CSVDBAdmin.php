<?php

namespace CSVDBAdmin;

use CSVDB\Helpers\CSVUtilities;

class CSVDBAdmin
{
    public string $basedir;
    private array $databases;

    public function __construct(string $basedir)
    {
        $this->basedir = $basedir;
        $this->databases = $this->createDatabases();
    }

    private function createDatabases(): array
    {
        $dir = $this->basedir . "/"; // todo
        $files = scandir($dir, SCANDIR_SORT_ASCENDING);
        $databases = array();
        foreach ($files as $file) {
            if (is_file($dir . $file) && CSVUtilities::is_csv($dir . $file)) {
                $path_parts = pathinfo($dir . $file);
                $csvdb = new CSVDBData($dir . $file, $this->config($path_parts["filename"]), $this->schema($path_parts["filename"]));
                $databases[$path_parts["filename"]] = $csvdb;
            }
        }
        return $databases;
    }

    public function databases(): array
    {
        return $this->databases;
    }

    public function database(string $database): ?CSVDBData
    {
        return $this->databases[$database];
    }

    private function config(string $database): ?string
    {
        $config = $this->basedir . "/" . $database . "_config.json";
        if (is_file($config)) {
            return $config;
        }
        return null;
    }

    private function schema(string $database): ?string
    {
        $config = $this->basedir . "/" . $database . "_schema.json";
        if (is_file($config)) {
            return $config;
        }
        return null;
    }
}