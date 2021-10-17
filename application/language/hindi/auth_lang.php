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
$lang['error_csrf'] = 'इस फॉर्म के पद ने हमारी सुरक्षा जांच को पारित नहीं किया।';

// Login
$lang['login_heading']         = 'लॉग इन करें';
$lang['login_subheading']      = 'कृपया नीचे अपना ईमेल / उपयोगकर्ता नाम और पासवर्ड के साथ लॉगिन करें।';
$lang['login_identity_label']  = 'ईमेल / प्रयोक्ता नाम:';
$lang['login_password_label']  = 'पासवर्ड:';
$lang['login_remember_label']  = 'मुझे याद रखना:';
$lang['login_submit_btn']      = 'लॉग इन करें';
$lang['login_forgot_password'] = 'क्या आप अपना पासवर्ड भूल गए?';

// Index
$lang['index_heading']           = 'उपयोगकर्ता';
$lang['index_subheading']        = 'नीचे उपयोगकर्ताओं की एक सूची है';
$lang['index_fname_th']          = 'पहला नाम';
$lang['index_lname_th']          = 'अंतिम नाम';
$lang['index_email_th']          = 'ईमेल';
$lang['index_groups_th']         = 'समूह';
$lang['index_status_th']         = 'स्थिति';
$lang['index_action_th']         = 'कार्य';
$lang['index_active_link']       = 'सक्रिय';
$lang['index_inactive_link']     = 'निष्क्रिय';
$lang['index_create_user_link']  = 'एक नया उपयोगकर्ता बनाएं';
$lang['index_create_group_link'] = 'एक नया समूह बनाएं';

// Deactivate User
$lang['deactivate_heading']                  = 'उपयोगकर्ता को निष्क्रिय करें';
$lang['deactivate_subheading']               = "क्या आप वाकई उपयोगकर्ता \ '% s \' निष्क्रिय करना चाहते हैं";
$lang['deactivate_confirm_y_label']          = 'हाँ:';
$lang['deactivate_confirm_n_label']          = 'नहीं:';
$lang['deactivate_submit_btn']               = 'जमा करें';
$lang['deactivate_validation_confirm_label'] = 'पुष्टीकरण';
$lang['deactivate_validation_user_id_label'] = 'उपयोगकर्ता पहचान';

// Create User
$lang['create_user_heading']                           = 'उपयोगकर्ता बनाइये';
$lang['create_user_subheading']                        = 'नीचे उपयोगकर्ता की जानकारी दर्ज करें।';
$lang['create_user_fname_label']                       = 'पहला नाम:';
$lang['create_user_lname_label']                       = 'अंतिम नाम:';
$lang['create_user_company_label']                     = 'कंपनी का नाम:';
$lang['create_user_identity_label']                    = 'पहचान:';
$lang['create_user_email_label']                       = 'ईमेल:';
$lang['create_user_phone_label']                       = 'फ़ोन:';
$lang['create_user_password_label']                    = 'पासवर्ड:';
$lang['create_user_password_confirm_label']            = 'पासवर्ड की पुष्टि कीजिये:';
$lang['create_user_submit_btn']                        = 'उपयोगकर्ता बनाइये';
$lang['create_user_validation_fname_label']            = 'पहला नाम';
$lang['create_user_validation_lname_label']            = 'अंतिम नाम';
$lang['create_user_validation_identity_label']         = 'पहचान';
$lang['create_user_validation_email_label']            = 'ईमेल पता';
$lang['create_user_validation_phone_label']            = 'फ़ोन';
$lang['create_user_validation_company_label']          = 'कंपनी का नाम';
$lang['create_user_validation_password_label']         = 'पासवर्ड';
$lang['create_user_validation_password_confirm_label'] = 'पासवर्ड पुष्टि';

// Edit User
$lang['edit_user_heading']                           = 'यूजर को संपादित करो';
$lang['edit_user_subheading']                        = 'नीचे उपयोगकर्ता की जानकारी दर्ज करें।';
$lang['edit_user_fname_label']                       = 'पहला नाम:';
$lang['edit_user_lname_label']                       = 'अंतिम नाम:';
$lang['edit_user_company_label']                     = 'कंपनी का नाम:';
$lang['edit_user_email_label']                       = 'ईमेल:';
$lang['edit_user_phone_label']                       = 'फ़ोन:';
$lang['edit_user_password_label']                    = 'पासवर्ड: (यदि पासवर्ड बदल रहा हो)';
$lang['edit_user_password_confirm_label']            = 'पासवर्ड की पुष्टि करें: (यदि पासवर्ड बदल रहा है)';
$lang['edit_user_groups_heading']                    = 'समूह के सदस्य';
$lang['edit_user_submit_btn']                        = 'उपयोगकर्ता सहेजें';
$lang['edit_user_validation_fname_label']            = 'पहला नाम';
$lang['edit_user_validation_lname_label']            = 'अंतिम नाम';
$lang['edit_user_validation_email_label']            = 'ईमेल पता';
$lang['edit_user_validation_phone_label']            = 'फ़ोन';
$lang['edit_user_validation_company_label']          = 'कंपनी का नाम';
$lang['edit_user_validation_groups_label']           = 'समूह';
$lang['edit_user_validation_password_label']         = 'पासवर्ड';
$lang['edit_user_validation_password_confirm_label'] = 'पासवर्ड पुष्टि';

// Create Group
$lang['create_group_title']                  = 'समूह बनाएँ';
$lang['create_group_heading']                = 'समूह बनाएँ';
$lang['create_group_subheading']             = 'कृपया नीचे समूह की जानकारी दर्ज करें।';
$lang['create_group_name_label']             = 'समूह का नाम:';
$lang['create_group_desc_label']             = 'विवरण:';
$lang['create_group_submit_btn']             = 'समूह बनाएँ';
$lang['create_group_validation_name_label']  = 'समूह का नाम';
$lang['create_group_validation_desc_label']  = 'विवरण';

// Edit Group
$lang['edit_group_title']                  = 'समूह संपादित करें';
$lang['edit_group_saved']                  = 'समूह सहेजा गया';
$lang['edit_group_heading']                = 'समूह संपादित करें';
$lang['edit_group_subheading']             = 'कृपया नीचे समूह की जानकारी दर्ज करें।';
$lang['edit_group_name_label']             = 'समूह का नाम:';
$lang['edit_group_desc_label']             = 'विवरण:';
$lang['edit_group_submit_btn']             = 'समूह सहेजें';
$lang['edit_group_validation_name_label']  = 'समूह का नाम';
$lang['edit_group_validation_desc_label']  = 'विवरण';

// Change Password
$lang['change_password_heading']                               = 'पासवर्ड बदलें';
$lang['change_password_old_password_label']                    = 'पुराना पासवर्ड:';
$lang['change_password_new_password_label']                    = 'नया पासवर्ड (कम से कम% s वर्ण लंबा):';
$lang['change_password_new_password_confirm_label']            = 'नए पासवर्ड की पुष्टि करें:';
$lang['change_password_submit_btn']                            = 'परिवर्तन';
$lang['change_password_validation_old_password_label']         = 'पुराना पासवर्ड';
$lang['change_password_validation_new_password_label']         = 'नया पासवर्ड';
$lang['change_password_validation_new_password_confirm_label'] = 'नए पासवर्ड की पुष्टि करें';

// Forgot Password
$lang['forgot_password_heading']                 = 'पासवर्ड भूल गए';
$lang['forgot_password_subheading']              = 'कृपया अपना% s दर्ज करें ताकि हम आपका पासवर्ड रीसेट करने के लिए आपको एक ईमेल भेज सकें।';
$lang['forgot_password_email_label']             = '% s:';
$lang['forgot_password_submit_btn']              = 'जमा करें';
$lang['forgot_password_validation_email_label']  = 'ईमेल पता';
$lang['forgot_password_identity_label'] 		 = 'पहचान';
$lang['forgot_password_email_identity_label']    = 'ईमेल';
$lang['forgot_password_email_not_found']         = 'उस ईमेल पते का कोई रिकॉर्ड नहीं है';

// Reset Password
$lang['reset_password_heading']                               = 'पासवर्ड बदलें';
$lang['reset_password_new_password_label']                    = 'नया पासवर्ड (कम से कम% s वर्ण लंबा):';
$lang['reset_password_new_password_confirm_label']            = 'नए पासवर्ड की पुष्टि करें:';
$lang['reset_password_submit_btn']                            = 'परिवर्तन';
$lang['reset_password_validation_new_password_label']         = 'नया पासवर्ड';
$lang['reset_password_validation_new_password_confirm_label'] = 'नए पासवर्ड की पुष्टि करें';

// Header
$lang['header_sign_out'] 			= 'साइन आउट';
$lang['header_online'] 				= 'ऑनलाइन';
$lang['header_main_navidation'] 	= 'मुख्य नेविगेशन';
$lang['header_dashboard'] 			= 'डैशबोर्ड';
$lang['header_product'] 			= 'उत्पाद';
$lang['header_list'] 				= 'सूची';
$lang['header_add'] 				= 'जोड़ना';
$lang['header_product_alert'] 		= 'उत्पाद चेतावनी';
$lang['header_purchase'] 			= 'खरीद फरोख्त';
$lang['header_purchase_return'] 	= 'खरीद वापसी';
$lang['header_transfers'] 			= 'स्थानान्तरण';
$lang['header_sales'] 				= 'बिक्री';
$lang['header_sales_return'] 		= 'बिक्री वापसी';
$lang['header_payment'] 			= 'भुगतान';
$lang['header_invoice'] 			= 'बीजक';
$lang['header_reports'] 			= 'रिपोर्ट';
$lang['header_daily'] 				= 'रोज';
$lang['header_people'] 				= 'लोग';
$lang['header_users'] 				= 'उपयोगकर्ता';
$lang['header_billers'] 			= 'बिलर्स';
$lang['header_clients'] 			= 'ग्राहकों';
$lang['header_suppliers'] 			= 'आपूर्तिकर्ता';
$lang['header_setting'] 			= 'सेटिंग';
$lang['header_company_setting'] 	= 'कंपनी की स्थापना';
$lang['header_category'] 			= 'वर्ग';
$lang['header_sub_category'] 		= 'उपश्रेणी';
$lang['header_branch'] 				= 'डाली';
$lang['header_brand']				= 'ब्रांड';	
$lang['header_discount'] 			= 'छूट';
$lang['header_tax'] 				= 'कर';
$lang['header_warehouse'] 			= 'गोदाम';
$lang['header_assign_warehouse'] 	= 'गोदाम सौंपें';

//Company Settings
$lang['company_setting_name'] 				= 'नाम';
$lang['company_setting_site_short_name'] 	= 'साइट का संक्षिप्त नाम';
$lang['company_setting_country'] 			= 'देश';
$lang['company_setting_select'] 			= 'चुनते हैं';
$lang['company_setting_state'] 				= 'राज्य';
$lang['company_setting_city'] 				= 'शहर';
$lang['company_setting_street'] 			= 'सड़क';
$lang['company_setting_zip_code'] 			= 'पिन कोड';
$lang['company_setting_email'] 				= 'ईमेल';
$lang['company_setting_mobile'] 			= 'मोबाइल';
$lang['company_setting_default_language'] 	= 'डिफ़ॉल्ट भाषा';
$lang['company_setting_default_currency'] 	= 'डिफ़ॉल्ट मुद्रा';
$lang['company_setting_submit'] 			= 'जमा करें';
$lang['company_setting_cancel'] 			= 'रद्द करना';

//Product
$lang['product_list_product'] 			= 'सूची उत्पाद';
$lang['product_add_new_product'] 		= 'नया उत्पाद जोड़ें';
$lang['product_no'] 					= 'संख्या';
$lang['product_image'] 					= 'छवि';
$lang['product_code'] 					= 'कोड';
$lang['product_hsn_sac_code'] 			= 'एचएसएन / एसएसी कोड';
$lang['product_name'] 					= 'नाम';
$lang['product_category'] 				= 'वर्ग';
$lang['product_cost'] 					= 'लागत';
$lang['product_price'] 					= 'मूल्य';
$lang['product_quantity'] 				= 'मात्रा';
$lang['product_unit'] 					= 'इकाई';
$lang['product_alert_quantity'] 		= 'अलर्ट मात्रा';
$lang['product_available_quantity'] 	= 'उपलब्ध मात्रा';
$lang['product_action'] 				= 'कार्य';
$lang['product_add_product'] 			= 'उत्पाद जोड़ें';
$lang['product_product_code'] 			= 'उत्पाद कोड';
$lang['product_product_name'] 			= 'उत्पाद का नाम';
$lang['product_hsn_sac_lookup'] 		= 'एचएसएन / एसएसी लुकअप';
$lang['product_select_category'] 		= 'श्रेणी का चयन करें';
$lang['product_select'] 				= 'चुनते हैं';
$lang['product_select_subcategory'] 	= 'उपश्रेणी चुनें';
$lang['product_product_unit'] 			= 'उत्पाद इकाई';
$lang['product_product_size'] 			= 'उत्पाद का आकार';
$lang['product_product_cost'] 			= 'उत्पाद लागत';
$lang['product_product_price'] 			= 'नेट डीलर प्राइस';
$lang['product_select_product_tax'] 	= 'उत्पाद कर का चयन करें';
$lang['product_no_tax'] 				= 'कोई कर नहीं';
$lang['product_product_image'] 			= 'उत्पाद की छवि';
$lang['product_product_details'] 		= 'चालान के लिए उत्पाद विस्तार';
$lang['product_add'] 					= 'जोड़ना';
$lang['product_cancel'] 				= 'रद्द करना';
$lang['product_hsn'] 					= 'HSN';
$lang['product_sac'] 					= 'सैक';
$lang['product_chapter'] 				= 'अध्याय';
$lang['product_hsn_code'] 				= 'एचएसएन कोड #';
$lang['product_description'] 			= 'विवरण';
$lang['product_sac_code'] 				= 'सैक कोड #';
$lang['product_close'] 					= 'बंद करे';
$lang['product_apply'] 					= 'लागू करें';
$lang['header_edit_product'] 			= 'उत्पाद संपादित करें';
$lang['product_update'] 				= 'अद्यतन';
$lang['product_delete_conform'] 		= 'यकीन है कि यह रिकॉर्ड निकालें?';

//Product Alert
$lang['product_alert_pdf'] 				= 'पीडीएफ';
$lang['header_list_product_alert'] 		= 'सूची उत्पाद चेतावनी सूची';

//transfer
$lang['transfer_dashboard']	 		=	'डैशबोर्ड';
$lang['transfer_transfers']	 		=	'स्थानांतरण';
$lang['transfer_listtransfers']	 	=	'सूची स्थानांतरण';
$lang['transfer_add_new_transfer']	=	'नया स्थानांतरण जोड़ें';
$lang['transfer_no']	 			=	'संख्या';
$lang['transfer_date']	 			=	'तारीख';
$lang['transfer_warehouse_from'] 	=	'गोदाम (से)';
$lang['transfer_warehouse_to']	 	=	'गोदाम (करने के लिए)';
$lang['transfer_total']	 			=	'कुल';
$lang['transfer_actions']	 		=	'क्रिया';
$lang['transfer_add_transfer']	 	=	'स्थानांतरण जोड़ें';
$lang['transfer_to_warehouse']	 	=	'गोदाम के लिए';
$lang['transfer_from_warehouse']	=	'गोदाम से';
$lang['transfer_select_product']	=	'उत्पाद का चयन करें';
$lang['transfer_select']	 		=	'चुनते हैं';
$lang['transfer_inventory_items']	=	'इन्वेंटरी आइटम';
$lang['transfer_code']	 			=	'कोड';
$lang['transfer_quantity']	 		=	'मात्रा';
$lang['transfer_available_qty']	 	=	'उपलब्ध मात्रा';
$lang['transfer_unit']	 			=	'इकाई';
$lang['transfer_cost']	 			=	'लागत';
$lang['transfer_sub_total']	 		=	'उप कुल';
$lang['transfer_grand_total']	 	=	'कुल योग ';
$lang['transfer_note']	 			=	'ध्यान दें';
$lang['transfer_add']	 			=	'जोड़ना';
$lang['transfer_edit_transfer']	 	=	'स्थानांतरण संपादित करें';
$lang['transfer_save']	 			=	'बचाना';

//assaign warehouse
$lang['assign_warehouse']						=	"गोदाम सौंपें";
$lang['assign_warehouse_add_assign_warehouse']	=	"वेयरहाउस सौंपें जोड़ें";
$lang['assign_warehouse_user_name']				=	"उपयोगकर्ता नाम";
$lang['assign_warehouse_select']				=	"चुनते हैं";
$lang['assign_warehouse_warehouse_name']		=	"गोदाम का नाम";
$lang['assign_warehouse_cancel']				=	"रद्द करना";
$lang['assign_warehouse_add']					=	"जोड़ना";
$lang['assign_warehouse_list_assign_warehouse']	=	"सूची वेयरहाउस असाइन करें";
$lang['assign_warehouse_no']					=	"नहीं";
$lang['assign_warehouse_actions']				=	"क्रिया";

//Purchase
$lang['purchase_list_purchase'] 		= 'सूची खरीद';
$lang['purchase_add_new_purchase'] 		= 'नई खरीदारी जोड़ें';
$lang['purchase_date'] 					= 'तारीख';
$lang['purchase_reference_no'] 			= 'संदर्भ संख्या';
$lang['purchase_supplier'] 				= 'प्रदायक';
$lang['purchase_purchase_status'] 		= 'खरीद स्थिति';
$lang['purchase_grand_total'] 			= 'कुल योग';
$lang['purchase_received'] 				= 'प्राप्त किया';
$lang['purchase_purchase_details'] 		= 'खरीदारी का ब्योरा';
$lang['purchase_edit_purchase'] 		= 'खरीद संपादित करें';
$lang['purchase_download_as_pdf'] 		= 'पीडीएफ के रूप में डाउनलोड करें';
$lang['purchase_email_purchase'] 		= 'ईमेल खरीद';
$lang['purchase_delete_purchase'] 		= 'खरीदारी हटाएं';
$lang['purchase_add_purchase'] 			= 'खरीदारी जोड़ें';
$lang['purchase_select_warehouse'] 		= 'वेयरहाउस चुनें';
$lang['purchase_select_supplier'] 		= 'चयन प्रदायक';
$lang['purchase_select_product'] 		= 'उत्पाद चुनें';
$lang['purchase_inventory_items'] 		= 'इन्वेंटरी आइटम';
$lang['purchase_product_description'] 	= 'उत्पाद वर्णन';
$lang['purchase_sub_total'] 			= 'उप कुल';
$lang['purchase_taxable_value'] 		= 'कर योग्य मूल्य';
$lang['purchase_total'] 				= 'कुल';
$lang['purchase_total_value'] 			= 'कुल मूल्य';
$lang['purchase_total_discount'] 		= 'कुल छूट';
$lang['purchase_total_tax'] 			= 'कुल कर';
$lang['purchase_note'] 					= 'ध्यान दें';
$lang['purchase_total_sales'] 			= 'कुल बिक्री';
$lang['purchase_total_amount'] 			= 'कुल रकम';
$lang['purchase_edit'] 					= 'संपादन';
$lang['purchase_delete'] 				= 'नष्ट करें';
$lang['purchase_to'] 					= 'सेवा मेरे';
$lang['purchase_from'] 					= 'प्रेषक';
$lang['purchase_mobile'] 				= 'मोबाइल';
$lang['purchase_ordered_by'] 			= 'के द्वारा आदेश';
$lang['purchase_stamp_and_signature']	= 'स्टाम्प और हस्ताक्षर';

//Purchase Return
$lang['purchase_return_list_purchase_return'] 		= 'सूची खरीद वापसी';
$lang['purchase_return_add_new_purchase_return'] 	= 'नई खरीद वापसी जोड़ें';
$lang['purchase_return_add_purchase_return'] 		= 'खरीद वापसी जोड़ें';
$lang['purchase_return_grand_total'] 				= 'ग्रांड कुल: 0.00';
$lang['purchase_return_edit_purchase_return'] 		= 'क्रय रिटर्न संपादित करें';
$lang['purchase_return_edit_grand_total'] 			= 'कुल योग :';

//sales
$lang['sales_list_sales'] 				= 'सूची बिक्री';
$lang['sales_add_new_sales'] 			= 'नई बिक्री जोड़ें';
$lang['sales_biller'] 					= 'बिलर';
$lang['sales_client'] 				= 'ग्राहक';
$lang['sales_sales_status'] 			= 'बिक्री स्थिति';
$lang['sales_payment_status'] 			= 'भुगतान की स्थिति';
$lang['sales_paid'] 					= 'भुगतान किया है';
$lang['sales_complited'] 				= 'पूरा कर लिया है';
$lang['sales_pending'] 					= 'लंबित';
$lang['sales_sales_details'] 			= 'बिक्री विवरण';
$lang['sales_add_payment'] 				= 'भुगतान जोड़ें';
$lang['sales_edit_sales'] 				= 'बिक्री संपादित करें';
$lang['sales_email_sales'] 				= 'ईमेल बिक्री';
$lang['sales_delete_sales'] 			= 'बिक्री हटाएं';
$lang['sales_add_sales'] 				= 'बिक्री जोड़ें';
$lang['sales_select_biller'] 			= 'बिलर चुनें';
$lang['sales_select_client'] 			= 'ग्राहक चुनें';
$lang['sales_internal_note'] 			= 'आंतरिक नोट';
$lang['sales_status'] 					= 'स्थिति';
$lang['sales_balance'] 					= 'शेष';
$lang['sales_invoice'] 					= 'चालान';
$lang['sales_client_details'] 		= 'उपभोक्ता विवरण';
$lang['sales_pos'] 						= 'स्थिति';
$lang['sales_invoice_hash'] 			= 'चालान #';
$lang['sales_address'] 					= 'पता';
$lang['sales_product_wise_details'] 	= 'उत्पाद-वार विवरण';
$lang['sales_cgst'] 					= 'सीजीएसटी';
$lang['sales_sgst'] 					= 'एसजीएसटी';
$lang['sales_igst'] 					= 'आईजीएसटी';
$lang['sales_total_sales'] 				= 'बिक्री कुल';
$lang['sales_remarks'] 					= 'टिप्पणियों:';
$lang['sales_summary'] 					= 'सारांश';
$lang['sales_amount'] 					= 'रकम';
$lang['sales_total_invoice_value'] 		= 'कुल चालान मान';
$lang['sales_total_cgst'] 				= 'कुल सीजीएसटी';
$lang['sales_receivers_signature'] 		= 'रिसीवर के हस्ताक्षर';
$lang['sales_senior_accounts_manager'] 	= 'सीनियर अकाउंट मैनेजर';
$lang['sales_total_sgst'] 				= 'कुल एसजीएसटी';
$lang['slaes_invoice_note'] 			= 'नोट: कंपनी के नाम पर देय सभी चेक करें';
$lang['sales_igst'] 					= 'कुल आईजीएसटी';
$lang['sales_thank_you'] 				= 'आपके व्यापार के लिए धन्यवाद';
$lang['sales_edit_sales'] 				= 'बिक्री संपादित करें';
$lang['sales_pay']		 				= 'वेतन';
$lang['sales_list_invoice']		 		= 'सूची चालान';
$lang['sales_sales_amount']		 		= 'बिक्री मूल्य';
$lang['sales_paid_amount']		 		= 'भरी गई राशि';
$lang['sales_invoice_no']		 		= 'चालान नंबर';

//Sales Return
$lang['sales_return_list_sales_return'] 	= 'सूची बिक्री वापसी';
$lang['sales_return_add_new_sales_return'] 	= 'नई बिक्री वापसी जोड़ें';
$lang['sales_return_add_sales_return'] 		= 'सेल्स रिटर्न जोड़ें';
$lang['sales_return_edit_sales_return'] 	= 'बिक्री बिक्री संपादित करें';

//payment
$lang['payment_list_payment'] 				= 'सूची भुगतान';
$lang['payment_paying_by'] 					= 'पेइंग बाय';
$lang['payment_edit_payment'] 				= 'भुगतान संपादित करें';
$lang['payment_bank_name'] 					= 'बैंक का नाम';
$lang['payment_cheque_no'] 					= 'चेक नं';
$lang['sales_amount'] 						= 'रकम';

//Reports
$lang['reports_daily_reports'] 				= 'दैनिक रिपोर्ट';
$lang['reports_current_month_sales'] 		= 'वर्तमान महीना बिक्री:';
$lang['reports_profite'] 					= 'फायदा :';
$lang['reports_product_reports'] 			= 'उत्पाद रिपोर्ट';
$lang['reports_start_date'] 				= 'आरंभ करने की तिथि';
$lang['reports_end_date'] 					= 'अंतिम तिथि';
$lang['reports_purchased'] 					= 'खरीदा';
$lang['reports_sold'] 						= 'बिक';
$lang['reports_profite_title'] 				= 'फायदा';
$lang['reports_purchase_reports'] 			= 'रिपोर्ट खरीद';
$lang['reports_created_by'] 				= 'के द्वारा बनाई गई ';
$lang['reports_supplier'] 					= 'प्रदायक';
$lang['reports_product_qty'] 				= 'उत्पाद (मात्रा)';
$lang['reports_hide_show'] 					= 'छिपाएं दिखाएं';
$lang['reports_submit'] 					= 'जमा करें';
$lang['reports_purchase_return_reports'] 	= 'क्रय रिटर्न रिपोर्ट';
$lang['reports_sales_reports'] 				= 'बिक्री रिपोर्ट';
$lang['reports_biller'] 					= 'बिलर';
$lang['reports_client'] 					= 'ग्राहक';
$lang['reports_sales_return_reports'] 		= 'बिक्री वापसी';

//Dashboard
$lang['dashboard_today'] 					= 'आज';
$lang['dashboard_this_week'] 				= 'इस सप्ताह';
$lang['dashboard_this_month'] 				= 'इस महीने';
$lang['dashboard_this_year'] 				= 'इस साल';
$lang['dashboard_all_time'] 				= 'पूरा समय';
$lang['dashboard_new_items'] 				= 'नई वस्तुएं';
$lang['dashboard_purchase_item'] 			= 'खरीदा गया आइटम';
$lang['dashboard_sold_items'] 				= 'सोल्ड आइटम्स';
$lang['dashboard_purchase_value'] 			= 'खरीदे गए मूल्य';
$lang['dashboard_sales_value'] 				= 'बिक्री मूल्य';
$lang['dashboard_yearly_sales'] 			= 'वार्षिक बिक्री';
$lang['dashboard_total_sales'] 				= 'कुल बिक्री';
$lang['dashboard_value_in_warehouse'] 		= 'वेयरहाउस में मूल्य';
$lang['dashboard_warehouse_products'] 		= 'वेयरहाउस उत्पाद';
$lang['dashboard_no_of_items'] 				= 'मदों की संख्या';
$lang['dashboard_rights_reserved'] 			= 'अधिकार सुरक्षित।';
$lang['dashboard_copyright'] 				= 'कॉपीराइट';
$lang['dashboard_version'] 					= 'संस्करण';
$lang['dashboard_month'] 					= 'महीना';
$lang['dashboard_sales_performance'] 		= 'बिक्री प्रदर्शन';
$lang['dashboard_sales_of_company'] 		= 'कंपनी की बिक्री';


/***   User    ***/

$lang['user_lable'] 	   		= 'उपयोगकर्ता';
$lang['user_lable_header'] 		= 'सूची उपयोगकर्ता';
$lang['user_btn_new'] 	   		= 'नई उपयोगकर्ता को जोड़ना';
$lang['user_lable_fname']  		= 'पहला नाम';
$lang['user_lable_lname']  		= 'अंतिम नाम';
$lang['user_lable_email']  		= 'ईमेल';
$lang['user_lable_group']  		= 'समूह';
$lang['user_lable_status'] 		= 'स्थिति';
$lang['user_lable_action'] 		= 'कार्रवाई';

$lang['add_user_header'] 		= 'उपयोगकर्ता जोड़ें';
$lang['add_user_label'] 		= 'नई उपयोगकर्ता को जोड़ना';
$lang['add_user_company'] 		= 'कंपनी का नाम';
$lang['add_user_mobile'] 		= 'मोबाइल नहीं है';
$lang['add_user_password'] 	   	= 'पासवर्ड';
$lang['add_user_confpassword'] 	= 'पासवर्ड की पुष्टि कीजिये';
$lang['add_user_btn'] 			= 'जोड़ें';
$lang['add_user_btn_cancel'] 	= 'रद्द करना';
$lang['edit_user_header'] 		= 'यूजर को संपादित करो';
$lang['edit_user_member'] 		= 'समूह का सदस्य';
$lang['edit_user_btn'] 			= 'अद्यतन';



/*****   Billers ***/

$lang['biller_lable'] 	   		= 'बिलर्स';
$lang['biller_header'] 	   		= 'लिस्ट बिलर्स';
$lang['biller_btn_add'] 	   	= 'नए बिलर्स जोड़ें';
$lang['biller_lable_no'] 	   	= 'नहीं';
$lang['biller_lable_name'] 	   	= 'नाम';
$lang['biller_lable_company'] 	= 'कंपनी';
$lang['biller_lable_phone'] 	= 'फ़ोन';
$lang['biller_lable_email'] 	= 'ईमेल पता';
$lang['biller_lable_city'] 	    = 'शहर';
$lang['biller_lable_country'] 	= 'देश';
$lang['biller_lable_action'] 	= 'कार्रवाई';


$lang['add_biller_label'] 		= 'बिलर जोड़ें';
$lang['add_biller_header'] 		= 'नई बिलर जोड़ें';
$lang['add_biller_billname'] 	= 'बिलर का नाम';
$lang['add_biller_gst'] 		= 'GSTIN';
$lang['add_biller_select_branch'] = 'शाखा चुनें';
$lang['add_biller_select']      = 'चुनते हैं';
$lang['add_biller_address'] 	= 'पता';
$lang['add_biller_state'] 		= 'स्थिति';
$lang['add_biller_fax'] 		= 'फैक्स';
$lang['add_biller_telephone'] 	= 'टेलीफोन';
$lang['add_biller_mobile'] 		= 'मोबाइल';
$lang['edit_biller_header'] 	= 'बिलर संपादित करें';
$lang['edit_biller_btn'] 		= 'अद्यतन';

/***** Clients *******/

$lang['client_header'] 			= 'ग्राहक';
$lang['client_label'] 			= 'सूची ग्राहक';
$lang['client_btn_add'] 			= 'नया ग्राहक जोड़ें';
$lang['add_client_label'] 		= 'ग्राहक जोड़ें';
$lang['add_client_header'] 		= 'नया ग्राहक जोड़ें';
$lang['add_client_cname'] 		= 'ग्राहक का नाम';
$lang['add_client_compname'] 		= 'कंपनी का नाम';
$lang['add_client_code'] 			= 'डाक कोड';
$lang['edit_client_header'] 		= 'ग्राहक संपादित करें';


/****** Supplier ****/

$lang['supplier_header'] 		= 'प्रदायक';
$lang['supplier_label'] 		= 'सूची आपूर्तिकर्ता';
$lang['supplier_btn_add'] 		= 'नई आपूर्तिकर्ता जोड़ें';
$lang['supplier_add'] 			= 'आपूर्तिकर्ता जोड़ें';
$lang['add_supplier_name'] 		= 'आपूर्तिकर्ता का नाम';
$lang['edit_supplier_header'] 	= 'प्रदाता को संपादित करें';


/**** Warehouse *********/

$lang['warehouse_header'] 		= 'गोदाम';
$lang['warehouse_label'] 		= 'सूची वेअरहाउस';
$lang['warehouse_label_no'] 	= 'नहीं';
$lang['warehouse_label_wname'] 	= 'गोदाम का नाम';
$lang['warehouse_label_bname'] 	= 'शाखा का नाम';
$lang['warehouse_label_uname'] 	= 'उपयोगकर्ता नाम';
$lang['warehouse_label_action'] = 'क्रिया';
$lang['warehouse_btn_new'] 		= 'नया गोदाम जोड़ें';

$lang['add_warehouse'] 			= 'वेयरहाउस जोड़ें';
$lang['add_warehouse_name'] 	= 'गोदाम का नाम';
$lang['edit_warehouse_header'] 	= 'वेयरहाउस संपादित करें';

//Category

$lang['category_add'] 						= 'जोड़ें';
$lang['category_cancel'] 					= 'रद्द करना';
$lang['category_lable'] 					= 'वर्ग';
$lang['category_lable_addcategory'] 		= 'श्रेणी जोड़ना';
$lang['category_lable_editcategory'] 		= 'श्रेणी संपादित करें';
$lang['category_lable_no'] 					= 'नहीं';
$lang['category_lable_code'] 				= 'श्रेणी कोड';
$lang['category_lable_cname'] 				= 'श्रेणी नाम';
$lang['category_lable_actions'] 			= 'क्रिया';
$lang['category_lable_lcategory'] 			= 'सूची श्रेणी';
$lang['category_lable_newcategory'] 		= 'नई श्रेणी जोड़ें';

//Subcategory
$lang['subcategory_add'] 					= 'जोड़ें';
$lang['subcategory_cancel'] 				= 'रद्द करना';
$lang['subcategory_update'] 				= 'अद्यतन';
$lang['subcategory_label'] 					= 'उपश्रेणी';
$lang['subcategory_label_add'] 				= 'उपश्रेणी जोड़ें';
$lang['subcategory_newcategory'] 			= 'नई उपश्रेणी जोड़ें';
$lang['subcategory_label_select'] 			= 'श्रेणी का चयन करें';
$lang['subcategory_label_name'] 			= 'उपश्रेणी नाम';
$lang['subcategory_label_listcategory'] 	= 'सूची उपश्रेणी';
$lang['subcategory_cancel'] 				= 'रद्द करना';
$lang['subcategory_label_code'] 			= 'उपश्रेणी कोड';
$lang['subcategory_label_main'] 			= 'मुख्य श्रेणी';
$lang['subcategory_label_name'] 			= 'उपश्रेणी नाम';
$lang['subcategory_label_edit'] 			= 'उपश्रेणी संपादित करें';

//Branch
$lang['branch_label'] 						= 'डाली';
$lang['branch_label_name'] 					= 'शाखा का नाम';
$lang['branch_label_city'] 					= 'शहर';
$lang['branch_label_address'] 				= 'पता';
$lang['branch_label_add'] 					= 'जोड़ें';
$lang['branch_label_newbranch'] 			= 'नई शाखा जोड़ें';
$lang['branch_label_cancel'] 				= 'रद्द करना';
$lang['branch_label_addbranch'] 			= 'शाखा जोड़ें';
$lang['branch_label_edit'] 					= 'शाखा संपादित करें';

//Discount

$lang['discount_label_name'] 				= 'डिस्काउंट नाम';
$lang['discount_label_value'] 				= 'डिस्काउंट वैल्यू';
$lang['discount_label'] 					= 'छूट';
$lang['discount_label_username'] 			= 'उपयोगकर्ता नाम';
$lang['discount_label_add']					= 'जोड़ें';
$lang['discount_label_newbranch'] 			= 'नया डिस्काउंट जोड़ें';
$lang['discount_label_cancel'] 				= 'रद्द करना';
$lang['discount_label_addbranch'] 			= 'डिस्काउंट जोड़ें';
$lang['discount_label_list'] 				= 'सूची छूट';
$lang['discount_label_edit'] 				= 'डिस्काउंट संपादित करें';
$lang['discount_label_update'] 				= 'अद्यतन';

//Tax

$lang['tax_label_name'] 				= 'कर नाम';
$lang['tax_label_form'] 				= 'शुरू से';
$lang['tax_label_rnumber'] 				= 'पंजीकरण संख्या';
$lang['tax_label_frequency'] 			= 'भरने की आवृत्ति';
$lang['tax_label_desc'] 				= 'विवरण';
$lang['tax_label_applies'] 				= 'कर लागू होता है';
$lang['tax_label_calculate'] 			= 'पर गणना';
$lang['tax_label_salesrate'] 			= 'बिक्री कर की दर';
$lang['tax_label_addnew'] 				= 'नया टैक्स जोड़ें';
$lang['tax_label_add'] 					= 'टैक्स जोड़ें';
$lang['tax_label_purchaserate'] 		= 'टैक्स दर खरीद';
$lang['tax_label_list'] 				= 'सूची कर';
$lang['tax_label'] 						= 'कर';
$lang['tax_label_Edit'] 				= 'कर संपादित करें';