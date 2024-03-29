<?php

namespace CSVDBAdmin;

use CSVDB\CSVDB;
use CSVDB\Helpers\CSVConfig;

class CSVDBData
{
    public string $file;
    public ?string $config;
    public ?string $schema;

    private ?CSVDB $csvdb = null;

    public function __construct(string $file, ?string $config = null, ?string $schema = null)
    {
        $this->file = $file;
        $this->config = $config;
        $this->schema = $schema;
    }

    /**
     * @throws \Exception
     */
    public function csvdb(): CSVDB
    {
        if ($this->csvdb == null) {
            $this->create();
        }
        return $this->csvdb;
    }

    /**
     * @throws \Exception
     */
    private function create()
    {
        $this->csvdb = new CSVDB($this->file, $this->csvConfig());
        $this->csvSchema();
    }

    private function csvConfig(): CSVConfig
    {
        $csvConfig = CSVConfig::default();
        if ($this->config != null) {
            $configJson = file_get_contents($this->config);
            $configJson = json_decode($configJson, true);
            return new CSVConfig(
                $configJson['index'],
                $configJson['encoding'],
                $configJson['delimiter'],
                $configJson['headers'],
                $configJson['cache'],
                $configJson['history'],
                $configJson['autoincrement']);
        }
        return $csvConfig;
    }

    /**
     * @throws \Exception
     */
    private function csvSchema()
    {
        if ($this->csvdb != null && $this->schema != null) {
            $schemaJson = file_get_contents($this->schema);
            $schemaJson = json_decode($schemaJson, true);
            $this->csvdb->schema($schemaJson);
        }
    }

    public function hasConfig(): bool
    {
        return !empty($this->config);
    }

    public function configFile(): ?string
    {
        if ($this->hasConfig()) {
            return $this->filename($this->config);
        }
        return null;
    }

    public function hasSchema(): bool
    {
        return !empty($this->schema);
    }

    public function schemaFile(): ?string
    {
        if ($this->hasSchema()) {
            return $this->filename($this->schema);
        }
        return null;
    }

    private function filename(string $file): string
    {
        $path_parts = pathinfo($file);
        return $path_parts["basename"];
    }

    // history

    public function history(): array
    {
        $dir = $this->csvdb->history_dir();
        $files = scandir($dir, SCANDIR_SORT_DESCENDING);
        $result = array();
        foreach ($files as $file) {
            $result[$file] = $dir . $file;
        }
        return $result;
    }
}