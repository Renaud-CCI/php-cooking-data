<?php
$string = file_get_contents("dictionnaire.txt", FILE_USE_INCLUDE_PATH);
$dico = explode("\n", $string);


//--Fonctions

function dico15($array){
    $i=0;
    foreach ($array as $item){
        if (strlen($item) == 15){
            $i++;
        }
    }
    return $i;
}

function dicoW($array){
    $i=0;
    foreach($array as $item){
        if (strpos($item, "w") !== false){
            $i++;
        }
    }
    return $i;
}

function dicoQ($array){
    $i=0;
    foreach($array as $word){
        if(substr($word, -1) == "q"){
            $i++;
        }
    }
    return $i;
}

//--Programme

echo("Total des mots du dictionnaire = ". count($dico). "<br>");
echo("Total des mots de 15 lettres du dictionnaire = ". dico15($dico). "<br>");
echo("Total des mots du dictionnaire contenant la lettre 'W' = ". dicoW($dico). "<br>");
echo("Total des mots du dictionnaire finissant par la lettre 'Q' = ". dicoQ($dico). "<br>");


//-----------------------EXERCICE 2----------------------

$string = file_get_contents("films.json", FILE_USE_INCLUDE_PATH);
$brut = json_decode($string, true);
$top = $brut["feed"]["entry"]; # liste de films

echo ("<br>");
echo ("<br>");

    // * Afficher le top10 des films sous cette forme :
        // 1 Mission: Impossible - Rogue Nation
        // 2 …
        // …
        // 10 …


    // * Quel est le classement du film « Gravity » ?

    // * Quel est le réalisateur du film « The LEGO Movie » ?
$searchedMovie = "The LEGO Movie";
foreach($top as $items){
    if ($items["im:name"]["label"] == $searchedMovie){
        echo("Le réalisateur du film \"{$searchedMovie}\" est {$items["im:artist"]["label"]} <br>");
    }
}

echo ("<br>");
    // * Combien de films sont sortis avant 2000 ?
$year = "2000";
$movies = [];
foreach($top as $items){
    if (substr($items["im:releaseDate"]["label"], 0,4) < $year){
        $movies[] = $items["im:name"]["label"];
    }
}
sort($movies);
echo("Liste de films sortis avant ${year} : <br>");
foreach($movies as $movie){
    echo("&emsp;- {$movie}<br>");
}

echo ("<br>");

    // * Quel est le film le plus récent ? Le plus vieux ?
$maxYear = "1900-01-01";
$minYear="3000-01-01";
$maxMovie="";
$minMovie="";
foreach($top as $items){
    if (substr($items["im:releaseDate"]["label"], 0,10) < $minYear){
        $minYear = substr($items["im:releaseDate"]["label"], 0,10);
        $minMovie = $items["im:name"]["label"];
    } elseif (substr($items["im:releaseDate"]["label"], 0,10) > $maxYear){
        $maxYear = substr($items["im:releaseDate"]["label"], 0,10);
        $maxMovie = $items["im:name"]["label"];
    };
};

$maxDate = date("j F Y", strtotime($maxYear));
$minDate = date("j F Y", strtotime($minYear));


echo("Le film le plus récent est : {$maxMovie}. Il est sorti le {$maxDate}");
echo ("<br>");
echo("Le film le plus ancien est : {$minMovie}. Il est sorti le {$minDate}");
echo ("<br>");

echo ("<br>");

    // * Quelle est la catégorie de films la plus représentée ?
$categories = [];

foreach($top as $items){
    $categories[] = $items["category"]["attributes"]["term"];
}

$eachCategory = array_count_values($categories);
$maxKey = 0;
$maxCat = "";
foreach ($eachCategory as $category => $value) {
    if($value > $maxKey){
        $maxKey = $value;
        $maxCat = $category;
    };
};

echo ("$maxCat est la catégorie de film la plus représentée. Elle est présente $maxKey fois. <br>");



    // * Quel est le réalisateur le plus présent dans le top100 ?
    // * Combien cela coûterait-il d'acheter le top10 sur iTunes ? de le louer ?
    // * Quel est le mois ayant vu le plus de sorties au cinéma ?
    // * Quels sont les 10 meilleurs films à voir en ayant un budget limité ?


echo ("<br>");
echo ("<br>");
echo ("<hr>");


foreach($top as $items){
    foreach($items as $key => $item){
        var_dump($key, $item);
        echo ("<br><br>");
    }
}


?>