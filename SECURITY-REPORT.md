# セキュリティチェックレポート

**プラグイン:** NExT Date Expiry Text Block
**バージョン:** 0.3.1
**チェック日:** 2026-03-04
**対象ファイル:**
- `next-date-expiry-block.php`
- `src/render.php`
- `src/edit.js`
- `src/block.json`
- `src/view.js`

---

## 総合評価

**リスクレベル: 低**

深刻な脆弱性は検出されませんでした。ただし、改善推奨の軽微な指摘が 3 件あります。

---

## チェック結果一覧

| # | 重要度 | 場所 | 指摘内容 | 状態 |
|---|--------|------|---------|------|
| 1 | MEDIUM | `src/render.php:80` | `echo $wrapper_attributes` に明示的なエスケープアノテーションなし | 要対応 |
| 2 | LOW | `src/render.php:18` | `$text_content` が入力時に未サニタイズ（出力時は `wp_kses_post()` で処理済み） | 要確認 |
| 3 | LOW | `src/render.php:50` | `strtotime()` にデータベース値を渡している | 許容範囲 |
| 4 | INFO | `src/block.json` | `viewScript` に空の `view.js` を指定 | 改善推奨 |

---

## 詳細

### #1 MEDIUM — `echo $wrapper_attributes` に明示的なエスケープアノテーションなし

**ファイル:** `src/render.php` 行 80

```php
// 現在のコード
<div <?php echo $wrapper_attributes; ?>>
```

**説明:**
`get_block_wrapper_attributes()` は WordPress コアが提供する関数で、返り値は内部でサニタイズ済みです。実害は生じませんが、PHPCS (WordPress Coding Standards) はこの行を「エスケープなしの出力」としてフラグします。

**推奨対応:**

```php
<div <?php echo $wrapper_attributes; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Sanitized by get_block_wrapper_attributes(). ?>>
```

または WordPress 6.x 以降なら `wp_kses_data()` でラップする方法もあります。

---

### #2 LOW — `$text_content` の入力時サニタイズなし

**ファイル:** `src/render.php` 行 18

```php
// 現在のコード
$text_content = isset( $attributes['content'] ) ? $attributes['content'] : '';
```

**説明:**
`$text_content` は入力時にサニタイズされていません。ただし、出力時に `wp_kses_post()` で処理されているため（行 81）、フロントエンドへの XSS は防がれています。

ブロック属性はブロックエディターを通じて保存されるため、外部からの直接インジェクションは困難です。実際のリスクは低いですが、「入力時サニタイズ・出力時エスケープ」という WordPress のベストプラクティスに沿って入力時にも `wp_kses_post()` を適用することを推奨します。

**推奨対応:**

```php
$text_content = isset( $attributes['content'] ) ? wp_kses_post( $attributes['content'] ) : '';
```

---

### #3 LOW — `strtotime()` にデータベース値を渡している

**ファイル:** `src/render.php` 行 50

```php
$timestamp = strtotime( $field_value );
```

**説明:**
`$field_value` は `get_post_meta()` 経由のデータベース値であり、外部ユーザーの直接入力ではありません。`strtotime()` はコードを実行しないため、コードインジェクションのリスクはありません。`false` 返却時のチェックも実装済み（行 51）です。

現状のコードは許容範囲内です。念のため、予期しない値に対しての動作が `false` を返して処理を終了することを確認済みです。

---

### #4 INFO — 空の `view.js` が `viewScript` に登録されている

**ファイル:** `src/block.json` 行 66、`src/view.js`

```json
"viewScript": "file:./view.js"
```

**説明:**
`view.js` の中身は空（コメントのみ）です。このままでは WordPress がフロントエンドで空の JS ファイルをエンキューするため、不要なリクエストが発生します。サーバーサイドレンダリング専用のブロックなので `viewScript` の記述自体が不要です。

**推奨対応:**
`src/block.json` から `"viewScript"` の行を削除し、`src/view.js` も削除する。

---

## 問題なし（合格）の項目

| 項目 | 内容 |
|------|------|
| ABSPATH チェック | `next-date-expiry-block.php`・`render.php` ともに実装済み ✓ |
| SQL インジェクション | SQL を直接扱うコードなし（`get_post_meta()` 使用）✓ |
| `$custom_field_name` サニタイズ | `sanitize_text_field()` 適用済み ✓ |
| `$date_format` サニタイズ | `sanitize_text_field()` 適用済み ✓ |
| `$text_align` エスケープ | `esc_attr()` 適用済み ✓ |
| リッチテキスト出力 | `wp_kses_post()` 適用済み ✓ |
| HTML サポート無効化 | `block.json` に `"html": false` 設定済み ✓ |
| Nonce / 権限チェック | render.php はフォーム処理ではなく不要。ブロックエディターは WordPress が `edit_posts` 権限を強制 ✓ |
| 直接ファイルアクセス防止 | `if ( ! defined( 'ABSPATH' ) ) { exit; }` 実装済み ✓ |

---

## 優先対応リスト

1. **[推奨]** `render.php:80` — `phpcs:ignore` アノテーションを追加
2. **[推奨]** `render.php:18` — `$text_content` の入力時サニタイズに `wp_kses_post()` を追加
3. **[任意]** `block.json` から `viewScript` を削除し `view.js` を削除

---

*本レポートは静的コード解析に基づいています。動的テスト（ペネトレーションテスト等）は含みません。*
