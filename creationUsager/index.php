<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="../style/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <?php
        $nom = $mdp = $cmdp = $courriel = $avatar = $sexe = $ddn = $transport = "";
        $nomErreur = $mdpErreur = $cmdpErreur = $courrielErreur = $avatarErreur = $sexeErreur = $ddnErreur = $transportErreur ="";
        $erreur = false;
        $codeCourriel = "/^[^\s@]+@[^\s@]+\.[^\s@]+$/";
        $codeDdn = "/^\d{4}-\d{2}-\d{2}$/";

        if ($_SERVER['REQUEST_METHOD'] == "POST"){

            if(empty($_POST['nom'])){
                $nomErreur = "Le nom ne peut pas être vide";
                $erreur  = true;
            }
            else if ($_POST['nom'] == "SLAY"){
                $nomErreur = "Ce nom est déjà pris";
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
                $mdp = $cmdp = "";
                $erreur = true;
            } else {
                $cmdp = trojan($_POST['cmdp']);
            }

            if(empty($_POST['courriel'])){
                $courrielErreur = "Le courriel ne peut pas être vide";
                $erreur  = true;
            }
            else if (preg_match($codeCourriel, $_POST['courriel']) != 1){
                $courrielErreur = "Ce courriel n'est pas valide";
                $erreur  = true;
            } else {
                $courriel = trojan($_POST['courriel']);
            }
            
            if(empty($_POST['avatar'])){
                $avatarErreur = "Vous devez mettre un lien pour votre avatar";
                $erreur  = true;
            }
            else{
                $avatar = trojan($_POST['avatar']);
            }

            if(empty($_POST['sexe'])){
                $sexeErreur = "Vous devez choisir un sexe";
                $erreur  = true;
            }
            else if ($_POST['sexe'] != "homme" && $_POST['sexe'] != "femme" && $_POST['sexe'] != "autre"){
                $sexeErreur = "Ceci n'est pas une option valide";
                $erreur  = true;
            }
            else{
                $sexe = trojan($_POST['sexe']);
            }

            if(empty($_POST['ddn'])){
                $ddnErreur = "Vous devez choisir une date de naissance";
                $erreur  = true;
            }
            else if(preg_match($codeDdn, $_POST['ddn']) != 1){
                $ddnErreur = "Vous ne pouvez pas mettre du text ici";
                $erreur  = true;
            }
            else{
                $ddn = trojan($_POST['ddn']);
            }

            if(empty($_POST['transport'])){
                $transportErreur = "Vous devez choisir au moins un moyen de transport";
                $erreur  = true;
            }
            else if ($_POST['transport'] != "auto" && $_POST['transport'] != "autobus" && $_POST['transport'] != "marche" && $_POST['transport'] && "velo"){
                $transportErreur = "Ceci n'est pas une option valide";
                $erreur  = true;
            }
            else{
                $transport = trojan($_POST['transport']);
            }

            //AFFICHER LE RÉSULTAT DE MON FORM
        }
        if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
        ?>
            <div class="container-fluid" style="text-align:center">
                <h1>Inscription</h1>
                <div class="row" style="text-align:left">
                    <div class="offset-md-5 ">
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
                                <label for="autre">autre</label><br>
                            <p style="color:red;"><?php echo $sexeErreur; ?></p><br>
                            Date de naissance : <input type="date" name="ddn" maxLength="10" value="<?php echo $ddn;?>"><br>
                            <p style="color:red;"><?php echo $ddnErreur; ?></p>
                            Transport : <br>
                                <input type="checkbox" name="transport" value="auto">
                                <label for="auto">auto</label><br>
                                <input type="checkbox" name="transport" value="autobus">
                                <label for="autobus">autobus</label><br>
                                <input type="checkbox" name="transport" value="marche">
                                <label for="marche">marche</label><br>
                                <input type="checkbox" name="transport" value="velo">
                                <label for="velo">vélo</label><br>
                                <p style="color:red;"><?php echo $transportErreur; ?></p>
                            <input type="submit">
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
        else {
        ?>
            <div class="container-fluid" style="text-align:center">
                <div class="card" style="width:600px ">
                    <img class="card-img-top" src="<?php echo"$avatar"?>" alt="Card image" style="width:100%">
                        <div class="card-body">
                        <h4 class="card-title"><?php echo "$nom"?></h4>
                        <p class="card-text">
                            <?php echo "$courriel"?><br>
                            <?php echo "$sexe"?><br>
                            <?php echo "$ddn"?><br>
                            <?php echo "$transport"?>
                        </p>
                    </div>
                </div>
                <a href="index.php">Retour au formulaire</a>
            </div>
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