<?php

class Database
{
    public $db_name = "chat";
    public $server_name = "localhost";
    public $username = "root";
    public $password = "";
    public $con;

    function __construct()
    {
        try {
            $this->con = new PDO("mysql:host=$this->server_name;dbname=$this->db_name;charset=utf8", $this->username, $this->password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "ok";
        } catch (PDOException $e) {
            echo "connection failed " . $e->getMessage();
        }
    }

    public function insert($Table, $Fields, $Values)
    {
        try {
            $i = 1;
            $fi = '';
            $qi = '';

            foreach ($Fields as $Field) {
                if (count($Fields) == $i) {
                    $fi .= $Field;
                    $qi .= '?';
                } else {
                    $fi .= $Field . ',';
                    $qi .= '?,';
                }
                $i++;
            }

            $Result = $this->con->prepare('INSERT INTO ' . $Table . '(' . $fi . ') VALUES (' . $qi . ')');

            for ($i = 1; $i <= count($Values); $i++) {
                $Result->bindValue($i, $Values[$i - 1]);
            }

            $Result->execute();

            // echo "Insert OK";

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function update($Table, $Fields, $Values, $Id)
    {
        try {
            $i = 1;
            $fi = '';

            foreach ($Fields as $Field) {
                if (count($Fields) == $i) {
                    $fi .= $Field . '=?';
                } else {
                    $fi .= $Field . '=?,';
                }
                $i++;
            }

            $fi .= 'WHERE id = ' . $Id;

            $Result = $this->con->prepare('UPDATE ' . $Table . ' SET ' . $fi);

            for ($i = 1; $i <= count($Values); $i++) {
                $Result->bindValue($i, $Values[$i - 1]);
            }

            $Result->execute();

            // echo "Update OK";
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function delete($Table, $Id)
    {
        try {
            $Result = $this->con->prepare('DELETE FROM ' . $Table . ' WHERE id=? ');

            $Result->bindValue(1, $Id);

            $Result->execute();

            // echo "Delete OK";

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function search($Table, $Fields, $Values, $isFix = false, $isArr)
    {
        try {

            $i = 1;
            $fi = '';

            foreach ($Fields as $Field) {
                if ($isFix == false) {
                    if (count($Fields) == $i) {
                        $fi .= $Field . ' LIKE ?';
                    } else {
                        $fi .= $Field . ' LIKE ? AND ';
                    }
                } else if ($isFix == true) {
                    if (count($Fields) == $i) {
                        $fi .= $Field . '=?';
                    } else {
                        $fi .= $Field . '=? AND ';
                    }
                }
                $i++;
            }

            $Result = $this->con->prepare('SELECT * FROM ' . $Table . ' WHERE ' . $fi);

            for ($i = 0; $i < count($Values); $i++) {
                if ($isFix == false) {
                    $Result->bindValue($i + 1, '%' . $Values[$i] . '%');
                } else if ($isFix == true) {
                    $Result->bindValue($i + 1, $Values[$i]);
                }
            }

            $Result->execute();

            if ($Result->rowCount() > 1 || $isArr == true) {
                $json = $Result->fetchAll(PDO::FETCH_ASSOC);
            } else {
                $json = $Result->fetch(PDO::FETCH_ASSOC);
            }

            echo json_encode($json);

            return $json;

        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function query($query)
    {
        $Result = $this->con->prepare($query);

        $Result->execute();

        if ($Result->rowCount() > 1) {
            $json = $Result->fetchAll(PDO::FETCH_ASSOC);
        } else {
            $json = $Result->fetch(PDO::FETCH_ASSOC);
        }

        echo json_encode($json);
    }

}

?>