<html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Recherche</title>
<link rel="stylesheet" type="text/css" href="style1.css" />

</head>
<body>
<div>
<h1 id="entete">Le site de rencontres sportives</h1>
</div>

<div class="container">
 
  <section id="content">
  
    <form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <h1>Recherche des partenaires</h1>
      
      <div>
        <select name="design"  >
            <option value="">--Sport pratiqué--</option>
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
           
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                    <option value="<?php echo $user['design'];?>"><?php echo $user['design'];?></option>
                    <?php
                }
                
            ?>            
</select>
<div>
        <select name="niveau" required>
            <option value="">--Niveau--</option>
            <option value="Débutant">Débutant</option>
            <option value="Confirmé">Confirmé</option>
            <option value="Pro">Pro</option>
            <option value="Supporter">Supporter</option>
        </select>
      </div>
      <div>
        <select name="depart" >
            <option value="">--Département--</option>
            <?php
                // LOOP TILL END OF DATA
                
                $stmt = $idcom->prepare("SELECT DISTINCT depart From personne");
                $stmt->execute();
                $users = $stmt->fetchAll();
                foreach( $users as $user) 
                {
            ?>
           
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                    <option value="<?php echo $user['depart'];?>"><?php echo $user['depart'];?></option>
                    <?php
                }
                
            ?>            
</select>
<div>
      
     
      <br>
      <div >
      <input type="submit" value="Rechercher" />
      <input type="reset" value="Effacer">
      </div>
      
      <!--<div> 
        <input type="submit" value="Log in" />
        <a href="#">Lost your password?</a>
        <a href="#">Register</a>
      </div>-->
    </form><!-- form -->
    <a href="index.php">Accueil</a>
    <a href="ajout.php">Inscription</a>
    <div>
    <table class="center">
           
            <!-- PHP CODE TO FETCH DATA FROM ROWS -->
            <?php
                // LOOP TILL END OF DATA
                
                if(!empty($_POST['depart'])&&!empty($_POST['design'])&&!empty($_POST['niveau'])){
                    $query = $idcom->prepare("SELECT personne.prenom, personne.nom, personne.mail FROM personne JOIN pratique ON pratique.id_personne = personne.id_personne JOIN sport ON sport.id_sport = pratique.id_sport WHERE personne.depart =:depart and sport.design=:design and pratique.niveau=:niveau");
                    $query->bindParam(":depart",$_POST['depart'],PDO::PARAM_STR);
                    $query->bindParam(":design",$_POST['design'],PDO::PARAM_STR);
                    $query->bindParam(":niveau",$_POST['niveau'],PDO::PARAM_STR);
                    $query->execute();
                    $users = $query->fetchAll();
                     ?>

             <tr>
                <th>PRENOM</th>
                <th>NOM</th>
                <th>EMAIL</th>
            </tr>
            <?php
                foreach( $users as $user) 
                {
            ?>
            
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $user['prenom'];?></td>
                <td><?php echo $user['nom'];?></td>
                <td><?php echo $user['mail'];?></td>
                
            </tr>
            <?php
                }
            ?>
            <?php } 
           
            ?>
        </table>
    </div>
    
  
  </section><!-- content -->
</div><!-- container -->

</body>
</html>




