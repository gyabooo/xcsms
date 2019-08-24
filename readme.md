# 業務の自動化および管理システム

# 1.　作業の概要

### 1.1. 開発作業のタイプ分類
- 開発の形態：変更
- 事務フロー：若干の改善
- 開発方式：アジャイル（1人）
- 言語：PHP（Laravel）

### 1.2. 背景と目的
現在、定期業務の準備を半自動作業で実施しているが準備する手順が煩雑なため  
作業者により準備時間の違いが出てきたりミスも発生しやすい状態になっている。  
そこで定期業務の準備の手順を簡略化および自動化し作業時間の短縮とミスを軽減し  
属人化をなるべく無くしていくことを目的とする。

### 1.3. 業務の概要
定期作業は主に以下を実施している。

1. OSアップデート作業
サーバーのパッケージを夜間に自動でアップデート。
アップデートするには事前にエンドユーザーにアップデートアナウンスを実施し承認を得られれば作業を実施する。

2. SSL更新作業
バーチャルドメインに設定されているSSL証明書を夜間に自動で更新する。
アナウンスは不要。

## 1.4. 作業内容・納入成果物

1. 作業内容
OSアップデート作業およびSSL更新作業のプログラム製造・単体テスト、結合テスト、総合テストを実施する。

2. 納入成果物
成果物の納入期限は以下の通りとする。
また納入成果物は電子ファイル納品とする。

    |成果物名・内容説明|納入期限|
    |:-------------:|:----:|
    |要件定義書（本ファイル）|2019/7/21|
    |業務フロー|2019/7/21|
    |画面設計書|2019/7/27|
    |ソースコード|2019/8/10|
    |テストプログラム|2019/8/20|

# 2.　開発するシステムの要件

## 2.1．機能要件
本システムは定期作業を効率的かつミスの減少を提供するシステムとして構築する。  
以下に、本システムの機能について必要と考える主な機能を示す。

#### 2.1.1 OSアップデート作業管理機能
主にOSアップデート作業の業務を管理する機能。

1. アナウンスメール送付機能  
エンドユーザーに作業対象および作業日時をアナウンスできること。  
機能要件としては
    - 案件が選べること
    - 選んだ案件から対象サーバーと送付先メールアドレスが選べること
    - 件名、送付先、本文に送付先メールアドレス・対象サーバー・対象ドメインが自動で挿入されていること
    - 承認用一時URLがランダムで作成されること
    - 本文に承認用一時URLが記載されていること

2. 作業日程承認機能  
エンドユーザーが承認用一時URLから承認を行えること。  
機能要件としては
    - 承認用一時URLの画面に作業日時、停止時間、対象サーバー、対象ドメインが表示されること
    - 承認する、承認しないが選択できること
    - 一度承認された場合、承認されている旨の画面が表示されること

3. 履歴管理機能  
アナウンスされた日程の履歴が確認できること。  
機能要件としては
    - アナウンスを行った日時、案件、対象サーバー、作業日、承認されているかが確認できること

4. アナウンス削除機能
不要なアナウンスを削除できること。  
機能要件としては
    - 選択したアナウンスが削除できること。

#### 2.1.2 SSL更新作業管理機能  
主にSSL更新作業の業務を管理する機能。

1. SSL証明書一覧機能  
SSL証明書の一覧が表示されること。  
機能要件としては
    - SSL証明書の一覧が表示されること
    - CSR、秘密鍵、中間証明書、SSL証明書がダウンロードできること

2. CSR（証明書署名要求）作成機能  
新しくCSR（証明書署名要求）が作成できること。  
機能要件としては
    - CSRファイルをアップロードするとCSR情報が自動入力されること
    - 対象サーバーを選択できること
    - DBにCSRファイル、秘密鍵ファイル、パスフレーズが保存されること
    - パスフレーズあり秘密鍵がアップロードされた場合、パスフレーズ無し秘密鍵が作成され保存されること
    - 保存先フォルダのパスがDBに保存されること

3. SSL証明書保存機能  
発行されたSSL証明書をアップロードし所定の場所に保存されること。  
機能要件としては
    - アップロードされたファイルから証明書ファイルと中間証明書ファイルを抽出できること
    - DBの保存情報から保存先を選択できること
    - GoogleDeiveの保存先フォルダを選択できること
    - SSL証明書のコモンネームと有効期限をDBに保存すること

4. 履歴管理機能  
保存されているSSL証明書ファイルの履歴が確認できること。  
機能要件としては
    - 今までアップロードしたSSL証明書ファイルの一覧が各サーバーごとにコモンネーム、有効期限と共に表示されること

5. 更新作業スケジュール機能  
SSL証明書の更新作業が指定した日時で実施されるようにする機能。  
機能要件としては
    - 案件が選べること
    - 選んだ案件から対象サーバーが選べること
    - カレンダーから実行する日時を選択できること
    - どの証明書を利用するか選択できること
    - 事前確認作業が実施できること
    - スケジュール管理サーバーに作業を登録できること

#### 2.1.3 案件管理機能
CMDBから取得した案件を管理する機能。

1. 案件一覧機能
全ての案件の一覧を表示する機能。  
機能要件としては
    - 案件名、対象サーバー、担当者が表示されること

2. 案件詳細機能  
案件の詳細を表示する機能。  
機能要件としては
    - 選択した案件の対象サーバー、対象サーバーの詳細、担当者、担当詳細情報が表示されること

#### 2.1.4 サーバー管理機能
CMDBから取得したサーバーを管理する機能。

1. サーバー一覧機能
サーバーの一覧を表示する機能。  
機能要件としては
    - 全ての対象サーバー、IPアドレスまたはFQDN、案件が表示されること

2. サーバー詳細機能
サーバーの詳細を表示する機能。  
機能要件としては
    - 選択したサーバーの対象サーバー、IPアドレスまたはFQDN、案件、OS、パッケージ情報、最終アップデート日情報が表示されること

#### 2.1.5 メールテンプレート管理機能
メールテンプレートを管理する機能。

1. テンプレート一覧機能
テンプレートの一覧を表示する機能。  
機能要件としては
    - 全ての作成されたテンプレートのテンプレート名、件名が表示されること

2. テンプレート詳細機能
テンプレートの詳細を表示する機能。  
機能要件としては
    - 選択したテンプレートのテンプレート名、件名、本文が表示されること

3. テンプレート作成機能
テンプレートを作成する機能。  
機能要件としては
    - テンプレート名、件名、本文を入力できること
    - 変数が使えること
    - テンプレートが保存できること

4. テンプレート編集機能
テンプレートを編集する機能。  
機能要件としては
    - テンプレート名、件名、本文を入力できること
    - 変数が使えること
    - テンプレートが更新できること

5. テンプレート削除機能
テンプレートを削除する機能。
機能要件としては
    - 選択したテンプレートが削除できること

#### 2.1.6 変数管理機能
メールテンプレートで使用する変数を管理する機能。

1. 変数作成機能
テンプレートで使用する変数を作成できる機能。
機能要件としては
    - 変数を作成できること

2. 変数編集機能
テンプレートで使用する変数を編集できる機能。
機能要件としては
    - 変数を編集できること

3. 変数削除機能
テンプレートで使用する変数を編集できる機能。
機能要件としては
    - 変数を削除できること


## 2.2 外部インターフェース設計
他システムのインタフェースを適用する機能は、以下の通りであり、それぞれ、各システムが定めるインタフェース仕様に従うこと。
|機能名|インタフェース|
|:---------:|:-------------:|
|案件管理機能, サーバー管理機能 |社内CMDB |
|更新作業スケジュール機能|jobscheduler |

## 2.3．非機能要件
#### 2.3.1 性能要件
リアルタイム処理は実装しないためおおよそレスポンス時間の目標値は、平常時5秒以内とする。

#### 2.3.2 拡張性・柔軟性要件
- 将来、外部インタフェースの仕様が変わっても柔軟に対応できるようなモデル設計にする
- バージョンによるエラーをなるべく回避するためプログラムで使用するパッケージは固定のバージョンまたはOS提供のパッケージを利用する

#### 2.3.3 情報セキュリティ要件
- セキュアな通信を提供するためHTTPS通信をデフォルトとする。
- 外部からアクセスされないよう接続元IPアドレス制限を実施する。

# 今後の展開
以下も定期的に発生する作業だが実装するかは現在のところ未定。

- サーバー構築作業
- ドメイン追加作業
- ドメイン削除作業