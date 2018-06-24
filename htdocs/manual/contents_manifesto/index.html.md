Contents Manifesto は、コンテンツの制作環境を宣言します。
モジュールを定義する CSS や JavaScript ファイルを読み込みます。

このファイルを異なるテーマ間で共有することにより、テーマを取り替えても、コンテンツの表現を再現する前提を保証することができます。

<!--autoindex-->

## Contents Manifesto ファイルのパス

Contents Manifesto は、 `config.php` の設定 `$conf->contents_manifesto` に設定されたパスに格納してください。

デフォルトでは、 `/common/contents_manifesto.ignore.php` です。


## テーマへの組み込み

Contents Manifesto は、 `$px->get_contents_manifesto()` から取得できます。 テーマは、 headセクション内にこの値を出力して、Contents Manifesto を読み込んでください。

```
<!doctype html>
<html>
<head>
<?php print "<" ?>?php
    // ↓コンテンツの環境構築を読み込みます。
    print $px->get_contents_manifesto();
?>
</head>
<body>
<!-- 中略 -->
</body>
</html>
```

## Contents Manifesto 実装の注意事項

テーマは、コンテンツが `.contents` の中に置かれるように実装します。

従って、 Contents Manifesto で定義される CSS や JavaScript は、`.contents` の中にのみ影響するように実装されるべきです。

テーマを交換したとき、テーマの要素に影響を与え、崩してしまわないための配慮です。
