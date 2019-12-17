WEBアプリまるみえくん
====

# 概要
WEBアプリを開発する学習用独自フレームワークです  
LaravelやRailsを使って学習するデメリットとして、それらが何故動くのかが見えづらい点が挙げられます。  
（例、コントローラークラスを定義していますが、それらは一体いつインスタンス化されているのでしょうか・・？)  
  
このフレームワークは、PHPの基本的な文法さえわかれば全ての処理を追えるよう記述されています  
従来の教材ではブラックボックス化されがちだった部分を根本から学びましょう！  
  
  
# 環境構築
ではさっそく、手元にコードをダウンロードして動かしてみましょう  

## 1. ソースコードをダウンロードします
ターミナルを立ち上げて、自分のパソコンの適当なディレクトリに、以下のコマンドでソースコードをダウンロードしましょう  
```
git clone https://github.com/hash52/mvc_template.git
```
ダウンロードしたら、そのターミナルで下記のコマンド  
```
cd mvc_template
pwd
```
を実行し、 **出力されたパスをどこかにメモしておいてください**  
例、/Users/Tanaka/workspace/mvc_template/
  
## 2. MAMPをインストールして立ち上げます
MAMPは[ここ](https://www.mamp.info/en/downloads/)からインストールしましょう   
  
インストールしたMAMP(象のアイコンのアプリです)を開いてください  
**右上のランプが点灯しているかどうか**に注目です  
![mvc_mamp_started](https://user-images.githubusercontent.com/17327364/70988588-79c92580-2105-11ea-8a0c-ea824628ebf4.png)
![mvc_mamp_stopped](https://user-images.githubusercontent.com/17327364/70988587-79308f00-2105-11ea-87b9-f2a11a52cd74.png)
  
[http://localhost/phpmyadmin/](http://localhost/phpmyadmin/) にアクセスして、下記の画面が出てくればMAMPの立ち上げは成功です
![mvc_phpAdmin_top](https://user-images.githubusercontent.com/17327364/70988590-79c92580-2105-11ea-9da5-ffc87411f92e.png)
  
## 3. MySQLにsampleアプリで使用するDBを作成します  
先程の[http://localhost/phpmyadmin/](http://localhost/phpmyadmin/) にアクセス、画面上部の「SQL」タブを選択し、下記のクエリを実行します  
```
DROP DATABASE IF EXISTS `mvc_template`;
CREATE DATABASE `mvc_template`;
```
（こんな感じ）  
![mvc_phpAdmin_create](https://user-images.githubusercontent.com/17327364/70988589-79c92580-2105-11ea-9db2-001674c6efd4.png)
画面左にmvc_templateという名前のDBが作成されれば成功です。  
  
次に、作成されたmvc_templateを選択し、下記のクエリを実行します  
```
DROP TABLE IF EXISTS `hoge`;

CREATE TABLE `hoge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `hoge` (`id`, `text`)
VALUES
	(1,'これはmvc_templateというデータベースのhogeテーブルにあるデータです'),
	(2,'hogehoge'),
	(3,'hogehoge'),
	(4,'hogehoge'),
	(5,'hogehoge'),
	(6,'hogehoge'),
	(7,'hogehoge'),
	(8,'hogeeeeeee');
```
（こんな感じ）  
![php_mvc_insert](https://user-images.githubusercontent.com/17327364/70988593-7a61bc00-2105-11ea-9f2d-2f4d1f7954f3.png)  
  
左のmvc_template直下に作成されたhogeテーブルを選択し、画面上部の「表示」タブで下記のようになればテーブルの作成は成功です  
![mvc_phpAdmin_hoge](https://user-images.githubusercontent.com/17327364/70988595-7a61bc00-2105-11ea-9f74-bef45b35bdf5.png)
  
## 4. ここまで来ればゴールは目前です。１でダウンロードしたソースコードに必要な設定をしていきます
mvc_template内の、 _public/index.php_ を開きましょう  
まずは、 _index.php13行目_ 、`$mvc_template_path`の中身を編集します。`$mvc_template_path`の値は、**１でメモしたパス**です  
行末に'/'が必要なので忘れないようにしてください  

（例）
```
$mvc_template_path = '/your_path/mvc_template/';
```
↓
```
$mvc_template_path = '/Users/Tanaka/workspace/mvc_template/';
```
    
次に32行目、`$connInfo`の情報を確認します  
MAMPの「Preferences」から、「Ports」タブを開き「MySQL Port」にある値を、 _index.php35行目_ のport番号として記述しましょう  
![mvc_mamp_port](https://user-images.githubusercontent.com/17327364/70988581-7897f880-2105-11ea-8e8e-c5e4575aca9b.png)
 
( _index.php_ 修正後の例。**【】に注目**)  
```
$mvc_template_path = '/Users/tanakatarou/workspace/mvc_template/'; // <= 【自分のパソコンにあるmvc_templateの場所。行末の/を忘れずに！】
$mvc_library_path = $mvc_template_path.'library/mvc/';
$public_path = $mvc_template_path.'/public/';
$app_name = 'sample';

//必要な外部phpファイルの読み込みは全てここで行っている。
require_once $mvc_library_path.'Dispatcher.php';
require_once $mvc_library_path.'RequestVariables.php';
require_once $mvc_library_path.'Post.php';
require_once $mvc_library_path.'QueryString.php';
require_once $mvc_library_path.'Request.php';
require_once $mvc_library_path.'ControllerBase.php';
require_once $mvc_library_path.'ModelBase.php';
require_once $mvc_library_path.'UrlParameter.php';
require_once $mvc_library_path.'Smarty/Smarty.class.php';

require_once $public_path.$app_name.'/models/Hoge.php';

// DB接続情報設定
$connInfo = array(
    'host'     => 'localhost',
    'dbname'   => 'mvc_template',
    'port' => '8889',  // <= 【MAMPで確認したMySQLのポート番号】
    'charset'   => 'utf8mb4',
    'dbuser'   => 'root',
    'password' => 'root'
);
//ModelBaseの$connInfoはstaticであるので、インスタンスを超えて共有される値
ModelBase::setConnectionInfo($connInfo );

$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot($public_path.$app_name);
//全ての処理の起点、Dispatcherクラスのdispatchメソッドへ
$dispatcher->dispatch();
```

## 5. いよいよ最後のステップです
MAMPの「Preference」から「Web Server」の「Document Root」を編集しましょう  
![mvc_mamp_docRoot](https://user-images.githubusercontent.com/17327364/70988582-7897f880-2105-11ea-9399-3f54af4dd9df.png)  
  
ダウンロードしたmvc_template内にある、public/htdocsを選択します。  
![mvc_where_htdocs](https://user-images.githubusercontent.com/17327364/70988583-79308f00-2105-11ea-80d0-edf7fce460cc.png)
  
okを押し、上手く行けば、サーバーが再起動します  
MAMPのランプの点灯を確認したら、下記URLにアクセスしましょう  
[http://localhost/hoge/get](http://localhost/hoge/get)
![mvc_hoge_get](https://user-images.githubusercontent.com/17327364/70988586-79308f00-2105-11ea-9fdb-d012607f0d40.png)
  
このように表示されれば、アプリのセットアップはひとまず完了です。  
お疲れさまでした  
  
※動作確認済の環境です  
```
PHP  :7.0
MySQL:5.6
```
  
  
## ディレクトリ構成の解説
library以下のクラスはフレームワークの共通コードです。これらのクラスを継承していくことで、個々のシステムのコントローラやモデルを作っていきます。  
Laravelを使った学習と大きく異なる点は、継承する親クラスの実装まで読める（改造できる）ということです!  
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
　　　　∟htdocs
```
  
public以下には個々のシステム単位のディレクトリを作ります。  
新たにシステムを作る際には、sampleを参考にこのようなディレクトリ構成で作っていきましょう。  
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
　　　　∟assets/
　　　　　　∟css/
　　　　　　∟images/
　　　　　　∟js/
```
  
処理の起点となるクラスは、public/htdocs直下のindex.phpです。  
.htaccessの設定で、全てのパスはこのindex.phpで処理されるようになっています（.htaccessはWebサーバの設定ファイルです。今はまだわからなくても大丈夫です）  
まずは、index.phpからコードを読み進めてみましょう！  
  
このフレームワークには、[足りない機能](https://github.com/hash52/mvc_template/issues)が山程あります！！！！  
**コードの改修を絶賛募集中です。**  
改修の方法ですが、このリポジトリをforkして、コードを改修したら、プルリクを投げてください。やり方は下記のリンクに載せてあります！
  
  
## Link
- [元ネタ](http://www.objective-php.net/mvc/index/)・・当リポジトリのコミット「設定ファイルで柔軟に」まではこのサイトの目次に対応させてあります。説明がわかりやすくて大変オススメです。ただし、バージョンの問題やスペルミスで動かない箇所があるので、コードはこっちを参考にしてくださいね
- [SequelPro](http://sequelpro.com)・・phpmyadminよりリッチな機能を備えたDBのGUIツールです
- [forkしてプルリクの方法](https://qiita.com/aipacommander/items/d61d21988a36a4d0e58b)・・開発にGitHubを使う会社であれば、必須スキルです
