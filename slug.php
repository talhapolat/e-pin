<?php
$slug = slugit("thank youşöüğ for visiting");
echo $slug;
// returns: thank-you-for-visiting
?>


<?php
setlocale(LC_ALL, 'en_US.UTF8');
function slugit($str, $replace=array(), $delimiter='-') {
    if ( !empty($replace) ) {
        $str = str_replace((array)$replace, ' ', $str);
	}
	$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);
	$clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
	$clean = strtolower(trim($clean, '-'));
	$clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);
	return $clean;
}
?>