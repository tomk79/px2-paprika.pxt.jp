"Paprika Framework Official Website" Source
=========

これは、 Paprika Framework の 公式情報サイト [Paprika Framework](https://px2-paprika.pxt.jp/) のサイトデータです。
Pickles 2 を使って編集されています。

## セットアップ手順 - Setup

### gitリポジトリをclone

```
$ mkdir /path/to/your/project
$ cd /path/to/your/project
$ git clone https://github.com/tomk79/px2-paprika.pxt.jp.git
```

### Pickles 2 Desktop Tool でプロジェクトを作成

次のように入力します。

- Path = cloneしたディレクトリ
- HOME Directory = htdocs/px-files/
- Entry Script = htdocs/.px_execute.php

### composer update を実行

```
$ composer update
```


## ディレクトリ構成

- `src_px2/` に、Pickles 2 のコンテンツデータが格納されています。
  - このデータはソースデータなので、ウェブ上に直接公開されるものではありません。
- パブリッシュデータは、 `dist/` に出力されます。
  - これをウェブサーバーに設置し、公開します。
  - `/?PX=publish.run` を実行してパブリッシュを行い、公開データを生成します。
  - パブリッシュコマンドの扱い方については [パブリッシュ | Pickles 2](https://pickles2.pxt.jp/manual/publish/) を参照してください。


## 作者 - Author

- Tomoya Koyanagi <tomk79@gmail.com>
- website: <https://www.pxt.jp/>
- Twitter: @tomk79 <https://twitter.com/tomk79/>
