
テーマは、ページ要素のうち、ヘッダー、フッター、ナビゲーションなど、サイト全体を通して共通の規則にしたがって生成されるべき部分を一元管理する概念です。コンテンツ領域以外のHTMLソースを自動的に生成します。

<!-- autoindex -->


## テーマの実装と $theme オブジェクト

テーマは、<a href="<?= htmlspecialchars('/manual/plugins/'); ?>">プラグイン</a> の1つとして実装されています。初期状態の Pickles 2 には、 `pickles2/px2-multitheme` というプラグインが設定されており、このプラグインが、テーマテンプレートの選択や切り替え、値の解決等の処理を行っています。

`pickles2/px2-multitheme` は、 `$theme` を生成します。 `$theme` は、テーマテンプレートの名前空間で利用可能なオブジェクトで、テンプレートの実装を助ける幾つかの機能を提供しています。

`pickles2/px2-multitheme` について詳しくは <a href="https://packagist.org/packages/pickles2/px2-multitheme" target="_blank">Packagist</a> を参照してください。


`config.php` にある下記の部分が、 `pickles2/px2-multitheme` を設定している箇所です。

```php
$conf->funcs->processor->html = array(

    /* 中略 */

	// テーマ
	'theme'=>'tomk79\pickles2\multitheme\theme::exec('.json_encode([
		'param_theme_switch'=>'THEME',
		'cookie_theme_switch'=>'THEME',
		'path_theme_collection'=>'./px-files/themes/',
		'attr_bowl_name_by'=>'data-contents-area',
		'default_theme_id'=>'pickles2'
	]).')' ,

    /* 中略 */

);
```

このドキュメントでは、 `pickles2/px2-multitheme` が導入されていることを前提に、テーマの取り扱い方法について説明します。


## テーマの格納ディレクトリ

テーマは、次のディレクトリに格納されます。

```bash
./px-files/themes/{$テーマ名}/
```

`{$テーマ名}` に該当するフォルダ名を任意に設定することで、複数のテーマを格納し、切り替えて使用することができます。テーマ名は パラメータ `?THEME={$テーマ名}` を付加することで切り替えることができます。デフォルトのテーマ名は `pickles2` で、 `default_theme_id` オプションで変更することができます。

テーマ格納フォルダのパスは、`pickles2/px2-multitheme` の `path_theme_collection` オプションで、切り替えに使用するパラメータ名は `param_theme_switch` で、デフォルトのテーマ名は `default_theme_id` で、それぞれ変更することができます。


<!--

### 複数のテーマの管理と切り替え

Pickles Framework では、1サイトに複数のテーマを定義することができます。テーマにはそれぞれ名前を付けます。デフォルトのテーマのテーマ名は <code>&quot;default&quot;</code> です。

テーマは、URLパラメータに <code>?THEME={$テーマ名}</code> と付加して切り替えることができます。

<div class="unit">
	<div><pre><code>例： http://xxxxxxxxx/?THEME={$テーマ名}
</code></pre></div>
</div>

-->


## レイアウト

各テーマには、それぞれ _レイアウト_ と呼ばれるテンプレートを複数定義することができます。サイトマップの `layout` 列にレイアウト名を指定することによって切り替えることができます。 `layout` 列を空白にした場合は、デフォルトのレイアウト `default` が適用されます。

```bash
./px-files/themes/{$テーマ名}/{$レイアウト名}.html
```

初期状態では、`default`(標準レイアウト)、`top`(トップページ用レイアウト)、`plain`(`<body>`の直下にコンテンツエリアを配したレイアウト)、`popup`(ポップアップウィンドウ用レイアウト)、`naked`(コンテンツエリアのみが出力されるレイアウト)が定義されていますが、任意に増やすことができます。

例えば、任意の新しいレイアウト `fullcolumn` を追加したい場合の手順は2ステップです。

1. まず、テーマフォルダに `fullcolumn.html` を作成してテンプレートを実装します。
2. 次に、サイトマップ上の適用させたいページの `layout` 列に `fullcolumn` と指定します。

これで、新しいレイアウトを利用することができます。



## テーマテンプレート内で利用可能なオブジェクト

テーマテンプレートでは、次のオブジェクトが利用できます。

- `$px` : Pickles Framework の機能を格納したオブジェクトです。コンテンツ内で呼び出せる `$px` と同じです。
- `$theme` : 前述のプラグイン `pickles2/px2-multitheme` が提供する機能を格納しています。


## テーマテンプレートの記述

テーマは、コンテンツ領域のソースを変数として受け取り、HTML全体を補完して完成させます。テーマのテンプレートは、DOCTYPE宣言、htmlタグ、headセクション、bodyセクションを出力し、ヘッダー、フッターナビゲーション構造などを生成するのもテーマの役割です。

この章では、基本的なテーマテンプレートの実装手順について、順を追って紹介します。

まず、デフォルトレイアウト `default.html` に、最低限の基本的なHTMLのセットを用意します。

```html
<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title>sample</title>
</head>
<body>
</body>
</html>
```

ここに、順を追って必要な動的要素を追加していきます。

### コンテンツを出力する

コンテンツは、コンテンツ領域にあたる部分に出力します。関数 `$px->bowl()->get_clean()` で出力でします。<br />
コンテンツ領域は、必ず `class="contents"` の要素で囲われるようにしなければなりません。<br />

```html
<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title>sample</title>
</head>
<body>
<div class="contents">
<<?=''?>?php
    //↓コンテンツから受け取った
    //  コンテンツエリアのソースを出力しています。
    print $px->bowl()->get_clean();
?>
</div>
</body>
</html>
```

### コンテンツが定義したCSSやJavaScriptを出力する

コンテンツは、そのコンテンツ独自のJavaScript機能やCSSを定義しているかも知れません。CSSやJavaScriptの定義は、headセクション内に出力したいところですが、コンテンツのコードにはheadセクションを含まないので、コンテンツの制作者は関数 `$px->bowl()->put('HTMLコード', 'head')` を使って、テーマにHTMLを託します。

こうして受け取ったコードは、次の例のように、関数 `$px->bowl()->get_clean('head')` で出力します。

同様に、bodyセクションの最後にコードを出力したい場合は、 `$px->bowl()->get_clean('foot')` にコードが渡されるので、あわせて出力するようにします。 `foot` には主に `<script>` タグなどが渡されます。

```html
<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title>sample</title>
<<?=''?>?php
    //↓コンテンツから受け取った
    //  headセクション内用のソースを出力しています。
    print $px->bowl()->get_clean('head');
?>
</head>
<body>
<div class="contents">
<<?=''?>?php
    //↓コンテンツから受け取った
    //  コンテンツエリアのソースを出力しています。
    print $px->bowl()->get_clean();
?>
</div>
<<?=''?>?php
    //↓コンテンツから受け取った
    //  bodyセクションの最後に出力するソースを出力しています。
    print $px->bowl()->get_clean('foot');
?>
</body>
</html>
```

### コンテンツの環境構築 (Contents Manifesto)

コンテンツのHTMLコードが本来の意図通りにレイアウトされるためには、それに必要なCSSなどの環境をテーマから提供する必要があります。しかし、コンテンツ向けのCSS環境はプロジェクトによって一定とは限りません。

そこで「プロジェクトは、コンテンツ向けに提供する環境設定を <code>/common/contents_manifesto.ignore.php</code> に置く」という約束が設けられました。すべてのテーマがこのファイルをインクルードすれば、テーマを取り替えたときにもコンテンツの表示を保証できるようになります。

```html
<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title>sample</title>
<<?=''?>?php
    // ↓コンテンツの環境構築を読み込みます。
    print $px->get_contents_manifesto();
?>
<<?=''?>?php
    //↓コンテンツから受け取った
    //  headセクション内用のソースを出力しています。
    print $px->bowl()->get_clean('head');
?>
</head>
<body>

...以下省略
```

Contents Manifesto のパスは、 `$conf->contents_manifesto` で設定変更可能なため、必ず同じパスに存在するとは限りません。 `$px->get_contents_manifesto()` は、この設定を考慮しつつ、解決されたHTMLソースとして Contents Manifesto を返します。


### ページの情報を出力する

カレントページの情報は、サイトマップCSVに定義されており、<code>$px-&gt;site()-&gt;get_current_page_info()</code> から取得することができます。

```html
<<?=''?>?= $px->site()->get_current_page_info('表示したい項目の物理名') ?>
```

引数に項目の物理名を指定して、ページ情報のどの項目を表示するかを決めます。 例えば、 ページのタイトルを表示する場合、 `<<?=''?>?= $px->site()->get_current_page_info('title') ?>` のようにします。

幾つか例を示します。

#### ページ名を出力する

ページ名には、HTMLの特殊文字が含まれている可能性があります。 <code>htmlspecialchars()</code> を通して、エスケープするようにします。

```html
<title><<?=''?>?= htmlspecialchars( $px->site()->get_current_page_info('title_full') ); ?></title>
```

#### メタタグ description を出力する

```html
<meta name="description" content="<<?=''?>?= htmlspecialchars($px->site()->get_current_page_info('description')); ?>" />
```

#### メタタグ keywords を出力する

```html
<meta name="keywords" content="<<?=''?>?= htmlspecialchars($px->site()->get_current_page_info('keywords')); ?>" />
```

#### ページ名(h1用) を出力する

他の幾つかのCMSでは、h1見出しはコンテンツ(記事など)に含まれることがありますが、 Pickles 2 では、これはテーマに含むとするのが基本的な考え方です。 h1見出しは統一されたスタイルで統一された位置に表示されること、ユーザーがアクセスしたページが何かを示すh1見出しはナビゲーション構造を成立させるために不可欠な要素であることがその理由です。

h1見出しの実装は少し特殊です。文字列に改行が含まれている場合があるからです。 HTML特殊文字に加え、改行コードを改行タグに置き換える必要があります。

```html
<h1><<?=''?>?= preg_replace('/\r\n|\r|\n/s', '<br />', htmlspecialchars($px->site()->get_current_page_info('title_h1')) ); ?></h1>
```

この他にも、サイトマップに定義されたすべての項目にアクセスすることができます。

### これらを組み込んだミニマム構成

```html
<!doctype html>
<html>
<head>
<meta charset="UTF-8" />
<title><<?=''?>?= htmlspecialchars($px->site()->get_current_page_info('title_full')); ?></title>
<meta name="description" content="<<?=''?>?= htmlspecialchars($px->site()->get_current_page_info('description')); ?>" />
<meta name="keywords" content="<<?=''?>?= htmlspecialchars($px->site()->get_current_page_info('keywords')); ?>" />
<<?=''?>?php
    // ↓コンテンツの環境構築を読み込みます。
    print $px->get_contents_manifesto();
?>
<<?=''?>?php
    //↓コンテンツから受け取った
    //  headセクション内用のソースを出力しています。
    print $px->bowl()->get_clean('head');
?>
</head>
<body>
<h1><<?=''?>?= preg_replace('/\r\n|\r|\n/s', '<br />', htmlspecialchars($px->site()->get_current_page_info('title_h1')) ); ?></h1>
<div class="contents">
<<?=''?>?php
    //↓コンテンツから受け取った
    //  コンテンツエリアのソースを出力しています。
    print $px->bowl()->get_clean();
?>
</div>
<<?=''?>?php
    //↓コンテンツから受け取った
    //  bodyセクションの最後に出力するソースを出力しています。
    print $px->bowl()->get_clean('foot');
?>
</body>
</html>
```

## テーマ固有のリソースファイルへのアクセス

テーマは、それぞれ固有のリソースファイル(CSS, JavaScript, 画像など)を持つことができます。

テーマ固有のリソースファイルは、テーマと合わせてインストールされる必要があるため、テーマパッケージの中に格納されます。このため、テーマリソースはブラウザから直接アクセスできないパスに置かれることになります。 このパスにアクセスするには、メソッド `$theme->files()` を使います。

```php
<img src="<<?php ?>?= htmlspecialchars( $theme->files('/path/to/resource.png') ) ?>" />
```

この実装例は、 `$theme->files($resource_path)` を介して `<theme>/theme_files/path/to/resource.png` を呼び出しています。

`$theme->files($resource_path)` は、 `theme_files` フォルダ内からリソースを取り出し、公開キャッシュフォルダにコピーし、キャッシュファイルのリンクを返します。 従ってブラウザは、キャッシュを読み込んで表示することになります。


## GUI編集のためのコンテンツエリア指定

<a href="<?= htmlspecialchars($px->href('/tools/px2dt/')) ?>">Pickles 2 アプリケーション</a> のGUI編集機能は、HTML上の属性値からコンテンツエリアを識別します。

デフォルトでは、セレクタ `.contents` でマッチする要素をbowl(コンテンツエリア)として扱い、各bowlの名前は要素の `id` 属性値から採用します(`id`属性がない場合は、`main`が省略されているものとします)。

この挙動は、 Pickles 2 プロジェクトの共有設定(コンフィグ)で変更することができます。次の例は、属性 `data-contents-area` がある要素をbowlとし、その値を bowl名 と解釈するようにしたものです。 初期状態の Pickles 2 プロジェクトの共有設定(コンフィグ)では、この値で設定されています。

```html
<<?=''?>?php
// config.php

$conf->plugins->px2dt->contents_area_selector = '[data-contents-area]';//←コンテンツエリアを識別するセレクタ(複数の要素がマッチしてもよい)
$conf->plugins->px2dt->contents_bowl_name_by = 'data-contents-area';//←コンテンツエリアのbowl名を指定する属性名
```

次の例は、テーマの実装例です。 `$conf->plugins->px2dt->contents_bowl_name_by` に設定された属性名に、 bowl の名前(この例では `main`) を指定しています。 `$px->bowl()->get_clean()` の引数を省略した場合のデフォルト値は `main` なので、 `$px->bowl()->get_clean('main')` のように明記することもできます。

```html
<div <<?=''?>?= htmlspecialchars( $theme->get_attr_bowl_name_by() )?<?=''?>>="main">
<<?=''?>?= $px->bowl()->get_clean() ?<?=''?>>
</div>
```

GUI編集にかかる設定や実装について詳しくは <?= $px->mk_link('/manual/guieditor/setting_pickles2/');?> も参照してください。


## テーマ編集でよく使うメソッド

- <a href="<?= htmlspecialchars($px->href('/phpdoc/px-fw-2.x/classes/picklesFramework2.site.html#method_get_current_page_info'));?>" target="_blank">$px->site()->get_current_page_info()</a> - 現在のページの情報を得る。
- <a href="<?= htmlspecialchars($px->href('/phpdoc/px-fw-2.x/classes/picklesFramework2.site.html#method_get_page_info')) ?>" target="_blank">$px->site()->get_page_info()</a> - ページ情報を取得する。
- <a href="<?= htmlspecialchars($px->href('/phpdoc/px-fw-2.x/classes/picklesFramework2.site.html#method_get_children')) ?>" target="_blank">$px->site()->get_children()</a> - 子階層のページの一覧を取得する。
- <a href="<?= htmlspecialchars($px->href('/phpdoc/px-fw-2.x/classes/picklesFramework2.site.html#method_get_bros')) ?>" target="_blank">$px->site()->get_bros()</a> - 同じ階層のページの一覧を取得する。
- <a href="<?= htmlspecialchars($px->href('/phpdoc/px-fw-2.x/classes/picklesFramework2.site.html#method_get_parent')) ?>" target="_blank">$px->site()->get_parent()</a> - 親ページのIDを取得する。
- <a href="<?= htmlspecialchars($px->href('/phpdoc/px-fw-2.x/classes/picklesFramework2.site.html#method_get_breadcrumb_array')) ?>" target="_blank">$px->site()->get_breadcrumb_array()</a> - パンくず配列を取得する。
- <a href="<?= htmlspecialchars($px->href('/phpdoc/px-fw-2.x/classes/picklesFramework2.site.html#method_get_global_menu')) ?>" target="_blank">$px->site()->get_global_menu()</a> - グローバルメニューのページID一覧を取得する。
- <a href="<?= htmlspecialchars($px->href('/phpdoc/px-fw-2.x/classes/picklesFramework2.site.html#method_get_shoulder_menu')) ?>" target="_blank">$px->site()->get_shoulder_menu()</a> - ショルダーメニューのページID一覧を取得する。
- <a href="<?= htmlspecialchars($px->href('/phpdoc/px-fw-2.x/classes/picklesFramework2.px.html#method_mk_link')) ?>" target="_blank">$px->mk_link()</a> - リンクタグ(aタグ)を生成する。
- <a href="<?= htmlspecialchars($px->href('/phpdoc/px-fw-2.x/classes/picklesFramework2.px.html#method_href')) ?>" target="_blank">$px->href()</a> - リンク先のパスを生成する。
- <a href="<?= htmlspecialchars($px->href('/phpdoc/px2-multitheme/classes/tomk79.pickles2.multitheme.template_utility.html#method_files')) ?>" target="_blank">$theme->files()</a> - テーマリソースへのパスを取得する


## サンプルコード

### 親ページへのリンクの実装例

```html
<p><<?=''?>?php
	$parent = $px->site()->get_parent();
	print $px->mk_link( $parent );
?<?=''?>></p>
```

### 子階層リンクの実装例

```html
<ul><<?=''?>?php
	$children = $px->site()->get_children();
	foreach( $children as $child ){
		print '<li>'.$px->mk_link( $child ).'</li>';
	}
?<?=''?>></ul>
```

### 兄弟階層リンクの実装例

```html
<ul><<?=''?>?php
	$bros = $px->site()->get_bros();
	foreach( $bros as $bro ){
		print '<li>'.$px->mk_link( $bro ).'</li>';
	}
?<?=''?>></ul>
```

### パンくずの実装例

```html
<div class="breadcrumb">
	<ul><<?=''?>?php
	// $site->get_breadcrumb_array() は、カレントページのパンくず配列を返します。
	$breadcrumb = $px->site()->get_breadcrumb_array();
	foreach( $breadcrumb as $pid ){
		print '<li>';
		if( $px->href($pid) != $px->href($px->site()->get_current_page_info('id')) ){
			print $px->mk_link( $pid, array('label'=>$px->site()->get_page_info($pid, 'title_breadcrumb'), 'current'=>false) );
		}else{
			print '<span>'.htmlspecialchars( $px->site()->get_page_info($pid, 'title_breadcrumb') ).'</span>';
		}
		print '</li>';
	}
	// $breadcrumb はカレントページ自身を含まないため、最後に自身を追加する。
	print '<li><span>'.htmlspecialchars( $px->site()->get_current_page_info('title_breadcrumb') ).'</span></li>';
?<?=''?>></ul>
</div>
```

### グローバルメニューの実装例

```html
<ul><<?=''?>?php
	$global_menu = $px->site()->get_global_menu();

	foreach( $global_menu as $global_menu_page_id ){
		print '<li>'.$px->mk_link( $global_menu_page_id ).'</li>';
	}
?<?=''?>></ul>
```

### ショルダーメニューの実装例

```html
<ul><<?=''?>?php
	$shoulder_menu = $px->site()->get_shoulder_menu();

	foreach( $shoulder_menu as $shoulder_menu_page_id ){
		print '<li>'.$px->mk_link( $shoulder_menu_page_id ).'</li>';
	}
?<?=''?>></ul>
```
