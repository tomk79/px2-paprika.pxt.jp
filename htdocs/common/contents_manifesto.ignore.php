<?php
/**
 * Contents Manifesto
 *
 * このファイルは、コンテンツの制作環境を宣言します。
 * モジュールを定義するCSSやJavaScriptファイルを読み込みます。
 *
 * このファイルを異なるテーマ間で共有することにより、テーマを取り替えても、
 * コンテンツの表現を再現する前提を保証することができます。
 *
 * - テーマは、このパス (`/common/contents_manifesto.nopublish.inc.php`) を、
 * headセクション内に `include()` します。
 * - このファイルの中にPHPの記述を埋め込むことができるように読み込みます。
 * - このファイルのスコープで `$px` を利用できるようにしてください。
 *
 * HTML上、コンテンツは `.contents` の中に置かれます。
 * 従って、このファイルで定義される内容は、`.contents` の中にのみ影響するように実装されるべきです。
 *
 */ ?>
 <?php
	 //$pxがない(=直接アクセスされた)場合、ここで処理を抜ける。
 	if(!$px){return;}
 ?>

<!-- jQuery -->
<script src="<?php print htmlspecialchars($px->href('/common/scripts/jquery-1.10.1.min.js')); ?>" type="text/javascript"></script>

<!-- Bootstrap -->
<link rel="stylesheet" href="<?= htmlspecialchars( $px->href('/common/styles/bootstrap/css/bootstrap.min.css') ); ?>">
<script src="<?= htmlspecialchars( $px->href('/common/styles/bootstrap/js/bootstrap.min.js') ); ?>"></script>

<!-- px2style -->
<link rel="stylesheet" href="<?php print htmlspecialchars($px->href('/common/px2style/dist/styles.css')); ?>" type="text/css" />
<script src="<?= htmlspecialchars( $px->href('/common/px2style/dist/scripts.js') ); ?>"></script>

<!-- Contents Stylesheets -->
<link rel="stylesheet" href="<?php print htmlspecialchars($px->href('/common/styles/contents.css')); ?>" type="text/css" />

<!-- Google Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-3100892-11', 'auto');
  ga('send', 'pageview');
</script>
