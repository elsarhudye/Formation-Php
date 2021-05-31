<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- meta référencement -->
    <meta name="description" content="Web Dev PHP : Conditions, requêtes GET">
    <meta name="author" content="Camile Ghastine">

    <title>Questionnaire de satisfaction du service client Amazin</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://bootswatch.com/4/lumen/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>

    <div class="container">

        <h1 class="mb-5">AMAZIN</h1>

        <h2>Questionnaire de satisfaction</h2>

        <!-- step 0 : A afficher uniquement au chargement de la page -->
        <?php 
            if(($_GET == null) || $_GET['question'] == 0){ 
        ?>     
        <p>Vous avez contacté notre service client et nous aimerions avoir votre avis sur la qualité de ce service</p>
        <p>Commencez le questionnaire : <a href="/amazin.php?question=1&result=0" role="button" class="btn btn-success">Commencer</a></p>
        <?php 
            }
        ?>
        
        
        <!-- Etape 1 : A afficher uniquement une fois que le boutton "Commencer" a été pressé -->
        <?php 
            if(isset($_GET['question']) && $_GET['question'] == 1){ 
        ?>  
            <h2>Question 1</h2>
            <p>L'agent a-t-il été agréable ?</p>
            <a href="?question=2&result=<?= $_GET['result'] + 2 ?>" role="button" class="btn btn-success">oui</a> <!-- rapporte 2 point -->
            <a href="?question=2&result=<?= $_GET['result'] + 0 ?>" role="button" class="btn btn-danger">non</a> <!-- rapporte 0 point -->
            <a href="?question=2&result=<?= $_GET['result'] + 1 ?>" role="button" class="btn btn-secondary">sans avis</a> <!-- rapporte 1 point -->
        <?php 
            }
        ?>
        
        <!-- Etape 2 : A afficher uniquement une fois que l\'étape 1 a été résolue -->
        <?php 
            if(isset($_GET['question']) && $_GET['question'] == 2){  
        ?>  
            <h2>Question 2</h2>
            <p>L'agent a-t-il compris votre problème ?</p>
            <a href="?question=3&result=<?= $_GET['result'] + 2 ?>" role="button" class="btn btn-success">oui</a> <!-- rapporte 2 point -->
            <a href="?question=3&result=<?= $_GET['result'] + 0 ?>" role="button" class="btn btn-danger">non</a> <!-- rapporte 0 point -->
            <a href="?question=3&result=<?= $_GET['result'] + 1 ?>" role="button" class="btn btn-secondary">sans avis</a> <!-- rapporte 0 point -->
        <?php 
            }
        ?>
        
        
        <!-- Etape 3 : A afficher uniquement une fois que l\'étape 2 a été résolue -->
        <?php 
            if(isset($_GET['question']) && $_GET['question'] == 3){  
        ?>  
            <h2>Question 3</h2>
            <p>L'agent a-t-il résolu votre problème ?</p>
            <a href="?question=5&result=<?= $_GET['result'] + 2 ?>" role="button" class="btn btn-success">oui</a> <!-- rapporte 1 point -->
            <a href="?question=4&result=<?= $_GET['result'] -1 ?>" role="button" class="btn btn-danger">non</a> <!-- rapporte -1 point -->
        <?php 
            }
        ?>
         
            
        <!-- Etape 4 : A afficher uniquement si "non" a été répondu à l'étape 3 -->
        <?php 
            $_GET['numero'] = isset($_GET['numero']) ? $_GET['numero'] : '';
            if(isset($_GET['question']) && $_GET['question'] == 4){   
        ?>  
            <p>Votre problème n'a pas été résolu.</p>
            <p>Pour être rappelé, entrez votre numéro de téléphone dans le clavier virtuel et validez :</p>
            <!-- Coder ici un clavier numérique permettant de saisir le numéro de téléphone -->
            <?php
            for ($i = 0; $i <=9; $i++) {
            ?>
                <a href="?question=4&result=<?= $_GET['result'] ?>&numero=<?= $_GET['numero'] . $i ?>" role="button" class="btn btn-secondary"><?= $i ?></a> 
            <?php
                }
            ?>
            <br>


            <!-- Afficher ici le numéro de téléphone qui s'affiche au fur et à mesure de la saisie-->

            <p>Votre numéro : <?= $_GET['numero'] ?></p>
            <?php       
                if(strlen($_GET['numero']) == 10 ) { 
            ?> 
                <a href="?question=5&result=<?= $_GET['result'] ?>&numero=<?= $_GET['numero'] ?>" role="button" class="btn btn-success">Valider</a> <!-- Validation du numéro de téléphone -->
            <?php
                }      
            ?> 
            <!-- Mes boutons-->
            <br><br>
            <a href="?question=5&result=<?= $_GET['result'] ?>" role="button" class="btn btn-secondary">Ne pas être rappelé</a>
            <a href="?question=4&result=<?= $_GET['result'] ?>&numero=<?= '' ?>" role="button" class="btn btn-secondary">Réinitialisation</a> 
            <a href="?question=4&result=<?= $_GET['result'] ?>&numero=<?= substr($_GET['numero'], 0, -1) ?>" role="button" class="btn btn-secondary">Correction</a>
        <?php 
            }
        ?>
          
        <!-- Etape finale : A afficher si "oui" a été répondu à la question 3 ou si l'étape 4 a été résolue -->
            
        <?php       
            if(isset($_GET['question']) && $_GET['question'] == 5){ 
                $ratings = "";
                for ($i = 1; $i <= 5 ; $i++) {
                    if ($i <= $_GET['result']) {
                        $note = "⭐";
                    } else {
                        $note = "⚫";
                    }
                    $ratings .= $note;
                }      
        ?>             
                
            <p class="mt-5">Merci pour votre notation : <?= $ratings ?> </p> <!-- le nombre d\'étoiles représente le nombre de points cumulés -->

            <!-- Si un téléphone à été saisi, afficher "Vous serez rappelé très prochainement au #numéro de téléphone#" -->
        <?php       
            if(isset($_GET['numero']) &&  $_GET['numero'] != '' ) { 
        ?> 
            <p>Vous serez rappelé très prochainement au <?= $_GET['numero'] ?></p>
        <?php
            }      
        ?> 
            <p class="mt-5">
                <a href="?" role="button" class="btn btn-danger">Recommencer</a>
            </p>
        <?php 
            }
        ?>
        
            
    </div>
</body>

</html>