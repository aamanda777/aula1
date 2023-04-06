<?php

class Model
{
    private $driver = 'mysql';
    private $host = 'localhost';
    private $dbname = 'sistematwig';
    private $port = '3306';
    private $user = 'root';
    private $password = null;
    protected $table;
    protected $conex;


    public function __construct()
    {
        //descobre o nome da classe
        $tbl = strtolower(get_class($this));
        $tbl .= 's';
        $this->table = $tbl;

        //conecta ao banco
        $this->conex = new PDO("{$this->driver}:host={$this->host};port={$this->port};dbname={$this->dbname}", $this->user, $this->password);

    }
    public function getAll()
    {
        $sql = $this->conex->query("SELECT * FROM {$this->table}");

        return $sql->fetchAll(PDO::FETCH_ASSOC);

    }
    public function getById($id)
    {
        $sql = $this->conex->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
    public function create($data)
    {

        $sql = "INSERT INTO {$this->table}";
        //prepara os campos e placeholders
        foreach (array_keys($data) as $field) {
            $sql_fields[] = "{$field} = :{$field}";
        }

        $sql_fields = implode(',', $sql_fields);
        //monta a consulta
        $sql .= " SET {$sql_fields}";

        $insert = $this->conex->prepare($sql);


        $insert->execute($data);
        return $insert->errorInfo();
    }
}