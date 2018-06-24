## ウェブサイトの制作手順

Pickles 2 を使ったウェブサイト制作では、次の手順で制作を進めます。

1. サイトマップを定義する
2. コンテンツを編集する
3. テーマを編集する
4. パブリッシュする

最後のパブリッシュの手順により、サイト全体のHTMLが静的な形式に出力されます。これにより、PHPや動的なフレームワークに依存せず、一般的なウェブサーバーがあれば公開できる状態になります。<br />


## コンテンツ

<ol>
<?php
$children = $px->site()->get_children(null, array('filter'=>false));
foreach( $children as $child ){
	print '<li>'.$px->mk_link($child).'</li>';
}
?>
</ol>
