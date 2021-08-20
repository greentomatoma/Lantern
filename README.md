# アプリ名
Lantern

# 概要
コンセプトは、「アイデアの共有」です。
このアプリでは、食材や資源が限られている災害時に役に立つ知識を閲覧または投稿することができます。
現段階では、レシピのみ投稿・閲覧ができる状態ですが、役立つ豆知識が投稿できるような機能も実装できるよう進めています。

# 本番環境
#### 【 URL】
  http://13.115.34.128/
#### 【ログイン情報（テスト用）】
- Eメールアドレス : test@test.com
- パスワード : test1234

# 制作背景（意図）
大学の課題研究で「災害時に有効な調理法」の研究を行っていたのがこのアプリケーションを作成するきっかけです。
災害時では、食事として「配給」がありますがこれは主に一般の人たち向けであり、幼児・高齢者・アレルギー持ちの人たちには個別対応していく必要があります。
こういった個別対応の調理法として「パッククッキング」というものがありますがこれは、各自治体のホームページにレシピをPDF形式で掲載していたりブログなどで紹介はされています。<br>
しかし、こういった情報はそれぞれのサイトで掲載されているため、複数のサイトをまたいで閲覧しなければいけません。<br>
また、実際の災害時では配給される食事の栄養バランスの偏りで体調を崩される方も少なくないというのが現状です。<br>
このように、「栄養が偏らない食事の取り方」や「どのように調理をしたらよいのか分からない」という課題を解決したいという思いからこのアプリケーションを作成しようと考えました。

# 実装機能
- レシピ一覧表示
- レシピ投稿
- レシピ編集/更新
- レシピ削除
- レシピ保存
- タグ
- 検索
- ユーザー登録
- ログイン/ログアウト
- ユーザー詳細
- ユーザー編集

# アプリケーションの様子
## トップページ
アプリを開いた時の一番初めに出てくる画面です。<br>
「Lanternのコンセプト」と「Lanternでできること」を記載しています。<br>
使用しているイラストは、Illustratorを用いて作成しています。
<img width="60%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130207038-3c9caa74-49b1-45b4-afa3-33be78048c25.png">
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130207135-83aeb07d-4aee-4204-80ca-3581f2a857af.gif">

## ログイン / ログアウト ・　新規登録
画面上部のナビバーより、ログイン/ログアウト、新規登録ができます。<br>
### ログイン
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130206206-1beb9930-ccec-4de0-bc33-9d20ef0eea45.gif">

### ログアウト
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130207747-ec032ce3-51c6-455e-b345-12f1f54143d5.gif">

## 投稿一覧画面
画面上部のナビバーにある「レシピをみる/書く」から、全ユーザーが投稿したレシピを閲覧することができます。<br>
レシピは、ログイン・非ログイン関係なく閲覧ができます。
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130208223-76a300df-5cd4-483b-9f7b-5d9b9a738850.gif">

## 投稿
ユーザーアイコンのドロップダウンメニューにある「レシピを書く」を押すことで、新規投稿画面へ遷移できます（ログイン時のみ）。<br>
必須項目の欄を埋めていれば投稿が可能です。<br>
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130208517-57d1f5c6-5bd5-4d00-ad97-7e32c333651e.gif">
### 投稿画面
<img width="50%" alt="スクリーンショット 2021-08-10 15 48 45" src="https://user-images.githubusercontent.com/80607137/128832260-428772a2-f247-49ca-b8f3-64aa839780db.png">

## 投稿詳細画面
画像またはタイトルをクリックすると、その投稿の詳細画面へ遷移します。<br>
<img width="80%" alt="スクリーンショット 2021-08-10 15 48 45" src="https://user-images.githubusercontent.com/80607137/130208876-1e4f16ea-6894-4418-9db1-8155e5824d7e.gif">
<br>

##  マイページ
ユーザーアイコンのドロップダウンメニューにある「マイページ」を押すことで、マイページへ遷移します。<br>
マイページでは自身が今まで投稿したレシピの一覧が表示されるだけでなく、投稿の編集・削除ができます。<br>
また、他ユーザーでも投稿したユーザーの名前を押すことでそのユーザーのマイページへ遷移することができます。<br>
### マイページへ遷移
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130208970-1a4bed2b-f22c-4384-8c92-e23989465c1b.gif">

### 編集/削除ボタン
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130209264-fbf15222-e877-42fc-a390-331d955169e0.gif">

## 保存機能
気になる投稿があれば、保存マークを押すことでその投稿を保存することができます。<br>
また、ユーザーアイコンのドロップダウンメニューにある「マイノート」を押すことで、保存したお気に入りの投稿を一覧で閲覧できます。<br>
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130209473-19c27dab-2c7c-4d98-a566-cac026033cc7.gif">
<br>

## キーワード検索/タグ検索
投稿一覧画面の上部にある検索窓では、キーワード検索が可能となっています。<br>
また、レシピにあるタグを押すことでそのタグが付けられたレシピの一覧が表示されます。<br>
### キーワード検索
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130212899-2e977534-8753-4847-a63a-1bcc82fed0ac.gif">

### タグ検索
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130213850-c61e8754-e541-4433-8c86-8eeda066b558.gif">

# 工夫したポイント
## 1. 気に入った投稿をストック
気に入った投稿をいつでもすぐに確認することができます。<br>
そして、ストックしたレシピをすぐに確認できるよう非同期(Vue.js)で検索を行える検索窓を設けました。<br>
<img width="60%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130210589-3f37a692-6059-4e1c-8f01-c99b16a59a08.png">
### レシピをストックする様子
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130210299-3839edf5-63b7-4389-b616-aa3bbbb7b6fa.gif">

### 非同期検索の様子
<img width="80%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/130209951-66ad35fc-03f0-40e3-9396-068fbea963d0.gif">


## 2. アイコン表示でよりわかりやすく
投稿されたレシピの<br>
・　料理の種類（主食・主菜・副菜・汁物・デザート・その他）<br>
・　料理の区分（容易にかめる・歯茎でつぶせる・舌でつぶせる・かまなくてよい）<br>
が選択肢によってアイコンが変化するように実装しています（料理の区分は色別）。
このようにする事で、レシピを見ている人も直感でその料理がどういったものなのかが理解しやすくなるのではないかと考えました。
<img width="70%" alt="スクリーンショット 2021-08-06 13 34 52" src="https://user-images.githubusercontent.com/80607137/128828698-369d3a74-7ccc-40b9-972a-fd025494051a.png">

# 使用技術（開発環境）

## バックエンド
PHP(Laravel)

## フロントエンド
Sass, Vue.js

## データベース
MySQL

## インフラ
AWS(EC2), RDS(MySQL), CodeDeploy, Docker(開発環境)

## Webサーバー（本番環境）
nginx

## ソース管理
GitHub, GitHubDesktop

## テスト
PHPUnit, CircleCI<br>
（※実装途中 2021.08.20現在）

## エディタ
VSCode

# 課題や今後実装したい機能
【実装したい機能】
- レシピだけでなく、災害時に役立つ知識や道具などを投稿できる機能
- SNSとの連携（認証）

【課題】
- 災害時に必要な準備物や量の目安などが記述されたページの作成
- ユーザー目線でのアプリ設計（操作方法などの記載）

# DB設計

## usersテーブル
ユーザー情報を管理
| Colum           | Type   | Options                   |
| --------------- | ------ | ------------------------- |
| nickname        | string | null: false               |
| email           | string | null: false, unique: true |
| avatar_img_file | string |                           |

### Association
- hasMany: recipes
- BelongsToMany: stocks


## recipesテーブル
投稿された全てのレシピを管理
| Colum            | Type       | Options                        |
| ---------------- | ---------- | ------------------------------ |
| title            | string     | null: false                    |
| cook_time        | integer    | null: false                    |
| ingredients      | text       | null: false                    |
| description      | text       | null: false                    |
| comment          | text       |                                |
| cooking_img_file | string     |                                |
| user_id          | references | null: false, foreign_key: true |
| meal_type_id     | references | null: false, foreign_key: true |
| meal_class_id    | references | null: false, foreign_key: true |

### Association
- BelongsTo: user
- BelongsTo: meal_type
- BelongsTo: meal_class
- BelongsToMany: tags
- BelongsToMany: stocks

## stocksテーブル
誰がどのレシピを保存したかを管理
| Colum     | Type       | Options                        |
| --------- | ---------- | ------------------------------ |
| user_id   | references | null: false, foreign_key: true |
| recipe_id | references | null: false, foreign_key: true |

### Association
- BelongsTo: user
- BelongsTo: recipe


## tagsテーブル
全てのタグ情報を管理
| Colum | Type       | Options      |
| ----- | ---------- | ------------ |
| name  | references | unique: true |

### Association
- BelongsToMany: recipes


## recipe_tagテーブル
レシピにどのタグが紐づいているかを管理
タグがどのレシピに紐づいているかを管理
| Colum     | Type       | Options           |
| --------- | ---------- | ----------------- |
| recipe_id | references | foreign_key: true |
| tag_id    | references | foreign_key: true |

### Association
- BelongsTo: recipes
- BelongsTo: tags


## meal_typesテーブル
料理の種類を管理
| Colum   | Type       | Options                        |
| ------- | ---------- | ------------------------------ |
| name    | references | null: false, foreign_key: true |
| sort_no | references | null: false, foreign_key: true |

### Association
- hasMany: recipes


## meal_classesテーブル
料理の区分を管理
| Colum   | Type       | Options                        |
| ------- | ---------- | ------------------------------ |
| name    | references | null: false, foreign_key: true |
| sort_no | references | null: false, foreign_key: true |

### Association
- hasMany: recipes


# ER図
![ER_lantern](https://user-images.githubusercontent.com/80607137/127274192-65164ba9-4a15-427f-8540-615a37a90aa7.png)
