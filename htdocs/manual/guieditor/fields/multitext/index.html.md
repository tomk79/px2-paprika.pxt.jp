HTML, プレーンテキスト, Markdown形式のいずれかを選択して編集できる入力欄を作成します。



## モジュール実装例

```html
{&{"input":{
    "type": "multitext",
    "name": "multitext-field",
    "label": "形式を選んでテキスト入力"
}}&}
```

## データ型

```json
{
    "src": "入力された文字データ",
    "editor": "markdown"
}
```

`editor` には、次のいずれかの値が入ります。

<dl>
    <dt>(空白)</dt>
        <dd>HTML編集を選択した場合の値です。</dd>
    <dt>text</dt>
        <dd>プレーンテキスト編集を選択した場合の値です。</dd>
    <dt>markdown</dt>
        <dd>Markdown編集を選択した場合の値です。</dd>
</dl>
