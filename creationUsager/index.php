<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <h1>COURS 2</h1>
    <?php
        $nom = $mdp = $cmdp = $courriel = $avatar = $sexe = $ddn = $transport = "";
        $nomErreur = $mdpErreur = $cmdpErreur = $courrielErreur = $avatarErreur = $ddnErreur = "";
        $erreur = false;
        $codeCourriel = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";

        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            echo "<h1>POST == TRUE </h1>";
            
            if(empty($_POST['nom'])){
                $nomErreur = "Le nom ne peut pas être vide";
                $erreur  = true;
            }
            else{
                $nom = trojan($_POST['nom']);
            }

            if(empty($_POST['mdp'])){
                $mdpErreur = "Le mot de passe ne peut pas être vide";
                $erreur  = true;
            }
            else{
                $mdp = trojan($_POST['mdp']);
            }

            if(empty($_POST['cmdp'])){
                $cmdpErreur = "Le champ de confirmation ne peut pas être vide";
                $erreur  = true;
            }
            else if ($_POST['cmdp']!= $_POST['mdp']){
                $cmdpErreur = "Le mot de passe n'est pas identique";
                $erreur = true;
            } else {
                $cmdp = trojan($_POST['nom']);
            }

            if(empty($_POST['courriel'])){
                $courrielErreur = "Le courriel ne peut pas être vide";
                $erreur  = true;
            }
            else if (preg_match($pattern, $str) != 1){
                $courrielErreur = "Le courriel n'est pas valide'";
                $erreur  = true;
            } else {
                $courreil = trojan($_POST['courriel']);
            }
            
            $avatar = trojan($_POST['avatar']);

            //AFFICHER LE RÉSULTAT DE MON FORM
        }
        if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
            // Cas #1 On veut afficher le formulaire
            echo "<h1>On affiche le formulaire </h1>";
        ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                Nom usager : <input type="text" name="nom" maxLength="15" value="<?php echo $nom;?>"><br>
                <p style="color:red;"><?php echo $nomErreur; ?></p>
                Mot de passe : <input type="password" name="mdp" maxLength="15" value="<?php echo $mdp;?>"><br>
                <p style="color:red;"><?php echo $mdpErreur; ?></p>
                Confirmation mot de passe : <input type="password" name="cmdp" maxLength="15" value="<?php echo $cmdp;?>"><br>
                <p style="color:red;"><?php echo $cmdpErreur; ?></p>
                Adresse courriel : <input type="text" name="courriel" value="<?php echo $courriel;?>"><br>
                <p style="color:red;"><?php echo $courrielErreur; ?></p>
                Avatar URL: <input type="text" name="avatar" value="<?php echo $avatar;?>"><br>
                <p style="color:red;"><?php echo $avatarErreur; ?></p>
                Sexe : <br><input type="radio" name="sexe" value="homme">
                    <label for="homme">homme</label><br>
                    <input type="radio" name="sexe" value="femme">
                    <label for="femme">femme</label><br>
                    <input type="radio" name="sexe" value="autre">
                    <label for="autre">autre</label><br><br>
                Date de naissance : <input type="date" name="ddn" value="<?php echo $ddn;?>"><br>
                <p style="color:red;"><?php echo $ddnErreur; ?></p>
                Transport : <br><input type="checkbox" name="transport" value="auto">
                    <label for="auto">auto</label><br>
                    <input type="checkbox" name="transport" value="autobus">
                    <label for="autobus">autobus</label><br>
                    <input type="checkbox" name="transport" value="marche">
                    <label for="marche">marche</label><br>
                    <input type="checkbox" name="transport" value="velo">
                    <label for="velo">vélo</label><br>

                <input type="submit">
            </form>
        <?php
        }

        function trojan($data){
            $data = trim($data); //Enleve les caractères invisibles
            $data = addslashes($data); //Mets des backslashs devant les ' et les  "
            $data = htmlspecialchars($data); // Remplace les caractères spéciaux par leurs symboles comme ­< devient &lt;
            
            return $data;
        }

    ?>

    
    

</body>
</html>