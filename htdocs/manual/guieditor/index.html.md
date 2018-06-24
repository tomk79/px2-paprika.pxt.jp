
GUI編集機能は、 Pickles 2 に搭載された拡張仕様です。

部品化されたHTMLのモジュール(ドキュメントモジュールと呼びます)を、直感的なドラッグ＆ドロップの操作で組み合わせ、コンテンツを構成することができます。

ドキュメントモジュールは、プロジェクトごとにHTML構造をカスタマイズすることができます。一度作成したモジュールは他のプロジェクトでも簡単に導入できます。

このGUI編集エンジンは、 独立したnpmパッケージ <a href="https://github.com/broccoli-html-editor" target="_blank">broccoli-html-editor</a> に実装されています。 この章では、 <a href="https://github.com/broccoli-html-editor" target="_blank">broccoli-html-editor</a> の使い方について説明します。

<ul>
<?php
$children = $px->site()->get_children();
foreach( $children as $child ){
?>
	<li><?php print $px->mk_link( $child ); ?></li>
<?php
}
?>
</ul>
