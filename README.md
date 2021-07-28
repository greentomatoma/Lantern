# アプリ名
Lantern

# 概要
コンセプトは、「アイデアの共有」です。
このアプリでは、食材や資源が限られている災害時に役に立つ調理法を閲覧または投稿することができます。


# 本番環境
#### 【 URL】
  http://13.115.34.128/
#### 【ログイン情報（テスト用）】
- Eメールアドレス : test@test.com
- パスワード : test1234

# 制作背景（意図）
大学の課題研究で「災害時に有効な調理法」の研究を行っていたのがこのアプリケーションを作成するきっかけです。
災害時では、食事として「配給」がありますがこれは主に一般の人たち向けであり、幼児・高齢者・アレルギー持ちの人たちには個別対応していく必要があります。
この個別対応の調理法である「パッククッキング」は、各自治体のホームページにレシピをPDF形式で掲載していたりブログなどで紹介はされており、
徐々に認知度は上がってきています。
そこで、この調理法をより多くの人に広めたいという思いと、災害時の時にも使えるアプリを作成したいと思いました。

# 実装機能
- レシピ一覧表示
- レシピ投稿
- レシピ編集/更新
- レシピ削除
- レシピ保存
- タグ
- 検索
- ユーザー登録
- ユーザー詳細
- ユーザー編集

# 工夫したポイント
気に入ったレシピをストックできるようにすることで、いつでもすぐにレシピを確認できるようにしました。
そして、ストックしたレシピをすぐに確認できるよう非同期で検索を行える検索窓を設けました。
また、投稿されたレシピの「料理の種類（主食・主菜・副菜・汁物・デザート・その他）」と「料理の区分（容易にかめる・歯茎でつぶせる・舌でつぶせる・かまなくてよい）」が
選択肢によってアイコンが変化するように実装しています（料理の区分は色別）。
このようにする事で、レシピを見ている人も直感でその料理がどういったものなのかが理解しやすくなるのではないかと考えました。

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
PHPUnit, CircleCI

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