
- Git

```shell

    `リポジトリに初回PULL || PUSHするときに必要`
    git merge --allow-unrelated-histories
    
```

- PG

```shell

    `スーパーユーザでログイン`
    psql -U postgres

    `ユーザーを登録`
    CREATE ROLE ユーザ名 WITH LOGIN PASSWORD パスワード

    `データベースを登録 [psql -U ユーザーで楽にログインするため]`
    CREATE DATABASE ユーザー名

    `SELECT INSERT DROPなどの権限を付与`
    GRANT USAGE ON SCHEMA public TO ユーザ名;
    
```