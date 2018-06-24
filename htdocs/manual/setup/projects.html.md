
Pickles 2 プロジェクトのセットアップ手順について説明します。

Pickles 2 のシステムは、デスクトップGUIアプリケーションである Pickles 2 アプリケーション と、 PHP製フレームワークの Pickles Framework 2 で構成されています。

プロジェクトは、 Pickles 2 アプリケーションのGUIから構築する方法の他に、 コマンドラインで手動で構築する方法もあります。

<!-- autoindex -->

## Pickles 2 プロジェクトを作成

### Pickles 2 アプリケーションからプロジェクトを作成

Pickles 2 アプリケーション を起動すると、はじめに表示されるのがダッシュボード画面です。初めて起動したときには、プロジェクトが登録されていません。ダッシュボードの右側にあるフォームから、新規プロジェクトを作成します。

- *Project Name* : プロジェクト名を入力してください。これは、ユーザー自身が識別するための論理名です。
- *Path* : プロジェクトは、ローカルディスク上の任意のパスを指定してください。
- *Home Directory*, *Entry Script* : それぞれ、 Path に指定した階層からの相対パスで入力します。特別なカスタマイズをしていない場合には、デフォルト値のままでOKです。

プロジェクトを作成すると、画面左の一覧に、作成されたプロジェクトが追加されます。プロジェクト名をクリックして、プロジェクトのホーム画面へ進みます。

プロジェクトのホーム画面では、 Pickles 2 のセットアップを促す画面が表示されます。画面の指示に従って進めると、指定したパスに Pickles 2 プロジェクトがセットアップされます。



### コマンドラインから手動でプロジェクトを作成

Pickles 2 プロジェクト は、Apache + PHP の環境で動作するアプリケーションの雛形で、Pickles 2 アプリケーション を使わなくても単体で使用することができます。

この章では、 Pickles 2 プロジェクトのセットアップ手順について説明します。





#### 事前準備：composer のインストール

composer のインストール方法について 詳しくは <a href="https://getcomposer.org/doc/00-intro.md" target="_blank">composerの公式サイト(英語)</a> を参照してください。

下記は公式サイトからの抜粋です。参考までに。

##### macOS

macOS の方は、次のコマンドでグローバルインストールできます。

```bash
$ curl -sS https://getcomposer.org/installer | php
$ mv composer.phar /usr/local/bin/composer
```


##### Windows

Windows の方は、GUIインストーラ `Composer-Setup.exe` が用意されています。 次のコマンドでもインストールできますので、お好みの方法でインストールしてください。

```bash
$ cd C:\bin
$ php -r "readfile('https://getcomposer.org/installer');" | php
```



#### Packagist から Pickles 2 プロジェクトをインストールする

Pickles 2 プロジェクトテンプレート は、`composer` コマンドを使用して Packagist からインストールすることができます。

`composer` コマンドのインストール方法については、<a href="#hash_事前準備：composer_のインストール">事前準備：composer のインストール</a> を御覧ください。


```bash
$ cd /path/to/your/documentRoot
$ composer create-project pickles2/preset-get-start-pickles2 ./
$ chmod -R 777 ./px-files/_sys
$ chmod -R 777 ./common/px_resources/
```

次のコマンドを実行して、バージョン番号が表示されれば成功です。

```bash
$ php .px_execute.php /?PX=api.get.version
"2.0.31"
```


#### Apache の設定

Pickles 2 プロジェクトを Apache + PHP の環境で動作させることができます。 一般的な LAMPP 環境で動作するはずです。

次のコードは Apache の設定例です。

```bash
Listen 8080
NameVirtualHost *:8080

<Directory "/path/to/your/documentRoot">
    AllowOverride All
    Order deny,allow
    Deny from all
    Allow from 127.0.0.1
    Allow from ::1
    AddType application/x-httpd-php .php
</Directory>
<VirtualHost *:8080>
    DocumentRoot "/path/to/your/documentRoot"
</VirtualHost>
```

### git リポジトリを作成する

git を使ってプロジェクトを世代管理する場合は、次の手順で gitリポジトリを初期化してください。

```bash
$ cd /path/to/your/documentRoot
$ git init
$ git add --all -v ./
$ git commit -m "initial commit"
```

#### .gitkeep がコミットされない場合

キャッシュを生成するディレクトリなど、`.gitkeep` が設置されています。Gitの除外設定によって、コミットできない場合は、`git commit` の前に次のコマンドを実行し、追加してください。

```bash
$ cd /path/to/your/documentRoot
$ git add -fv common/px_resources/.gitkeep
add 'common/px_resources/.gitkeep'
$ git add -fv px-files/_sys/ram/*/.gitkeep
add 'px-files/_sys/ram/applock/.gitkeep'
add 'px-files/_sys/ram/caches/.gitkeep'
add 'px-files/_sys/ram/data/.gitkeep'
add 'px-files/_sys/ram/publish/.gitkeep'
```



## composer のアップデート

composer は、 PHP のライブラリを管理するパッケージマネージャです。 しばらくすると、バグ修正などが反映された新しいバージョンのライブラリが公開されることがあります。

時々 `composer update` を実行して、ライブラリを最新バージョンに保つようにしてください。

次の方法でアップデートすることができます。

1. Pickles 2 アプリケーション を起動し、プロジェクトを選択します。
2. 次のいずれかの方法で、 `composer update` を実行してください
    1. 右上のハンバーガーメニューをクリック、上から5番目の「composer」を選択し「composer プロジェクト を更新する」ボタンをクリックします。
    2. 「基本的な手順」右下の「composer を操作する」をクリック、「composer プロジェクト を更新する」ボタンをクリックします。
    3. 「composer パッケージのいくつかに、新しいバージョンが見つかりました。いますつ更新することをお勧めします。」のメッセージが表示されている場合は、クリックして「composer プロジェクト を更新する」ボタンをクリックします。
3. しばらく待って、「composer update 完了しました」のメッセージが表示されればアップデート完了です。


## Pickles 2 プロジェクト のアンインストール

不要なプロジェクトを削除する場合は、 ディレクトリごと削除します。

Apache にバーチャルホストを設定した場合は、この設定も削除してください。
