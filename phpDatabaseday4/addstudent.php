<?php

        //var_dump($_POST);

    $dsn="mysql:dbname=studentDB;dbhost=127.0.0.1;dbport=3306";
    Define("DB_USER","root");
    Define("DB_PASS","");

    $db= new PDO($dsn,DB_USER,DB_PASS);
      // var_dump($db);
    if($db){

        // echo "connected";

        $name=$_POST["name"];
        $email=$_POST["email"];
        $password=$_POST["password"];
        $confirmPassword=$_POST["confirmPassword"];

        // if ($db) {
      
       
        $instQry="Insert into student (`name`,`email`,`password`,`confirmPassword`) values (:sname,:semail,:spassword,:sconfirmPassword)";
        $instmt=$db->prepare($instQry);
        $instmt->bindParam(":semail",$email);
        $instmt->bindParam(":spassword",$password);
        $instmt->bindParam(":sconfirmPassword",$confirmPassword);
        $instmt->bindParam(":sname",$name);
        $res=$instmt->execute();
        // var_dump($res);
        $rowCount=$instmt->rowCount();
        // var_dump($rowCount);
        $lid=$db->lastInsertId();
        // var_dump($lid);

        ##########################

        $selQry="select * from student";
        $stmt=$db->prepare($selQry);
        $res=$stmt->execute();
        #fetch the result
       $rows=$stmt->fetchAll(PDO::FETCH_ASSOC);
//       var_dump($rows);

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
                        <th>
                           confirmPassword
                        </th>
                           <th>
                           confirmPassword
                        </th>
                    </tr>";
       foreach($rows as $row) {

           echo "<tr> <td>" . $row["id"] . "</td>" .
               "<td>" . $row["name"] . "</td>" .
               "<td>" . $row["email"] . "</td>" .
               "<td>" . $row["password"] . "</td>" .
               "<td>" . $row["confirmPassword"] . "</td></tr>";
               
       }
       echo "</table>";



    }




