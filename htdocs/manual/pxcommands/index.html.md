

PXコマンドは、Pickles Framework の独自の機能を提供するインターフェイスです。Pickles FrameworkやPHPの設定を確認する、ページやコンテンツの情報を確認するといった情報サービスや、キャッシュのクリア、パブリッシュなどの機能もこれに含まれます。


<!-- autoindex -->



## 実行方法

PXコマンドは、コマンドラインで実行します。

```nohighlight
$ php ./.px_execute.php /?PX=phpinfo
```


`$conf->allow_pxcommands` が有効な場合、URLにGETパラメータ `?PX={$PXコマンド名}` を付加して起動することもできます。

```nohighlight
http://your.domain.com/?PX=phpinfo
```


## PXコマンド一覧

予め組み込まれたPXコマンドには次の種類があります。

<dl>
	<dt>api</dt>
	<dd>外部のアプリケーションと通信するためのAPIを提供します。より詳しい情報は、<?= $px->mk_link('../cmd_api/'); ?>を参照してください。</dd>
	<dt>clearcache</dt>
		<dd>Pickles Framework が作成するキャッシュファイルをクリアします。より詳しい情報は、<?= $px->mk_link('../cmd_clearcache/'); ?>を参照してください。</dd>
	<dt>config</dt>
		<dd>Pickles Framework のコンフィグ内容を確認します。</dd>
	<dt>phpinfo</dt>
		<dd>phpinfo() を実行し、PHPの設定情報を確認します。</dd>
	<dt>publish</dt>
		<dd>静的なファイルを出力します。詳しくは <a href="../publish/">パブリッシュ</a> を参照してください。</dd>
</dl>


## PXコマンドの拡張

PXコマンドは、プラグインによって拡張することができます。

プラグインの導入、開発、公開の方法については、<?= $px->mk_link('../plugins/'); ?> を参照してください。


## PXコマンドのアクセス制御

PXコマンドは、Pickles 2 を便利に使うためのさまざまな機能を提供します(例：パブリッシュ機能 `?PX=publish`)。 PXコマンドはサーバー内部の情報にアクセスしたり、サーバー上のデータを書き換えるインターフェイスを提供する場合があるため、*第3者にアクセスされると大変キケン*です。

Pickles 2 をインターネット上のサーバーで動かす場合には、次のことに注意してください。

<ul>
<li>ウェブ制作環境として利用する場合、利用基本認証やIP制限などの処理を施し、一般のユーザーがアクセスできない場所に設置してください。</li>
<li>または、Pickles 2 上に構築したウェブアプリケーションをサービスとして公開する場合、設定ファイル (<code>px-files/config.php</code>) の <code>$conf->allow_pxcommands</code> の値を <code>0</code> に設定し、PXコマンド機能を無効にしてください。(この場合でも、CLIからの実行は許可されます)
<pre><code class="nohighlight">$conf->allow_pxcommands = 0; // PX Commands の実行を許可</code></pre></li>
</ul>
