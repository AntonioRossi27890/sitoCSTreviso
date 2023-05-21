<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autentificazione</title>
</head>

<script>

    function TestAutentificazione(){
        codice=FormLogin.inputcodice.value;
        if (codice=="")
        {
            alert("Per fare login devi inserire il codice");
            return;
        }
        FormAutentificazione.Submit();
    }


</script>

<body>

<h1>Autentificazione</h1>

<form action="" method="post" name="FormAutentificazione">
        <input type="text" id="inputCodice"
        name="codice" placeholder="Codice" >
        <br>
        <br>

        <button onClick="TestAutentificazione()">Accedi</button>

    </form>

    <?php
        session_start();
        $codiceInserito = $_POST["codice"];
        if(isset($_SESSION['NumeroContoCorrente']))
        {
            // esiste la variabile session NumeroContoCorrente
            // do messaggio benvenuto
            $NumeroContoCorrente = $_SESSION['NumeroContoCorrente'];
            $conn=mysqli_connect(localhost,"cartedacollezione","zRDzt9Heg2aw","my_cartedacollezione");
            $strSQL= "SELECT ContoCorrenteID,Email FROM TabellaContiCorrenti Where NumeroContoCorrente = '$NumeroContoCorrente'";
            $query = mysqli_query($conn,$strSQL);
            $row = mysqli_fetch_assoc($query);
            $ID = $row["ContoCorrenteID"];
            $email=$row["Email"];
            echo($email);
            $numerorecord = mysqli_num_rows($query);
            $codice = rand(0, 1000);
            $oggetto = "Ecco il codice Email";
            if(mail($email,"Codice Email",$codice))
            {
            if($codiceInserito == $codice)
            {
                $_SESSION['NumeroContoCorrente'] = $NumeroContoCorrente;
                header("location: 003AreaRiservata.php");
            }
        }

            
            // chiudo la connessione al db
            mysqli_close($conn);
        }
        else
        {
            session_destroy();
            //non sono loggato rimando alla pagina di login
            header("location: index.php");
        }

    ?>

<a href="http://cartedacollezione.altervista.org/ContoCorrente/logout.php">
    <button type=button>Log Out</button>
    </a>



    
</body>
</html>