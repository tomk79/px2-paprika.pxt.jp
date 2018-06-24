`broccoli-html-editor` によるGUI編集機能を利用するために必要な、 Pickles 2 プロジェクト の設定について説明します。


<!-- autoindex -->

## config.php の設定

- `$conf->funcs->before_content` に、プラグイン `pickles2/px2-px2dthelper` をロードします。
- `$conf->plugins->px2dt` に、Pickles 2 アプリケーション の設定をセットします。
  - `paths_module_template` : 連想配列で、モジュールセットのパスを設定します。
  - `path_module_templates_dir` : プロジェクト固有のモジュールセットを格納するディレクトリのパスを設定します。
  - `contents_area_selector` : コンテンツエリアであることを示すCSSセレクタを設定します。
  - `contents_bowl_name_by` : コンテンツエリアの名称が格納されている属性名を設定します。
  - `guieditor->path_resource_dir` : GUI編集で登録したリソースファイルを出力するディレクトリ。 `$conf->path_files` と同様の書式で設定します。
  - `guieditor->path_data_dir` : GUI編集でデータファイルを格納するディレクトリ。 `$conf->path_files` と同様の書式で設定します。
  - `guieditor->custom_fields` : GUI編集に組み込むモジュールに独自のフィールド定義を追加します。
- `$conf->funcs->processor->html` に プラグイン `pickles2/px2-remove-attr` を設定します。
  - パブリッシュ時に `contents_bowl_name_by` に設定した属性を削除するように設定します。


以下に設定例を示します。

```
<?='<'?>?php
/**
 * config.php template
 */
return call_user_func( function(){

	// initialize

	/** コンフィグオブジェクト */
	$conf = new stdClass;

	// (中略)

	/**
	 * funcs: Before content
	 *
	 * サイトマップ読み込みの後、コンテンツ実行の前に実行するプラグインを設定します。
	 */
	$conf->funcs->before_content = array(

		// (中略)

		// PX=px2dthelper
		'tomk79\pickles2\px2dthelper\main::register'

		// (中略)

	);

	// (中略)

	$conf->funcs->processor->html = array(

		// 属性 data-contents-area を削除する
		'tomk79\pickles2\remove_attr\main::exec('.json_encode(array(
			"attrs"=>array(
				'data-contents-area',
			) ,
		)).')' ,

	);

	// (中略)

	// -------- config for Plugins. --------
	// その他のプラグインに対する設定を行います。
	$conf->plugins = new stdClass;

	/** config for Pickles 2 Desktop Tool. */
	$conf->plugins->px2dt = new stdClass;

	/** broccoliモジュールセットの登録 */
	$conf->plugins->px2dt->paths_module_template = [
		"PlainHTMLElements" => "./vendor/pickles2/broccoli-module-plain-html-elements/modules/",
		"FESS" => "./vendor/pickles2/broccoli-module-fess/modules/"
	];

	/** プロジェクト固有のbroccoliモジュールディレクトリ */
	$conf->plugins->px2dt->path_module_templates_dir = "./px-files/modules/";

	/** コンテンツエリアを識別するセレクタ(複数の要素がマッチしてもよい) */
	$conf->plugins->px2dt->contents_area_selector = '[data-contents-area]';

	/** コンテンツエリアのbowl名を指定する属性名 */
	$conf->plugins->px2dt->contents_bowl_name_by = 'data-contents-area';


	/** config for GUI Editor. */
	$conf->plugins->px2dt->guieditor = new stdClass;

	/** GUI編集データディレクトリ */
	$conf->plugins->px2dt->guieditor->path_data_dir = '{$dirname}/{$filename}_files/guieditor.ignore/';

	/** GUI編集リソース出力先ディレクトリ */
	$conf->plugins->px2dt->guieditor->path_resource_dir = '{$dirname}/{$filename}_files/resources/';

	/** broccoli-html-editor のフィールド拡張 */
	$conf->plugins->px2dt->guieditor->custom_fields = array(
		'projectCustom1'=>array(
			'backend'=>array(
				'require' => './px-files/broccoli-fields/projectCustom1/backend.js'
			),
			'frontend'=>array(
				'file' => './px-files/broccoli-fields/projectCustom1/frontend.js',
				'function' => 'window.broccoliFieldProjectCustom1'
			),
		),
		'projectCustom2'=>array(
			'backend'=>array(
				'require' => './px-files/broccoli-fields/projectCustom2/backend.js'
			),
			'frontend'=>array(
				'file' => './px-files/broccoli-fields/projectCustom2/frontend.js',
				'function' => 'window.broccoliFieldProjectCustom2'
			),
		),
	);

	return $conf;
} );

```

## テーマの実装

- コンテンツエリアを囲うラッパーが、 `$conf->plugins->px2dt->contents_area_selector` で設定したCSSセレクタでマッチするように実装します。
  - `[data-contents-area]` と設定した場合、 属性 `data-contents-area` を付与します。
- コンテンツエリアを囲うラッパーに、 `$conf->plugins->px2dt->contents_bowl_name_by` に設定した属性名を与え、bowl名をセットします。
  - `data-contents-area` と設定した場合、 `data-contents-area="(bowl名)"` のようにします。


`$theme->get_attr_bowl_name_by()` は、 `$conf->plugins->px2dt->contents_bowl_name_by` の値を取得するメソッドです。

これを用いた実装例は下記の通りです。

```
<!DOCTYPE html>
<html>
	<head>
		<!-- 中略 -->

<!-- head は通常通り -->
<?='<'?>?= $px->bowl()->pull('head') ?>
	</head>
	<body>

		<!-- 中略 -->

		<!-- メインコンテンツ -->
		<div class="contents" <?='<'?>?= htmlspecialchars($theme->get_attr_bowl_name_by())?>="main">
<?='<'?>?= $px->bowl()->pull() ?>
		</div>


		<!-- カスタムコンテンツエリアを設ける場合 -->
		<div class="contents" <?='<'?>?= htmlspecialchars($theme->get_attr_bowl_name_by())?>="custom_bowl_name">
<?='<'?>?= $px->bowl()->pull('custom_bowl_name') ?>
		</div>


		<!-- 中略 -->

<!-- foot は通常通り -->
<?='<'?>?= $px->bowl()->pull('foot') ?>
	</body>
</html>
```
