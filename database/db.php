<?php
declare(strict_types=1);
class ConnectToDatabase
{
    //Config
    private $fileName = '';
    //PDO object
    private $pdo;

    /**
     * Initialize DB-connection
     *
     * @return void
    */
    public function __construct()
    {
        $this->fileName = $_SERVER['DOCUMENT_ROOT'].'/database/fake-news.db';
        //Create PDO connection
        // Create (connect to) SQLite database in file
        $dsn = "sqlite:$this->fileName";
        $this->pdo = new PDO($dsn);
        // Set errormode to exceptions
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE,
                            PDO::ERRMODE_EXCEPTION);

        // Create tables if they do not exist
        $this->pdo->exec('CREATE TABLE IF NOT EXISTS "users" (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT NOT NULL,
                password TEXT NOT NULL,
                date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
                );');

        $this->pdo->exec('CREATE TABLE IF NOT EXISTS "posts" (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                title TEXT NOT NULL,
                content TEXT NOT NULL,
                author INTEGER,
                likes INTEGER NOT NULL,
                date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (id) REFERENCES users(id)
                );');
    }

    /**
     * Get data from database.
     *
     * @param string $query
     * @param array  $params (Optional)
     *
     * @return array
    */
    public function getData(string $query, ?array $params = []): array
    {
        $sth = $this->pdo->prepare($query);
        $sth->execute($params);

        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * INSERT / UPDATE / DELETE data.
     *
     * @param string $query
     * @param array  $params (Optional)
     * 
     * @return bool
    */
    public function setData(string $query, ?array $params = []): bool
    {
        $sth = $this->pdo->prepare($query);
        return $sth->execute($params);
    }
}