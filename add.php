  <?php  // <Schedule class="php"></Schedule>
    require_once 'Database.php';

    $db_server = mysql_connect($db_hostname, $db_username, $db_password);

    if (!$db_server) die("Unable to connect to MySQL: " . mysql_error());
    //echo "Connection Complete<br>";

    mysql_select_db($db_database, $db_server)
        or die("Unable to select database: " . mysql_error());
    //echo "Database Connection Complete<br>";

    if (isset($_POST['username']) && isset($_POST['password']))
    {
        $username  = get_post('username');
       // echo $username;
        $password  = get_post('password');
        $App   = get_post('App');

        $result1 = mysql_query("SELECT ID FROM Clients_Staff WHERE username = '$username' AND password = '$password' ");
        if(!$result1){
            echo 'Could not run query: ' . mysql_error();
        }
        $row = mysql_fetch_row($result1);
        $id = $row[0];
        //echo $id;
        
        $query1 = "INSERT INTO   appointments " . 
                    "(`App`,`DoctortName`,`clients_Staff_ID`) 
                    VALUES " . "('$App', 'Dr.Seuss', '$id')";
       // echo $query1 . '<br>';

        if (!mysql_query($query1, $db_server)){
            echo 'Appointment failed because time already taken or mistyped field...<br>';
        }else{
            echo 'Appointment Added Successfully! <br>';
        }
    }

  echo <<<_END
  <form  action="add.php" method="post"><pre>
  <h> Make an App NOW.<h>
    Username  <input type="text" name="username"> 
    Password  <input type="text" name="password"> 
    Date&Time <input type ="text" name="App"> 
              <input type="submit" value="ADD RECORD"></pre></form> <form action="home.php" method"post><pre>
              <input type ="submit" value="HOME">
	</pre></form>



  
_END;

 mysql_close($db_server);

    function get_post($var)
    {
        return mysql_real_escape_string($_POST[$var]);
    }
?>
