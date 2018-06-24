<div class="alert alert-warning">
    <p>[注意] 旧GUI編集エンジン legacy は、 Pickles 2 2.0.0-beta.17 で廃止された古い機能です。</p>
</div>


GUI編集機能はもともと、Pickles 2 アプリケーション に固く組み込まれた特有の機能として開発されました。しかし、機能拡張を重ね、複雑化するにつれて、このことは開発上の負担になるようになってきました。

こうした背景から、GUI編集機能を単一のパッケージとして Pickles 2 アプリケーション から分離し、 `broccoli-html-editor` というライブラリとして独立させ、エンジンの実装もゼロから刷新されました。


<!-- autoindex -->



## GUI編集エンジンの種類

GUIエンジンは、次の種類があります。

<ul>
<li><em>legacy</em> - 従来のエンジン (このオプションは Pickles 2 2.0.0-beta.17 で廃止されました)</li>
<li><em>broccoli-html-editr</em> - 刷新された新しいエンジン</li>
</ul>

## エンジンの切り替え設定

GUI編集エンジンは、Pickles 2 プロジェクトの `config.php` の `$conf->plugins->px2dt->guiEngine` 項目に設定します。

設定できる値は、`broccoli-html-editor` (デフォルト) または `legacy` のいずれかです。

<pre><code>&lt;?php
return call_user_func( function(){

    // initialize
    $conf = new stdClass;

    /* 中略 */

    // config for Plugins.
    $conf-&gt;plugins = new stdClass;

    // config for Pickles2 Desktop Tool.
    $conf-&gt;plugins-&gt;px2dt = new stdClass;

    /* 中略 */

    $conf-&gt;plugins-&gt;px2dt-&gt;guiEngine = &#39;broccoli-html-editor&#39;;//←GUI編集エンジンの名称 (broccoli-html-editor|legacy)

    return $conf;
} );
</code></pre>

`config.php` に設定するということはつまり、個人のデスクトップツール毎ではなく、プロジェクト別の設定になります。
