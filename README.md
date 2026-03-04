# NExT Date Expiry Text Block

**English** | [日本語](#日本語)

---

A WordPress block that displays custom text when a specified custom field date has passed. Supports full paragraph-level text styling.

## Features

- Specify any custom field name that contains a date value.
- Set the date format used in the custom field (default: `Y-m-d`).
- Write custom text to display when the date has passed.
- Full paragraph-level text styling: text color, background color, font size, text alignment, and typography controls.
- On the front end, the block only renders when the custom field date is in the past — otherwise nothing is shown.

## Installation

1. Upload the plugin files to the `/wp-content/plugins/next-date-expiry-block` directory, or install via the WordPress Plugins screen.
2. Activate the plugin through the **Plugins** screen in WordPress.
3. Add the **Date Expiry Text Block** from the block editor (category: Text).

## Frequently Asked Questions

**What date formats are supported?**
By default the block expects dates in `Y-m-d` format (e.g., `2026-03-04`). You can change the date format in the block settings to match the format stored in your custom field.

**What happens if the custom field doesn't exist?**
If the custom field is not found on the current post, the block will not render anything on the front end.

**Can I use this with ACF or other custom field plugins?**
Yes, as long as the custom field stores a date string, you can specify that field name in the block settings.

## Development

```bash
npm install        # Install dependencies
npm run start      # Start development build (watch mode)
npm run build      # Production build
npm run release    # Production build + create plugin zip
```

## Changelog

### 0.3.1
- Fixed plugin zip installation by renaming main PHP file to `next-date-expiry-block.php`

### 0.3.0
- Added Japanese (ja) translation
- Added i18n support with `load_plugin_textdomain()`

### 0.2.0
- Changed prefix from `telex-` to `next-`

### 0.1.0
- Initial release

---

## 日本語

カスタムフィールドに設定した日付を過ぎると、任意のテキストを表示する WordPress ブロックです。段落ブロックと同等のテキスト装飾に対応しています。

## 機能

- カスタムフィールド名を自由に指定できます。
- カスタムフィールドに保存されている日付のフォーマットを設定できます（デフォルト: `Y-m-d`）。
- 期限切れ後に表示するテキストを自由に入力できます。
- テキスト色・背景色・フォントサイズ・テキスト揃え・タイポグラフィなど、段落ブロックと同等のスタイリングが可能です。
- フロントエンドでは、カスタムフィールドの日付が過去の場合のみ表示されます。それ以外は何も出力されません。

## インストール

1. プラグインファイルを `/wp-content/plugins/next-date-expiry-block` にアップロードするか、WordPress の管理画面からインストールします。
2. **プラグイン**画面でプラグインを有効化します。
3. ブロックエディターの「テキスト」カテゴリから **Date Expiry Text Block** を追加します。

## よくある質問

**対応している日付フォーマットは？**
デフォルトでは `Y-m-d` 形式（例: `2026-03-04`）を想定しています。カスタムフィールドに保存されている形式に合わせて、ブロックの設定から変更できます。

**カスタムフィールドが存在しない場合はどうなりますか？**
対象の投稿にカスタムフィールドが存在しない場合、フロントエンドには何も表示されません。

**ACF などのカスタムフィールドプラグインと併用できますか？**
日付文字列として保存されていれば、ACF を含む任意のカスタムフィールドプラグインと併用できます。

## 開発

```bash
npm install        # 依存関係のインストール
npm run start      # 開発ビルド（ウォッチモード）
npm run build      # 本番ビルド
npm run release    # 本番ビルド + プラグインzip生成
```

## 変更履歴

### 0.3.1
- メインPHPファイルを `next-date-expiry-block.php` にリネームし、zipインストール時のエラーを修正

### 0.3.0
- 日本語（ja）翻訳を追加
- `load_plugin_textdomain()` による多言語化対応を追加

### 0.2.0
- プレフィックスを `telex-` から `next-` に変更

### 0.1.0
- 初回リリース
