WEBアプリまるみえくん
====

## 説明
既存のフレームワークを使わずにシンプルなMVCでWEBアプリを作成する学習用教材です。
従来の教材ではブラックボックス化されがちだった部分を根本から学びましょう。

## ディレクトリ構成
library以下のクラスはあらゆるシステムで共通に使うものです。
public以下には個々のシステム（Webサイト単位）のディレクトリを作ります。
```
(ROOT)/
　　∟library/
　　　　∟mvc/
　　　　　　∟ControllerBase.php
　　　　　　∟Dispatcher.php
　　　　　　∟ModelBase.php
　　　　　　∟Post.php
　　　　　　∟QueryString.php
　　　　　　∟Request.php
　　　　　　∟UrlParameter.php
　　　　　　∟Smarty/　
　　∟public/
　　　　∟sample/
　　　　∟(例)ec/
　　　　∟(例)cooking
```

各システムのディレクトリ構成は、sampleを参考にこんな感じにしましょう。
```
∟(例)ec/　（通販サイト）
　　　　∟controllers/
　　　　　　∟IndexController.php
　　　　　　∟CartController.php
　　　　　　∟ProductsController.php
　　　　　　∟RankingController.php
　　　　∟models/
　　　　　　∟Cart.php
　　　　　　∟Customer.php
　　　　∟views/
　　　　　　∟templates/
　　　　　　　　∟index/
　　　　　　　　　　∟index.html
　　　　　　　　∟cart/
　　　　　　　　　　∟index.html
　　　　　　　　∟products/
　　　　　　　　　　∟list.html
　　　　　　　　　　∟detail.html
　　　　　　　　∟ranking/
　　　　　　　　　　∟product.html
　　　　　　　　　　∟shop.html
　　　　　　∟templates_c/
　　　　∟htdocs/
　　　　　　∟css/
　　　　　　∟images/
　　　　　　∟js/
　　　　　　∟.htaccess
　　　　　　∟index.php
```

## Install
ターミナルから以下のコマンドを実行するとコードをダウンロードできます。
```
git clone https://github.com/hash52/mvc_template.git
```

### sampleの実行方法
1. MAMPをローカルにインストールして、設定からドキュメントルートをpublic/sample/htdocsに設定しましょう
2. MAMPを立ち上げ、DBにログイン。public/sample/sql直下の.sqlファイルを実行してsampleを実行するためのDBを構築しましょう
3. http://localhost/hoge/get　にアクセスして、画面上部に
```
0:hogehoge 1:hogehoge 2:hogehoge 3:hogehoge 4:hogehoge 5:hogehoge 6:hogehoge 7:hogeeeeeee
```
と表示されればokです。

処理の起点となるクラスは、htdocs直下のindex.phpです。
まずは、public/sample/htdocs/index.phpからコードを読み進めてみましょう！

## Link
- [元ネタ](http://www.objective-php.net/mvc/index/)・・説明がめちゃくちゃわかりやすくて大変オススメです。当リポジトリのコミットメッセージはこのサイトの目次に対応させてあります。ただし、リンク先はバージョンの問題やスペルミスで動かない箇所が結構あるので、コードはこっちを参考にしてくださいね。

- [MAMP](https://www.mamp.info/en/)
- [SequelPro](http://sequelpro.com)・・DBのGUIツール
