<?php
function paginate($reload, $page, $tpages, $adjacents) {
	$prevlabel = "&lsaquo; Anterior";
	$nextlabel = "Siguiente &rsaquo;";
	$out = '<ul class="pagination pagination-large">';
	
	// previous label

	if($page==1) {
		$out.= "<li style='font-size: 10pt; font-family: Courier' class='disabled'><span><a>$prevlabel</a></span></li>";
	} else if($page==2) {
		$out.= "<li style='font-size: 10pt; font-family: Courier'><span><a href='javascript:void(0);' onclick='load(1)'>$prevlabel</a></span></li>";
	}else {
		$out.= "<li style='font-size: 10pt; font-family: Courier'><span><a href='javascript:void(0);' onclick='load(".($page-1).")'>$prevlabel</a></span></li>";

	}
	
	// first label
	if($page>($adjacents+1)) {
		$out.= "<li style='font-size: 10pt; font-family: Courier'><a href='javascript:void(0);' onclick='load(1)'>1</a></li>";
	}
	// interval
	if($page>($adjacents+2)) {
		$out.= "<li style='font-size: 10pt; font-family: Courier'><a>...</a></li>";
	}

	// pages

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
		if($i==$page) {
			$out.= "<li style='font-size: 10pt; font-family: Courier' class='active'><a>$i</a></li>";
		}else if($i==1) {
			$out.= "<li style='font-size: 10pt; font-family: Courier'><a href='javascript:void(0);' onclick='load(1)'>$i</a></li>";
		}else {
			$out.= "<li style='font-size: 10pt; font-family: Courier'><a href='javascript:void(0);' onclick='load(".$i.")'>$i</a></li>";
		}
	}

	// interval

	if($page<($tpages-$adjacents-1)) {
		$out.= "<li style='font-size: 10pt; font-family: Courier'><a>...</a></li>";
	}

	// last

	if($page<($tpages-$adjacents)) {
		$out.= "<li style='font-size: 10pt; font-family: Courier'><a href='javascript:void(0);' onclick='load($tpages)'>$tpages</a></li>";
	}

	// next

	if($page<$tpages) {
		$out.= "<li style='font-size: 10pt; font-family: Courier'><span><a href='javascript:void(0);' onclick='load(".($page+1).")'>$nextlabel</a></span></li>";
	}else {
		$out.= "<li style='font-size: 10pt; font-family: Courier' class='disabled'><span><a>$nextlabel</a></span></li>";
	}
	
	$out.= "</ul>";
	return $out;
}
?>