
パブリッシュは、制作したウェブコンテンツを静的なHTMLファイルに書き出す処理です。

動的なままの Pickles 2 を公開することも可能ですが、サーバーに PHPの実行環境を要求し、そのぶん負荷もかかります。 静的に書きだされたHTMLは、サーバー負荷が軽く、サーバーの実行環境にもほとんど依存しません。

<!-- autoindex -->



## PXコマンドから実行する

パブリッシュは、次のPXコマンドから実行することができます。

```nohighlight
$ cd {$path_controot}
$ php .px_execute.php /?PX=publish.run
```

### コマンドラインオプション

<table class="def">
<tr>
<th>path_region</th>
<td>対象範囲とするディレクトリパスを1つ指定します。省略時はカレントディレクトリが対象になります。<br />
<code>/?PX=publish.run&path_region=/a/b/</code> と <code>/a/b/?PX=publish.run</code> は同じ意味です。</td>
</tr>
<tr>
<th>paths_region</th>
<td>対象範囲を追加指定します。配列で複数指定可能です。</td>
</tr>
<tr>
<th>paths_ignore</th>
<td><code>path_region</code> で指定した対象範囲のうち、パブリッシュを除外するパスを指定します。複数指定可能です。</td>
</tr>
<tr>
<th>keep_cache</th>
<td><code>1</code>を指定し、パブリッシュ処理の初期化時に、キャッシュの削除および再生成をスキップします。</td>
</tr>
</table>

オプションを設定した実行例を示します。

```nohighlight
$ php .px_execute.php "/?PX=publish.run&path_region=/a/b/&paths_region[]=/a/c/&paths_region[]=/a/d/&paths_ignore[]=/a/b/ignore1/&paths_ignore[]=/a/b/ignore2/&keep_cache=1"
```

この例では、対象範囲を `/a/b/` に絞った上で、 `/a/b/ignore1/` と `/a/b/ignore2/` を対象外に指定しています。


## ブラウザから実行する

`$conf->allow_pxcommands` が有効な場合、URLにGETパラメータ `?PX=publish.run` を付加して起動することもできます。

```nohighlight
http://your.domain.com/?PX=publish.run
```


## パブリッシュの設定

パブリッシュ機能は、 `config.php` 内に設定されています。

```
<?php print '<'.'?php'."\n"; ?>
return call_user_func( function(){

	// initialize
	$conf = new stdClass;

	/* 中略 */

	// funcs: Before content
	$conf->funcs->before_content = [

		// PX=publish
		'picklesFramework2\commands\publish::register('.json_encode(array(
			'paths_ignore'=> array(
				// パブリッシュ対象から常に除外するパスを設定する。
				// (ここに設定されたパスは、動的なプレビューは可能)
				'/sample_pages/no_publish/*'
			)
		)).')' ,

	];

```

コンフィグオプション `paths_ignore` には、配列でパブリッシュ対象外のパスを設定できます。 `$conf->paths_proc_type` で ignore 設定することと似ていますが、動的なプレビューはできるという点が異なります。

コマンドラインオプションの `paths_ignore` は、一時的に範囲を限定したい場合に利用しますが、コンフィグオプションの設定は常に適用されます。 配列で複数のパスを除外できます。 パスの指定にはワイルドカード `*` を使用できます。


## 生成されたファイルはどこに出力されるのか？

### 一時パブリッシュディレクトリ

パブリッシュしたファイルは、次の一時パブリッシュディレクトリに出力されます。

```nohighlight
./px-files/_sys/ram/publish/*
```

次のファイルが出力されます。

- publish_log.csv : 今回のパブリッシュで出力されたファイルの一覧です。
- alert_log.csv : パブリッシュでエラーが検出された場合に生成されます。
- htdocs/ : 今回のパブリッシュで出力されたHTMLやリソースファイル一式が格納されます。

### パブリッシュ先ディレクトリ

ここには、過去にパブリッシュされたファイルに、今回パブリッシュされたファイルを加えたサイト全体のパブリッシュファイルが置かれます。

このディレクトリは、`$conf->path_publish_dir` に設定した場所にあります。`$conf->path_publish_dir` を設定していない場合、一時パブリッシュディレクトリにのみ出力されます。


## Pickles 2 アプリケーション で、パブリッシュオプションのパターン登録を利用する

`$conf->plugins->px2dt->publish_patterns` に、パブリッシュの条件を設定すると、 Pickles 2 アプリケーション のパブリッシュ画面で、簡単にオプションを選択できるようになります。

下記は設定例です。

```php
<?='<'?>?php

/* (中略) */

$conf->plugins->px2dt->publish_patterns = array( // パブリッシュのパターンを登録
	array(
		'label'=>'デフォルト',
	),
	array(
		'label'=>'リソース類',
		'paths_region'=> array('/caches/','/common/'),
		'paths_ignore'=> array(),
		'keep_cache'=>true
	),
	array(
		'label'=>'すべて',
		'paths_region'=> array('/'),
		'paths_ignore'=> array(),
		'keep_cache'=>false
	),
	array(
		'label'=>'すべて(commonを除く)',
		'paths_region'=> array('/'),
		'paths_ignore'=> array('/common/'),
		'keep_cache'=>false
	),
);
```
