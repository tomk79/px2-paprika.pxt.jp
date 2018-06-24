<?php ob_start(); ?><link rel="stylesheet" href="<?= htmlspecialchars( $px->path_files('/style.css') ) ?>" /><?php $px->bowl()->send( ob_get_clean(), 'head' );?>
<?php ob_start(); ?><script src="<?= htmlspecialchars( $px->path_files('/script.js') ) ?>"></script><?php $px->bowl()->send( ob_get_clean(), 'foot' );?>

<div class="unit">
	<div class="center">
		<p class="YoutubeWrapper"><iframe width="560" height="315" src="https://www.youtube.com/embed/videoseries?list=PL5ZUBZrE-CkDSYUvVZNDCILrzGhRG2U8L" frameborder="0" allowfullscreen></iframe></p>
	</div>
	<p class="right">その他、<a href="https://www.youtube.com/watch?v=yUnckFu7SNs&amp;list=PL5ZUBZrE-CkDSYUvVZNDCILrzGhRG2U8L" target="_blank">YouTubeに複数の動画をアップしています</a>。</p>
</div>

## Get GUI Tool for Desktop
<p><a href="./tools/px2dt/">Pickles 2</a> は、ウェブサイトの制作をGUIでサポートするデスクトップアプリケーションです。 <a href="https://github.com/pickles2/app-pickles2/releases/tag/<?= h($px->conf()->project->px2dt_latestversion); ?>" target="_blank">Pickles 2 ダウンロードページ</a> からダウンロードできます。</p>

<div class="platform platform--mac"><a href="https://github.com/pickles2/app-pickles2/releases/download/<?= h($px->conf()->project->px2dt_latestversion); ?>/Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-osx64.zip" class="px2-btn px2-btn--download px2-btn--lg">Download
<div><small>Pickles 2 v<?= h($px->conf()->project->px2dt_latestversion); ?></small></div>
<small>for macOS</small>
</a></div>


<div class="platform platform--win"><a href="https://github.com/pickles2/app-pickles2/releases/download/<?= h($px->conf()->project->px2dt_latestversion); ?>/Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-win32.zip" class="px2-btn px2-btn--download px2-btn--lg">Download
<div><small>Pickles 2 v<?= h($px->conf()->project->px2dt_latestversion); ?></small></div>
<small>for Windows</small>
</a></div>


<div class="platform platform--linux"><a href="https://github.com/pickles2/app-pickles2/releases/download/<?= h($px->conf()->project->px2dt_latestversion); ?>/Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-linux64.zip" class="px2-btn px2-btn--download px2-btn--lg">Download
<div><small>Pickles 2 v<?= h($px->conf()->project->px2dt_latestversion); ?></small></div>
<small>for Linux</small>
</a></div>

<div class="cont_download-for-platforms">
	<ul>
		<li>for <a href="https://github.com/pickles2/app-pickles2/releases/download/<?= h($px->conf()->project->px2dt_latestversion); ?>/Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-osx64.zip">macOS</a></li>
		<li>for <a href="https://github.com/pickles2/app-pickles2/releases/download/<?= h($px->conf()->project->px2dt_latestversion); ?>/Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-win32.zip">Windows</a></li>
		<li>for <a href="https://github.com/pickles2/app-pickles2/releases/download/<?= h($px->conf()->project->px2dt_latestversion); ?>/Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-linux64.zip">Linux</a></li>
		<li><a href="./download/">その他のダウンロード</a></li>
	</ul>
</div>
