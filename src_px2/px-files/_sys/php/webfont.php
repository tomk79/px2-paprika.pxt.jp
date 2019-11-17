<?php
/**
 * Apply WebFont
 */
namespace jp\pxt\pickles2;

/**
 * Apply WebFont
 */
class webfont{
	/**
	 * 変換処理の実行
	 * @param object $px Picklesオブジェクト
	 */
	public static function exec( $px, $json ){
		// require_once( __DIR__.'/simple_html_dom.php' );

		// foreach( $px->bowl()->get_keys() as $key ){
		// 	$src = $px->bowl()->pull( $key );

		// 	// data-dec-blockブロックを削除
		// 	$html = str_get_html(
		// 		$src ,
		// 		true, // $lowercase
		// 		true, // $forceTagsClosed
		// 		DEFAULT_TARGET_CHARSET, // $target_charset
		// 		false, // $stripRN
		// 		DEFAULT_BR_TEXT, // $defaultBRText
		// 		DEFAULT_SPAN_TEXT // $defaultSpanText
		// 	);
		// 	$ret = $html->find('h1,h2,h3,h4,h5,h6');
		// 	foreach( $ret as $retRow ){
		// 		$retRow->class = 'tk-ryo-gothic-plusn';
		// 	}
		// 	$src = $html->outertext;

		// 	$px->bowl()->replace( $src, $key );
		// }

		return true;
	}
}
