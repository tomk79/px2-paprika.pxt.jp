<?php
return call_user_func( function(){

	// initialize
	$conf = new stdClass;

	// project
	$conf->name = 'Paprika Framework'; // サイト名
	$conf->domain ='px2-paprika.pxt.jp'; // ドメイン
	$conf->path_controot = '/'; // コンテンツルートディレクトリ

	// paths
	$conf->path_top = '/'; // トップページのパス(デフォルト "/")
	$conf->path_publish_dir = '../dist/'; // パブリッシュ先ディレクトリパス
	$conf->public_cache_dir = '/caches/'; // 公開キャッシュディレクトリ
	$conf->path_files = '{$dirname}/{$filename}_files/'; // リソースディレクトリ(各コンテンツに対して1:1で関連付けられる)のパス
	$conf->contents_manifesto = '/common/contents_manifesto.ignore.php'; // Contents Manifesto のパス

	// directory index
	$conf->directory_index = array(
		'index.html'
	);


	// system
	$conf->file_default_permission = '775';
	$conf->dir_default_permission = '775';
	$conf->filesystem_encoding = 'UTF-8';
	$conf->output_encoding = 'UTF-8';
	$conf->output_eol_coding = 'lf';
	$conf->session_name = 'PXSID';
	$conf->session_expire = 1800;
	$conf->allow_pxcommands = 1; // PX Commands のウェブインターフェイスからの実行を許可
	$conf->default_timezone = 'Asia/Tokyo';

	// commands
	$conf->commands = new stdClass;
	$conf->commands->php = 'php';

	// processor
	$conf->paths_proc_type = array(
		// パスのパターン別に処理方法を設定
		//     - ignore = 対象外パス
		//     - direct = 加工せずそのまま出力する(デフォルト)
		//     - その他 = extension 名
		// パターンは先頭から検索され、はじめにマッチした設定を採用する。
		// ワイルドカードとして "*"(アスタリスク) を使用可。
		'/.htaccess' => 'ignore' ,
		'/.px_execute.php' => 'ignore' ,
		'/px-files/*' => 'ignore' ,
		'*.ignore/*' => 'ignore' ,
		'*.ignore.*' => 'ignore' ,
		'/composer.json' => 'ignore' ,
		'/composer.lock' => 'ignore' ,
		'/README.md' => 'ignore' ,
		'/vendor/*' => 'ignore' ,
		'*/.DS_Store' => 'ignore' ,
		'*/Thumbs.db' => 'ignore' ,
		'*/.svn/*' => 'ignore' ,
		'*/.git/*' => 'ignore' ,
		'*/.gitignore' => 'ignore' ,

		'/phpdoc/*' => 'pass' ,

		'*.php' => 'php' , // <- for Paprika
		'*.php/*' => 'php' , // <- for Paprika

		'*.html' => 'html' ,
		'*.htm' => 'html' ,
		'*.css' => 'css' ,
		'*.js' => 'js' ,
		'*.png' => 'pass' ,
		'*.jpg' => 'pass' ,
		'*.gif' => 'pass' ,
		'*.svg' => 'pass' ,
	);


	/**
	 * paths_enable_sitemap
	 *
	 * サイトマップのロードを有効にするパスのパターンを設定します。
	 * ワイルドカードとして "*"(アスタリスク) が使用可能です。
	 *
	 * サイトマップ中のページ数が増えると、サイトマップのロード自体に時間を要する場合があります。
	 * サイトマップへのアクセスが必要ないファイルでは、この処理はスキップするほうがよいでしょう。
	 *
	 * 多くの場合では、 *.html と *.htm 以外ではロードする必要はありません。
	 */
	$conf->paths_enable_sitemap = array(
		'*.html',
		'*.htm',
	);


	// -------- functions --------

	$conf->funcs = new stdClass;

	// funcs: Before sitemap
	$conf->funcs->before_sitemap = [
		// PX=clearcache
		'picklesFramework2\commands\clearcache::register' ,

		 // PX=config
		'picklesFramework2\commands\config::register' ,

		 // PX=phpinfo
		'picklesFramework2\commands\phpinfo::register' ,

		// sitemapExcel
		'tomk79\pickles2\sitemap_excel\pickles_sitemap_excel::exec' ,

	];

	// funcs: Before content
	$conf->funcs->before_content = [
		// PX=api
		'picklesFramework2\commands\api::register' ,

		// PX=publish
		'picklesFramework2\commands\publish::register' ,

		// PX=px2dthelper
		'tomk79\pickles2\px2dthelper\main::register' ,

		// Paprika - PHPアプリケーションフレームワーク
		'tomk79\pickles2\paprikaFramework2\main::before_content('.json_encode( array(
			// アプリケーションが動的に生成したコンテンツエリアの名称
			'bowls'=>array('custom_area_1', 'custom_area_2', ),

			// Paprika を適用する拡張子の一覧
			'exts' => array('php'),
		) ).')' ,
	];


	// processor
	$conf->funcs->processor = new stdClass;

	require_once(__DIR__.'/_sys/php/webfont.php');
	$conf->funcs->processor->html = [
		// ページ内目次を自動生成する
		'picklesFramework2\processors\autoindex\autoindex::exec' ,

		// // テーマ
		// 'theme'=>'pickles2\themes\pickles\theme::exec' ,

		// テーマ
		'theme'=>'tomk79\pickles2\multitheme\theme::exec('.json_encode([
			'param_theme_switch'=>'THEME',
			'cookie_theme_switch'=>'THEME',
			'path_theme_collection'=>'./px-files/themes/',
			'attr_bowl_name_by'=>'data-contents-area',
			'default_theme_id'=>'pickles'
		]).')' ,

		// Apache互換のSSIの記述を解決する
		'picklesFramework2\processors\ssi\ssi::exec' ,

		// 属性 data-contents-area を削除する
		'tomk79\pickles2\remove_attr\main::exec('.json_encode(array(
			"attrs"=>array(
				'data-contents-area',
			) ,
		)).')' ,

		// WebFontを適用する
		// 'jp\pxt\pickles2\webfont::exec' ,

		// broccoli-receive-message スクリプトを挿入
		// (Optional)
		'tomk79\pickles2\px2dthelper\broccoli_receive_message::apply('.json_encode( array(
			// 許可する接続元を指定
			'enabled_origin'=>array(
			)
		) ).')',

		// output_encoding, output_eol_coding の設定に従ってエンコード変換する。
		'picklesFramework2\processors\encodingconverter\encodingconverter::exec' ,
	];

	$conf->funcs->processor->php = array(
		// Paprika - PHPアプリケーションフレームワーク
		'tomk79\pickles2\paprikaFramework2\main::processor' ,

		// for Paprika
		// html のデフォルトの処理を追加
		$conf->funcs->processor->html ,
	);

	$conf->funcs->processor->css = [
		// output_encoding, output_eol_coding の設定に従ってエンコード変換する。
		'picklesFramework2\processors\encodingconverter\encodingconverter::exec' ,
	];

	$conf->funcs->processor->js = [
		// output_encoding, output_eol_coding の設定に従ってエンコード変換する。
		'picklesFramework2\processors\encodingconverter\encodingconverter::exec' ,
	];

	$conf->funcs->processor->md = [
		// Markdown文法を処理する
		'picklesFramework2\processors\md\ext::exec' ,

		// html の処理を追加
		$conf->funcs->processor->html ,
	];

	$conf->funcs->processor->scss = [
		// SCSS文法を処理する
		'picklesFramework2\processors\scss\ext::exec' ,

		// css の処理を追加
		$conf->funcs->processor->css ,
	];


	// funcs: Before output
	$conf->funcs->before_output = [
		// px2-path-resolver - 相対パス・絶対パスを変換して出力する
		//   options
		//     string 'to':
		//       - relate: 相対パスへ変換
		//       - absolute: 絶対パスへ変換
		//       - pass: 変換を行わない(default)
		//     bool 'supply_index_filename':
		//       - true: 省略されたindexファイル名を補う
		//       - false: 省略できるindexファイル名を削除
		//       - null: そのまま (default)
		'tomk79\pickles2\pathResolver\main::exec('.json_encode(array(
			'to' => 'relate' ,
			'supply_index_filename' => false
		)).')' ,

	];



	// config for Plugins.
	$conf->plugins = new stdClass;

	// config for Pickles2 Desktop Tool.
	$conf->plugins->px2dt = new stdClass;
	$conf->plugins->px2dt->paths_module_template = [
		"PlainHTMLElements" => "../vendor/broccoli-html-editor/broccoli-module-plain-html-elements/modules/",
		"FESS" => "../vendor/broccoli-html-editor/broccoli-module-fess/modules/"
	];

	$conf->plugins->px2dt->contents_area_selector = '[data-contents-area]';//←コンテンツエリアを識別するセレクタ(複数の要素がマッチしてもよい)
	$conf->plugins->px2dt->contents_bowl_name_by = 'data-contents-area';//←コンテンツエリアのbowl名を指定する属性名

	/** パブリッシュのパターンを登録 */
    $conf->plugins->px2dt->publish_patterns = array(
        array(
            'label'=>'すべて',
            'paths_region'=> array('/'),
            'paths_ignore'=> array(),
            'keep_cache'=>false
        ),
        array(
            'label'=>'マニュアル',
            'paths_region'=> array('/manual/'),
            'paths_ignore'=> array(),
            'keep_cache'=>true
        ),
    );


	// config for this Project.
	$conf->project = new stdClass;
	$conf->project->px2dt_latestversion = '2.0.0-beta.19';



	// -------- PHP Setting --------

	/**
	 * `memory_limit`
	 *
	 * PHPのメモリの使用量の上限を設定します。
	 * 正の整数値で上限値(byte)を与えます。
	 *
	 *     例: 1000000 (1,000,000 bytes)
	 *     例: "128K" (128 kilo bytes)
	 *     例: "128M" (128 mega bytes)
	 *
	 * -1 を与えた場合、無限(システムリソースの上限まで)に設定されます。
	 * サイトマップやコンテンツなどで、容量の大きなデータを扱う場合に調整してください。
	 */
	@ini_set( 'memory_limit' , -1 );

	/**
	 * `display_errors`, `error_reporting`
	 *
	 * エラーを標準出力するための設定です。
	 *
	 * PHPの設定によっては、エラーが発生しても表示されない場合があります。
	 * もしも、「なんか挙動がおかしいな？」と感じたら、
	 * 必要に応じてこれらのコメントを外し、エラー出力を有効にしてみてください。
	 *
	 * エラーメッセージは問題解決の助けになります。
	 */
	@ini_set('display_errors', 1);
	@ini_set('error_reporting', E_ALL);


	return $conf;
} );
