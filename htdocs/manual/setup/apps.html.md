


<!-- autoindex -->

## Pickles 2 アプリケーションをインストールする

Pickles 2 のデスクトップアプリケーションをインストールする手順を説明します。

Pickles 2 アプリケーションは、 外部コマンド `php`、 `composer`、 `git` を使用します。予め、これらのコマンドのパスを通してください。各コマンドのインストール方法やパスの通し方について知りたい方は[参考: 周辺環境のセットアップ方法](apps_env.html)が助けになるかも知れません。


### 1. ダウンロードする

<a href="https://github.com/pickles2/app-pickles2/releases/tag/<?= h($px->conf()->project->px2dt_latestversion); ?>" target="_blank">Pickles 2 ダウンロードページ</a> からダウンロードできます。

<ul>
<li><a href="https://github.com/pickles2/app-pickles2/releases/download/<?= h($px->conf()->project->px2dt_latestversion); ?>/Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-osx64.zip">Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-osx64.zip</a></li>
<li><a href="https://github.com/pickles2/app-pickles2/releases/download/<?= h($px->conf()->project->px2dt_latestversion); ?>/Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-win32.zip">Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-win32.zip</a></li>
<li><a href="https://github.com/pickles2/app-pickles2/releases/download/<?= h($px->conf()->project->px2dt_latestversion); ?>/Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-linux64.zip">Pickles2-<?= h($px->conf()->project->px2dt_latestversion); ?>-linux64.zip</a></li>
</ul>

### 2. インストールする

Pickles 2 は、macOS 版、Windows版、Linux版 の3種類のビルドが提供されています。それぞれについてインストールの手順を説明します。

#### macOS 版

1. Pickles 2 アプリケーションをインストールします。
  - ZIPを解凍します。
  - 解凍されたフォルダの中にある `Pickles2.app` を、アプリケーションフォルダ(`/Applications`) にドラッグします。
2. Pickles 2 アプリケーションを起動します。
  - `Pickles2.app` をダブルクリックして実行します。
  - 初めて起動するときには、セキュリティブロックを受けます。
  - Ctrlを押しながらアイコンクリックし、コンテキストメニューから「開く」を選択すると、個別に許可して起動することができます。

#### Windows 版

1. Pickles 2 アプリケーションをインストールします。
  - ZIPを解凍して、任意の場所に置きます。
2. Pickles 2 アプリケーションを起動します。
  - `Pickles2.exe` をダブルクリックして実行します。

#### Linux 版

1. Pickles 2 アプリケーションをインストールします。
  - ZIPを解凍して、任意の場所に置きます。
2. Pickles 2 アプリケーションを起動します。
  - `Pickles2` をダブルクリックして実行します。


## アップデートの手順

すでに Pickles 2 アプリケーションがインストールされていて、新しいバージョンに更新する場合は、アプリケーションファイルを上書きしてください。

外部コマンドなど周辺環境の再インストールは必要ありません。

### Pickles 2 Desktop Tool 2.0.0-beta.16 以前から Pickles 2 2.0.0-beta.17 への更新

Pickles 2 2.0.0-beta.17 以降、 アプリケーションの名称が Pickles 2 Desktop Tool から Pickles 2 に変更されました。 この変更に伴い、アプリケーションの実行ファイル名も `Pickles2DesktopTool.app` から `Pickles2.app`  に (Windowsでは `.app` ではなく `.exe`) 変更されています。

beta.16 以前のバージョンをご利用の場合、古いバージョンのアプリケーションは削除し、 新しいバージョンのファイルと置き換えてください。


## アンインストールの手順

### Pickles 2 アプリケーション の削除

アプリケーションのフォルダごと削除します。

次に、設定フォルダが作成されているので、これも削除します。

設定フォルダのパスは、OSによって異なります。 macOS では、 `/Users/{$ユーザー名}/.pickles2desktoptool` 、Windows では `C:\Users\{$ユーザー名}\AppData\Local\.pickles2desktoptool` にあります。

### Pickles 2 プロジェクト の削除

Pickles 2 アプリケーションを削除しても、プロジェクトのデータは削除されません。

削除する場合は、 [Pickles 2 プロジェクトのセットアップ](projects.html) のページにある削除方法を参照し、個別に削除してください。