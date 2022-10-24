<?php

class DB
{
    private const SERVER_NAME = 'localhost';
    private const USERNAME = 'root';
    private const PASSWORD = '';
    private const DATABASE_NAME = 'user_manager';

    public static $connection = null;
    public static function get_connection()
    {
        if (self::$connection === null) {
            self::$connection = new mysqli(self::SERVER_NAME, self::USERNAME, self::PASSWORD, self::DATABASE_NAME);
            if (self::$connection->connect_error) {
                die("Connection failed: " . self::$connection->connect_error);
            }
        }
        return self::$connection;
    }
}
