<?php

define('DB_HOST', 'localhost');
define('DB_NAME', 'board');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_CHAR', 'utf8');

class DB
{
    protected static $instance = null;

    public function __construct()
    {
    }

    public function __clone()
    {
    }

    public static function instance()
    {
        if (self::$instance === null) {
            $opt = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => TRUE,
            );
            $dsn = 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHAR;
            self::$instance = new PDO($dsn, DB_USER, DB_PASS, $opt);
        }
        return self::$instance;
    }

    public static function __callStatic($method, $args)
    {
        return call_user_func_array(array(self::instance(), $method), $args);
    }

    public static function run($sql, $args = [])
    {
        if (!$args) {
            return self::instance()->query($sql);
        }
        $stmt = self::instance()->prepare($sql);
        $stmt->execute($args);
        return $stmt;
    }

    public function getColumnNames($table_name)
    {

        $sql = "select column_name from information_schema.columns where table_name = '$table_name'";
        #$sql = 'SHOW COLUMNS FROM ' . $this->table;

        $stmt = self::instance()->prepare($sql);
        try {
            if ($stmt->execute()) {
                $raw_column_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach ($raw_column_data as $outer_key => $array) {
                    foreach ($array as $inner_key => $value) {
                        if (!(int)$inner_key) {
                            $this->column_names[] = $value;
                        }
                    }
                }
            }
            return $this->column_names;
        } catch (Exception $e) {
            return $e->getMessage(); //return exception
        }
    }
}