テーブル要素を作成します。

これは、実験中のフィールドです。

Excel形式 や CSV形式 で作成したファイルをGUI上から登録すると、そのファイルの内容をもとにHTMLを自動生成します。

## モジュール実装例

```html
<table class="def">{&{"input":{
    "type": "table",
    "name": "table-field",
    "label": "基本テーブル"
}}&}</table>
```

## データ型

```json
{
    "resKey": "(リソースキー)",
    "output": "<tr><td>レンダリングされたHTMLタグ</td></tr>",
    "header_row": 0,
    "header_col": 0,
    "cell_renderer": "text",
    "renderer": "simplify"
}
```

table フィールドは resourceMgr にExcelファイルのリソースを１つ登録します。 resourceMgr が発行したリソースのキーが `resKey` に格納されます。

`cell_renderer` には、次のいずれかの値が入ります。

<dl>
    <dt>html</dt>
        <dd>セルの表現方法 で HTML を選択する場合の値です。</dd>
    <dt>text</dt>
        <dd>セルの表現方法 で テキスト を選択する場合の値です。</dd>
    <dt>markdown</dt>
        <dd>セルの表現方法 で Markdown を選択する場合の値です。</dd>
</dl>

`renderer` には、次のいずれかの値が入ります。

<dl>
    <dt>simplify</dt>
        <dd>再現方法 で 単純化 を選択する場合の値です。</dd>
    <dt>strict</dt>
        <dd>再現方法 で そのまま表示 を選択する場合の値です。</dd>
</dl>
