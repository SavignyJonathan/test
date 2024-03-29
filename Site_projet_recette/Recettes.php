<?php session_start();
include("header.php");
$bdd = new PDO("mysql:host=127.0.0.1;dbname=solibio;charset=utf8", "root", "");
$recettesParPage = 4;
$recettesTotalesReq = $bdd->query('SELECT id FROM recette');
$recettesTotales = $recettesTotalesReq->rowCount();
$pagesTotales = ceil($recettesTotales/$recettesParPage);
if(isset($_GET['page']) AND !empty($_GET['page']) AND $_GET['page'] > 0 AND $_GET['page'] <= $pagesTotales) {
   $_GET['page'] = intval($_GET['page']);
   $pageCourante = $_GET['page'];
} else {
   $pageCourante = 1;
}
$depart = ($pageCourante-1)*$recettesParPage;
?>


<div class="BlocRecettes">
	<h1>Une petite faim ? Essayer une de nos nombreuses recettes ! </h1><br /><br /><br /><br /><br />

<?php
	$reponse = $bdd->query('SELECT * FROM recette ORDER BY id DESC LIMIT '.$depart.','.$recettesParPage);
	while($donnees = $reponse->fetch())
	{?><div class="recette">
		<a href ="recetteF.php?id=<?= $donnees['id']?>">
			<img class="imageRecette" src="image/<?= $donnees['lastID']?>.jpg"></a>
			<?php
			echo "<div class =\"resumer\">";
			echo "<p> ";
			echo $donnees['titre'];
			echo '<br />';
			echo '<br />';
			echo $donnees['dureeCuisson']." minutes de cuisson";
			echo '<br />';
			echo $donnees['dureePrepa']." minutes de préparation";
			echo '<br />'; 
			echo '<br />';
			echo 'Ingredients :';
			echo '<br />';
			echo '<br />';
			$ingredients = $donnees['ingredients'];
			echo "<textarea readonly=\"readonly\">$ingredients</textarea>";
			echo "</div>";
			echo "</div>";
	}
	for($i=1;$i<=$pagesTotales;$i++) {
         if($i == $pageCourante) {
            echo $i.' ';
         } else {
            echo '<a href="recettes.php?page='.$i.'">'.$i.'</a> ';
         }
      }
      echo '<br /><br />';
?>



</div>
<?php
if($_SESSION){
echo "<div class = \"nav\">
<p><a href=\"#\">Les mieux notées </a></p>
<p><a href=\"#\">Les recettes de saison </a></p>
<p><a href=\"#\">Les recettes spécial végan </a></p>
<p><a href=\"#\">Au hasard </a></p>
<p><a href=\"titrerecette.php\">Proposer une recette </a></p>
<p><a href=\"deconnexion.php\">Déconnexion</a></p>

</div>";}


?>

<footer>
	<ul class="ul">
		<li class="li"><a href="">Contactez nous</a></li><br />
		<li class="li"><a href="">Besoin d'aide</a></li><br />
		<li class="li"><a href="">Condition</a></li>
	</ul>
</footer>

</div>

</body>

</html>

