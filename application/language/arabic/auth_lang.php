<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Daniel Davis
*         @ourmaninjapan
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  English language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'لم تجتاز مشاركة النموذج هذه عمليات التحقق من الأمان.';

// Login
$lang['login_heading']         = 'تسجيل الدخول';
$lang['login_subheading']      = 'يرجى تسجيل الدخول باستخدام البريد الإلكتروني / اسم المستخدم وكلمة المرور أدناه.';
$lang['login_identity_label']  = 'البريد الالكتروني / اسم المستخدم:';
$lang['login_password_label']  = 'كلمه السر:';
$lang['login_remember_label']  = 'تذكرنى:';
$lang['login_submit_btn']      = 'تسجيل الدخول';
$lang['login_forgot_password'] = 'نسيت رقمك السري?';

// Index
$lang['index_heading']           = 'المستخدمين';
$lang['index_subheading']        = 'في ما يلي قائمة بالمستخدمين.';
$lang['index_fname_th']          = 'الاسم الاول';
$lang['index_lname_th']          = 'الكنية';
$lang['index_email_th']          = 'البريد الإلكتروني';
$lang['index_groups_th']         = 'المجموعات';
$lang['index_status_th']         = 'الحالة';
$lang['index_action_th']         = 'عمل';
$lang['index_active_link']       = 'نشيط';
$lang['index_inactive_link']     = 'غير نشط';
$lang['index_create_user_link']  = 'إنشاء مستخدم جديد';
$lang['index_create_group_link'] = 'إنشاء مجموعة جديدة';

// Deactivate User
$lang['deactivate_heading']                  = 'إلغاء تنشيط المستخدم';
$lang['deactivate_subheading']               = 'هل تريد بالتأكيد إلغاء تنشيط المستخدم \'%s\'';
$lang['deactivate_confirm_y_label']          = 'نعم فعلا:';
$lang['deactivate_confirm_n_label']          = 'لا:';
$lang['deactivate_submit_btn']               = 'عرض';
$lang['deactivate_validation_confirm_label'] = 'التأكيد';
$lang['deactivate_validation_user_id_label'] = 'معرف المستخدم';

// Create User
$lang['create_user_heading']                           = 'إنشاء مستخدم';
$lang['create_user_subheading']                        = 'يرجى إدخال معلومات المستخدمين أدناه.';
$lang['create_user_fname_label']                       = 'الاسم الاول:';
$lang['create_user_lname_label']                       = 'الكنية:';
$lang['create_user_identity_label']                    = 'هوية:';
$lang['create_user_company_label']                     = 'اسم الشركة:';
$lang['create_user_email_label']                       = 'البريد الإلكتروني:';
$lang['create_user_phone_label']                       = 'هاتف:';
$lang['create_user_password_label']                    = 'كلمه السر:';
$lang['create_user_password_confirm_label']            = 'تأكيد كلمة المرور:';
$lang['create_user_submit_btn']                        = 'إنشاء مستخدم';
$lang['create_user_validation_fname_label']            = 'الاسم الاول';
$lang['create_user_validation_lname_label']            = 'الكنية';
$lang['create_user_validation_identity_label']         = 'هوية';
$lang['create_user_validation_email_label']            = 'عنوان البريد الإلكتروني';
$lang['create_user_validation_phone_label']            = 'هاتف';
$lang['create_user_validation_company_label']          = 'اسم الشركة';
$lang['create_user_validation_password_label']         = 'كلمه السر';
$lang['create_user_validation_password_confirm_label'] = 'تأكيد كلمة المرور';

// Edit User
$lang['edit_user_heading']                           = 'تحرير العضو';
$lang['edit_user_subheading']                        = 'يرجى إدخال معلومات المستخدمين أدناه.';
$lang['edit_user_fname_label']                       = 'الاسم الاول:';
$lang['edit_user_lname_label']                       = 'الكنية:';
$lang['edit_user_company_label']                     = 'اسم الشركة:';
$lang['edit_user_email_label']                       = 'البريد الإلكتروني:';
$lang['edit_user_phone_label']                       = 'هاتف:';
$lang['edit_user_password_label']                    = 'كلمه السر: (if changing password)';
$lang['edit_user_password_confirm_label']            = 'تأكيد كلمة المرور: (if changing password)';
$lang['edit_user_groups_heading']                    = 'عضو في المجموعات';
$lang['edit_user_submit_btn']                        = 'حفظ المستخدم';
$lang['edit_user_validation_fname_label']            = 'الاسم الاول';
$lang['edit_user_validation_lname_label']            = 'الكنية';
$lang['edit_user_validation_email_label']            = 'عنوان البريد الإلكتروني';
$lang['edit_user_validation_phone_label']            = 'هاتف';
$lang['edit_user_validation_company_label']          = 'اسم الشركة';
$lang['edit_user_validation_groups_label']           = 'المجموعات';
$lang['edit_user_validation_password_label']         = 'كلمه السر';
$lang['edit_user_validation_password_confirm_label'] = 'تأكيد كلمة المرور';

// Create Group
$lang['create_group_title']                  = 'إنشاء مجموعة';
$lang['create_group_heading']                = 'إنشاء مجموعة';
$lang['create_group_subheading']             = 'الرجاء إدخال معلومات المجموعة أدناه.';
$lang['create_group_name_label']             = 'أسم المجموعة:';
$lang['create_group_desc_label']             = 'وصف:';
$lang['create_group_submit_btn']             = 'إنشاء مجموعة';
$lang['create_group_validation_name_label']  = 'أسم المجموعة';
$lang['create_group_validation_desc_label']  = 'وصف';

// Edit Group
$lang['edit_group_title']                  = 'تعديل المجموعة';
$lang['edit_group_saved']                  = 'تم حفظ المجموعة';
$lang['edit_group_heading']                = 'تعديل المجموعة';
$lang['edit_group_subheading']             = 'الرجاء إدخال معلومات المجموعة أدناه.';
$lang['edit_group_name_label']             = 'أسم المجموعة:';
$lang['edit_group_desc_label']             = 'وصف:';
$lang['edit_group_submit_btn']             = 'حفظ المجموعة';
$lang['edit_group_validation_name_label']  = 'أسم المجموعة';
$lang['edit_group_validation_desc_label']  = 'وصف';

// Change Password
$lang['change_password_heading']                               = 'تغيير كلمة السر';
$lang['change_password_old_password_label']                    = 'كلمة المرور القديمة:';
$lang['change_password_new_password_label']                    = 'كلمة المرور الجديدة (طول الحروف٪ s على الأقل):';
$lang['change_password_new_password_confirm_label']            = 'تأكيد كلمة المرور الجديدة:';
$lang['change_password_submit_btn']                            = 'يتغيرون';
$lang['change_password_validation_old_password_label']         = 'كلمة المرور القديمة';
$lang['change_password_validation_new_password_label']         = 'كلمة السر الجديدة';
$lang['change_password_validation_new_password_confirm_label'] = 'تأكيد كلمة المرور الجديدة';

// Forgot Password
$lang['forgot_password_heading']                 = 'هل نسيت كلمة المرور';
$lang['forgot_password_subheading']              = 'الرجاء إدخال٪ s حتى نتمكن من إرسال رسالة إلكترونية إليك لإعادة تعيين كلمة المرور.';
$lang['forgot_password_email_label']             = '%الصورة:';
$lang['forgot_password_submit_btn']              = 'عرض';
$lang['forgot_password_validation_email_label']  = 'عنوان البريد الإلكتروني';
$lang['forgot_password_username_identity_label'] = 'اسم المستخدم';
$lang['forgot_password_email_identity_label']    = 'البريد الإلكتروني';
$lang['forgot_password_email_not_found']         = 'لا يوجد سجل لعنوان البريد الإلكتروني هذا.';
$lang['forgot_password_identity_not_found']         = 'لا يوجد سجل لذلك العنوان.';

// Reset Password
$lang['reset_password_heading']                               = 'تغيير كلمة السر';
$lang['reset_password_new_password_label']                    = 'كلمة المرور الجديدة (طول الحروف٪ s على الأقل):';
$lang['reset_password_new_password_confirm_label']            = 'تأكيد كلمة المرور الجديدة:';
$lang['reset_password_submit_btn']                            = 'يتغيرون';
$lang['reset_password_validation_new_password_label']         = 'كلمة السر الجديدة';
$lang['reset_password_validation_new_password_confirm_label'] = 'تأكيد كلمة المرور الجديدة';

// Activation Email
$lang['email_activate_heading']    = 'تنشيط الحساب ل٪ s';
$lang['email_activate_subheading'] = 'يرجى النقر على هذا الرابط إلى٪ s.';
$lang['email_activate_link']       = 'فعل حسابك';

// Forgot Password Email
$lang['email_forgot_password_heading']    = 'إعادة تعيين كلمة المرور ل٪ s';
$lang['email_forgot_password_subheading'] = 'يرجى النقر على هذا الرابط إلى٪ s.';
$lang['email_forgot_password_link']       = 'اعد ضبط كلمه السر';

// New Password Email
$lang['email_new_password_heading']    = 'كلمة مرور جديدة ل٪ s';
$lang['email_new_password_subheading'] = 'تمت إعادة تعيين كلمة المرور إلى:٪ s';

// Header
$lang['header_sign_out'] 			= 'خروج';
$lang['header_online'] 				= 'عبر الانترنت';
$lang['header_main_navidation'] 	= "الملاحة البحرية";
$lang['header_dashboard'] 			= 'لوحة القيادة';
$lang['header_product'] 			= 'المنتج';
$lang['header_list'] 				= 'قائمة';
$lang['header_add'] 				= 'إضافة';
$lang['header_product_alert'] 		= "تنبيه المنتج";
$lang['header_purchase'] 			= 'شراء';
$lang['header_purchase_return'] 	= 'عودة الشراء';
$lang['header_transfers'] 			= 'تحويل ايرادات';
$lang['header_sales'] 				= 'مبيعات';
$lang['header_sales_return'] 		= 'عائد المبيعات';
$lang['header_payment'] 			= 'دفع';
$lang['header_invoice'] 			= 'فاتورة';
$lang['header_reports'] 			= 'تقارير';
$lang['header_daily'] 				= 'اليومي';
$lang['header_people'] 				= 'اشخاص';
$lang['header_users'] 				= 'المستخدمين';
$lang['header_billers'] 			= 'المفوترين';
$lang['header_clients'] 			= 'الزبائن';
$lang['header_suppliers'] 			= 'الموردين';
$lang['header_setting'] 			= 'ضبط';
$lang['header_company_setting'] 	= 'إعداد الشركة';
$lang['header_category'] 			= 'الفئة';
$lang['header_sub_category'] 		= 'فرعية';
$lang['header_branch'] 				= 'فرع شجرة';
$lang['header_brand']				= 'علامة تجارية';
$lang['header_discount'] 			= 'خصم';
$lang['header_tax'] 				= 'ضريبة';
$lang['header_warehouse'] 			= 'مستودع';
$lang['header_assign_warehouse'] 	= 'تعيين مستودع';

//Company Settings
$lang['company_setting_name'] 				= 'اسم';
$lang['company_setting_site_short_name'] 	= 'اسم الموقع القصير';
$lang['company_setting_country'] 			= 'بلد';
$lang['company_setting_select'] 			= 'تحديد';
$lang['company_setting_state'] 				= 'حالة';
$lang['company_setting_city'] 				= 'مدينة';
$lang['company_setting_street'] 			= 'شارع';
$lang['company_setting_zip_code'] 			= 'الرمز البريدي';
$lang['company_setting_email'] 				= 'البريد الإلكتروني';
$lang['company_setting_mobile'] 			= 'التليفون المحمول';
$lang['company_setting_default_language'] 	= 'الافتراضي لانغواغe';
$lang['company_setting_default_currency'] 	= 'العملة الافتراضية';
$lang['company_setting_submit'] 			= 'عرض';
$lang['company_setting_cancel'] 			= 'إلغاء';

//Product
$lang['product_list_product'] 			= 'قائمة المنتجات';
$lang['product_add_new_product'] 		= 'إضافة منتج جديد';
$lang['product_no'] 					= 'لا';
$lang['product_image'] 					= 'صورة';
$lang['product_code'] 					= 'الشفرة';
$lang['product_hsn_sac_code'] 			= 'هسن / ساك رمز';
$lang['product_name'] 					= 'اسم';
$lang['product_category'] 				= 'الفئة';
$lang['product_cost'] 					= 'كلفة';
$lang['product_price'] 					= 'السعر';
$lang['product_quantity'] 				= 'الكميهy';
$lang['product_unit'] 					= 'وحدة';
$lang['product_alert_quantity'] 		= 'كمية تنبيه';
$lang['product_available_quantity'] 	= 'الكمية المتوفرة';
$lang['product_action'] 				= 'عمل';
$lang['product_add_product'] 			= 'إضافة منتج';
$lang['product_product_code'] 			= 'كود المنتج';
$lang['product_product_name'] 			= 'اسم المنتج';
$lang['product_hsn_sac_lookup'] 		= 'هسن / ساك بحث';
$lang['product_select_category'] 		= 'اختر الفئة';
$lang['product_select'] 				= 'تحديد';
$lang['product_select_subcategory'] 	= 'حدد الفئة الفرعية';
$lang['product_product_unit'] 			= 'وحدة المنتج';
$lang['product_product_size'] 			= 'حجم المنتج';
$lang['product_product_cost'] 			= 'تكلفة المنتج';
$lang['product_product_price'] 			= 'صافي سعر التاجر';
$lang['product_select_product_tax'] 	= 'حدد ضريبة المنتج';
$lang['product_no_tax'] 				= 'لا ضرائب';
$lang['product_product_image'] 			= 'إيماج المنتجe';
$lang['product_product_details'] 		= 'تفاصيل المنتج للفاتورة';
$lang['product_add'] 					= 'إضافة';
$lang['product_cancel'] 				= 'إلغاء';
$lang['product_hsn'] 					= 'HSN';
$lang['product_sac'] 					= 'كيس';
$lang['product_chapter'] 				= 'الفصل';
$lang['product_hsn_code'] 				= 'رموز هسن #';
$lang['product_description'] 			= 'وصف';
$lang['product_sac_code'] 				= 'رموز ساك #';
$lang['product_close'] 					= 'قريب';
$lang['product_apply'] 					= 'تطبيق';
$lang['header_edit_product'] 			= 'تحرير المنتج';
$lang['product_update'] 				= 'تحديث';
$lang['product_delete_conform'] 		= 'هل تريد إزالة هذا السجل؟';

//Product Alert
$lang['product_alert_pdf'] 				= 'PDF';
$lang['header_list_product_alert'] 		= "قائمة تنبيه المنتج";

//transfer
$lang['transfer_dashboard']	 		=	'لوحة القيادة';
$lang['transfer_transfers']	 		=	'نقل';
$lang['transfer_listtransfers']	 	=	'قائمة التحويلات';
$lang['transfer_add_new_transfer']	=	'إضافة نقل جديد';
$lang['transfer_no']	 			=	'لا';
$lang['transfer_date']	 			=	'تاريخ';
$lang['transfer_warehouse_from'] 	=	'مستودع (من)';
$lang['transfer_warehouse_to']	 	=	'مستودع (ل)';
$lang['transfer_total']	 			=	'مجموع';
$lang['transfer_actions']	 		=	'أفعال';
$lang['transfer_add_transfer']	 	=	'إضافة نقل';
$lang['transfer_to_warehouse']	 	=	'إلى مستودع';
$lang['transfer_from_warehouse']	=	'من المستودع';
$lang['transfer_select_product']	=	'حدد المنتج';
$lang['transfer_select']	 		=	'تحديد';
$lang['transfer_inventory_items']	=	'عناصر المخزون';
$lang['transfer_code']	 			=	'الشفرة';
$lang['transfer_quantity']	 		=	'كمية';
$lang['transfer_available_qty']	 	=	'الكمية المتاحة';
$lang['transfer_unit']	 			=	'وحدة';
$lang['transfer_cost']	 			=	'كلفة';
$lang['transfer_sub_total']	 		=	'المجموع الفرعي';
$lang['transfer_grand_total']	 	=	'المبلغ الإجمالي ';
$lang['transfer_note']	 			=	'ملحوظة';
$lang['transfer_add']	 			=	'إضافة';
$lang['transfer_edit_transfer']	 	=	'تحرير نقل';
$lang['transfer_save']	 			=	'حفظ';

//assaign warehouse
$lang['assign_warehouse']						=	"تعيين مستودع";
$lang['assign_warehouse_add_assign_warehouse']	=	"إضافة تعيين مستودع";
$lang['assign_warehouse_user_name']				=	"اسم المستخدم";
$lang['assign_warehouse_select']				=	"تحديد";
$lang['assign_warehouse_warehouse_name']		=	"اسم المستودع";
$lang['assign_warehouse_cancel']				=	"إلغاء";
$lang['assign_warehouse_add']					=	"إضافة ";
$lang['assign_warehouse_list_assign_warehouse']	=	"تعيين قائمة المستودع";
$lang['assign_warehouse_no']					=	"لا";
$lang['assign_warehouse_actions']				=	"أفعال";

//Purchase
$lang['purchase_list_purchase'] 		= 'قائمة الشراء';
$lang['purchase_add_new_purchase'] 		= 'إضافة شراء جديد';
$lang['purchase_date'] 					= 'تاريخ';
$lang['purchase_reference_no'] 			= 'رقم المرجع';
$lang['purchase_supplier'] 				= 'المورد';
$lang['purchase_purchase_status'] 		= 'حالة الشراء';
$lang['purchase_grand_total'] 			= 'المبلغ الإجمالي';
$lang['purchase_received'] 				= 'تم الاستلام';
$lang['purchase_purchase_details'] 		= 'تفاصيل شراء';
$lang['purchase_edit_purchase'] 		= 'تحرير الشراء';
$lang['purchase_download_as_pdf'] 		= 'تحميل باسم بدف';
$lang['purchase_email_purchase'] 		= 'شراء البريد الإلكتروني';
$lang['purchase_delete_purchase'] 		= 'حذف الشراء';
$lang['purchase_add_purchase'] 			= 'إضافة شراء';
$lang['purchase_select_warehouse'] 		= 'حدد مستودع';
$lang['purchase_select_supplier'] 		= 'حدد المورد';
$lang['purchase_select_product'] 		= 'حدد المنتج';
$lang['purchase_inventory_items'] 		= 'عناصر المخزون';
$lang['purchase_product_description'] 	= 'وصف المنتج';
$lang['purchase_sub_total'] 			= 'المجموع الفرعي';
$lang['purchase_taxable_value'] 		= 'ضرائب فالوe';
$lang['purchase_total'] 				= 'مجموع';
$lang['purchase_total_value'] 			= 'القيمة الإجمالية';
$lang['purchase_total_discount'] 		= 'مجموع ديسكونt';
$lang['purchase_total_tax'] 			= 'مجموع الضريبة';
$lang['purchase_note'] 					= 'ملحوظة';
$lang['purchase_total_sales'] 			= 'إجمالي المبيعات';
$lang['purchase_total_amount'] 			= 'المبلغ الإجمالي';
$lang['purchase_edit'] 					= 'تصحيح';
$lang['purchase_delete'] 				= 'حذف';
$lang['purchase_to'] 					= 'إلى';
$lang['purchase_from'] 					= 'من عند';
$lang['purchase_mobile'] 				= 'التليفون المحمول';
$lang['purchase_ordered_by'] 			= 'طلب بواسطة';
$lang['purchase_stamp_and_signature']	= 'ختم وتوقيع';

//Purchase Return
$lang['purchase_return_list_purchase_return'] 		= 'قائمة شراء العودة';
$lang['purchase_return_add_new_purchase_return'] 	= 'إضافة عودة شراء جديد';
$lang['purchase_return_add_purchase_return'] 		= 'إضافة عودة الشراء';
$lang['purchase_return_grand_total'] 				= 'المجموع الكلي: 0.00';
$lang['purchase_return_edit_purchase_return'] 		= 'تحرير شراء العودة';
$lang['purchase_return_edit_grand_total'] 			= 'المبلغ الإجمالي :';

//sales
$lang['sales_list_sales'] 				= 'قائمة المبيعات';
$lang['sales_add_new_sales'] 			= 'إضافة مبيعات جديدة';
$lang['sales_biller'] 					= 'بيلر';
$lang['sales_client'] 				= 'زبون';
$lang['sales_sales_status'] 			= 'حالة المبيعات';
$lang['sales_payment_status'] 			= 'حالة السداد';
$lang['sales_paid'] 					= 'دفع';
$lang['sales_complited'] 				= 'منجز';
$lang['sales_pending'] 					= 'قيد الانتظار';
$lang['sales_sales_details'] 			= 'تفاصيل المبيعات';
$lang['sales_add_payment'] 				= 'إضافة دفعة';
$lang['sales_edit_sales'] 				= 'تعديل المبيعات';
$lang['sales_email_sales'] 				= 'مبيعات البريد الإلكتروني';
$lang['sales_delete_sales'] 			= 'حذف المبيعات';
$lang['sales_add_sales'] 				= 'إضافة مبيعات';
$lang['sales_select_biller'] 			= 'حدد بيلر';
$lang['sales_select_client'] 			= 'حدد العميل';
$lang['sales_internal_note'] 			= 'ملاحظة داخلية';
$lang['sales_status'] 					= 'الحالة العمليةs';
$lang['sales_balance'] 					= 'توازن';
$lang['sales_invoice'] 					= 'فاتورة';
$lang['sales_client_details'] 		= 'تفاصيل العميل';
$lang['sales_pos'] 						= 'نقاط البيع';
$lang['sales_invoice_hash'] 			= 'فاتورة #';
$lang['sales_address'] 					= 'عنوان';
$lang['sales_product_wise_details'] 	= 'المنتج من الحكمة التفاصيل';
$lang['sales_cgst'] 					= 'CGST';
$lang['sales_sgst'] 					= 'SGST';
$lang['sales_igst'] 					= 'IGST';
$lang['sales_total_sales'] 				= 'المبيعات الإجمالي';
$lang['sales_remarks'] 					= 'ملاحظات:';
$lang['sales_summary'] 					= 'ملخص';
$lang['sales_amount'] 					= 'كمية';
$lang['sales_total_invoice_value'] 		= 'إجمالي الفاتورة فالوe';
$lang['sales_total_cgst'] 				= 'إجمالي غست';
$lang['sales_receivers_signature'] 		= 'استقبال \ ق التوقيع';
$lang['sales_senior_accounts_manager'] 	= 'الحسابات العليا إدارةr';
$lang['sales_total_sgst'] 				= 'المجموع سست';
$lang['slaes_invoice_note'] 			= 'ملاحظة: جعل جميع الشيكات المستحقة لاسم الشركة';
$lang['sales_igst'] 					= 'إجمالي إيغست';
$lang['sales_thank_you'] 				= 'شكرا لك على عملك';
$lang['sales_edit_sales'] 				= 'تعديل المبيعات';
$lang['sales_pay']		 				= 'دفع';
$lang['sales_list_invoice']		 		= 'قائمة الفاتورة';
$lang['sales_sales_amount']		 		= 'مبلغ المبيعات';
$lang['sales_paid_amount']		 		= 'المبلغ المدفوع';
$lang['sales_invoice_no']		 		= 'رقم الفاتورة';

//Sales Return
$lang['sales_return_list_sales_return'] 	= 'قائمة المبيعات العودة';
$lang['sales_return_add_new_sales_return'] 	= 'إضافة مبيعات جديدة العودة';
$lang['sales_return_add_sales_return'] 		= 'إضافة مبيعات العودة';
$lang['sales_return_edit_sales_return'] 	= 'تحرير مبيعات العودة';

//payment
$lang['payment_list_payment'] 				= 'قائمة بايمنt';
$lang['payment_paying_by'] 					= 'الدفع بواسطة';
$lang['payment_edit_payment'] 				= 'تعديل الدفع';
$lang['payment_bank_name'] 					= 'اسم البنك';
$lang['payment_cheque_no'] 					= 'Cهك نو';
$lang['sales_amount'] 						= 'كمية';

//Reports
$lang['reports_daily_reports'] 				= 'التقارير اليومية';
$lang['reports_current_month_sales'] 		= 'مبيعات الشهر الحالي:';
$lang['reports_profite'] 					= 'الربح:';
$lang['reports_product_reports'] 			= 'تقارير المنتجات';
$lang['reports_start_date'] 				= 'تاريخ البدء';
$lang['reports_end_date'] 					= 'تاريخ الانتهاء';
$lang['reports_purchased'] 					= 'اشترى';
$lang['reports_sold'] 						= 'تم البيع';
$lang['reports_profite_title'] 				= 'Profite';
$lang['reports_purchase_reports'] 			= 'تقارير الشراء';
$lang['reports_created_by'] 				= 'صنع من قبل ';
$lang['reports_supplier'] 					= 'المورد';
$lang['reports_product_qty'] 				= 'المنتج (الكمية)';
$lang['reports_hide_show'] 					= 'إخفاء / عرض';
$lang['reports_submit'] 					= 'عرض';
$lang['reports_purchase_return_reports'] 	= 'شراء تقارير العودة';
$lang['reports_sales_reports'] 				= 'تقارير المبيعات';
$lang['reports_biller'] 					= 'بيلر';
$lang['reports_client'] 					= 'زبون';
$lang['reports_sales_return_reports'] 		= 'عائد المبيعات';

//Dashboard
$lang['dashboard_today'] 					= 'اليوم';
$lang['dashboard_this_week'] 				= 'هذا الاسبوع';
$lang['dashboard_this_month'] 				= 'هذا الشهر';
$lang['dashboard_this_year'] 				= 'هذا العام';
$lang['dashboard_all_time'] 				= 'كل الوقت';
$lang['dashboard_new_items'] 				= 'عناصر جديدة';
$lang['dashboard_purchase_item'] 			= 'شراء البند';
$lang['dashboard_sold_items'] 				= 'تباع البنود';
$lang['dashboard_purchase_value'] 			= 'شراء فالue';
$lang['dashboard_sales_value'] 				= 'قيمة المبيعات';
$lang['dashboard_yearly_sales'] 			= 'بيع سنويs';
$lang['dashboard_total_sales'] 				= 'إجمالي المبيعات';
$lang['dashboard_value_in_warehouse'] 		= 'القيمة في المستودع';
$lang['dashboard_warehouse_products'] 		= 'مستودع المنتجs';
$lang['dashboard_no_of_items'] 				= 'أي من العناصر';
$lang['dashboard_rights_reserved'] 			= 'الحقوق محفوظة.';
$lang['dashboard_copyright'] 				= 'لحقوق الطبعt';
$lang['dashboard_version'] 					= 'الإصدار';
$lang['dashboard_month'] 					= 'شهر';
$lang['dashboard_sales_performance'] 		= 'اداء المبيعات';
$lang['dashboard_sales_of_company'] 		= 'مبيعات الشركة';


/***   User    ***/

$lang['user_lable'] 	   		= 'المستخدمين';
$lang['user_lable_header'] 		= 'قائمة المستخدمين';
$lang['user_btn_new'] 	   		= 'إضافة مستخدم جديد';
$lang['user_lable_fname']  		= 'الاسم الاول';
$lang['user_lable_lname']  		= 'الكنية';
$lang['user_lable_email']  		= 'البريد الإلكتروني';
$lang['user_lable_group']  		= 'مجموعة';
$lang['user_lable_status'] 		= 'الحالة';
$lang['user_lable_action'] 		= 'عمل';

$lang['add_user_header'] 		= 'إضافة مستخدم';
$lang['add_user_label'] 		= 'إضافة مستخدم جديد';
$lang['add_user_company'] 		= 'اسم الشركة';
$lang['add_user_mobile'] 		= 'موبايل لا';
$lang['add_user_password'] 	   	= 'كلمه السر';
$lang['add_user_confpassword'] 	= 'تأكيد باسوrd';
$lang['add_user_btn'] 			= 'إضافة';
$lang['add_user_btn_cancel'] 	= 'إلغاء';
$lang['edit_user_header'] 		= 'تحرير الاستخدامr';
$lang['edit_user_member'] 		= 'عضو في المجموعات';
$lang['edit_user_btn'] 			= 'تحديث';



/*****   Billers ***/

$lang['biller_lable'] 	   		= 'المفوترين';
$lang['biller_header'] 	   		= 'قائمة بيلرس';
$lang['biller_btn_add'] 	   	= 'إضافة بيلر جديدs';
$lang['biller_lable_no'] 	   	= 'لا';
$lang['biller_lable_name'] 	   	= 'اسم';
$lang['biller_lable_company'] 	= 'شركة';
$lang['biller_lable_phone'] 	= 'هاتف';
$lang['biller_lable_email'] 	= 'عنوان البريد الالكترونيs';
$lang['biller_lable_city'] 	    = 'مدينة';
$lang['biller_lable_country'] 	= 'بلد';
$lang['biller_lable_action'] 	= 'عمل';


$lang['add_biller_label'] 		= 'إضافة بيل';
$lang['add_biller_header'] 		= 'إضافة بيلر جدي';
$lang['add_biller_billname'] 	= 'اسم بيل';
$lang['add_biller_gst'] 		= 'GSTI';
$lang['add_biller_select_branch'] = 'حدد الفر';
$lang['add_biller_select']      = 'تحدي';
$lang['add_biller_address'] 	= 'عنوا';
$lang['add_biller_state'] 		= 'حال';
$lang['add_biller_fax'] 		= 'فاكس ';
$lang['add_biller_telephone'] 	= 'هاتف';
$lang['add_biller_mobile'] 		= 'التليفون المحمو';
$lang['edit_biller_header'] 	= 'تحرير بيr';
$lang['edit_biller_btn'] 		= 'تحدي';

/***** Clients *******/

$lang['client_header'] 		= 'زبون';
$lang['client_label'] 		= 'قائمة العملاء';
$lang['client_btn_add'] 		= 'إضافة عميل جديد';
$lang['add_client_label'] 	= 'إضافة عميل';
$lang['add_client_header'] 	= 'إضافة جديد كوستومr';
$lang['add_client_cname'] 	= 'اسم الزبون';
$lang['add_client_compname'] 	= 'اسم الشركة';
$lang['add_client_code'] 		= 'الرمز البريدي';
$lang['edit_client_header'] 	= 'تحرير العملاء';


/****** Supplier ****/

$lang['supplier_header'] 		= 'المورد';
$lang['supplier_label'] 		= 'قائمة الموردين';
$lang['supplier_btn_add'] 		= 'إضافة مورد جديدs';
$lang['supplier_add'] 			= 'إضافة الموردين';
$lang['add_supplier_name'] 		= 'اسم المورد';
$lang['edit_supplier_header'] 	= 'تحرير المورد';


/**** Warehouse *********/

$lang['warehouse_header'] 		= 'مستودع';
$lang['warehouse_label'] 		= 'قائمة مستودع';
$lang['warehouse_label_no'] 	= 'لا';
$lang['warehouse_label_wname'] 	= 'اسم المستودع';
$lang['warehouse_label_bname'] 	= 'اسم الفرع';
$lang['warehouse_label_uname'] 	= 'المستخدم نامe';
$lang['warehouse_label_action'] = 'أفعال';
$lang['warehouse_btn_new'] 		= 'إضافة مستودع جديد';

$lang['add_warehouse'] 			= 'إضافة مستودع';
$lang['add_warehouse_name'] 	= 'اسم المستودع';
$lang['edit_warehouse_header'] 	= 'تحرير مستودع';

//Category

$lang['category_add'] 						= 'إضافة';
$lang['category_cancel'] 					= 'إلغاء';
$lang['category_lable'] 					= 'الفئة';
$lang['category_lable_addcategory'] 		= 'إضافة فئة';
$lang['category_lable_editcategory'] 		= 'تحرير الفئة';
$lang['category_lable_no'] 					= 'لا';
$lang['category_lable_code'] 				= 'فئة سمك القدe';
$lang['category_lable_cname'] 				= 'اسم التصنيف';
$lang['category_lable_actions'] 			= 'أفعال';
$lang['category_lable_lcategory'] 			= 'قائمة الفئة';
$lang['category_lable_newcategory'] 		= 'إضافة فئة جديدةy';

//Subcategory
$lang['subcategory_add'] 					= 'إضافة';
$lang['subcategory_cancel'] 				= 'إلغاء';
$lang['subcategory_update'] 				= 'تحديث';
$lang['subcategory_label'] 					= 'فرعية';
$lang['subcategory_label_add'] 				= 'إضافة الفئة الفرعية';
$lang['subcategory_newcategory'] 			= 'إضافة فئة فرعية جديدةy';
$lang['subcategory_label_select'] 			= 'حدد الفئةy';
$lang['subcategory_label_name'] 			= 'اسم الفئة الفرعية';
$lang['subcategory_label_listcategory'] 	= 'قائمة سوبكاتيغوry';
$lang['subcategory_cancel'] 				= 'إلغاء';
$lang['subcategory_label_code'] 			= 'رمز الفئة الفرعية';
$lang['subcategory_label_main'] 			= 'الفئة الرئيسية';
$lang['subcategory_label_name'] 			= 'الفئة الفرعية نامe';
$lang['subcategory_label_edit'] 			= 'تعديل الفئة الفرعيةy';

//Branch
$lang['branch_label'] 						= 'فرع شجرة';
$lang['branch_label_name'] 					= 'اسم الفرع';
$lang['branch_label_city'] 					= 'مدينة';
$lang['branch_label_address'] 				= 'عنوان';
$lang['branch_label_add'] 					= 'إضافة';
$lang['branch_label_newbranch'] 			= 'إضافة فرع جديد';
$lang['branch_label_cancel'] 				= 'إلغاء';
$lang['branch_label_addbranch'] 			= 'إضافة فرع';
$lang['branch_label_edit'] 					= 'تحرير الفرع';

//Discount

$lang['discount_label_name'] 				= 'اسم الخصم';
$lang['discount_label_value'] 				= 'قيمة الخصم';
$lang['discount_label'] 					= 'خصم';
$lang['discount_label_username'] 			= 'اسم المستخدم';
$lang['discount_label_add']					= 'إضافة';
$lang['discount_label_newbranch'] 			= 'إضافة قرص جديدt';
$lang['discount_label_cancel'] 				= 'Cancel';
$lang['discount_label_addbranch'] 			= 'إضافة خصم';
$lang['discount_label_list'] 				= 'قائمة الخصم';
$lang['discount_label_edit'] 				= 'تحرير ديسكونt';
$lang['discount_label_update'] 				= 'تحديث';

//Tax

$lang['tax_label_name'] 				= 'اسم الضريبة';
$lang['tax_label_form'] 				= 'يبدأ من';
$lang['tax_label_rnumber'] 				= 'تسجيل نومبr';
$lang['tax_label_frequency'] 			= 'تردد التعبئة';
$lang['tax_label_desc'] 				= 'وصف';
$lang['tax_label_applies'] 				= 'تطبق الضريبة على';
$lang['tax_label_calculate'] 			= 'حسابOn';
$lang['tax_label_salesrate'] 			= 'ضريبة المبيعات ضريبةe';
$lang['tax_label_addnew'] 				= 'إضافة ضريبة جديدة';
$lang['tax_label_add'] 					= 'إضافة ضريبة';
$lang['tax_label_purchaserate'] 		= 'معدل ضريبة الشراء';
$lang['tax_label_list'] 				= 'قائمة الضرائب';
$lang['tax_label'] 						= 'ضريبة';
$lang['tax_label_Edit'] 				= 'تحرير الضرائب';

