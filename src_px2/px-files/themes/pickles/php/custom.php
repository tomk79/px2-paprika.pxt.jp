<?php
/**
 * theme "pickles"
 */
namespace pickles2\themes\pickles;

/**
 * theme "pickles" class
 */
class theme_custom{
	private $px, $theme;

	/**
	 * constructor
	 */
	public function __construct($px, $theme){
		$this->px = $px;
		$this->theme = $theme;
	}

	/**
	 * OGタグを出力する。
	 */
	public function ogtags(){
		$url = 'http://'.$this->px->conf()->domain.$this->px->href( $this->px->req()->get_request_file_path() );
		$page_info = $this->px->site()->get_current_page_info();

		$rtn = '';
		$rtn .= '<meta property="og:site_name" content="'.htmlspecialchars( $this->px->conf()->name ).'" />'."\n";
		$rtn .= '<meta property="og:title" content="'.htmlspecialchars( (!strlen($page_info['id']) ? $this->px->conf()->name : $page_info['title_full']) ).'" />'."\n";
		$rtn .= '<meta property="og:type" content="blog" />'."\n";
		$rtn .= '<meta property="og:url" content="'.htmlspecialchars( $url ).'" />'."\n";
		$rtn .= '<meta property="og:image" content="http://pickles2.pxt.jp/common/images/og_image.png" />'."\n";

		// $rtn .= '<meta property="fb:admins" content="100001304756545" />'."\n";//←Facebookインサイトの認証タグ

		$rtn .= '<link rel="canonical" href="'.htmlspecialchars( $url ).'" />'."\n";

		$rtn .= '<link rel="icon" href="'.htmlspecialchars($this->px->href('/common/images/favicon.png')).'" type="image/png" />'."\n";
		$rtn .= ('<meta name="apple-mobile-web-app-capable" content="no" />');//←Mobile Safari 用。ホーム画面に登録したときに、アプリとして登録するか、ブックマークとして登録するかの選択。noだとブックマーク。
		$rtn .= ('<meta name="format-detection" content="telephone=no" />');//←Mobile Safari 用。勝手に電話番号としてリンクしたりとかしなくなる。
		$rtn .= ('<link rel="apple-touch-icon" href="'.htmlspecialchars($this->px->href('/common/images/apple-touch-icon.png')).'" />');//←iPhone用ホーム画面アイコン。
		return $rtn;
	}

	/**
	 * ブログの日付などを表示する
	 */
	public function mk_article_date($page_info = null){
		if(!$page_info){
			$page_info = $this->px->site()->get_current_page_info();
		}
		ob_start();
if( @strlen($page_info['release_date']) ){ ?>
<div>
	<p>公開日: <?= htmlspecialchars( @date('Y年m月d日(D)', strtotime($page_info['release_date'])) ); ?></p>
</div>
<?php }
		$rtn = ob_get_clean();
		return $rtn;
	}

}
