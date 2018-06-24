Pickles 2 アプリケーション設定は、デスクトップアプリケーションの動作全体にかかる設定項目が含まれます。サーバー内部のコマンドのパスや、外部アプリケーションの設定、プレビュー用サーバーの設定などが含まれます。

<!-- autoindex -->


## 設定画面の開き方

- Pickles 2 アプリケーションを起動します。
- 画面右上のハンバーガーメニューをクリックします。
- "Pickles 2 アプリケーション設定" をクリックします。

## 設定項目

### 言語 - Language

アプリケーションUIの自然言語を設定します。

### コマンドのパス - Command Path

デスクトップアプリケーションが内部的にコールするコマンドのパスを設定します。

`php` と `git` のコマンドを設定できます。

### ネットワーク - Network

アプリケーション内に内蔵されているプレビュー用のサーバーなどについて設定します。

プレビュー用サーバーとアプリケーション・サーバーの2種類のサーバーについて設定します。

- プレビュー用ポート番号 : プレビュー用サーバーのポート番号を設定します。
- アプリケーション・サーバー用ポート番号 : アプリケーション・サーバーのポート番号を設定します。
- プレビューサーバーのアクセス制限 : デフォルトの状態では、 "ネットワークからのアクセスを拒否 (127.0.0.1 のみ許可)" が選択されており、自分のローカルPCからのみアクセスできるように制限されます。 "制限しない" を選択すると、接続元の制限を行いません。この場合、同じローカルネットワークに属する他のPCやスマートフォンなどから、プレビューサーバーを閲覧できるようになります。

### アプリケーション - Application

Pickles 2 アプリケーションから接続する外部のアプリケーションについて設定します。

- 外部テキストエディタ : コンテンツ等を外部のテキストエディタから開く場合に呼び出すアプリケーションのパスを設定します。
- 外部テキストエディタ(ディレクトリを開く) : 同じく外部のテキストエディタのパスを設定しますが、こちらの設定は、ディレクトリを開く場合に参照されます。テキストエディタの種類によっては、ディレクトリを開けない場合があるため、別に設定項目が設けられました。