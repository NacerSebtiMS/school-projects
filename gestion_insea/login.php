<?php
   include("Connexion_BdD.php");
   session_start();

   $error = "";

   if ( isset($_POST['login']) && $_POST['login'] != ""
         && isset($_POST['mdp']) && $_POST['mdp'] != "") {
      $sql = "SELECT id_util, username, password, type_util
               FROM utilisateur
               WHERE username like '".$_POST['login']."'
                  AND password like '".$_POST['mdp']."'";
      $result = mysqli_query($db,$sql);
      if($result->num_rows>=1){
         $user = mysqli_fetch_object($result);
         $_SESSION['type'] = $user->type_util;
         if ($user->type_util == 'a') {
            header("Location: tableau_bord.php");
         }
      } else {
         $error = "le mot de passe ou le login sont incorrects";
      }
   }
?>
<html>

   <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/normalize.css">
        <link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/main.css">
        <title>la page d'acceuil</title>
         <b><h1> application de gestion des cours </h1></b>
      <!--style type = "text/css">
         body {
            font-family:Arial, Helvetica, sans-serif;
            font-size:14px;
         }
         label {
            font-weight:bold;
            width:100px;
            font-size:14px;
         }
         .box {
            border:#666666 solid 1px;
         }
      </style-->

   </head>
   <body>
      <!--div align = "center">
         <div style = "width:300px; border: solid 1px #333333; " align = "left">
            <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Login</b></div-->
               <form action = "login.php" method = "post">
                  <h1>Login :</h1>
                  <label>Username  :</label>
                  <input type = "text" name = "login"/><br><br>
                  <label>Password  :</label>
                  <input type = "password" name = "mdp"/><br/>
                  <button type="submit" value="Valider">Valider</button>
               </form>

               <!--div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
            </div>

         </div>

      </div-->
   </body>
</html>
