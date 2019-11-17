			<div class="theme_container">
				<nav class="theme_megafooter_navi">
<?php
	$global_menu = $px->site()->get_global_menu();
	echo( '<ul>' );
	foreach( $global_menu as $page_id ){
		echo( '<li>'.$px->mk_link( $page_id ).'</li>' );
	}
	echo( '</ul>' );
?>
				</nav>
			</div>
			<div class="theme_container theme_footer_shouldernavi">
<?php
	$shoulder_menu = $px->site()->get_shoulder_menu();
	echo( '<ul>' );
	echo( '<li>'.$px->mk_link( '', array('current'=>false) ).'</li>' );
	foreach( $shoulder_menu as $page_id ){
		echo( '<li>'.$px->mk_link( $page_id ).'</li>' );
	}
	echo( '</ul>' );
?>
			</div>
			<div class="theme_container theme_footer_searcher">
				<form action="<?= htmlspecialchars( $px->href('/search/') ); ?>" class="form-inline">
					<div class="form-group">
						<label>サイト内検索</label>
						<input type="text" name="q" value="" class="form-control" />
						<button class="form-control">検索</button>
					</div>
				</form>
			</div>
			<div class="theme_container">
<?php include(__DIR__.'/default_footer_social_icons.inc'); ?>
			</div>
			<div class="theme_container">
				<p style="text-align:center;">&copy;Pickles 2 Project.</p>
			</div>
