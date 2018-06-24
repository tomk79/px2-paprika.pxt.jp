

Pickles 2 には、プラグインを組み込む機能があります。

<!-- autoindex -->

## プラグインを利用する

プラグインは、次の手順で組み込みます。

1. `composer.json` の `require` にプラグインパッケージ情報を設定する
2. コマンド `$ composer update` を実行し、プラグインパッケージをインストールする
3. `px-files/config.php` の `$conf->funcs` にプラグインを設定する

### 1. composer.json に、パッケージ情報を設定する

<a href="https://packagist.org/" target="_blank">Packagist</a> に登録されているパッケージを利用する場合は、`require` にパッケージ名とバージョンを追加します。

```
{
    "require": {
        "pickles2/px2-sitemapexcel": "2.0.*"
    }
}
```

パッケージが <a href="https://packagist.org/" target="_blank">Packagist</a> に登録されていない場合、次のように、`repositories` にパッケージのURLを設定する必要があります。

```json
{
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/tomk79/px2-page-list-generator.git"
        }
    ],
    "require": {
        "tomk79/px2-page-list-generator": "dev-master"
    }
}
```

### 2. composer update を実行する

更新したパッケージ情報を反映します。

```bash
$ composer update
```


### 3. config.php を更新する

パッケージのインストールが成功したら、`px-files/config.php` に、プラグインを設定します。プラグインの設定方法やオプションは、プラグインによってそれぞれ異なります。詳しくはプラグインのドキュメントを参照してください。

次の記述例は、`config.php` の `$conf->funcs->before_sitemap` にプラグインを設定した例です。

```
<?php print '<' ?>?php
return call_user_func( function(){

	/* 中略 */

    // -------- functions --------

    $conf->funcs = new stdClass;

    // funcs: Before sitemap
    // サイトマップ読み込みの前に実行するプラグインを設定します。
    $conf->funcs->before_sitemap = [
        // PX=clearcache
        'picklesFramework2\commands\clearcache::register' ,

         // PX=config
        'picklesFramework2\commands\config::register' ,

         // PX=phpinfo
        'picklesFramework2\commands\phpinfo::register' ,

        // sitemapExcel
        'tomk79\pickles2\sitemap_excel\pickles_sitemap_excel::exec'

    ];

	/* 中略 */

	return $conf;
} );
```

### プラグインの種類と実行のタイミング

プラグインには次の種類があります。

- before_sitemap
- before_content
- processor
- before_output

`before_sitemap`、`before_content`、`before_output` は、Pickles2が処理するすべてのリクエストに対して適用されるプラグインです。

`processor` は、コンテンツの拡張子によって別々のプラグインを設定することができます。


Pickles 2 の処理は、おおまかに次の順で行われます。

1. 環境変数、入力パラメータ、コンフィグなどの解釈・調整
2. サイトマップCSVの読み込み
3. コンテンツを処理
4. 出力

この流れの、それぞれの間でプラグインを実行することができます。

1. 環境変数、入力パラメータ、コンフィグなどの解釈・調整
  - before_sitemap
2. サイトマップCSVの読み込み
  - before_content
3. コンテンツを処理
  - processor (拡張子ごとに別の処理を適用)
  - before_output
4. 出力

それぞれの実行タイミングに対して複数のプラグイン処理を配列で設定できます。 処理は、配列の先頭から順に実行されます。


### PXコマンドとテーマ

パラメータ `PX` で実行する<a href="../pxcommands/">PXコマンド</a>は、プラグインの1つとして組み込まれています。

次のサンプルのプラグインは、それぞれPXコマンドを登録するように実装されたものです。

```php
$conf->funcs->before_sitemap = [
    // PX=clearcache
    'picklesFramework2\commands\clearcache::register' ,

     // PX=config
    'picklesFramework2\commands\config::register' ,

     // PX=phpinfo
    'picklesFramework2\commands\phpinfo::register'

];
```

テーマも同様に、processorの1つとして実装されています。次のに示すコードで設定されているのが、 テーマを処理するプラグイン `pickles2/px2-multitheme` です。

```php
$conf->funcs->processor->html = [
    // テーマ
    'theme'=>'tomk79\pickles2\multitheme\theme::exec('.json_encode([
        'param_theme_switch'=>'THEME',
        'cookie_theme_switch'=>'THEME',
        'path_theme_collection'=>'./px-files/themes/',
        'attr_bowl_name_by'=>'data-contents-area',
        'default_theme_id'=>'pickles2'
]).')' ,
];
```


## プラグインを開発する

ここでは、マークダウンコンテンツを処理する processor を例に、プラグイン開発の基礎について、処理の流れを追って説明します。



### プラグインPHPのロード

プラグインを実装したPHPファイルのパスを `composer.json` の autoload に追記して、ロードするように設定します。

```json
{
    "autoload": {
        "files": [
            "px-files/_sys/php/myplugin.php"
        ]
    }
}
```

追記したら、composer update を実行してください。

<pre><code class="bash">$ composer update
</code></pre>

### 呼び出し側の設定

プラグインを導入する設定コードが次のサンプルです。

```php
// px-files/config.php
$conf->funcs->processor->md = [
    // Markdown文法を処理する
    'myidentity\myplugin\myclass::myfunction' ,

    // html の処理を追加
    $conf->funcs->processor->html ,
];
```

`$conf->funcs->processor->md` に設定された processor は、拡張子に `.md` が付加されたコンテンツ(例：`index.html.md` など)に対して有効です。このサンプルでは、マークダウン書式を処理した後に、HTMLに対する一般的な処理を追加するために、最後に `$conf->funcs->processor->html` を設定しています。

コンフィグに設定された、`myidentity\myplugin\myclass::myfunction` というメソッドが、プラグインとして呼ばれます。この設定には、名前領域とクラス名、メソッド名までが含まれた名前として与えてください。`static` に呼び出せる必要があります。

namespace名、クラス名、メソッド名は、制作するプラグインの機能や名前に応じて適宜付け替えてください。他のプラグインとたまたま同じ名前になってしまうとエラーの原因になりえます。namespaceの先頭に開発者の名前やID名などを含めておくとよいでしょう。

`myidentity\myplugin\myclass::myfunction({"JSON":"Value"})` のように、引数にJSONを与えることもできます。

### プラグイン側の処理

次のコードは、受け側のプラグインの実装です。

```
<?php print '<'; ?>?php
/**
 * processor "*.md"
 */
namespace myidentity\myplugin;

/**
 * processor "*.md" class
 */
class myclass{

	/**
	 * 変換処理の実行
	 * @param object $px Picklesオブジェクト
	 * @param object $json プラグイン設定
	 */
	public static function myfunction( $px, $json ){

		foreach( $px->bowl()->get_keys() as $key ){
			$src = $px->bowl()->get_clean( $key );

			$src = \Michelf\MarkdownExtra::defaultTransform($src);

			$px->bowl()->replace( $src, $key );
		}

		return true;
	}
}
```

処理の内容を見てみます。

```php
public static function myfunction( $px, $json ){

	/* 中略 */

	return true;
}
```

引数は、Pickles2のコアオブジェクト `$px` が渡されます。

この例では使用していませんが、第2引数 `$json` に、コンフィグに設定した JSON オブジェクトを受け取ることができます。

Pickles Framework は返却値を評価しません。このメソッドは、常に `true` を返して終了します。

### bowl とコンテンツの加工処理

コンテンツが生成したコードは、`$px->bowl()` オブジェクトに格納されています。

コンテンツコードはキーと値で構造化して管理されています。 `$px->bowl()->get_keys()` から、すべてのコンテンツのキーを取得しています。

```php
foreach( $px->bowl()->get_keys() as $key ){

	/* 中略 */

}
```

次に、コンテンツのキーを使って、bowl からコンテンツの入出力を行います。

`$px->bowl()->get_clean( $key )` でコンテンツコードを取り出し、`$px->bowl()->replace( $src, $key )` で格納しなおしています。

```php
foreach( $px->bowl()->get_keys() as $key ){
	$src = $px->bowl()->get_clean( $key );

	/* 中略 */

	$px->bowl()->replace( $src, $key );
}
```

取り出してすぐのコードを格納しなおしただけでは結果は変わりません。取り出したコード `$src` を加工しているのが次の部分です。

```php
$src = \Michelf\MarkdownExtra::defaultTransform($src);
```

この例は、マークダウン文法で書かれたコンテンツコードを受け取り、HTMLに変換して再格納しています(<a href="https://packagist.org/" target="_blank">Packagist</a>のパッケージ <a href="https://packagist.org/packages/michelf/php-markdown" target="_blank">michelf/php-markdown</a> を利用)。



## プラグインを公開する

開発したプラグインを公開すれば、`composer` を通じて誰でも利用できるようになります。

### どこに公開するのか？

composer が対応していればどこでも利用可能です。<a href="https://github.com/" target="_blank">Github</a>、<a href="https://bitbucket.org/" target="_blank">Bitbucket</a> などのVCSホスティングサービスが利用できます。詳しくは <a href="https://getcomposer.org/doc/05-repositories.md" target="_blank">composer のマニュアルを参照</a>してください。


### 公開するための設定

`composer.json` をリポジトリのルート階層に置き、次のように編集してください。

<dl>
<dt>name</dt><dd>リポジトリ名称を設定します。他のパッケージと重複しないようユニークな名前をつけてください。</dd>
<dt>autoload</dt><dd>パッケージを利用するために必要となるPHPファイルを設定します。ここに設定されたファイルは、composer の autoload.php により自動的に読み込まれます。</dd>
<dt>description, keywords, license, authors</dt><dd>必須ではありません。パッケージに関する各種の情報を記述します。</dd>
</dl>

### Packagist に登録

作成したパッケージは、PHPのパッケージ管理サービス <a href="https://packagist.org/" target="_blank">Packagist</a> に登録すると、簡単に呼び出せるようになります。

Packagistへの登録は必須ではありません。登録しない場合は、利用者側が `composer.json` の `repository` にリポジトリ情報を記載することで、利用することができます。


