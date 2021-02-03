<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="" method="POST">
    <input type="text" name="beer_name" placeholder="Nom d'une bière" required/>
    <input type="submit" value="Recherche"/>
</form>

<?php
if(isset($_REQUEST["beer_name"])){
    $postfields = $_REQUEST["beer_name"];

    //Initialisation de la session cURL
    $curl = curl_init();
    //On définie l'url de la page à récuperer
    curl_setopt($curl, CURLOPT_URL, "https://api.punkapi.com/v2/beers?beer_name=$postfields");
    //Ici on récupère le résultat au lieu de l'afficher
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    //On initialise un nouveau cookie de session pour igniorer les cookies antérieur
    curl_setopt($curl, CURLOPT_COOKIESESSION, true);
    //On execute la requête
    $resultat = curl_exec($curl);
    //On décode le json pour en faire un tableau associatif
    $resultat = json_decode($resultat, true);
    //On affiche les résultat
    foreach($resultat as $key => $value){
        $beer_name = $value["name"];
        $beer_image = $value["image_url"];
        $beer_description = $value["description"];

        echo("<h1>$beer_name</h1>
            <img src=$beer_image alt='image' width=100px>
            <p>$beer_description</p>");
    }
    //On ferme la session
    curl_close($curl);
}
?>
</body>
</html>