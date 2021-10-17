<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Name:  Auth Lang - Russian
 *
 * Author: Ben Edmunds
 * 		  ben.edmunds@gmail.com
 *         @benedmunds
 *
 * Author: Daniel Davis
 *         @ourmaninjapan
 *
 * Translation: Ievgen Sentiabov
 *         @joni-jones
 *
 * Location: http://github.com/benedmunds/ion_auth/
 *
 * Created:  03.09.2013
 *
 * Description:  Russian language file for Ion Auth views
 *
 */

// Errors
$lang['error_csrf'] = 'Форма не прошла проверку безопасности.';

// Login
$lang['login_heading']         = 'Вход';
$lang['login_subheading']      = 'Для входа используйте email/имя пользователя и пароль.';
$lang['login_identity_label']  = 'Email:';
$lang['login_password_label']  = 'Пароль:';
$lang['login_remember_label']  = 'Запомнить меня:';
$lang['login_submit_btn']      = 'Вход';
$lang['login_forgot_password'] = 'Забыли свой пароль?';

// Index
$lang['index_heading']           = 'Пользователь';
$lang['index_subheading']        = 'Доступный список пользователей.';
$lang['index_fname_th']          = 'Имя';
$lang['index_lname_th']          = 'Фамилия';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Группы';
$lang['index_status_th']         = 'Статус';
$lang['index_action_th']         = 'Действие';
$lang['index_active_link']       = 'Активный';
$lang['index_inactive_link']     = 'Неактивный';
$lang['index_create_user_link']  = 'Создать нового пользователя';
$lang['index_create_group_link'] = 'Создать новую группу';

// Deactivate User
$lang['deactivate_heading']                  = 'Деактивировать пользователя';
$lang['deactivate_subheading']               = 'Вы уверены, что хотите деактивировать пользователя \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Да:';
$lang['deactivate_confirm_n_label']          = 'Нет:';
$lang['deactivate_submit_btn']               = 'Отправить';
$lang['deactivate_validation_confirm_label'] = 'подтверждение';
$lang['deactivate_validation_user_id_label'] = 'ID пользователя';

// Create User
$lang['create_user_heading']                           = 'Создать пользователя';
$lang['create_user_subheading']                        = 'Пожалуйста заполните следующую информацию.';
$lang['create_user_fname_label']                       = 'Имя:';
$lang['create_user_lname_label']                       = 'Фамилия:';
$lang['create_user_identity_label']                    = 'Identity:';
$lang['create_user_company_label']                     = 'Компания:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_phone_label']                       = 'Телефон:';
$lang['create_user_password_label']                    = 'Пароль:';
$lang['create_user_password_confirm_label']            = 'Подтверждение пароля:';
$lang['create_user_submit_btn']                        = 'Создать пользователя';
$lang['create_user_validation_fname_label']            = 'Имя';
$lang['create_user_validation_lname_label']            = 'Фамилия';
$lang['create_user_validation_identity_label']         = 'Identity';
$lang['create_user_validation_email_label']            = 'Email';
$lang['create_user_validation_phone1_label']           = 'Первая часть телефона';
$lang['create_user_validation_phone2_label']           = 'Вторая часть телефона';
$lang['create_user_validation_phone3_label']           = 'Третья часть телефона';
$lang['create_user_validation_company_label']          = 'Компания';
$lang['create_user_validation_password_label']         = 'Пароль';
$lang['create_user_validation_password_confirm_label'] = 'Подтверждение пароля';

// Edit User
$lang['edit_user_heading']                           = 'Редактировать пользователя';
$lang['edit_user_subheading']                        = 'Пожалуйста заполните информацию ниже.';
$lang['edit_user_fname_label']                       = 'Имя:';
$lang['edit_user_lname_label']                       = 'Фамилия:';
$lang['edit_user_company_label']                     = 'Название компании:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Телефон:';
$lang['edit_user_password_label']                    = 'Пароль: (если изменился)';
$lang['edit_user_password_confirm_label']            = 'Подтвердить пароль: (если изменился)';
$lang['edit_user_groups_heading']                    = 'Член группы';
$lang['edit_user_submit_btn']                        = 'Сохранить пользователя';
$lang['edit_user_validation_fname_label']            = 'Имя';
$lang['edit_user_validation_lname_label']            = 'Фамилия';
$lang['edit_user_validation_email_label']            = 'Email';
$lang['edit_user_validation_phone1_label']           = 'Первая часть телефона';
$lang['edit_user_validation_phone2_label']           = 'Вторая часть телефона';
$lang['edit_user_validation_phone3_label']           = 'Третья часть телефона';
$lang['edit_user_validation_company_label']          = 'Компания';
$lang['edit_user_validation_groups_label']           = 'Группы';
$lang['edit_user_validation_password_label']         = 'Пароль';
$lang['edit_user_validation_password_confirm_label'] = 'Подтверждение пароля';

// Create Group
$lang['create_group_title']                  = 'Создать группу';
$lang['create_group_heading']                = 'Создать группу';
$lang['create_group_subheading']             = 'Пожалуйста заполните следующую информацию.';
$lang['create_group_name_label']             = 'Группа:';
$lang['create_group_desc_label']             = 'Описание:';
$lang['create_group_submit_btn']             = 'Создать группу';
$lang['create_group_validation_name_label']  = 'Группа';
$lang['create_group_validation_desc_label']  = 'Описание';

// Edit Group
$lang['edit_group_title']                  = 'Редактировать группу';
$lang['edit_group_saved']                  = 'Группа сохранена';
$lang['edit_group_heading']                = 'Редактировать группу';
$lang['edit_group_subheading']             = 'Пожалуйста заполните следующую информацию.';
$lang['edit_group_name_label']             = 'Название группы:';
$lang['edit_group_desc_label']             = 'Описание:';
$lang['edit_group_submit_btn']             = 'Сохранить группу';
$lang['edit_group_validation_name_label']  = 'Группа';
$lang['edit_group_validation_desc_label']  = 'Описание';

// Change Password
$lang['change_password_heading']                               = 'Изменить пароль';
$lang['change_password_old_password_label']                    = 'Старый пароль:';
$lang['change_password_new_password_label']                    = 'Новый пароль (минимум %s символов):';
$lang['change_password_new_password_confirm_label']            = 'Подтвердить пароль:';
$lang['change_password_submit_btn']                            = 'Изменить';
$lang['change_password_validation_old_password_label']         = 'Старый пароль';
$lang['change_password_validation_new_password_label']         = 'Новый пароль';
$lang['change_password_validation_new_password_confirm_label'] = 'Подтвердить пароль';

// Forgot Password
$lang['forgot_password_heading']                 = 'Забыли пароль';
$lang['forgot_password_subheading']              = 'Пожалуйста введите ваш email и мы сможем отправить вам email с новым паролем.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Отправить';
$lang['forgot_password_validation_email_label']  = 'Email';
$lang['forgot_password_username_identity_label'] = 'Логин';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_back']    = 'Вернуться';
$lang['forgot_password_email_not_found']         = 'No record of that email address.';
$lang['forgot_password_identity_not_found']         = 'No record of that username address.';

// Reset Password
$lang['reset_password_heading']                               = 'Изменить пароль';
$lang['reset_password_new_password_label']                    = 'Новый пароль (минимум 8 символов):';
$lang['reset_password_new_password_confirm_label']            = 'Подвердить:';
$lang['reset_password_submit_btn']                            = 'Изменить';
$lang['reset_password_validation_new_password_label']         = 'Новый пароль';
$lang['reset_password_validation_new_password_confirm_label'] = 'Подтвердить';

// Activation Email
$lang['email_activate_heading']    = 'Активировать аккаунт для %s';
$lang['email_activate_subheading'] = 'Пожалуйста перейдите по ссылке для %s.';
$lang['email_activate_link']       = 'Активировать аккаунт';

// Forgot Password Email
$lang['email_forgot_password_heading']    = 'Сбросить пароль для %s';
$lang['email_forgot_password_subheading'] = 'Пожалуста по ссылке для %s.';
$lang['email_forgot_password_link']       = 'Сбросить пароль';

// New Password Email
$lang['email_new_password_heading']    = 'Новый пароль для %s';
$lang['email_new_password_subheading'] = 'Пароль был сброшен для: %s';

// Header
$lang['header_sign_out'] = 'Выйти';
$lang['header_online'] = 'В сети';
$lang['header_main_navidation'] = 'ОСНОВНАЯ НАВИГАЦИЯ';
$lang['header_dashboard'] = 'Панель приборов';
$lang['header_product'] = 'Продукт';
$lang['header_list'] 				= 'Список';
$lang['header_add'] 				= 'Добавить';
$lang['header_product_alert'] 		= 'Оповещение о продукте';
$lang['header_purchase'] 			= 'покупка';
$lang['header_purchase_return'] 	= 'Возврат к покупке';
$lang['header_transfers'] 			= 'переводы';
$lang['header_sales'] 				= 'Продажи';
$lang['header_sales_return'] 		= 'Возвращение продаж';
$lang['header_payment'] 			= 'Оплата';
$lang['header_invoice'] 			= 'Выставленный счет';
$lang['header_reports'] 			= 'Отчеты';
$lang['header_daily'] 				= 'Ежедневно';
$lang['header_people'] 				= 'люди';
$lang['header_users'] 				= 'пользователей';
$lang['header_billers'] 			= 'выставителя';
$lang['header_clients'] 			= 'Клиенты';
$lang['header_suppliers'] 			= 'Поставщики';
$lang['header_setting'] 			= 'настройка';
$lang['header_company_setting'] 	= 'Настройка компании';
$lang['header_category'] 			= 'категория';
$lang['header_sub_category'] 		= 'Подкатегория';
$lang['header_branch'] 				= 'Филиал';
$lang['header_brand']				= 'марка';	
$lang['header_discount'] 			= 'скидка';
$lang['header_tax'] 				= 'налог';
$lang['header_warehouse'] 			= 'Склад';
$lang['header_assign_warehouse'] 	= 'Назначить склад';

//Company Settings
$lang['company_setting_name'] 				= 'имя';
$lang['company_setting_site_short_name'] 	= 'Краткое название сайта';
$lang['company_setting_country'] 			= 'Страна';
$lang['company_setting_select'] 			= 'Выбрать';
$lang['company_setting_state'] 				= 'состояние';
$lang['company_setting_city'] 				= 'город';
$lang['company_setting_street'] 			= 'улица';
$lang['company_setting_zip_code'] 			= 'Почтовый Индекс';
$lang['company_setting_email'] 				= 'Эл. адрес';
$lang['company_setting_mobile'] 			= 'мобильный';
$lang['company_setting_default_language'] 	= 'Язык по умолчанию';
$lang['company_setting_default_currency'] 	= 'Валюта по умолчанию';
$lang['company_setting_submit'] 			= 'Отправить';
$lang['company_setting_cancel'] 			= 'Отмена';

//Product
$lang['product_list_product'] 			= 'Список продуктов';
$lang['product_add_new_product'] 		= 'Добавить новый продукт';
$lang['product_no'] 					= 'нет';
$lang['product_image'] 					= 'Образ';
$lang['product_code'] 					= 'Код';
$lang['product_hsn_sac_code'] 			= 'Код HSN / SAC';
$lang['product_name'] 					= 'Name';
$lang['product_category'] 				= 'имя';
$lang['product_cost'] 					= 'Стоимость';
$lang['product_price'] 					= 'Цена';
$lang['product_quantity'] 				= 'Количество';
$lang['product_unit'] 					= 'Ед. изм';
$lang['product_alert_quantity'] 		= 'Количество предупреждений';
$lang['product_available_quantity'] 	= 'Доступное количество';
$lang['product_action'] 				= 'действие';
$lang['product_add_product'] 			= 'Добавить продукт';
$lang['product_product_code'] 			= 'Код продукта';
$lang['product_product_name'] 			= 'наименование товара';
$lang['product_hsn_sac_lookup'] 		= 'Поиск HSN / SAC';
$lang['product_select_category'] 		= 'выберите категорию';
$lang['product_select'] 				= 'Выбрать';
$lang['product_select_subcategory'] 	= 'Выберите подкатегорию';
$lang['product_product_unit'] 			= 'Продукт';
$lang['product_product_size'] 			= 'Размер товара';
$lang['product_product_cost'] 			= 'Стоимость продукта';
$lang['product_product_price'] 			= 'Чистая цена дилера';
$lang['product_select_product_tax'] 	= 'Выберите налог на продукт';
$lang['product_no_tax'] 				= 'No Tax';
$lang['product_product_image'] 			= 'Нет налога';
$lang['product_product_details'] 		= 'Деталь продукта для счета-фактуры';
$lang['product_add'] 					= 'Добавить';
$lang['product_cancel'] 				= 'Отмена';
$lang['product_hsn'] 					= 'HSN';
$lang['product_sac'] 					= 'SAC';
$lang['product_chapter'] 				= 'глава';
$lang['product_hsn_code'] 				= 'HSN-коды #';
$lang['product_description'] 			= 'Описание';
$lang['product_sac_code'] 				= 'Коды SAC #';
$lang['product_close'] 					= 'Закрыть';
$lang['product_apply'] 					= 'Подать заявление';
$lang['header_edit_product'] 			= 'Изменить продукт';
$lang['product_update'] 				= 'Обновить';
$lang['product_delete_conform'] 		= 'Конечно, чтобы удалить эту запись?';

//Product Alert
$lang['product_alert_pdf'] 				= 'PDF';
$lang['header_list_product_alert'] 		= 'Список продуктов';

//transfer
$lang['transfer_dashboard']	 		=	'Панель приборов';
$lang['transfer_transfers']	 		=	'переводы';
$lang['transfer_listtransfers']	 	=	'Список трансферов';
$lang['transfer_add_new_transfer']	=	'Добавить новую передачу';
$lang['transfer_no']	 			=	'нет';
$lang['transfer_date']	 			=	'Дата';
$lang['transfer_warehouse_from'] 	=	'Склад (С)';
$lang['transfer_warehouse_to']	 	=	'Склад (К)';
$lang['transfer_total']	 			=	'Всего';
$lang['transfer_actions']	 		=	'действия';
$lang['transfer_add_transfer']	 	=	'Добавить перевод';
$lang['transfer_to_warehouse']	 	=	'Склад';
$lang['transfer_from_warehouse']	=	'От склада';
$lang['transfer_select_product']	=	'Выберите продукт';
$lang['transfer_select']	 		=	'Выбрать';
$lang['transfer_inventory_items']	=	'Элементы инвентаря';
$lang['transfer_code']	 			=	'Код';
$lang['transfer_quantity']	 		=	'Количество';
$lang['transfer_available_qty']	 	=	'Доступное количество';
$lang['transfer_unit']	 			=	'Ед. изм';
$lang['transfer_cost']	 			=	'Стоимость';
$lang['transfer_sub_total']	 		=	'Промежуточный итог';
$lang['transfer_grand_total']	 	=	'Общая сумма ';
$lang['transfer_note']	 			=	'Заметка';
$lang['transfer_add']	 			=	'Добавить';
$lang['transfer_edit_transfer']	 	=	'Изменить передачу';
$lang['transfer_save']	 			=	'Сохранить';

//assaign warehouse
$lang['assign_warehouse']						=	"Назначить склад";
$lang['assign_warehouse_add_assign_warehouse']	=	"Назначить склад";
$lang['assign_warehouse_user_name']				=	"Имя пользователя";
$lang['assign_warehouse_select']				=	"Выбрать";
$lang['assign_warehouse_warehouse_name']		=	"Название склада";
$lang['assign_warehouse_cancel']				=	"Отмена";
$lang['assign_warehouse_add']					=	"Добавить";
$lang['assign_warehouse_list_assign_warehouse']	=	"Список Назначить Склад";
$lang['assign_warehouse_no']					=	"нет";
$lang['assign_warehouse_actions']				=	"действия";

//Purchase
$lang['purchase_list_purchase'] 		= 'Список покупок';
$lang['purchase_add_new_purchase'] 		= 'Добавить новую покупку';
$lang['purchase_date'] 					= 'Дата';
$lang['purchase_reference_no'] 			= 'Ссылка №';
$lang['purchase_supplier'] 				= 'поставщик';
$lang['purchase_purchase_status'] 		= 'Статус покупки';
$lang['purchase_grand_total'] 			= 'Общая сумма';
$lang['purchase_received'] 				= 'Получено';
$lang['purchase_purchase_details'] 		= 'Сведения о покупке';
$lang['purchase_edit_purchase'] 		= 'Изменить покупку';
$lang['purchase_download_as_pdf'] 		= 'Загрузить как PDF';
$lang['purchase_email_purchase'] 		= 'Покупка электронной почты';
$lang['purchase_delete_purchase'] 		= 'Удалить покупку';
$lang['purchase_add_purchase'] 			= 'Добавить покупку';
$lang['purchase_select_warehouse'] 		= 'Выберите Склад';
$lang['purchase_select_supplier'] 		= 'Выбрать поставщика';
$lang['purchase_select_product'] 		= 'Выберите продукт';
$lang['purchase_inventory_items'] 		= 'Элементы инвентаря';
$lang['purchase_product_description'] 	= 'описание продукта';
$lang['purchase_sub_total'] 			= 'Промежуточный итог';
$lang['purchase_taxable_value'] 		= 'Налогооблагаемая стоимость';
$lang['purchase_total'] 				= 'Всего';
$lang['purchase_total_value'] 			= 'Общая стоимость';
$lang['purchase_total_discount'] 		= 'Общая скидка';
$lang['purchase_total_tax'] 			= 'Общий налог';
$lang['purchase_note'] 					= 'Заметка';
$lang['purchase_total_sales'] 			= 'Тотальная распродажа';
$lang['purchase_total_amount'] 			= 'Итого';
$lang['purchase_edit'] 					= 'редактировать';
$lang['purchase_delete'] 				= 'Удалить';
$lang['purchase_to'] 					= 'к';
$lang['purchase_from'] 					= 'Из';
$lang['purchase_mobile'] 				= 'мобильный';
$lang['purchase_ordered_by'] 			= 'Заказан';
$lang['purchase_stamp_and_signature']	= 'Штамп и подпись';

//Purchase Return
$lang['purchase_return_list_purchase_return'] 		= 'Список покупок';
$lang['purchase_return_add_new_purchase_return'] 	= 'Добавить новую покупку';
$lang['purchase_return_add_purchase_return'] 		= 'Добавить покупку';
$lang['purchase_return_grand_total'] 				= 'Всего: 0,00';
$lang['purchase_return_edit_purchase_return'] 		= 'Изменить возврат покупки';
$lang['purchase_return_edit_grand_total'] 			= 'Общая сумма :';

//sales
$lang['sales_list_sales'] 				= 'Список продаж';
$lang['sales_add_new_sales'] 			= 'Добавить новые продажи';
$lang['sales_biller'] 					= 'Биллер';
$lang['sales_client'] 				= 'Клиент';
$lang['sales_sales_status'] 			= 'Статус продаж';
$lang['sales_payment_status'] 			= 'Статус платежа';
$lang['sales_paid'] 					= 'оплаченный';
$lang['sales_complited'] 				= 'Complited';
$lang['sales_pending'] 					= 'в ожидании';
$lang['sales_sales_details'] 			= 'Информация о продажах';
$lang['sales_add_payment'] 				= 'Добавить платеж';
$lang['sales_edit_sales'] 				= 'Редактировать продажи';
$lang['sales_email_sales'] 				= 'Электронная почта';
$lang['sales_delete_sales'] 			= 'Удалить продажи';
$lang['sales_add_sales'] 				= 'Добавить продажи';
$lang['sales_select_biller'] 			= 'Выберите «Биллер»';
$lang['sales_select_client'] 			= 'Выбрать клиента';
$lang['sales_internal_note'] 			= 'Внутренняя заметка';
$lang['sales_status'] 					= 'Положение дел';
$lang['sales_balance'] 					= 'Баланс';
$lang['sales_invoice'] 					= 'Выставленный счет';
$lang['sales_client_details'] 		= 'Информация о клиенте';
$lang['sales_pos'] 						= 'POS';
$lang['sales_invoice_hash'] 			= 'Выставленный счет #';
$lang['sales_address'] 					= 'Адрес';
$lang['sales_product_wise_details'] 	= 'Информация о продукте';
$lang['sales_cgst'] 					= 'CGST';
$lang['sales_sgst'] 					= 'SGST';
$lang['sales_igst'] 					= 'IGST';
$lang['sales_total_sales'] 				= 'Общий объем продаж';
$lang['sales_remarks'] 					= 'замечания:';
$lang['sales_summary'] 					= 'Резюме';
$lang['sales_amount'] 					= 'Количество';
$lang['sales_total_invoice_value'] 		= 'Общая стоимость счета';
$lang['sales_total_cgst'] 				= 'Всего CGST';
$lang['sales_receivers_signature'] 		= 'Подпись получателя';
$lang['sales_senior_accounts_manager'] 	= 'Старший менеджер по работе с клиентами';
$lang['sales_total_sgst'] 				= 'Всего SGST';
$lang['slaes_invoice_note'] 			= 'Примечание. Сделать все чеки, подлежащие оплате, на имя компании';
$lang['sales_igst'] 					= 'Всего IGST';
$lang['sales_thank_you'] 				= 'Спасибо за ваш бизнес';
$lang['sales_edit_sales'] 				= 'Редактировать продажи';
$lang['sales_pay']		 				= 'платить';
$lang['sales_list_invoice']		 		= 'Список счетов';
$lang['sales_sales_amount']		 		= 'Объем продаж';
$lang['sales_paid_amount']		 		= 'Выплаченная сумма';
$lang['sales_invoice_no']		 		= 'Счет-фактура Нет';

//Sales Return
$lang['sales_return_list_sales_return'] 	= 'Список продаж';
$lang['sales_return_add_new_sales_return'] 	= 'Добавить новый возврат продаж';
$lang['sales_return_add_sales_return'] 		= 'Добавить возврат продаж';
$lang['sales_return_edit_sales_return'] 	= 'Редактировать возврат продаж';

//payment
$lang['payment_list_payment'] 				= 'Список платежей';
$lang['payment_paying_by'] 					= 'Оплачивая';
$lang['payment_edit_payment'] 				= 'Изменить платеж';
$lang['payment_bank_name'] 					= 'Название банка';
$lang['payment_cheque_no'] 					= 'Проверить Нет';
$lang['sales_amount'] 						= 'Количество';

//Reports
$lang['reports_daily_reports'] 				= 'Ежедневные отчеты';
$lang['reports_current_month_sales'] 		= 'Продажи текущего месяца:';
$lang['reports_profite'] 					= 'Прибыль:';
$lang['reports_product_reports'] 			= 'Отчеты о продукции';
$lang['reports_start_date'] 				= 'Дата начала';
$lang['reports_end_date'] 					= 'Дата окончания';
$lang['reports_purchased'] 					= 'купленный';
$lang['reports_sold'] 						= 'Продан';
$lang['reports_profite_title'] 				= 'Profite';
$lang['reports_purchase_reports'] 			= 'Отчеты о покупке';
$lang['reports_created_by'] 				= 'Сделано ';
$lang['reports_supplier'] 					= 'поставщик';
$lang['reports_product_qty'] 				= 'Продукт (кол-во)';
$lang['reports_hide_show'] 					= 'Скрыть / Показать';
$lang['reports_submit'] 					= 'Отправить';
$lang['reports_purchase_return_reports'] 	= 'Отчеты о возврате прибыли';
$lang['reports_sales_reports'] 				= 'Отчеты по продажам';
$lang['reports_biller'] 					= 'Биллер';
$lang['reports_client'] 					= 'Клиент';
$lang['reports_sales_return_reports'] 		= 'Возвращение продаж';

//Dashboard
$lang['dashboard_today'] 					= 'Cегодня';
$lang['dashboard_this_week'] 				= 'На этой неделе';
$lang['dashboard_this_month'] 				= 'Этот месяц';
$lang['dashboard_this_year'] 				= 'В этом году';
$lang['dashboard_all_time'] 				= 'Все время';
$lang['dashboard_new_items'] 				= 'Новые предметы';
$lang['dashboard_purchase_item'] 			= 'Приобретенный товар';
$lang['dashboard_sold_items'] 				= 'Проданные товары';
$lang['dashboard_purchase_value'] 			= 'Покупная стоимость';
$lang['dashboard_sales_value'] 				= 'Объем продаж';
$lang['dashboard_yearly_sales'] 			= 'Ежегодные продажи';
$lang['dashboard_total_sales'] 				= 'Тотальная распродажа';
$lang['dashboard_value_in_warehouse'] 		= 'Стоимость в складе';
$lang['dashboard_warehouse_products'] 		= 'Складские товары';
$lang['dashboard_no_of_items'] 				= 'Нет элементов';
$lang['dashboard_rights_reserved'] 			= 'права защищены.';
$lang['dashboard_copyright'] 				= 'Авторские права';
$lang['dashboard_version'] 					= 'Версия';
$lang['dashboard_month'] 					= 'Месяц';
$lang['dashboard_sales_performance'] 		= 'Эффективность продаж';
$lang['dashboard_sales_of_company'] 		= 'Продажи компании';


/***   User    ***/

$lang['user_lable'] 	   		= 'пользователей';
$lang['user_lable_header'] 		= 'Список пользователей';
$lang['user_btn_new'] 	   		= 'Добавить пользователя';
$lang['user_lable_fname']  		= 'Имя';
$lang['user_lable_lname']  		= 'Фамилия';
$lang['user_lable_email']  		= 'Эл. адрес';
$lang['user_lable_group']  		= 'группа';
$lang['user_lable_status'] 		= 'Положение дел';
$lang['user_lable_action'] 		= 'действие';

$lang['add_user_header'] 		= 'Добавить пользователя';
$lang['add_user_label'] 		= 'Добавить пользователя';
$lang['add_user_company'] 		= 'название компании';
$lang['add_user_mobile'] 		= 'Номер мобильного';
$lang['add_user_password'] 	   	= 'пароль';
$lang['add_user_confpassword'] 	= 'Подтвердите Пароль';
$lang['add_user_btn'] 			= 'Добавить';
$lang['add_user_btn_cancel'] 	= 'Отмена';
$lang['edit_user_header'] 		= 'Редактировать пользователя';
$lang['edit_user_member'] 		= 'Член групп';
$lang['edit_user_btn'] 			= 'Обновить';



/*****   Billers ***/

$lang['biller_lable'] 	   		= 'Биллер';
$lang['biller_header'] 	   		= 'Список пользователей';
$lang['biller_btn_add'] 	   	= 'Добавить новых подписчиков';
$lang['biller_lable_no'] 	   	= 'нет';
$lang['biller_lable_name'] 	   	= 'имя';
$lang['biller_lable_company'] 	= 'Компания';
$lang['biller_lable_phone'] 	= 'Телефон';
$lang['biller_lable_email'] 	= 'Адрес электронной почты';
$lang['biller_lable_city'] 	    = 'город';
$lang['biller_lable_country'] 	= 'Страна';
$lang['biller_lable_action'] 	= 'действие';


$lang['add_biller_label'] 		= 'Добавить Биллер';
$lang['add_biller_header'] 		= 'Добавить новый счетчик';
$lang['add_biller_billname'] 	= 'Имя биллера';
$lang['add_biller_gst'] 		= 'GSTIN';
$lang['add_biller_select_branch'] = 'Выбрать ветвь';
$lang['add_biller_select']      = 'Выбрать';
$lang['add_biller_address'] 	= 'Адрес';
$lang['add_biller_state'] 		= 'состояние';
$lang['add_biller_fax'] 		= 'факс';
$lang['add_biller_telephone'] 	= 'телефон';
$lang['add_biller_mobile'] 		= 'мобильный';
$lang['edit_biller_header'] 	= 'Редактировать Биллер';
$lang['edit_biller_btn'] 		= 'Обновить';

/***** Clients *******/

$lang['client_header'] 		= 'Клиент';
$lang['client_label'] 		= 'Список клиентов';
$lang['client_btn_add'] 		= 'Добавить нового клиента';
$lang['add_client_label'] 	= 'Добавить клиента';
$lang['add_client_header'] 	= 'Добавить нового клиента';
$lang['add_client_cname'] 	= 'Имя Клиента';
$lang['add_client_compname'] 	= 'название компании';
$lang['add_client_code'] 		= 'Почтовый индекс';
$lang['edit_client_header'] 	= 'Изменить клиента';


/****** Supplier ****/

$lang['supplier_header'] 		= 'поставщик';
$lang['supplier_label'] 		= 'Список поставщиков';
$lang['supplier_btn_add'] 		= 'Добавить новых поставщиков';
$lang['supplier_add'] 			= 'Добавить поставщиков';
$lang['add_supplier_name'] 		= 'наименование поставщика';
$lang['edit_supplier_header'] 	= 'Изменить поставщика';


/**** Warehouse *********/

$lang['warehouse_header'] 		= 'Склад';
$lang['warehouse_label'] 		= 'Список Склад';
$lang['warehouse_label_no'] 	= 'нет';
$lang['warehouse_label_wname'] 	= 'Название склада';
$lang['warehouse_label_bname'] 	= 'Название филиала';
$lang['warehouse_label_uname'] 	= 'Имя пользователя';
$lang['warehouse_label_action'] = 'действия';
$lang['warehouse_btn_new'] 		= 'Добавить новый склад';
$lang['add_warehouse'] 			= 'Добавить склад';
$lang['add_warehouse_name'] 	= 'Название склада';
$lang['edit_warehouse_header'] 	= 'Изменить хранилище';

//Category

$lang['category_add'] 						= 'Добавить';
$lang['category_cancel'] 					= 'Отмена';
$lang['category_lable'] 					= 'категория';
$lang['category_lable_addcategory'] 		= 'Добавить категорию';
$lang['category_lable_editcategory'] 		= 'Изменить категорию';
$lang['category_lable_no'] 					= 'нет';
$lang['category_lable_code'] 				= 'Код категории';
$lang['category_lable_cname'] 				= 'Название категории';
$lang['category_lable_actions'] 			= 'действия';
$lang['category_lable_lcategory'] 			= 'Список категорий';
$lang['category_lable_newcategory'] 		= 'Добавить новую категорию';

//Subcategory
$lang['subcategory_add'] 					= 'Добавить';
$lang['subcategory_cancel'] 				= 'Отмена';
$lang['subcategory_update'] 				= 'Обновить';
$lang['subcategory_label'] 					= 'Подкатегория';
$lang['subcategory_label_add'] 				= 'Добавить подкатегорию';
$lang['subcategory_newcategory'] 			= 'Добавить новую подкатегорию';
$lang['subcategory_label_select'] 			= 'выберите категорию';
$lang['subcategory_label_name'] 			= 'Название подкатегории';
$lang['subcategory_label_listcategory'] 	= 'Список подкатегорий';
$lang['subcategory_cancel'] 				= 'Отмена';
$lang['subcategory_label_code'] 			= 'Код подкатегории';
$lang['subcategory_label_main'] 			= 'Главная категория';
$lang['subcategory_label_name'] 			= 'Название подкатегории';
$lang['subcategory_label_edit'] 			= 'Изменить подкатегорию';

//Branch
$lang['branch_label'] 						= 'Филиал';
$lang['branch_label_name'] 					= 'Название филиала';
$lang['branch_label_city'] 					= 'город';
$lang['branch_label_address'] 				= 'Адрес';
$lang['branch_label_add'] 					= 'Добавить';
$lang['branch_label_newbranch'] 			= 'Добавить новую ветку';
$lang['branch_label_cancel'] 				= 'Отмена';
$lang['branch_label_addbranch'] 			= 'Добавить ветвь';
$lang['branch_label_edit'] 					= 'Редактировать ветвь';

//Discount

$lang['discount_label_name'] 				= 'Название скидки';
$lang['discount_label_value'] 				= 'Дисконтная стоимость';
$lang['discount_label'] 					= 'скидка';
$lang['discount_label_username'] 			= 'Имя пользователя';
$lang['discount_label_add']					= 'Добавить';
$lang['discount_label_newbranch'] 			= 'Добавить новую скидку';
$lang['discount_label_cancel'] 				= 'Отмена';
$lang['discount_label_addbranch'] 			= 'Добавить скидку';
$lang['discount_label_list'] 				= 'Список скидок';
$lang['discount_label_edit'] 				= 'Изменить скидку';
$lang['discount_label_update'] 				= 'Обновить';

//Tax

$lang['tax_label_name'] 				= 'Налоговое имя';
$lang['tax_label_form'] 				= 'Начать с';
$lang['tax_label_rnumber'] 				= 'Регистрационный номер';
$lang['tax_label_frequency'] 			= 'Частота заполнения';
$lang['tax_label_desc'] 				= 'Описание';
$lang['tax_label_applies'] 				= 'Налог применяется к';
$lang['tax_label_calculate'] 			= 'Рассчитать';
$lang['tax_label_salesrate'] 			= 'Ставка налога с продаж';
$lang['tax_label_addnew'] 				= 'Добавить новый налог';
$lang['tax_label_add'] 					= 'Добавить налог';
$lang['tax_label_purchaserate'] 		= 'Ставка налога на покупку';
$lang['tax_label_list'] 				= 'Перечислить налог';
$lang['tax_label'] 						= 'налог';
$lang['tax_label_Edit'] 				= 'Изменить налог';
