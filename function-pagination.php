<?php


/********************************************************************************
*  			Function pour définir les paramêtres d'une pagination :				*
* 	page actuelle, nombre de pages, page de départ et nombre d'items par pages 	*
*         					et crée la nav de pagination						*
********************************************************************************/

function pagination($nb_result, $nb_items){
	// On initialise la première page sur laquelle on arrive au départ
	$page = 1;

	// On vérifie si une page est envoyée en GET et on la stocke
	if(!empty($_GET['page']) && is_numeric($_GET['page'])){
		$page=intval($_GET['page']);
	}

	// on définit le nombre de page
	$nb_page = ceil($nb_result / $nb_items);

	// on vérifie que la page transmise en get soit une valeur existante
	if(!empty($_GET['page']) && $_GET['page'] > $nb_page) {
			$page = $nb_page;
	}
	elseif(!empty($_GET['page']) && $_GET['page']< 1){
			$page = 1;
	}

	// on définit le resultat par lequel commence la page
	$start = ($page-1) * $nb_items;

	// on crée un tableau pour stocker la page actuelle et le nombre de page
	$pagination=array(
		'actual' => $page, // à utiliser
		'nb_pages' => $nb_page,
		'start' => $start,
		'nb_items' => $nb_items);

	return $pagination;
}

function prevNext($pagination, $url){
	echo '<nav><ul class="pager">';
	if($pagination['actual']>1){?>
		<li><a href="<?= $url ?><?= $pagination['actual']-1 ?>">Previous</a></li>
	<?php }
	for($i=1;$i<=$pagination['nb_pages'];$i++){ ?>
		<li><a href="<?= $url ?><?=$i?>"><?=$i?></a></li>
	<?php }
	if($pagination['actual']< $pagination['nb_pages']){?>
		<li><a href="<?= $url ?><?= $pagination['actual']+1 ?>">Next</a></li>
	<?php }
	echo '</ul></nav>';

}