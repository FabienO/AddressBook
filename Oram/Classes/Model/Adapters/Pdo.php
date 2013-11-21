<?php
/**
 * Project: Oram
 * User: fab
 * Date: 02/10/13
 * Time: 23:12
 */

namespace Classes\Model\Adapters;

class Pdo
{
    private $dsn;
    private $user;
    private $password;
    protected $connection;


    public function __construct($dsn, $user, $password)
    {
        $this->dsn = $dsn;
        $this->user = $user;
        $this->password = $password;
    }

    public function connect()
    {
        if ($this->connection)
        {
            return;
        }

        try
        {
            $this->connection = new \PDO($this->dsn, $this->user, $this->password);
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->connection->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage() . ' on  ' . $e->getFile() . '. Line:' . $e->getLine();
        }
    }

    public function disconnect()
    {
        $this->connection = null;
    }

    /** Get Row **/
    public function getRow($query, array $array = array())
    {
        if(!empty($array))
        {
            $this->connect();
            $stmt = $this->connection->prepare($query);
            foreach($array as $k => $a)
            {
                $stmt->bindValue(':' . $k, $a, \PDO::PARAM_STR);
            }
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        else
        {
            return $this->getDirectRow($query);
        }
    }

    public function getDirectRow($query)
    {
        $this->connect();
        try
        {
            $stmt = $this->connection->query($query);
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage() . ' on  ' . $e->getFile() . '. Line:' . $e->getLine();
        }
    }


    /** Get Rows **/
    public function getRows($query, array $array = array())
    {
        if(!empty($array))
        {
            $this->connect();
            $stmt = $this->connection->prepare($query);
            foreach($array as $k => $a)
            {
                $stmt->bindValue(':' . $k, $a, \PDO::PARAM_STR);
            }
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else
        {
            return $this->getDirectRows($query);
        }
    }

    public function inQuery($query, array $array = array())
    {
        if(!empty($array))
        {
            $this->connect();
            $stmt = $this->connection->prepare($query);
            foreach($array as $k => $a)
            {
                $stmt->bindValue(($k+1), $a, \PDO::PARAM_STR);
            }
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else
        {
            return $this->getDirectRows($query);
        }
    }

    public function search($query, array $array = array())
    {
        if(!empty($array))
        {
            $this->connect();
            $stmt = $this->connection->prepare($query);
            foreach($array as $k => $a)
            {
                $stmt->bindValue(':'. $k, '%'. $a .'%', \PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        else
        {
            return $this->getDirectRows($query);
        }
    }

    public function getDirectRows($query)
    {
        $this->connect();
        try
        {
            $stmt = $this->connection->query($query);
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage() . ' on  ' . $e->getFile() . '. Line:' . $e->getLine();
        }
    }

    /** Get Cols l*/
    public function getCols($query, array $array = array())
    {
        if(!empty($array))
        {
            $this->connect();
            $stmt = $this->connection->prepare($query);
            foreach($array as $k => $a)
            {
                $stmt->bindValue(':' . $k, $a, \PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_COLUMN );
        }
        else
        {
            return $this->getDirectCols($query);
        }
    }

    public function getDirectCols($query)
    {
        $this->connect();
        try
        {
            $stmt = $this->connection->query($query);
            return $stmt->fetchAll(\PDO::FETCH_COLUMN);
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage() . ' on  ' . $e->getFile() . '. Line:' . $e->getLine();
        }
    }

    //** CUD **/
    public function getLastInsertId($name = null)
    {
        $this->connect();
        return $this->connection->lastInsertId($name);
    }

    public function insert($query, array $array = array())
    {
        try
        {
            $this->connect();
            $stmt = $this->connection->prepare($query);
            $stmt->execute($array);
            return $this->getLastInsertId();
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage() . ' on  ' . $e->getFile() . '. Line:' . $e->getLine();
        }
    }

    public function update($query, array $array = array())
    {
        try
        {
            $this->connect();
            $stmt = $this->connection->prepare($query);
            $stmt->execute($array);
            return $affected_rows = $stmt->rowCount();;
        }
        catch (\PDOException $e)
        {
            echo $e->getMessage() . ' on  ' . $e->getFile() . '. Line:' . $e->getLine();
        }
    }

    public function delete($query, array $array = array())
    {
        try
        {
            $this->connect();
            $stmt = $this->connection->prepare($query);
            foreach($array as $k => $a)
            {
                $stmt->bindValue(':' . $k, $a, \PDO::PARAM_INT);
            }
            $stmt->execute();
            return $stmt->rowCount();
        }
        catch (\PDOException $e)
        {
            throw new \RunTimeException($e->getMessage());
        }
    }

} 