<?php
/**
 * Created by PhpStorm.
 * User: IRUNWEBSERVER
 * Date: 20/09/2017
 * Time: 15:48
 */
$curl = curl_init();
curl_setopt_array($curl, Array(
    CURLOPT_URL =& gt;
'http://intranet.forestpioneer.com/intranet/a_maquinariaSegMano.php',
	CURLOPT_RETURNTRANSFER =& gt; TRUE,
	CURLOPT_ENCODING =& gt; 'UTF-8'
	));
$data = curl_exec($curl);
curl_close($curl);
libxml_use_internal_errors(true);
$xml = simplexml_load_string($data);
if ($xml === false) {
    echo "Failed loading XML\n";
    foreach (libxml_get_errors() as $error) {
        echo "\t", $error -&gt;message;
	}
} else {
    $columna = '1';
    $poscion = '0';
    $altura = '0';
    echo "[vc_row][vc_column width='1/1']
    [vcex_portfolio_grid term_slug='all' filter='true' grid_style='fit-columns' columns='3' posts_per_page='-1' img_crop='true' img_filter='none' thumb_link='post' order='DESC' orderby='date' pagination='true' title='true' excerpt='true' excerpt_length='20' read_more='false' center_filter='no' overlay_style='title-category-hover' title_link='post']";
    echo "
	<div class='vcex-module vcex-portfolio-grid-wrap wpex-clr'>
	<ul class='vcex-portfolio-filter vcex-filter-links clr'>
 	<li class='active'><a class='theme-button minimal-border' href='#' data-filter='*'>All</a></li>
    <li class='filter-cat-26'><a class='theme-button minimal-border' href='#' data-filter='.cat-26'>Cabezales</a></li>
 	<li class='filter-cat-21'><a class='theme-button minimal-border' href='#' data-filter='.cat-21'>Procesadoras o Taladoras de Ruedas</a></li>
 	</ul>
 	<div class='wpex-row vcex-portfolio-grid wpex-clr entries vcex-isotope-grid' style='position: relative; height: 1378.19px;'>";
    foreach ($xml->children() as $book) {
        echo "
 	<div class="portfolio - entry entry - has - details span_1_of_3 col col ->.$columna .> vcex - isotope - entry post ->.$book->&lt;p > id .> entry type - portfolio has - media tag - 62 tag - 60 cat - 21" style="z - index: 1000; width = 325px; position: absolute; left: '.$poscion.'px; top: '.$altura.'px;">
 	<div class="portfolio - entry - inner entry - inner wpex - clr">
 	<div class="portfolio - entry - media entry - media wpex - clr overlay - parent overlay - parent - title - category - hover"><a class="portfolio - entry - media - link" title="TIMBERJACK 1070D + WARATHA H754" href="http://forestpioneer.com/portfolio-item/procesadora-timberjack-1070d-cabezal-waratha-h754-en-venta/">
 	<img class="portfolio-entry-img" style = "max-width: 340px; max-height: 300px;" src = "http://forestpioneer.com/wp-content/uploads/2017/04/TIMBERJACK-3-500x350.jpg" alt = "TIMBERJACK 1070D+WARATHA H754" width = "340px" height = "300px" data - no - retina = "" /></a >
 	<div class="overlay-title-category-hover overlay-hide theme-overlay textcenter" style = "max-width: 340px; max-height: 300px;" >
 	<div class="overlay-table clr" >
 	<div class="overlay-table-cell clr" >
 	<div class="overlay-title" > ".$columna.")".$book->modelo." </div >
<div class="overlay-terms" ><span class="term-21" > ".$book->makina."</span ></div >
</div >
</div >
</div >
</div >
<div class='portfolio-entry-details entry-details wpex-clr' >
<h2 class='portfolio-entry-title entry-title' ><a title = 'TIMBERJACK 1070D+WARATHA H754' href = 'http://forestpioneer.com/portfolio-item/procesadora-timberjack-1070d-cabezal-waratha-h754-en-venta/' > ".$columna."')".$book->modelo." </a ></h2 >
<div class="portfolio-entry-excerpt entry-excerpt wpex-clr" > ".$columna.")".$book->makina." Cabezal talador de disco QUADCO 2400 con 500h por 65.000€ con disponibilidad inmediata </div >
</div >
</div >
</div >
    ";
if($columna=='3'){
	$columna = '1';
	$poscion = 0;
	$altura = $altura+360;
} else{
	$columna++;
	$poscion = $poscion+333;
}
}
echo "

</div >
</div >
    ";
echo "[/vc_column][/vc_row]";
}