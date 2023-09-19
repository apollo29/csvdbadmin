<?php

namespace CSVDBAdmin;

use CSVDB\Helpers\CSVConfig;
use CSVDB\Helpers\CSVUtilities;
use League\Csv\Exception;
use League\Csv\InvalidArgument;
use PHPSQLParser\PHPSQLParser;

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
        $data->csvdb()->remove_unique($constraint);
        $this->storeSchema(json_encode($data->csvdb()->getSchema(), JSON_PRETTY_PRINT), $database);
    }

    // fields

    /**
     * @throws \Exception
     */
    public function rename_field(string $new_field, string $field, string $database)
    {
        if ($this->check_rename_field($new_field, $database)) {
            $data = $this->database($database);
            $delimiter = $data->csvdb()->config->delimiter;
            if (($handle = fopen($data->file, "r")) !== FALSE) {
                $header = fgetcsv($handle, 1000, $delimiter);
                fclose($handle);

                $index = array_search($field, $header, true);
                $new_header = implode($delimiter, array_replace($header, [$index => $new_field]));

                $lines = file($data->file);
                $lines[0] = $new_header . "\n";
                file_put_contents($data->file, $lines);

                if ($data->hasSchema()) {
                    $this->rename_field_schema($new_field, $field, $database);
                } else {
                    $this->refreshDatabase($database);
                }
            }
        } else {
            throw new Exception('There is another Field with the same name: ' . $new_field);
        }
    }

    /**
     * @throws InvalidArgument
     * @throws Exception
     * @throws \Exception
     */
    private function check_rename_field(string $new_field, string $database): bool
    {
        $data = $this->database($database);
        if (in_array($new_field, $data->csvdb()->headers())) {
            return false;
        }
        return true;
    }

    /**
     * @throws \Exception
     */
    private function rename_field_schema(string $new_field, string $field, string $database)
    {
        $data = $this->database($database);
        $schema = $data->csvdb()->getSchema();
        $new_schema = array();
        foreach ($schema as $key => $value) {
            if ($key != $field) {
                $new_schema[$key] = $value;
            } else {
                $new_schema[$new_field] = $value;
            }
        }
        $this->storeSchema(json_encode($new_schema, JSON_PRETTY_PRINT), $database);
    }

    public function get_database(array $get): ?string
    {
        if (array_key_exists("db", $get)) {
            $db = $get["db"];
        } else if (array_key_exists("sql_query", $get)) {
            $sql_query = $get["sql_query"];
            $parser = new PHPSQLParser($sql_query);
            $db = $parser->parsed["FROM"][0]["table"];
        } else {
            return null;
        }
        return $db;
    }

    public function get_route(array $get, ?string $fallback = null): string
    {
        if (array_key_exists("route", $get)) {
            return $get["route"];
        } else if (!empty($fallback)) {
            return $fallback;
        }
        return "";
    }

    // export

    /**
     * @throws \Exception
     */
    public function export($db, string $format, ?string $query = null): string
    {
        if (!is_array($db)) {
            $data = $this->database($db);
            if (!empty($query)) {
                return $data->csvdb()->query($query)->export($format);
            }
            return $data->csvdb()->select()->export($format);
        } else {
            $export = "";
            foreach ($db as $database) {
                $export .= $this->export($database, $format) . "\n";
            }
            return $export;
        }

    }
}