<?php

function createPagination($address, $nb_pages) {

	$pagination = array();

	for($i=1 ; $i<=$nb_pages ; $i++) {

		$pagination[] = array('page' =>$i
							, 'address'=>$address.'&page='.$i);

	}
	
	return $pagination;

}

