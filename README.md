# テーブル設計

## Usersテーブル
| Colum           | Type   | Options                   |
| --------------- | ------ | ------------------------- |
| nickname        | string | null: false               |
| email           | string | null: false, unique: true |
| avatar_img_file | string |                           |

### Association
- has_many: recipes


## Recipesテーブル
レシピを管理
| Colum            | Type       | Options                        |
| ---------------- | ---------- | ------------------------------ |
| title            | string     | null: false                    |
| cook_time        | integer    | null: false                    |
| ingredients      | text       | null: false                    |
| description      | text       | null: false                    |
| comment          | text       |                                |
| cooking_img_file | string     |                                |
| user_id          | references | null: false, foreign_key: true |

### Association
- belongs_to: user


## Recipe_stockテーブル
誰がどのレシピを保存したか
| Colum     | Type       | Options                        |
| --------- | ---------- | ------------------------------ |
| user_id   | references | null: false, foreign_key: true |
| recipe_id | references | null: false, foreign_key: true |

### Association
- belongs_to: user
- belongs_to: recipe