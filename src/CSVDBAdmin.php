<?php

namespace CSVDBAdmin;

use CSVDB\Helpers\CSVConfig;
use CSVDB\Helpers\CSVUtilities;
use League\Csv\Exception;

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
                $databases[$path_parts["filename"]] = $this->createDatabase($path_parts["filename"], $dir . $file);
            }
        }
        return $databases;
    }

    private function createDatabase(string $database, string $file): CSVDBData
    {
        return new CSVDBData($file, $this->config($database), $this->schema($database));
    }

    private function refreshDatabase(string $database)
    {
        $data = $this->database($database);
        $this->databases[$database] = $this->createDatabase($database, $data->file);
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

    public function storeConfig(array $config, string $database)
    {
        $file = $this->basedir . "/" . $database . "_config.json";
        $csvConfig = new CSVConfig(
            (int)$config['index'],
            $config['encoding'],
            $config['delimiter'],
            $config['headers'] == "true",
            $config['cache'] == "true",
            $config['history'] == "true",
            $config['autoincrement'] == "true");
        $result = file_put_contents($file, json_encode($csvConfig, JSON_PRETTY_PRINT));

        if ($result) {
            $this->refreshDatabase($database);
        } else {
            // todo throw?
        }
    }

    public function deleteConfig($database)
    {
        $file = $this->basedir . "/" . $database . "_config.json";
        $result = unlink($file);
        if ($result) {
            $this->refreshDatabase($database);
        } else {
            // todo throw?
        }
    }

    private function schema(string $database): ?string
    {
        $config = $this->basedir . "/" . $database . "_schema.json";
        if (is_file($config)) {
            return $config;
        }
        return null;
    }

    public function storeSchema(string $schema, string $database)
    {
        if ($this->json_validate($schema)) {
            $file = $this->basedir . "/" . $database . "_schema.json";
            var_dump($this->json_validate($schema));
            $result = file_put_contents($file, $schema);

            if ($result) {
                $this->refreshDatabase($database);
            } else {
                // todo throw?
            }
        } else {
            // todo throw?
        }
    }

    public function deleteSchema($database)
    {
        $file = $this->basedir . "/" . $database . "_schema.json";
        $result = unlink($file);
        if ($result) {
            $this->refreshDatabase($database);
        } else {
            // todo throw?
        }
    }

    private function json_validate(string $json): bool
    {
        json_decode($json);
        return json_last_error() === JSON_ERROR_NONE;
    }

    // constraints

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function constraint(string $constraint, string $database)
    {
        $data = $this->database($database);
        $data->csvdb()->unique($constraint);
        $this->storeSchema(json_encode($data->csvdb()->getSchema()), $database);
    }

    /**
     * @throws Exception
     * @throws \Exception
     */
    public function add_constraint(string $field, string $constraint, string $value, string $database)
    {
        $data = $this->database($database);
        $schema = $data->csvdb()->getSchema();
        $schema[$field][$constraint] = $value;
        $this->storeSchema(json_encode($schema, JSON_PRETTY_PRINT), $database);
    }


    /**
     * @throws \Exception
     */
    public function remove_constraint(string $constraint, string $database)
    {
        $data = $this->database($database);
        var_dump($data->csvdb()->constraints());
        $data->csvdb()->remove_unique($constraint);
        $this->storeSchema(json_encode($data->csvdb()->getSchema(), JSON_PRETTY_PRINT), $database);
    }
}