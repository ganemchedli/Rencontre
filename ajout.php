<html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6 ielt8"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7 ielt8"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html lang="en"> <!--<![endif]-->
<head>
<meta charset="utf-8">
<title>Inscription</title>
<link rel="stylesheet" type="text/css" href="style1.css" />

</head>
<body>
<div>
<h1 id="entete">Le site de rencontres sportives</h1>
</div>

<div class="container">
 
  <section id="content">
  
    <form action= "<?php echo $_SERVER['PHP_SELF'];?>" method="post">
      <h1>Vos coordonnées</h1>
      <div>
        <input type="text" placeholder="Nom" required="" name="nom" />
      </div>
      <div>
        <input type="text" placeholder="Prenom" required="" name="prenom" />
      </div>
      <div>
        <input type="text" placeholder="Departement" required="" name="depart" />
      </div>
      <div>
        <input type="text" placeholder="Email" required="" name="mail" />
      </div>
      <h1>Vos pratiques sportives</h1>
      <div>
        <select name="design" id="list" >
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
      </div>
      <div>
        <h6>OU: Ajouter un sport à la liste </h6>
        <input type="text" id="framework" name="">
        <button class="button" id="btnAdd">Ajouter</button>       
      </div>
      <div>
        <select name="niveau" required>
            <option value="">--Niveau--</option>
            <option value="Débutant">Débutant</option>
            <option value="Confirmé">Confirmé</option>
            <option value="Pro">Pro</option>
            <option value="Supporter">Supporter</option>
        </select>
      </div>
      <br>
      <div >
      <input type="submit" value="Envoyer" />
      <input type="reset" value="Effacer">
      </div>
      
      <!--<div> 
        <input type="submit" value="Log in" />
        <a href="#">Lost your password?</a>
        <a href="#">Register</a>
      </div>-->
    </form><!-- form -->
    <button class="button"><a href="index.php">Accueil</a></button>


    <?php
        
         if(!empty($_POST['nom'])&& !empty($_POST['prenom'])&& !empty($_POST['depart']) && !empty($_POST['mail'])) 
          {
              $stmt = $idcom->prepare("INSERT INTO personne (nom,prenom,depart,mail) VALUES (:nom,:prenom,:depart,:mail)");
              $stmt->bindParam(':nom', $_POST['nom'],PDO::PARAM_STR); // parametre de sortie 
              $stmt->bindParam(':prenom', $_POST['prenom'],PDO::PARAM_STR);
              $stmt->bindParam(':depart', $_POST['depart'],PDO::PARAM_STR);
              $stmt->bindParam(':mail', $_POST['mail'],PDO::PARAM_STR);
              $stmt->execute();
             
          }
          if(!empty($_POST['design'])){
            $query3= $idcom->prepare("SELECT design FROM `sport`" );
            
            $query3->execute() ;
            $designs= $query3->fetchAll();
            foreach( $designs as $tab){
                if($_POST['design']==$tab['design']){
                    $result = true ;
                    break;
                }else{
                    $result = false ;
                }
            }
          }
          
          if(!empty($_POST['design']) && !$result ){
            $stmt = $idcom->prepare("INSERT INTO sport (design) VALUES (:design)");
            $stmt->bindParam(':design', $_POST['design'],PDO::PARAM_STR); // parametre de sortie 
            $stmt->execute() ;
            
          }
          $query1 = $idcom->prepare("SELECT id_personne FROM `personne` WHERE `mail` = :mail" );
        $query1->bindParam( ':mail', $_POST['mail'] );
        $query1->execute() ;
        $ids1= $query1->fetchAll();
        foreach( $ids1 as $tab) 
                {$id_personne = $tab['id_personne'];}
        
                $query2 = $idcom->prepare("SELECT id_sport FROM `sport` WHERE `design` = :design" );
                $query2->bindParam( ':design', $_POST['design'] );
                $query2->execute() ;
                $ids2= $query2->fetchAll();
                foreach( $ids2 as $tab) 
                        {$id_sport = $tab['id_sport'];}        
         if(!empty($_POST['niveau']) ) {
            $query = $idcom->prepare("INSERT INTO pratique (id_personne,id_sport,niveau) VALUES (:id_personne,:id_sport,:niveau)");
            $query->bindParam(':id_personne', $id_personne,PDO::PARAM_STR);
            $query->bindParam(':id_sport', $id_sport,PDO::PARAM_STR);
            $query->bindParam(':niveau', $_POST['niveau'],PDO::PARAM_STR);
            $query->execute() ;
            
         }
         

        ?>
 
  </section><!-- content -->
</div><!-- container -->
<script src="js/app.js"></script>
</body>
</html>




