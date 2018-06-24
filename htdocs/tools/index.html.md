<ol>
<?php
$children = $px->site()->get_children(null, array('filter'=>false));
foreach( $children as $child ){
	print '<li>'.$px->mk_link($child).'</li>';
}
?>
</ol>
