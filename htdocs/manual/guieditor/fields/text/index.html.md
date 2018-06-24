プレーンテキスト形式の入力欄を作成します。この入力欄に入力されたテキストは、HTML特殊文字がエンティティ変換され、改行コードは `<br/>` に置き換えられます。


## モジュール実装例

```html
{&{"input":{
    "type": "text",
    "name": "text-field",
    "label": "プレーンテキスト入力"
}}&}
```

## データ型

```json
"入力されたテキストデータ"
```