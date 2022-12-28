<html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Accueil</title>
<link rel="stylesheet" type="text/css" href="style1.css" />

</head>
<body>
<div>
<h1 id="entete">Le site de rencontres sportives</h1>
</div>



<div class="container">
 
  <section id="content">
  <table class="center">
            <tr>
                <th><h3>Sport existant</h3></th>
                
            </tr>
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                include("connexpdo.php");
                $idcom=connexpdo('rencontre','myparam');
                $stmt = $idcom->prepare("SELECT design From sport");
                $stmt->execute();
                $users = $stmt->fetchAll();
                foreach( $users as $user) 
                {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $user['design'];?></td>
                
            </tr>
            <?php
                }
            ?>
        </table>
    <form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <h1>S'identifier</h1>
      <div>
        <input type="text" placeholder="Email" required="" name="mail" />
      </div>
      <div >
      <input type="submit" value="Entrer" />
      <input type="reset" value="Effacer">
      </div>
      
      <!--<div> 
        <input type="submit" value="Log in" />
        <a href="#">Lost your password?</a>
        <a href="#">Register</a>
      </div>-->
    </form><!-- form -->
    <?php
       if(!empty($_POST['mail'])){
        $stmt = $idcom->prepare("SELECT mail FROM `personne` WHERE `mail` = :mail" );
        $stmt->bindParam( ':mail', $_POST['mail'] );
        $stmt->execute();
        $query = $idcom->prepare("SELECT nom FROM `personne` WHERE `mail` = :mail" );
        $query->bindParam( ':mail', $_POST['mail'] );
        $query->execute() ;
        $noms= $query->fetchAll();
        foreach( $noms as $nom) 
                {$esm = $nom['nom'];}
                  
        if($stmt->rowCount() > 0){
            $req = $idcom->prepare("SELECT mail FROM `personne` WHERE `mail` = :mail" );
            $req->bindParam( ':mail', $_POST['mail'] );
            $req->execute();
            $tabcook= $req->fetchAll();
            foreach($tabcook as $cle=>$tab1)
              {
                foreach($tab1 as $cle=>$valeur){
                    setcookie("personne[$cle]",$valeur,time()+7200);
                }

              }

            echo "<h2>BIENVENUE $esm </h2>";
            echo "<a href='ajout.php'>Inscrire dans un autre sport</a> <br>";
            echo "<a href='recherche.php'>Rechercher des collègues</a><br>";

        }else{
          header('Location: ajout.php');
          exit();
        }
       } 
       
    ?>
    <br>
    <button class="button"><a href="ajout.php">S'inscrire</a></button>
    
  </section><!-- content -->
</div><!-- container -->
</body>
</html>




