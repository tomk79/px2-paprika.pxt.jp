<?php
// chdir
chdir(__DIR__);

// autoload.php をロード
$tmp_path_autoload = __DIR__;
while(1){
    if( is_file( $tmp_path_autoload.'/vendor/autoload.php' ) ){
        require_once( $tmp_path_autoload.'/vendor/autoload.php' );
        break;
    }

    if( $tmp_path_autoload == dirname($tmp_path_autoload) ){
        // これ以上、上の階層がない。
        break;
    }
    $tmp_path_autoload = dirname($tmp_path_autoload);
    continue;
}
unset($tmp_path_autoload);

$paprika = new \tomk79\pickles2\paprikaFramework2\paprika(json_decode('{"file_default_permission":"775","dir_default_permission":"775","filesystem_encoding":"UTF-8","session_name":"PXSID","session_expire":1800,"directory_index":["index.html"],"realpath_controot":"./","realpath_controot_preview":"../htdocs/","realpath_homedir":"../htdocs/px-files/","path_controot":"/","realpath_files":"./config_paprika_files/","realpath_files_cache":"./caches/c/config_paprika_files/","realpath_files_private_cache":"../htdocs/px-files/_sys/ram/caches/c/config_paprika_files/"}'), false);

// 共通の prepend スクリプトを実行
if(is_file($paprika->env()->realpath_homedir.'paprika_prepend.php')){
    include($paprika->env()->realpath_homedir.'paprika_prepend.php');
}

// コンテンツが標準出力する場合があるので、それを拾う準備
ob_start();

// コンテンツを実行する
// クロージャーの中で実行
$execute_php_content = function()use($paprika){
?>
<?php
/**
 * config_paprika.php template
 */
return call_user_func( function(){

	// initialize

	/** コンフィグオブジェクト */
	$conf_paprika = new stdClass;

	/** database setting */
	$conf_paprika->database = new stdClass;
	$conf_paprika->database->dbms = 'sqlite';
	$conf_paprika->database->host = './px-files/_sys/ram/data/database.sqlite';
	$conf_paprika->database->port = null;
	$conf_paprika->database->dbname = null;
	$conf_paprika->database->username = null;
	$conf_paprika->database->password = null;

	/** Excellent DB Config */
	$conf_paprika->exdb = new stdClass;
	$conf_paprika->exdb->prefix = 'paprika';
	$conf_paprika->exdb->path_definition_file = './px-files/db/db.xlsx';
	$conf_paprika->exdb->path_cache_dir = './px-files/_sys/ram/caches/exdb/';
	@mkdir('./px-files/_sys/ram/caches/exdb/');

	return $conf_paprika;
} );
?><?php
};
$execute_php_content();
$content = ob_get_clean();
if(strlen($content)){
    $paprika->bowl()->put($content);
}
echo $paprika->bowl()->bind_template();
exit;
?>
