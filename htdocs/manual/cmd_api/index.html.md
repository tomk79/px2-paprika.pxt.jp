

Pickles2 の内部のデータにアクセスすることができるAPIについて説明します。


<!-- autoindex -->


## CLIのAPI

PXコマンドの `PX=api.get.*`, `PX=api.is.*` は、Pickles2 の内部の情報にアクセスできるAPIです。

コンフィグ情報を取得する(`PX=api.get.config`)、サイトマップ情報を取得する(`PX=api.get.sitemap`) 、その他のAPIが用意されています。

その他のAPIについては下記を参照してください。

- <a href="../../phpdoc/classes/picklesFramework2.commands.api.html#method_api_get" target="_blank">PX=api.get.*</a>
- <a href="../../phpdoc/classes/picklesFramework2.commands.api.html#method_api_is" target="_blank">PX=api.is.*</a>


## Node.js からアクセスする

Node.js 向けに、npmパッケージ <a href="https://www.npmjs.com/package/px2agent" target="_blank">px2agent</a> が提供されています。

