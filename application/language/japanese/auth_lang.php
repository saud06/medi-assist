<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - Japanese
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author/Translation: Daniel Davis
*         @ourmaninjapan
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.19.2013
*
* Description:  Japanese language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'セキュリティに問題が生じ送信できませんでした。';

// Login
$lang['login_heading']         = 'ログイン';
$lang['login_subheading']      = 'メールアドレス又はユーザー名とパスワードでログインして下さい。';
$lang['login_identity_label']  = 'メールアドレス又はユーザー名：';
$lang['login_password_label']  = 'パスワード：';
$lang['login_remember_label']  = '次回から自動的にログイン：';
$lang['login_submit_btn']      = 'ログイン';
$lang['login_forgot_password'] = 'パスワードを忘れましたか？';

// Index
$lang['index_heading']           = 'ユーザー';
$lang['index_subheading']        = 'ユーザー一覧';
$lang['index_fname_th']          = '名';
$lang['index_lname_th']          = '姓';
$lang['index_email_th']          = 'メールアドレス';
$lang['index_groups_th']         = 'グループ';
$lang['index_status_th']         = '状態';
$lang['index_action_th']         = '操作';
$lang['index_active_link']       = '有効';
$lang['index_inactive_link']     = '無効';
$lang['index_create_user_link']  = 'ユーザーの新規作成';
$lang['index_create_group_link'] = 'グループの新規作成';

// Deactivate User
$lang['deactivate_heading']                  = 'ユーザーの無効化';
$lang['deactivate_subheading']               = '本当にユーザー「%s」を無効にしますか。';
$lang['deactivate_confirm_y_label']          = 'はい：';
$lang['deactivate_confirm_n_label']          = 'いいえ：';
$lang['deactivate_submit_btn']               = '送信';
$lang['deactivate_validation_confirm_label'] = '確認';
$lang['deactivate_validation_user_id_label'] = 'ユーザーID';

// Create User
$lang['create_user_heading']                           = 'ユーザーの作成';
$lang['create_user_subheading']                        = 'ユーザー情報を入力して下さい。';
$lang['create_user_fname_label']                       = '名：';
$lang['create_user_lname_label']                       = '姓：';
$lang['create_user_identity_label']                    = 'Identity:';
$lang['create_user_company_label']                     = '会社名：';
$lang['create_user_email_label']                       = 'メールアドレス：';
$lang['create_user_phone_label']                       = '電話番号：';
$lang['create_user_password_label']                    = 'パスワード：';
$lang['create_user_password_confirm_label']            = 'パスワード（確認用）：';
$lang['create_user_submit_btn']                        = '作成';
$lang['create_user_validation_fname_label']            = '名';
$lang['create_user_validation_lname_label']            = '姓';
$lang['create_user_validation_identity_label']         = 'Identity';
$lang['create_user_validation_email_label']            = 'メールアドレス';
$lang['create_user_validation_phone1_label']           = '電話番号の第1部';
$lang['create_user_validation_phone2_label']           = '電話番号の第2部';
$lang['create_user_validation_phone3_label']           = '電話番号の第3部';
$lang['create_user_validation_company_label']          = '会社名';
$lang['create_user_validation_password_label']         = 'パスワード';
$lang['create_user_validation_password_confirm_label'] = 'パスワードの確認';

// Edit User
$lang['edit_user_heading']                           = 'ユーザーの編集';
$lang['edit_user_subheading']                        = 'ユーザー情報を入力して下さい。';
$lang['edit_user_fname_label']                       = '名：';
$lang['edit_user_lname_label']                       = '姓：';
$lang['edit_user_company_label']                     = '会社名：';
$lang['edit_user_email_label']                       = 'メールアドレス：';
$lang['edit_user_phone_label']                       = '電話番号：:';
$lang['edit_user_password_label']                    = 'パスワード（パスワードを変更する場合のみ）：';
$lang['edit_user_password_confirm_label']            = 'パスワードの確認（パスワードを変更する場合のみ）：';
$lang['edit_user_groups_heading']                    = '所属グループ';
$lang['edit_user_submit_btn']                        = '保存';
$lang['edit_user_validation_fname_label']            = '名';
$lang['edit_user_validation_lname_label']            = '姓';
$lang['edit_user_validation_email_label']            = 'メールアドレス';
$lang['edit_user_validation_phone1_label']           = '電話番号の第1部';
$lang['edit_user_validation_phone2_label']           = '電話番号の第2部';
$lang['edit_user_validation_phone3_label']           = '電話番号の第3部';
$lang['edit_user_validation_company_label']          = '会社名';
$lang['edit_user_validation_groups_label']           = 'グループ';
$lang['edit_user_validation_password_label']         = 'パスワード';
$lang['edit_user_validation_password_confirm_label'] = 'パスワードの確認';

// Create Group
$lang['create_group_title']                  = 'グループの作成';
$lang['create_group_heading']                = 'グループの作成';
$lang['create_group_subheading']             = 'グループ情報を入力して下さい。';
$lang['create_group_name_label']             = 'グループ名：';
$lang['create_group_desc_label']             = '詳細：';
$lang['create_group_submit_btn']             = '作成';
$lang['create_group_validation_name_label']  = 'グループ名';
$lang['create_group_validation_desc_label']  = '詳細';

// Edit Group
$lang['edit_group_title']                  = 'グループの編集';
$lang['edit_group_saved']                  = '保存できました';
$lang['edit_group_heading']                = 'グループの編集';
$lang['edit_group_subheading']             = 'グループ情報を入力して下さい。';
$lang['edit_group_name_label']             = 'グループ名：';
$lang['edit_group_desc_label']             = '詳細：';
$lang['edit_group_submit_btn']             = '保存';
$lang['edit_group_validation_name_label']  = 'グループ名';
$lang['edit_group_validation_desc_label']  = '詳細';

// Change Password
$lang['change_password_heading']                               = 'パスワードの変更';
$lang['change_password_old_password_label']                    = '元のパスワード：';
$lang['change_password_new_password_label']                    = '新しいパスワード（少なくとも%s字以上）：';
$lang['change_password_new_password_confirm_label']            = '新しいパスワード（確認用）：';
$lang['change_password_submit_btn']                            = '変更';
$lang['change_password_validation_old_password_label']         = '元のパスワード';
$lang['change_password_validation_new_password_label']         = '新しいパスワード';
$lang['change_password_validation_new_password_confirm_label'] = '新しいパスワードの確認';

// Forgot Password
$lang['forgot_password_heading']                 = 'パスワードの再発行';
$lang['forgot_password_subheading']              = '新しいパスワードをメールで送信するため、%sを入力して下さい。';
$lang['forgot_password_email_label']             = '%s：';
$lang['forgot_password_submit_btn']              = '送信';
$lang['forgot_password_validation_email_label']  = 'メールアドレス';
$lang['forgot_password_username_identity_label'] = 'ユーザー名';
$lang['forgot_password_email_identity_label']    = 'メールアドレス';
$lang['forgot_password_email_not_found']         = 'No record of that email address.';
$lang['forgot_password_identity_not_found']         = 'No record of that username address.';

// Reset Password
$lang['reset_password_heading']                               = 'パスワードの変更';
$lang['reset_password_new_password_label']                    = '新しいパスワード（少なくとも%s字以上）：';
$lang['reset_password_new_password_confirm_label']            = '新しいパスワード（確認用）：';
$lang['reset_password_submit_btn']                            = '変更';
$lang['reset_password_validation_new_password_label']         = '新しいパスワード';
$lang['reset_password_validation_new_password_confirm_label'] = '新しいパスワードの確認';

// Activation Email
$lang['email_activate_heading']    = 'アカウントの有効化： %s';
$lang['email_activate_subheading'] = 'このリンクをクリックして%s。';
$lang['email_activate_link']       = 'アカウントを有効にして下さい';

// Forgot Password Email
$lang['email_forgot_password_heading']    = 'パスワードのリセット： %s';
$lang['email_forgot_password_subheading'] = 'このリンクをクリックして%s。';
$lang['email_forgot_password_link']       = 'パスワードをリセットして下さい';

// New Password Email
$lang['email_new_password_heading']    = '新しいパスワード： %s';
$lang['email_new_password_subheading'] = 'パスワードをリセットすることができました： %s';

// Header
$lang['header_sign_out'] 			= 'サインアウト';
$lang['header_online'] 				= 'オンライン';
$lang['header_main_navidation'] 	= 'メインナビゲーション';
$lang['header_dashboard'] 			= 'ダッシュボード';
$lang['header_product'] 			= '製品';
$lang['header_list'] 				= 'リスト';
$lang['header_add'] 				= '追加';
$lang['header_product_alert'] 		= '製品アラート';
$lang['header_purchase'] 			= '購入';
$lang['header_purchase_return'] 	= '購入リターン';
$lang['header_transfers'] 			= 'Tranfers';
$lang['header_sales'] 				= '販売';
$lang['header_sales_return'] 		= 'セールスレターn';
$lang['header_payment'] 			= '支払い';
$lang['header_invoice'] 			= '請求書';
$lang['header_reports'] 			= 'レポート';
$lang['header_daily'] 				= '毎日';
$lang['header_people'] 				= '人';
$lang['header_users'] 				= 'ユーザー';
$lang['header_billers'] 			= 'ビラーズ';
$lang['header_clients'] 			= '顧客';
$lang['header_suppliers'] 			= 'サプライヤー';
$lang['header_setting'] 			= '設定';
$lang['header_company_setting'] 	= '会社の設定';
$lang['header_category'] 			= 'カテゴリー';
$lang['header_sub_category'] 		= 'サブカテゴリ';
$lang['header_branch'] 				= 'ブランチ';
$lang['header_brand']				= 'ブランド';
$lang['header_discount'] 			= 'ディスカウント';
$lang['header_tax'] 				= '税金';
$lang['header_warehouse'] 			= '倉庫';
$lang['header_assign_warehouse'] 	= '倉庫を割り当てる';

//Company Settings
$lang['company_setting_name'] 				= '名';
$lang['company_setting_site_short_name'] 	= 'サイトの短縮名';
$lang['company_setting_country'] 			= '国';
$lang['company_setting_select'] 			= '選択';
$lang['company_setting_state'] 				= '状態';
$lang['company_setting_city'] 				= 'シティ';
$lang['company_setting_street'] 			= '通り';
$lang['company_setting_zip_code'] 			= '郵便番号';
$lang['company_setting_email'] 				= 'Eメール';
$lang['company_setting_mobile'] 			= 'モバイル';
$lang['company_setting_default_language'] 	= 'デフォルト言語';
$lang['company_setting_default_currency'] 	= 'デフォルト通貨';
$lang['company_setting_submit'] 			= '提出する';
$lang['company_setting_cancel'] 			= 'キャンセル';

//Product
$lang['product_list_product'] 			= '製品のリスト';
$lang['product_add_new_product'] 		= '新製品の追加';
$lang['product_no'] 					= 'いいえ';
$lang['product_image'] 					= '画像';
$lang['product_code'] 					= 'コード';	
$lang['product_hsn_sac_code'] 			= 'HSN / SACコード';
$lang['product_name'] 					= '名';
$lang['product_category'] 				= 'カテゴリー';
$lang['product_cost'] 					= 'コスト';
$lang['product_price'] 					= '価格';
$lang['product_quantity'] 				= '量';
$lang['product_unit'] 					= '単位';
$lang['product_alert_quantity'] 		= 'アラート数量';
$lang['product_available_quantity'] 	= '利用可能な数量';
$lang['product_action'] 				= 'アクション';
$lang['product_add_product'] 			= '製品を追加';
$lang['product_product_code'] 			= '製品コード';
$lang['product_product_name'] 			= '商品名';
$lang['product_hsn_sac_lookup'] 		= 'HSN / SACルックアップ';
$lang['product_select_category'] 		= 'カテゴリを選んでください';
$lang['product_select'] 				= '選択';
$lang['product_select_subcategory'] 	= 'サブカテゴリを選択';
$lang['product_product_unit'] 			= 'プロダクトユニット';
$lang['product_product_size'] 			= '製品サイズ';
$lang['product_product_cost'] 			= '製品コスト';
$lang['product_product_price'] 			= 'ネットディーラー価格';
$lang['product_select_product_tax'] 	= '製品税の選択';
$lang['product_no_tax'] 				= '税なし';
$lang['product_product_image'] 			= '製品イメージ';
$lang['product_product_details'] 		= '請求書の商品詳細';
$lang['product_add'] 					= '追加';
$lang['product_cancel'] 				= 'キャンセル';
$lang['product_hsn'] 					= 'HSN';
$lang['product_sac'] 					= 'SAC';
$lang['product_chapter'] 				= '章';
$lang['product_hsn_code'] 				= 'HSNコード＃';
$lang['product_description'] 			= '説明';
$lang['product_sac_code'] 				= 'SACコード＃';
$lang['product_close'] 					= '閉じる';
$lang['product_apply'] 					= '適用';
$lang['header_edit_product'] 			= '製品の編集';
$lang['product_update'] 				= '更新';
$lang['product_delete_conform'] 		= 'このレコードを削除する ?';

//Product Alert
$lang['product_alert_pdf'] 				= 'PDF';
$lang['header_list_product_alert'] 		= '製品アラートの一覧';

//transfer
$lang['transfer_dashboard']	 		=	'Dashboard';
$lang['transfer_transfers']	 		=	'Transfers';
$lang['transfer_listtransfers']	 	=	'リスト転送';
$lang['transfer_add_new_transfer']	=	'新しい転送を追加';
$lang['transfer_no']	 			=	'いいえ';
$lang['transfer_date']	 			=	'日付';
$lang['transfer_warehouse_from'] 	=	'倉庫（から）';
$lang['transfer_warehouse_to']	 	=	'倉庫（まで）';
$lang['transfer_total']	 			=	'合計';
$lang['transfer_actions']	 		=	'行動';
$lang['transfer_add_transfer']	 	=	'転送を追加';
$lang['transfer_to_warehouse']	 	=	'倉庫へ';
$lang['transfer_from_warehouse']	=	'倉庫から';
$lang['transfer_select_product']	=	'製品を選択';
$lang['transfer_select']	 		=	'選択';
$lang['transfer_inventory_items']	=	'在庫品目';
$lang['transfer_code']	 			=	'コード';
$lang['transfer_quantity']	 		=	'量';
$lang['transfer_available_qty']	 	=	'利用可能な数量';
$lang['transfer_unit']	 			=	'単位';
$lang['transfer_cost']	 			=	'コスト';
$lang['transfer_sub_total']	 		=	'小計';
$lang['transfer_grand_total']	 	=	'総計 ';
$lang['transfer_note']	 			=	'注意';
$lang['transfer_add']	 			=	'追加';
$lang['transfer_edit_transfer']	 	=	'転送を編集';
$lang['transfer_save']	 			=	'セーブ';

//assaign warehouse
$lang['assign_warehouse']						=	"倉庫を割り当てる";
$lang['assign_warehouse_add_assign_warehouse']	=	"割当倉庫の追加";
$lang['assign_warehouse_user_name']				=	"ユーザー名";
$lang['assign_warehouse_select']				=	"選択";
$lang['assign_warehouse_warehouse_name']		=	"倉庫名";
$lang['assign_warehouse_cancel']				=	"キャンセル";
$lang['assign_warehouse_add']					=	"追加";
$lang['assign_warehouse_list_assign_warehouse']	=	"リスト倉庫割当";
$lang['assign_warehouse_no']					=	"いいえ";
$lang['assign_warehouse_actions']				=	"行動";

//Purchase
$lang['purchase_list_purchase'] 		= 'リスト倉庫割当';
$lang['purchase_add_new_purchase'] 		= 'いいえ';
$lang['purchase_date'] 					= '行動';
$lang['purchase_reference_no'] 			= '参照番号';
$lang['purchase_supplier'] 				= 'サプライヤー';
$lang['purchase_purchase_status'] 		= '購入ステータス';
$lang['purchase_grand_total'] 			= '総計';
$lang['purchase_received'] 				= '受け取った';
$lang['purchase_purchase_details'] 		= '購入の詳細';
$lang['purchase_edit_purchase'] 		= '購入編集';
$lang['purchase_download_as_pdf'] 		= 'PDfとしてダウンロード';
$lang['purchase_email_purchase'] 		= '電子メールの購入';
$lang['purchase_delete_purchase'] 		= '購入を削除する';
$lang['purchase_add_purchase'] 			= '購入を追加';
$lang['purchase_select_warehouse'] 		= '倉庫を選択';
$lang['purchase_select_supplier'] 		= '倉庫を選択';
$lang['purchase_select_product'] 		= '製品を選択';
$lang['purchase_inventory_items'] 		= '在庫品目';
$lang['purchase_product_description'] 	= '製品説明';
$lang['purchase_sub_total'] 			= '小計';
$lang['purchase_taxable_value'] 		= '課税上の価値';
$lang['purchase_total'] 				= '合計';
$lang['purchase_total_value'] 			= '総価値';
$lang['purchase_total_discount'] 		= '合計割引';
$lang['purchase_total_tax'] 			= '総税額';
$lang['purchase_note'] 					= '注意';
$lang['purchase_total_sales'] 			= 'トータルセールス';
$lang['purchase_total_amount'] 			= '合計金額';
$lang['purchase_edit'] 					= '編集';
$lang['purchase_delete'] 				= '削除';
$lang['purchase_to'] 					= 'に';
$lang['purchase_from'] 					= 'から';
$lang['purchase_mobile'] 				= 'モバイル';
$lang['purchase_ordered_by'] 			= 'によって順序付け';
$lang['purchase_stamp_and_signature']	= 'スタンプ＆シグネチャー';

//Purchase Return
$lang['purchase_return_list_purchase_return'] 		= 'リストの購入返品';
$lang['purchase_return_add_new_purchase_return'] 	= '新規購入返品を追加する';
$lang['purchase_return_add_purchase_return'] 		= '購入返品を追加する';
$lang['purchase_return_grand_total'] 				= '総計：0.00';
$lang['purchase_return_edit_purchase_return'] 		= '購入返品の編集';
$lang['purchase_return_edit_grand_total'] 			= '総計 :';

//sales
$lang['sales_list_sales'] 				= 'リストセールス';
$lang['sales_add_new_sales'] 			= '新しい販売を追加する';
$lang['sales_biller'] 					= 'ビラー';
$lang['sales_client'] 				= '顧客';
$lang['sales_sales_status'] 			= '販売状況';
$lang['sales_payment_status'] 			= '支払い状況';
$lang['sales_paid'] 					= '有料';
$lang['sales_complited'] 				= '合併';
$lang['sales_pending'] 					= '保留中';
$lang['sales_sales_details'] 			= '販売の詳細';
$lang['sales_add_payment'] 				= 'お支払いの追加';
$lang['sales_edit_sales'] 				= '販売を編集する';
$lang['sales_email_sales'] 				= 'メールでの販売';
$lang['sales_delete_sales'] 			= '販売を削除する';
$lang['sales_add_sales'] 				= '販売を追加する';
$lang['sales_select_biller'] 			= 'ビラーを選択';
$lang['sales_select_client'] 			= '顧客を選択';
$lang['sales_internal_note'] 			= '内部メモ';
$lang['sales_status'] 					= '状態';
$lang['sales_balance'] 					= 'バランス';
$lang['sales_invoice'] 					= '請求書';
$lang['sales_client_details'] 		= 'お客様情報';
$lang['sales_pos'] 						= 'POS';
$lang['sales_invoice_hash'] 			= '請求書 ＃';
$lang['sales_address'] 					= '住所';
$lang['sales_product_wise_details'] 	= '製品別の詳細';
$lang['sales_cgst'] 					= 'CGST';
$lang['sales_sgst'] 					= 'SGST';
$lang['sales_igst'] 					= 'IGST';
$lang['sales_total_sales'] 				= '売上高合計';
$lang['sales_remarks'] 					= '備考:';
$lang['sales_summary'] 					= '概要';
$lang['sales_amount'] 					= '量';
$lang['sales_total_invoice_value'] 		= '合計請求金額';
$lang['sales_total_cgst'] 				= '合計CGST';
$lang['sales_receivers_signature'] 		= '受信者の署名';
$lang['sales_senior_accounts_manager'] 	= 'シニアアカウントマネージャー';
$lang['sales_total_sgst'] 				= 'SGSTの合計';
$lang['slaes_invoice_note'] 			= '注：すべての小切手を会社名に支払う';
$lang['sales_igst'] 					= 'IGSTの合計';
$lang['sales_thank_you'] 				= 'お買い上げくださってありがとうございます';
$lang['sales_edit_sales'] 				= '販売を編集する';
$lang['sales_pay']		 				= '支払う';
$lang['sales_list_invoice']		 		= '請求書の一覧';
$lang['sales_sales_amount']		 		= '売上高';
$lang['sales_paid_amount']		 		= '支払金額';
$lang['sales_invoice_no']		 		= '請求書番号';

//Sales Return
$lang['sales_return_list_sales_return'] 	= 'リストラ';
$lang['sales_return_add_new_sales_return'] 	= '新しいセールスリターンを追加する';
$lang['sales_return_add_sales_return'] 		= 'セールスリターンを追加';
$lang['sales_return_edit_sales_return'] 	= '販売返品の編集';

//payment
$lang['payment_list_payment'] 				= 'お支払いの一覧';
$lang['payment_paying_by'] 					= '支払い元';
$lang['payment_edit_payment'] 				= '支払いの編集';
$lang['payment_bank_name'] 					= '銀行名';
$lang['payment_cheque_no'] 					= 'チェックNo';
$lang['sales_amount'] 						= '量';

//Reports
$lang['reports_daily_reports'] 				= '日報';
$lang['reports_current_month_sales'] 		= '当月売上高 :';
$lang['reports_profite'] 					= '利益 :';
$lang['reports_product_reports'] 			= '製品レポート';
$lang['reports_start_date'] 				= '開始日';
$lang['reports_end_date'] 					= '終了日';
$lang['reports_purchased'] 					= '購入した';
$lang['reports_sold'] 						= '売れた';
$lang['reports_profite_title'] 				= 'プロフィール';
$lang['reports_purchase_reports'] 			= '購入レポート';
$lang['reports_created_by'] 				= 'によって作成された ';
$lang['reports_supplier'] 					= 'サプライヤー';
$lang['reports_product_qty'] 				= '製品（数量）';
$lang['reports_hide_show'] 					= '表示/非表示';
$lang['reports_submit'] 					= '提出する';
$lang['reports_purchase_return_reports'] 	= '購入リターンレポート';
$lang['reports_sales_reports'] 				= '営業報告書';
$lang['reports_biller'] 					= 'ビラー';
$lang['reports_client'] 					= '顧客';
$lang['reports_sales_return_reports'] 		= 'セールスリターン';

//Dashboard
$lang['dashboard_today'] 					= '今日';
$lang['dashboard_this_week'] 				= '今週';
$lang['dashboard_this_month'] 				= '今月';
$lang['dashboard_this_year'] 				= '今年';
$lang['dashboard_all_time'] 				= 'すべての時間';
$lang['dashboard_new_items'] 				= '新しいアイテム';
$lang['dashboard_purchase_item'] 			= '購入したアイテム';
$lang['dashboard_sold_items'] 				= '販売アイテム';
$lang['dashboard_purchase_value'] 			= '購入価額';
$lang['dashboard_sales_value'] 				= '販売価格';
$lang['dashboard_yearly_sales'] 			= '年間売上高';
$lang['dashboard_total_sales'] 				= 'トータルセールス';
$lang['dashboard_value_in_warehouse'] 		= '倉庫の価値';
$lang['dashboard_warehouse_products'] 		= '倉庫製品';
$lang['dashboard_no_of_items'] 				= 'アイテム数';
$lang['dashboard_rights_reserved'] 			= '権利予約。';
$lang['dashboard_copyright'] 				= '著作権';
$lang['dashboard_version'] 					= 'バージョン';
$lang['dashboard_month'] 					= '月';
$lang['dashboard_sales_performance'] 		= '販売実績';
$lang['dashboard_sales_of_company'] 		= '会社の売上';


/***   User    ***/

$lang['user_lable'] 	   		= 'ユーザー';
$lang['user_lable_header'] 		= 'ユーザーを一覧表示する';
$lang['user_btn_new'] 	   		= '新しいユーザーを追加';
$lang['user_lable_fname']  		= 'ファーストネーム';
$lang['user_lable_lname']  		= '苗字';
$lang['user_lable_email']  		= 'Eメール';
$lang['user_lable_group']  		= 'グループ';
$lang['user_lable_status'] 		= '状態';
$lang['user_lable_action'] 		= 'アクション';
$lang['add_user_header'] 		= 'ユーザーを追加する';
$lang['add_user_label'] 		= '新しいユーザーを追加';
$lang['add_user_company'] 		= '会社名';
$lang['add_user_mobile'] 		= 'モバイル番号';
$lang['add_user_password'] 	   	= 'パスワード';
$lang['add_user_confpassword'] 	= 'パスワードを認証する';
$lang['add_user_btn'] 			= '追加';
$lang['add_user_btn_cancel'] 	= 'キャンセル';
$lang['edit_user_header'] 		= 'ユーザーの編集';
$lang['edit_user_member'] 		= 'グループのメンバー';
$lang['edit_user_btn'] 			= '更新';



/*****   Billers ***/

$lang['biller_lable'] 	   		= 'ビラーズ';
$lang['biller_header'] 	   		= 'ビラーズのリスト';
$lang['biller_btn_add'] 	   	= '新しいビラーズを追加';
$lang['biller_lable_no'] 	   	= 'いいえ';
$lang['biller_lable_name'] 	   	= '名';
$lang['biller_lable_company'] 	= '会社';
$lang['biller_lable_phone'] 	= '電話';
$lang['biller_lable_email'] 	= '電子メールアドレス';
$lang['biller_lable_city'] 	    = 'シティ';
$lang['biller_lable_country'] 	= '国';
$lang['biller_lable_action'] 	= 'アクション';


$lang['add_biller_label'] 		= 'ビラーを追加';
$lang['add_biller_header'] 		= '新しいビラーを追加';
$lang['add_biller_billname'] 	= '請求書の名前';
$lang['add_biller_gst'] 		= 'GSTIN';
$lang['add_biller_select_branch'] = '支店を選択';
$lang['add_biller_select']      = '選択';
$lang['add_biller_address'] 	= '住所';
$lang['add_biller_state'] 		= '状態';
$lang['add_biller_fax'] 		= 'ファックス';
$lang['add_biller_telephone'] 	= '電話';
$lang['add_biller_mobile'] 		= 'モバイル';
$lang['edit_biller_header'] 	= 'ビラーの編集';
$lang['edit_biller_btn'] 		= '更新';

/***** Clients *******/

$lang['client_header'] 		= '顧客';
$lang['client_label'] 		= '顧客リスト';
$lang['client_btn_add'] 		= '新規顧客を追加';
$lang['add_client_label'] 	= '顧客を追加';
$lang['add_client_header'] 	= '新規顧客を追加';
$lang['add_client_cname'] 	= '顧客名';
$lang['add_client_compname'] 	= '会社名';
$lang['add_client_code'] 		= '郵便番号';
$lang['edit_client_header'] 	= '顧客の編集';


/****** Supplier ****/

$lang['supplier_header'] 		= 'サプライヤー';
$lang['supplier_label'] 		= 'サプライヤを一覧表示する';
$lang['supplier_btn_add'] 		= '新しいサプライヤを追加';
$lang['supplier_add'] 			= 'サプライヤを追加';
$lang['add_supplier_name'] 		= 'サプライヤ名';
$lang['edit_supplier_header'] 	= 'サプライヤを編集する';


/**** Warehouse *********/

$lang['warehouse_header'] 		= '倉庫';
$lang['warehouse_label'] 		= 'リストウェアハウス';
$lang['warehouse_label_no'] 	= 'いいえ';
$lang['warehouse_label_wname'] 	= '倉庫名';
$lang['warehouse_label_bname'] 	= '支店名';
$lang['warehouse_label_uname'] 	= 'ユーザー名';
$lang['warehouse_label_action'] = '行動';
$lang['warehouse_btn_new'] 		= '新しい倉庫を追加';
$lang['add_warehouse'] 			= '倉庫を追加';
$lang['add_warehouse_name'] 	= '倉庫名';
$lang['edit_warehouse_header'] 	= '倉庫を編集';

//Category

$lang['category_add'] 						= '追加';
$lang['category_cancel'] 					= 'キャンセル';
$lang['category_lable'] 					= 'カテゴリー';
$lang['category_lable_addcategory'] 		= 'カテゴリを追加';
$lang['category_lable_editcategory'] 		= 'カテゴリーを編集';
$lang['category_lable_no'] 					= 'いいえ';
$lang['category_lable_code'] 				= 'カテゴリコード';
$lang['category_lable_cname'] 				= '種別名';
$lang['category_lable_actions'] 			= '行動';
$lang['category_lable_lcategory'] 			= 'リストのカテゴリ';
$lang['category_lable_newcategory'] 		= '新しいカテゴリを追加';

//Subcategory
$lang['subcategory_add'] 					= '追加';
$lang['subcategory_cancel'] 				= 'キャンセル';
$lang['subcategory_update'] 				= '更新';
$lang['subcategory_label'] 					= 'サブカテゴリ';
$lang['subcategory_label_add'] 				= 'サブカテゴリを追加';
$lang['subcategory_newcategory'] 			= '新しいサブカテゴリを追加';
$lang['subcategory_label_select'] 			= 'カテゴリを選んでください';
$lang['subcategory_label_name'] 			= 'サブカテゴリ名';
$lang['subcategory_label_listcategory'] 	= 'サブカテゴリのリスト';
$lang['subcategory_cancel'] 				= 'キャンセル';
$lang['subcategory_label_code'] 			= 'サブカテゴリコード';
$lang['subcategory_label_main'] 			= '主要カテゴリ';
$lang['subcategory_label_name'] 			= 'サブカテゴリ名';
$lang['subcategory_label_edit'] 			= 'サブカテゴリの編集';

//Branch
$lang['branch_label'] 						= 'ブランチ';
$lang['branch_label_name'] 					= '支店名';
$lang['branch_label_city'] 					= 'シティ';
$lang['branch_label_address'] 				= '住所';
$lang['branch_label_add'] 					= '追加';
$lang['branch_label_newbranch'] 			= '新しい支店を追加';
$lang['branch_label_cancel'] 				= 'キャンセル';
$lang['branch_label_addbranch'] 			= 'ブランチを追加';
$lang['branch_label_edit'] 					= '支店を編集';

//Discount

$lang['discount_label_name'] 				= 'ディスカウント名';
$lang['discount_label_value'] 				= '割引価値';
$lang['discount_label'] 					= 'ディスカウント';
$lang['discount_label_username'] 			= 'ユーザー名';
$lang['discount_label_add']					= '追加';
$lang['discount_label_newbranch'] 			= '新しい割引を追加';
$lang['discount_label_cancel'] 				= 'キャンセル';
$lang['discount_label_addbranch'] 			= '追加割引';
$lang['discount_label_list'] 				= 'リストディスカウント';
$lang['discount_label_edit'] 				= '編集割引';
$lang['discount_label_update'] 				= '更新';

//Tax

$lang['tax_label_name'] 				= '税名';
$lang['tax_label_form'] 				= 'から始まる';
$lang['tax_label_rnumber'] 				= '登録番号';
$lang['tax_label_frequency'] 			= '充填頻度';
$lang['tax_label_desc'] 				= '説明';
$lang['tax_label_applies'] 				= '税金は';
$lang['tax_label_calculate'] 			= 'オンに計算する';
$lang['tax_label_salesrate'] 			= '売上税率';
$lang['tax_label_addnew'] 				= '新しい税金を追加する';
$lang['tax_label_add'] 					= '税を追加する';
$lang['tax_label_purchaserate'] 		= '購入税率';
$lang['tax_label_list'] 				= 'リスト税';
$lang['tax_label'] 						= '税金';
$lang['tax_label_Edit'] 				= '税金を編集する';