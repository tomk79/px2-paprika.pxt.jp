画像の入力欄を作成します。

ただし、このフィールドは `<img>`要素は出力しません。 src属性の中身だけを提供することに注意してください。




## モジュール実装例

```html
<img src="{&{"input":{
    "type": "image",
    "name": "image-field",
    "label": "画像"
}}&}" />
```

## データ型

```json
{
    "resKey": "(リソースキー)",
    "path": "./index_files/resources/resource-name.png",
    "resType": "",
    "webUrl": ""
}
```

image フィールドは resourceMgr に画像リソースを１つ登録します。 resourceMgr が発行したリソースのキーが `resKey` に格納されます。

`resType` には、次のいずれかの値が入ります。

<dl>
    <dt>(空白)</dt>
        <dd>画像ファイルを登録する場合の値です。</dd>
    <dt>web</dt>
        <dd>ウェブ上の画像URLを登録する場合の値です。</dd>
</dl>

`resType` が `web` のとき、 `webUrl` にそのURLがセットされます。 `webUrl` は `http://` や `https://` から始まるウェブアドレスや、 `/common/images/sample.png` のような絶対パス、相対パスによるローカルのリソースのパスがセットされる場合があります。
