<?php

namespace database;
use PDO;
class ORM{  

    use welecome;

   function __construct($userName,$userEmail,$userPassword){

    $this->userName=$userName;
    $this->userEmail=$userEmail;
    $this->userPassword=$userPassword;
       // echo "hi";
    }

    public $db;
     function conDB(){

        $dsn="mysql:dbname=studentDB;dbhost=127.0.0.1;dbport=3306";
        Define("DB_USER","root");
        Define("DB_PASS","");
    
        $this->db= new PDO($dsn,DB_USER,DB_PASS);

        if ($this->db) {
            echo "coo";
        }
        else{
            echo "not";
        }
    }

    function selectData()
    {
       
        $selQry="select * from user";
        $stmt=$this->db->prepare($selQry);
        $res=$stmt->execute();
        #fetch the result
       $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
    //    var_dump($rows);


            echo "<table border='2'> <tr> 
            <th>
                ID
            </th>
            <th>
                Name
            </th>
            <th>
                Email
            </th>
            </th>
            <th>
                password
            </th>
        </tr>";
        foreach($rows as $row) {

        echo 
            "<tr> <td>" . $row["userId"] . "</td>" .
            "<td>" . $row["userName"] . "</td>" .
            "<td>" . $row["userEmail"] . "</td>" .
            "<td>" . $row["userPassword"] . "</td></tr>";

        }
        echo "</table>";

    }

    function insertData()
    {
      

        $instQry="Insert into user (`userName`,`userEmail`,`userPassword`) values (:suserName,:suserEmail,:suserPassword)";
        $instmt=$this->db->prepare($instQry);
        $instmt->bindValue(":suserName","amira");
        $instmt->bindValue(":suserEmail","amira@gmail.com");
        $instmt->bindValue(":suserPassword","123");
        $res=$instmt->execute();
        // var_dump($res);
        $rowCount=$instmt->rowCount();
        // var_dump($rowCount);
        $lid=$this->db->lastInsertId();
        // var_dump($lid);
    }

  



}


trait welecome{

    function helloFun()
    {
        echo "<br>Welcome everybody!<br>";
    }

}

$obj = new ORM("amira","amira123@gmail.com","123");
$res =$obj->conDB();
$selectRes =$obj->selectData();
$insertRes =$obj->insertData();
$traitObj =$obj->helloFun();


?>