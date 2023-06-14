<!DOCTYPE html>

<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> ONEE </title>
    <link rel="stylesheet" href="index.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
    <nav class="nav" style="background-color: black;">
        <div class="logo" style="display: flex; justify-content: center;">
            <img src="./image/onee.png" alt="" class="lg">
        </div>
    </nav>

    <div style="display: flex;justify-content: end;align-items: center; margin-right: 10px;">
        <div style="    display: flex;
        align-items: center;
        margin: 10px;">
            <img src="./image/home.png" alt="" class="nm">
        </div>
        <a href="./index.php">Home</a>
    </div>

  <section class="home-section">
    <?php
    //vérifier que le bouton ajouter a bien été cliqué
    if(isset($_POST['button'])){
        //extraction des informations envoyé dans des variables par la methode POST
        extract($_POST);
        //verifier que tous les champs ont été remplis
        if(isset($nom) && isset($prenom) && ($destination)&& ($date) && ($matricule)){
             //connexion à la base de donnée
             include_once "connexion.php";
             //requête d'ajout
             $req = mysqli_query($con , "INSERT INTO n_mission VALUES(NULL, '$nom', '$prenom','$matricule','$destination','$date')");
             if($req){//si la requête a été effectuée avec succès , on fait une redirection
                 header("location: index.php");
             }else {//si non
                 $message = "Erreur d'envoi";
             }

        }else {
            //si non
            $message = "Veuillez remplir tous les champs !";
        }
    }
 
 ?>

 
 <div class="form">
     <h2>Nouvelle mission</h2>
     <p class="erreur_message">
         <?php 
         // si la variable message existe , affichons son contenu
         if(isset($message)){
             echo $message;
         }
         ?>

     </p>
     <form action="" method="POST">
         <label>Nom</label>
         <input type="text" name="nom" require>
         <label>Prénom</label>
         <input type="text" name="prenom" require>
         <label>Matricule</label>
         <input type="text" name="matricule" require>
         <label>Destination</label>
         <input type="text" name="destination" require>
         <label>Date</label>
         <input type="date" name="date" require>
         <input type="submit" value="Ajouter" name="button">
     </form>
 </div>
</body>
  </section>

</body>
</html>