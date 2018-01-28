### Plan

***

- 概要設計

    - 前提条件

        - 従業員の情報を一覧に表示(カタカナ)

        - 従業員の名前をクリックしたら勤務状態を確認、状態により勤務を開始、終了を行う

        - 勤務時間テーブルを一日毎に格納、このテーブルの情報を(勤務時間)合算するテーブルを作成

        - 月の最終日になったら勤務時間を削除

- 内部設計

    - テーブル

        - Peoples - people_id:int name:string state:varchar-default=0 session_id:int?

        - Sessions - id:int(People INNER) name:string state:varchar time:int(経過時間を計測) session_id:int

        - Times - id:int(People INNER) Time:int Sum:int
        

    - ページ推移

        - スタッフ一覧表示

        - Prompt

        - Modal

    - controller

        - ViewContent

        - index - 上記クライアント

        - owner - レコード操作(オプション)

- 詳細設計

    - データを初期投入

    - 一覧を表示 -> クリックしたらサーバにid,name,stateをPOST
    
    - 状態で条件分離、状態(done,yat)、名前、現在時間をtimeに入れる

    - yatの場合にはuser.stateを変更、SessionIDを発行、user table session tableに同一の値をインサート

    - done場合、SessionIDをテーブル内からSELECT、セレクトしたTimeカラムの時刻からの経過時間をタイムテーブルにインサート(name , time, sum)

    - $this->sum = $this->sum + $current_value
