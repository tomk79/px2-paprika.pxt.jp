汎用的な属性値のテキストを入力する欄を作成します。

HTML特殊文字がエンティティ変換される点は <a href="../text/">textフィールド</a>と同じですが、改行コードはそのまま出力される点が異なります。



## モジュール実装例

```html
<div class="{&{"input":{
    "type": "html_attr_text",
    "name": "attr-field",
    "label": "クラス名"
}}&}">
    〜〜〜〜
</div>
```

## データ型

```json
"入力された属性値"
```
