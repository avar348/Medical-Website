<?php
       require_once 'Database.php';
$connection = new mysqli($db_hostname, $db_username, $db_password, $db_database);


 if ( 
        isset($_POST['firstname']) &&
        isset($_POST['lastname']) &&
        isset($_POST['username'])   &&
        isset($_POST['password']))

    {
        if(isset($_POST['isStaff']) && isset($_POST['isStaff']) == 'true' && isset($_POST['staffPassword']))
        {
            $staffPassword = get_post($connection,'staffPassword');
            if($staffPassword == "DOCTOR")
            {
                $isStaff = 1;
            }
        }
        $edate = get_post($connection,'firstname');
        $etime = get_post($connection,'lastname');
        $sid   = get_post($connection,'username');
        $clubname = get_post($connection,'password');

        $query = "INSERT INTO Clients_Staff " .
                "(`firstname`, `lastname`, `username`,`isStaff`, `password`) VALUES " .
            "('$edate', '$etime', '$sid','$isStaff', '$clubname')";
        //echo $query . "<br>";

        $result = $connection->query($query);

        if (!$result)
            echo "INSERT failed:  $query<br>" .
                $connection->error . "<br><br>";

    }

  echo <<<_END
  <form action="create.php" method="post"><pre>
       <h> Create an Account<h> 
       FirstName    <input type="text" name="firstname">
       LastName     <input type="text" name="lastname">
       UserName     <input type="text" name="username">
       Password     <input type="text" name="password">
       Staff member <input type="checkbox" name="isStaff" value="true">
       Staff Code   <input type=text" name="staffPassword">
                    <input type="submit" value="ADD RECORD"></pre></form> <form action="home.php" method"post><pre>
                    <input type ="submit" value="HOME">
	</pre></form>

_END;
    



    $result->close();
    $connection->close();

    function get_post($connection, $var)
    {
        return $connection->real_escape_string($_POST[$var]);
    }
?>

