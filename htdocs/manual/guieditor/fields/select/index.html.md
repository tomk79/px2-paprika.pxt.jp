selectフィールドは、選択式の入力欄を作成します。



## モジュール実装例

selectフィールドには、特別な設定値 `options` が定義されています。`options` には、プロパティに `value` と `label` を持ったオブジェクトを配列に格納して設定します。

```html
<!-- 実装例 -->
<div style="text-align:{&{"input":{"type":"select", "name":"text-align", "label":"テキスト寄せ", "display":"select", "options":[
    {"value":"left", "label":"左寄せ"},
    {"value":"center", "label":"中央寄せ"},
    {"value":"right", "label":"右寄せ"}
]}}&};">inner html.</div>
```

`display` に `radio` を設定すると、ラジオボタンの形式に変更することができます。省略時は `select` になります。

## データ型

```json
"選択されたオプションの value 値"
```
