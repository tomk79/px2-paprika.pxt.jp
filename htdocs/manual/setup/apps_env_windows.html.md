Pickles 2 デスクトップアプリケーションが動作するために必要な、いくつかの外部のコマンドを、 Windows PC にインストールする方法についてご紹介します。

ここで紹介する方法は、手順の例であり、他のよりよい方法があるかも知れません。 また、内容が古くなっている可能性もあります。 詳しく、正確な情報は、それぞれ開発元のサイトを確認するようにしてください。


<!-- autoindex -->

## `php` コマンド

"ターミナル" (Windowsでは "コマンドプロンプト") を開いて、次のコマンドを実行してみてください。

```bash
$ php -v
```

次のようなバージョン情報が表示されれば、 `php` コマンドの準備はすでに整っています。(PHP 5.4 系以上が必要です)

```bash
PHP 5.5.38 (cli) (built: Oct 29 2017 20:49:07)
Copyright (c) 1997-2015 The PHP Group
Zend Engine v2.5.0, Copyright (c) 1998-2015 Zend Technologies
```

バージョン番号が確認できない場合は、インストールが必要です。

Windows にPHPをインストールする方法がいくつかあります。ここでは XAMPP、MAMP、公式のPHPを使った方法をご紹介します。

### XAMPP

<a href="https://www.apachefriends.org/jp/" target="_blank">XAMPP</a> は、お使いの Windows PC に Apache、PHP、MySQL の環境をインストーラーを使って簡単にインストールできます。この中に含まれるPHPが利用できます。

### MAMP

<a href="https://www.mamp.info/en/" target="_blank">MAMP</a> は、 XAMPP と同様、Apache、PHP、MySQL などの環境を簡単に構築してくれるツールです。

MAMP を使う場合、設定ファイルを一部書き換える必要があります。

- `php.ini-development` を複製し、 `php.ini` に改名します。
- `php.ini` の下記の記述の前にある `;` をそれぞれ削除し、コメントを解除します。
    - extension_dir = "ext"
    - extension=gd2
    - extension=mbstring
    - extension=openssl
    - extension=pdo_sqlite

### PHP公式

<a href="http://php.net/downloads.php" target="_blank">PHP公式サイトで配布されているPHP</a> を使う方法もあります。
Non Thread Safe 版を選択してください。
ZIPを解凍して任意のパスに設置して使用できます。

MAMP 同様、設定ファイルを一部書き換える必要があります。

- `php.ini-development` を複製し、 `php.ini` に改名します。
- `php.ini` の下記の記述の前にある `;` をそれぞれ削除し、コメントを解除します。
    - extension_dir = "ext"
    - extension=gd2
    - extension=mbstring
    - extension=openssl
    - extension=pdo_sqlite

### PHP 7系 を使用する場合の注意

PHP 7系を使う場合、対応するアーキテクチャ(32bit または 64bit)が合っていないと、 CSVファイルの読み込みが上手くいかない問題が生じるようです。 お使いのWindowsと合ったインストーラーを選択してください。または、 PHP 5系ではこの不具合が起きないようです。

### パスの通し方
XAMPPやMAMPをインストールしただけではパスが通りません。後述する Composer のインストールを行うと、自動的にパスを通してくれます。

手動でパスを通す場合は、コントロールパネルからパスを設定する方法があります。詳しくは Windows のマニュアルを参照してください。


## `composer` コマンド

"ターミナル" (Windowsでは "コマンドプロンプト") を開いて、次のコマンドを実行してみてください。

```bash
$ composer --version
```

次のようなバージョン情報が表示されれば、 `composer` コマンドの準備はすでに整っています。

```bash
Composer version 1.2.1 2016-09-12 11:27:19
```

バージョン番号が確認できない場合は、インストールが必要です。

<a href="https://getcomposer.org/download/" target="_blank">Composer の公式サイト</a>に、セットアップの手順が書かれていますので参照してください。

Windows 向けにはインストーラーが提供されているので簡単にインストールできます。

もし、PHPのパスが通されていない場合、 Composer インストーラーから使用するPHPコマンド `php.exe` のパスを選択するように促されます。ここで選択した `php.exe` は、自動的にパスが通されるようです。


## `git` コマンド

"ターミナル" (Windowsでは "コマンドプロンプト") を開いて、次のコマンドを実行してみてください。

```bash
$ git --version
```

次のようなバージョン情報が表示されれば、 `git` コマンドの準備はすでに整っています。

```bash
git version 2.6.2
```

バージョン番号が確認できない場合は、インストールが必要です。

Windows では、 <a href="https://gitforwindows.org/" target="_blank">msysGit (git for windows)</a> を使ってインストールできます。
