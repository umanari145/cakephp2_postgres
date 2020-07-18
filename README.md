# CakePHP

cakephp2.10 + postgres


# migrationsについて

## CakeDC
- 履歴はDB管理
- git submodule(特定のディレクトりを別のgitの範囲にする)
- かなり複雑で面倒っぽい
- 直SQLは無理っぽい
- 複合主キー無理(cake2の仕様がそうらしい)
参考<br>
https://www.ryuzee.com/contents/blog/6108


## Dbup 
- 超簡単
- 履歴をテキスト管理
- upコマンドのみ
- SQLのなかに;を入れるとダメ

参考<br>
https://brtriver.github.io/dbup/ja/

## phinx
- 直SQL可能
- 履歴はDB管理
- ロールバックあり
- 特定のマイグレーションのみ実行可能
- シーダーなども可能

参考<br>
https://phinx.org/
https://qiita.com/hypermkt/items/b915b8a9fbda2f0c612e

