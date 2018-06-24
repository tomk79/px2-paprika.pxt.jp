<?php /*
すべての layout について共通の、headセクションの記述
*/ ?>

<?= $theme_custom->ogtags(); ?>

		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta name="keywords" content="<?= htmlspecialchars($px->site()->get_current_page_info('keywords')); ?>" />
		<meta name="description" content="<?= htmlspecialchars($px->site()->get_current_page_info('description')); ?>" />

<?= $px->get_contents_manifesto(); ?>

		<!-- Adobe Typekit -->
		<script src="https://use.typekit.net/erd0xqv.js"></script>
		<script>try{Typekit.load({ async: true });}catch(e){}</script>

		<!-- Bootstrap Theme -->
		<link rel="stylesheet" href="<?= htmlspecialchars( $theme->files('/styles/bootstrap-theme.min.css') ); ?>">
		<link rel="stylesheet" href="<?= htmlspecialchars( $theme->files('/styles/theme.css') ); ?>">

		<!-- Font Awesome -->
		<link rel="stylesheet" href="<?= htmlspecialchars( $theme->files('/libs/font-awesome-4.6.3/css/font-awesome.min.css') ); ?>" />

		<!-- highlight.js -->
		<link rel="stylesheet" href="<?= htmlspecialchars( $theme->files('/libs/highlight.js/styles/github.css') ); ?>">
		<script src="<?= htmlspecialchars( $theme->files('/libs/highlight.js/highlight.pack.js') ); ?>"></script>
		<script>
			$(document).ready(function() {
				$('pre code').each(function(i, block) {
					hljs.highlightBlock(block);
				});
			});
		</script>

		<script>
			// Adobe Typekit
			$(function(){
				var mutObs = new MutationObserver(function(records, observer){
					// console.log('MutationObserver() callback');
					// console.log(records);
					// console.log(observer);

					for( var idx in records ){
						var $tgt = $(records[idx].target);
						// $tgt.find('h1,h2,h3,h4,h5,h6')
						// 	.removeClass('tk-ryo-gothic-plusn')
						// 	.removeClass('tk-skolar-sans-latin')
						// 	.addClass('tk-ryo-gothic-plusn')
						// ;
						$tgt.find('.theme_welcome h1').removeClass('tk-ryo-gothic-plusn').addClass('tk-skolar-sans-latin');
						$tgt.find('.theme_welcome p').addClass('tk-ryo-gothic-plusn');

						// $tgt.find('.theme_header').addClass('tk-ryo-gothic-plusn');
						// $tgt.find('.theme_footer').addClass('tk-ryo-gothic-plusn');
						// $tgt.find('.theme_breadcrumb').addClass('tk-ryo-gothic-plusn');
						$tgt.find('.theme_si').removeClass('tk-ryo-gothic-plusn').addClass('tk-skolar-sans-latin');
					}

				});
				mutObs.observe($('body').get(0), {
					childList: true,
					subtree: true
				});

			});
		</script>
