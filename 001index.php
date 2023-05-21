<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>

<script>

    function TestLogin(){
        numeroContoCorrenteInserito=FormLogin.inputNumeroContoCorrente.value;
        passwordInserita=FormLogin.inputPassword.value;
        if ((numeroContoCorrenteInserito=="")||(passwordInserita==""))
        {
            alert("Per fare login devi inserire numero conto corrente e password");
            return;
        }
        FormLogin.Submit();
    }


</script>


<body>

    <form action="" method="post" name="FormLogin">
        <input type="text" id="inputNumeroContoCorrente"
        name="NumeroContoCorrente" placeholder="Numero conto corrente" >
        <br>

        <input type="password" id="inputPassword" name="Password" placeholder="Password" >
        <br>

        <button onClick="TestLogin()">Accedi</button>

    </form>

    <?php

        session_start();
        // se sono loggato vado direttamente nell' area riservata
        if(isset($_SESSION['NumeroContoCorrente']))
        {
            header("location: 0022fa.php");
            return;
        }

        //ricevo le due variabili inviate tramite post: email e password
        $NumeroContoCorrente=$_POST['NumeroContoCorrente'];
        $password=$_POST['Password'];
        if((empty($NumeroContoCorrente)==false)&&(empty($password)==false))
        {
            $conn=mysqli_connect();
            $strSQL = "SELECT * from TabellaContiCorrenti WHERE NumeroContoCorrente = '$NumeroContoCorrente' and Password = '$password'";
            $query = mysqli_query($conn,$strSQL);
            $numerorecord = mysqli_num_rows($query);
            mysqli_close($conn);

            if($numerorecord == 1)
            {
                //echo("credenziali valide");
                $_SESSION['NumeroContoCorrente'] = $NumeroContoCorrente;
                header("location: 0022fa.php");
                
            }
            else 
            {
                echo("credenziali non valide");
            }


            // fare il codice che verifica se esiste la coppia numeroContoCorrente/Password
            // se esiste -> echo("ok")
            // altrimenti -> echo("ko")
        }
        

    ?>
    
</body>
</html>
