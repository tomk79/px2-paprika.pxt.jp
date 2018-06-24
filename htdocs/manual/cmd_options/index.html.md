

<!-- autoindex -->


## コマンドから実行する基本

```nohighlight
$ php ./.px_execute.php [-o type] [-u userAgent] [--command-php /path/to/php] [-c /path/to/php.ini] [path]
```

## コマンドラインオプション一覧

<dl>
	<dt>-o</dt>
		<dd>出力形式。<code>-o json</code> でJSON形式の出力を受けられる。</dd>

	<dt>-u</dt>
		<dd>HTTP_USER_AGENT。<code>-u &quot;Mozilla/5.0&quot;</code> で USER_AGENT を偽装することができる。 USER_AGENTが空白の場合、または文字列 <code>PicklesCrawler</code> を含む場合に、パブリッシュツールからのアクセスであるとみなされる。</dd>

	<dt>--command-php</dt>
		<dd>PHPコマンドのパスを指定する。主にパブリッシュ時に参照され、サブプロセスの実行に使用される。</dd>

	<dt>-c</dt>
		<dd>Pickles2 が発行する <code>php</code> コマンド(<code>$conf->commands->php</code> に設定) に対して与える <code>php.ini</code> のパスを指定する。主にパブリッシュ時に参照され、サブプロセスの実行に使用される。</dd>

</dl>


## 実行例

### /abc/def.html を Mozilla/5.0 として処理し、JSON形式で取得する

```nohighlight
$ php ./.px_execute.php -o json -u "Mozilla/5.0" /abc/def.html
```

### /abc/def.html をパブリッシュした結果を、JSON形式で取得する

```nohighlight
$ php ./.px_execute.php -o json -u "PicklesCrawler" /abc/def.html
```

### パブリッシュコマンドを実行する (PXコマンド)

```nohighlight
$ php ./.px_execute.php /?PX=publish.run
```

### Pickles 2 の内部キャッシュを削除する (PXコマンド)

```nohighlight
$ php ./.px_execute.php /?PX=clearcache
```




