<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - Turkish
*
* Author: Hüseyin Kozan
* 		  posta@huseyinkozan.com.tr
*         @huseyinkozan
*
* Location: http://github.com/huseyinkozan/CodeIgniter-Ion-Auth/
*
* Created:  21.08.2014
*
* Description:  Turkish language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'Gönderilen form verisi güvenlik kontrolünden geçemedi.';

// Login
$lang['login_heading']         = 'Giriş';
$lang['login_subheading']      = 'Lütfen kullanıcı adınız/epostanız ve şifreniz ile giriş yapın. ';
$lang['login_identity_label']  = 'Eposta/Kullanıcı Adı:';
$lang['login_password_label']  = 'Şifre:';
$lang['login_remember_label']  = 'Beni Hatırla:';
$lang['login_submit_btn']      = 'Gir';
$lang['login_forgot_password'] = 'Şifrenizi mi unuttunuz ?';

// Index
$lang['index_heading']           = 'Kullanıcılar';
$lang['index_subheading']        = 'Aşağıdaki kullanıcıların listesidir.';
$lang['index_fname_th']          = 'İsim';
$lang['index_lname_th']          = 'Soyisim';
$lang['index_email_th']          = 'Eposta';
$lang['index_groups_th']         = 'Gruplar';
$lang['index_status_th']         = 'Durum';
$lang['index_action_th']         = 'Eylem';
$lang['index_active_link']       = 'Etkin';
$lang['index_inactive_link']     = 'Etkin Değil';
$lang['index_create_user_link']  = 'Yeni bir kullanıcı oluştur';
$lang['index_create_group_link'] = 'Yeni bir grup oluştur';

// Deactivate User
$lang['deactivate_heading']                  = 'Kullanıcı Devre Dışı Bırakma';
$lang['deactivate_subheading']               = '\'%s\' Kullanıcısını devre dışı bırakmak istediğinizden emin misiniz ?';
$lang['deactivate_confirm_y_label']          = 'Evet:';
$lang['deactivate_confirm_n_label']          = 'Hayır:';
$lang['deactivate_submit_btn']               = 'Kaydet';
$lang['deactivate_validation_confirm_label'] = 'onaylama';
$lang['deactivate_validation_user_id_label'] = 'kullanıcı ID';

// Create User
$lang['create_user_heading']                           = 'Kullanıcı Oluşturma';
$lang['create_user_subheading']                        = 'Kullanıcı bilgilerini aşağıya giriniz.';
$lang['create_user_fname_label']                       = 'İsim:';
$lang['create_user_lname_label']                       = 'Soyisim:';
$lang['create_user_identity_label']                    = 'Identity:';
$lang['create_user_company_label']                     = 'Şirket İsmi:';
$lang['create_user_email_label']                       = 'Eposta:';
$lang['create_user_phone_label']                       = 'Telefon:';
$lang['create_user_password_label']                    = 'Şifre:';
$lang['create_user_password_confirm_label']            = 'Şifre Tekrarı:';
$lang['create_user_submit_btn']                        = 'Kullanıcı Oluştur';
$lang['create_user_validation_fname_label']            = 'İsim';
$lang['create_user_validation_lname_label']            = 'Soyisim';
$lang['create_user_validation_identity_label']         = 'Identity';
$lang['create_user_validation_email_label']            = 'Eposta Adresi';
$lang['create_user_validation_phone1_label']           = 'Telefonun İlk Kısmı';
$lang['create_user_validation_phone2_label']           = 'Telefonun İkinci Kısmı';
$lang['create_user_validation_phone3_label']           = 'Telefonun Üçüncü Kısmı';
$lang['create_user_validation_company_label']          = 'Şirket İsmi';
$lang['create_user_validation_password_label']         = 'Şifre';
$lang['create_user_validation_password_confirm_label'] = 'Şifre Tekrarı';

// Edit User
$lang['edit_user_heading']                           = 'Kullanıcı Düzenleme';
$lang['edit_user_subheading']                        = 'Kullanıcı bilgilerini aşağıya giriniz.';
$lang['edit_user_fname_label']                       = 'İsim:';
$lang['edit_user_lname_label']                       = 'Soyisim:';
$lang['edit_user_company_label']                     = 'Şirket İsmi:';
$lang['edit_user_email_label']                       = 'Eposta:';
$lang['edit_user_phone_label']                       = 'Telefon:';
$lang['edit_user_password_label']                    = 'Şifre: (Eğer değişecekse)';
$lang['edit_user_password_confirm_label']            = 'Şifre Tekrarı: (Eğer değişecekse)';
$lang['edit_user_groups_heading']                    = 'Üye olduğu gruplar';
$lang['edit_user_submit_btn']                        = 'Kullanıcıyı Kaydet';
$lang['edit_user_validation_fname_label']            = 'İsim';
$lang['edit_user_validation_lname_label']            = 'Soyisim';
$lang['edit_user_validation_email_label']            = 'Eposta Adresi';
$lang['edit_user_validation_phone1_label']           = 'Telefonun İlk Kısmı';
$lang['edit_user_validation_phone2_label']           = 'Telefonun İkinci Kısmı';
$lang['edit_user_validation_phone3_label']           = 'Telefonun Üçüncü Kısmı';
$lang['edit_user_validation_company_label']          = 'Şirket İsmi';
$lang['edit_user_validation_groups_label']           = 'Gruplar';
$lang['edit_user_validation_password_label']         = 'Şifre';
$lang['edit_user_validation_password_confirm_label'] = 'Şifre Tekrarı';

// Create Group
$lang['create_group_title']                  = 'Grup Oluşturma';
$lang['create_group_heading']                = 'Grup Oluşturma';
$lang['create_group_subheading']             = 'Grup bilgilerini aşağıya giriniz.';
$lang['create_group_name_label']             = 'Grup İsmi:';
$lang['create_group_desc_label']             = 'Açıklama:';
$lang['create_group_submit_btn']             = 'Grubu Oluştur';
$lang['create_group_validation_name_label']  = 'Grup İsmi';
$lang['create_group_validation_desc_label']  = 'Açıklama';

// Edit Group
$lang['edit_group_title']                  = 'Grup Düzenleme';
$lang['edit_group_saved']                  = 'Grup Kaydedildi';
$lang['edit_group_heading']                = 'Grup Düzenleme';
$lang['edit_group_subheading']             = 'Grup bilgilerini aşağıya giriniz.';
$lang['edit_group_name_label']             = 'Grup İsmi:';
$lang['edit_group_desc_label']             = 'Açıklama:';
$lang['edit_group_submit_btn']             = 'Grubu Kaydet';
$lang['edit_group_validation_name_label']  = 'Grup İsmi';
$lang['edit_group_validation_desc_label']  = 'Açıklama';

// Change Password
$lang['change_password_heading']                               = 'Şifre Değiştirme';
$lang['change_password_old_password_label']                    = 'Eski Şifre:';
$lang['change_password_new_password_label']                    = 'Yeni Şifre (en az %s karakter uzunluğunda):';
$lang['change_password_new_password_confirm_label']            = 'Yeni Şifre Tekrarı:';
$lang['change_password_submit_btn']                            = 'Değiştir';
$lang['change_password_validation_old_password_label']         = 'Eski Şifre';
$lang['change_password_validation_new_password_label']         = 'Yeni Şifre';
$lang['change_password_validation_new_password_confirm_label'] = 'Yeni Şifre Tekrarı';

// Forgot Password
$lang['forgot_password_heading']                 = 'Şifremi Unuttum';
$lang['forgot_password_subheading']              = 'Şifrenizi sıfırlamanızı sağlayacak eposta gönderebilmemiz için %s giriniz.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Gönder';
$lang['forgot_password_validation_email_label']  = 'Eposta Adresi';
$lang['forgot_password_username_identity_label'] = 'Kullanıcı Adı';
$lang['forgot_password_email_identity_label']    = 'Eposta';
$lang['forgot_password_email_not_found']         = 'Belirttiğiniz Eposta adresi için bir kayıt bulunamadı.';
$lang['forgot_password_identity_not_found']         = 'No record of that username address.';

// Reset Password
$lang['reset_password_heading']                               = 'Şifre Değiştirme';
$lang['reset_password_new_password_label']                    = 'Yeni Şifre (en az %s karakter uzunluğunda):';
$lang['reset_password_new_password_confirm_label']            = 'Yeni Şifre Tekrarı:';
$lang['reset_password_submit_btn']                            = 'Değiştir';
$lang['reset_password_validation_new_password_label']         = 'Yeni Şifre';
$lang['reset_password_validation_new_password_confirm_label'] = 'Yeni Şifre Tekrarı';

// Activation Email
$lang['email_activate_heading']    = '%s İçin Hesap Etkinleştirme';
$lang['email_activate_subheading'] = 'Bağlantıya basarak %s.';
$lang['email_activate_link']       = 'Hesabınızı Etkinleştiriniz';

// Forgot Password Email
$lang['email_forgot_password_heading']    = '%s İçin Şifre Sıfırlama';
$lang['email_forgot_password_subheading'] = 'Bağlantıya basarak %s.';
$lang['email_forgot_password_link']       = 'Şifrenizi Sıfırlayınız';

// New Password Email
$lang['email_new_password_heading']    = '%s İçin Yeni Şifre';
$lang['email_new_password_subheading'] = 'Şifreniz %s olarak değiştirildi';

// Header
$lang['header_sign_out'] 			= 'oturumu Kapat';
$lang['header_online'] 				= 'İnternet üzerinden';
$lang['header_main_navidation'] 	= 'ANA NAVİGASYON';
$lang['header_dashboard'] 			= 'gösterge paneli';
$lang['header_product'] 			= 'Ürün';
$lang['header_list'] 				= 'Liste';
$lang['header_add'] 				= 'Eklemek';
$lang['header_product_alert'] 		= 'Ürün Uyarısı';
$lang['header_purchase'] 			= 'Satın alma';
$lang['header_purchase_return'] 	= 'Geri Dönüş Satın Alın';
$lang['header_transfers'] 			= 'Geçişler';
$lang['header_sales'] 				= 'Satış';
$lang['header_sales_return'] 		= 'Satış İadesi';
$lang['header_payment'] 			= 'Ödeme';
$lang['header_invoice'] 			= 'Fatura';
$lang['header_reports'] 			= 'Raporlar';
$lang['header_daily'] 				= 'Günlük';
$lang['header_people'] 				= 'İnsanlar';
$lang['header_users'] 				= 'Kullanıcılar';
$lang['header_billers'] 			= 'fatura eden';
$lang['header_clients'] 			= 'Müşteriler';
$lang['header_suppliers'] 			= 'Tedarikçiler';
$lang['header_setting'] 			= 'Ayar';
$lang['header_company_setting'] 	= 'Şirketin Kuruluşu';
$lang['header_category'] 			= 'Kategori';
$lang['header_sub_category'] 		= 'Alt kategori';
$lang['header_branch'] 				= 'şube';
$lang['header_brand']				= 'marka';
$lang['header_discount'] 			= 'İndirim';
$lang['header_tax'] 				= 'Vergi';
$lang['header_warehouse'] 			= 'Depo';
$lang['header_assign_warehouse'] 	= 'Atölyesi Ata';

//Company Settings
$lang['company_setting_name'] 				= 'isim';
$lang['company_setting_site_short_name'] 	= 'Site Kısa Adı';
$lang['company_setting_country'] 			= 'ülke';
$lang['company_setting_select'] 			= 'seçmek';
$lang['company_setting_state'] 				= 'Belirtmek, bildirmek';
$lang['company_setting_city'] 				= 'Şehir';
$lang['company_setting_street'] 			= 'sokak';
$lang['company_setting_zip_code'] 			= 'Posta kodu';
$lang['company_setting_email'] 				= 'E-posta';
$lang['company_setting_mobile'] 			= 'seyyar';
$lang['company_setting_default_language'] 	= 'Varsayılan dil';
$lang['company_setting_default_currency'] 	= 'Varsayılan Para Birimi';
$lang['company_setting_submit'] 			= 'Gönder';
$lang['company_setting_cancel'] 			= 'İptal etmek';

//Product
$lang['product_list_product'] 			= 'Ürün Listeleme';
$lang['product_add_new_product'] 		= 'Yeni Ürün Ekle';
$lang['product_no'] 					= 'Yok hayır';
$lang['product_image'] 					= 'görüntü';
$lang['product_code'] 					= 'kod';
$lang['product_hsn_sac_code'] 			= 'HSN / SAC Kodu';
$lang['product_name'] 					= 'isim';
$lang['product_category'] 				= 'Kategori';
$lang['product_cost'] 					= 'Maliyet';
$lang['product_price'] 					= 'Fiyat';
$lang['product_quantity'] 				= 'miktar';
$lang['product_unit'] 					= 'birim';
$lang['product_alert_quantity'] 		= 'Uyarı Miktarı';
$lang['product_available_quantity'] 	= 'Mevcut Miktarı';
$lang['product_action'] 				= 'Aksiyon';
$lang['product_add_product'] 			= 'Ürün Ekle';
$lang['product_product_code'] 			= 'Ürün Kodu';
$lang['product_product_name'] 			= 'Ürün adı';
$lang['product_hsn_sac_lookup'] 		= 'HSN / SAC Arama';
$lang['product_select_category'] 		= 'Kategori seç';
$lang['product_select'] 				= 'seçmek';
$lang['product_select_subcategory'] 	= 'Alt kategori seçin';
$lang['product_product_unit'] 			= 'Ürün Birimi';
$lang['product_product_size'] 			= 'Ürün boyutu';
$lang['product_product_cost'] 			= 'Ürün maliyeti';
$lang['product_product_price'] 			= 'Net Bayi Fiyatı';
$lang['product_select_product_tax'] 	= 'Ürün Vergi Seç';
$lang['product_no_tax'] 				= 'Vergisiz';
$lang['product_product_image'] 			= 'Ürün resmi';
$lang['product_product_details'] 		= 'Fatura İçin Ürün Detayı';
$lang['product_add'] 					= 'Eklemek';
$lang['product_cancel'] 				= 'İptal etmek';
$lang['product_hsn'] 					= 'HSN';
$lang['product_sac'] 					= 'SAC';
$lang['product_chapter'] 				= 'bölüm';
$lang['product_hsn_code'] 				= 'HSN Kodları#';
$lang['product_description'] 			= 'Açıklama';
$lang['product_sac_code'] 				= 'SAC Kodları#';
$lang['product_close'] 					= 'Kapat';
$lang['product_apply'] 					= 'Uygulamak';
$lang['header_edit_product'] 			= 'Ürünü Düzenle';
$lang['product_update'] 				= 'Güncelleştirme';
$lang['product_delete_conform'] 		= 'Bu Kaydı Kaldırmak İçin Elbette ?';

//Product Alert
$lang['product_alert_pdf'] 				= 'PDF';
$lang['header_list_product_alert'] 		= 'Ürün Uyarısını Listele';

//transfer
$lang['transfer_dashboard']	 		=	'gösterge paneli';
$lang['transfer_transfers']	 		=	'Transferler';
$lang['transfer_listtransfers']	 	=	'Transferleri Listele';
$lang['transfer_add_new_transfer']	=	'Yeni Aktarım Ekle';
$lang['transfer_no']	 			=	'Yok hayır';
$lang['transfer_date']	 			=	'tarih';
$lang['transfer_warehouse_from'] 	=	'Depo (Dan)';
$lang['transfer_warehouse_to']	 	=	'Depo (To)';
$lang['transfer_total']	 			=	'Genel Toplam';
$lang['transfer_actions']	 		=	'Eylemler';
$lang['transfer_add_transfer']	 	=	'Aktarımı Ekle';
$lang['transfer_to_warehouse']	 	=	'Depoya';
$lang['transfer_from_warehouse']	=	'Depodan';
$lang['transfer_select_product']	=	'Ürün Seçiniz';
$lang['transfer_select']	 		=	'seçmek';
$lang['transfer_inventory_items']	=	'Envanter Öğeleri';
$lang['transfer_code']	 			=	'kod';
$lang['transfer_quantity']	 		=	'miktar';
$lang['transfer_available_qty']	 	=	'Mevcut Miktar';
$lang['transfer_unit']	 			=	'birim';
$lang['transfer_cost']	 			=	'Maliyet';
$lang['transfer_sub_total']	 		=	'Alt Toplam';
$lang['transfer_grand_total']	 	=	'Genel Toplam ';
$lang['transfer_note']	 			=	'Not';
$lang['transfer_add']	 			=	'Eklemek';
$lang['transfer_edit_transfer']	 	=	'Aktarımı Düzenle';
$lang['transfer_save']	 			=	'Kayıt etmek';

//assaign warehouse
$lang['assign_warehouse']						=	"Atölyesi Ata";
$lang['assign_warehouse_add_assign_warehouse']	=	"Atama Ambarını Ekle";
$lang['assign_warehouse_user_name']				=	"Kullanıcı adı";
$lang['assign_warehouse_select']				=	"seçmek";
$lang['assign_warehouse_warehouse_name']		=	"Depo adı";
$lang['assign_warehouse_cancel']				=	"İptal etmek";
$lang['assign_warehouse_add']					=	"Eklemek";
$lang['assign_warehouse_list_assign_warehouse']	=	"Atölye Atölyesini Listele";
$lang['assign_warehouse_no']					=	"Yok hayır";
$lang['assign_warehouse_actions']				=	"Eylemler";

//Purchase
$lang['purchase_list_purchase'] 		= 'Satın Alma Listesini Oluştur';
$lang['purchase_add_new_purchase'] 		= 'Yeni Satın Alma Ekle';
$lang['purchase_date'] 					= 'tarih';
$lang['purchase_reference_no'] 			= 'Referans Numarası';
$lang['purchase_supplier'] 				= 'satıcı';
$lang['purchase_purchase_status'] 		= 'Satın Alma Durumu';
$lang['purchase_grand_total'] 			= 'Genel Toplam';
$lang['purchase_received'] 				= 'Alınan';
$lang['purchase_purchase_details'] 		= 'Satın Alma Ayrıntıları';
$lang['purchase_edit_purchase'] 		= 'Satın Almayı Düzenle';
$lang['purchase_download_as_pdf'] 		= 'PDf olarak indir';
$lang['purchase_email_purchase'] 		= 'E-posta Satın Alma';
$lang['purchase_delete_purchase'] 		= 'Satın Alma Silme';
$lang['purchase_add_purchase'] 			= 'Satın Alma Ekle';
$lang['purchase_select_warehouse'] 		= 'Depoyu seçin';
$lang['purchase_select_supplier'] 		= 'Tedarikçi Seçiniz';
$lang['purchase_select_product'] 		= 'Ürün Seçiniz';
$lang['purchase_inventory_items'] 		= 'Envanter Öğeleri';
$lang['purchase_product_description'] 	= 'Ürün Açıklaması';
$lang['purchase_sub_total'] 			= 'Alt Toplam';
$lang['purchase_taxable_value'] 		= 'Vergiye tabi değer';
$lang['purchase_total'] 				= 'Genel Toplam';
$lang['purchase_total_value'] 			= 'Toplam değer';
$lang['purchase_total_discount'] 		= 'Toplam İndirim';
$lang['purchase_total_tax'] 			= 'Toplam Vergi';
$lang['purchase_note'] 					= 'Not';
$lang['purchase_total_sales'] 			= 'Toplam satış';
$lang['purchase_total_amount'] 			= 'Toplam tutar';
$lang['purchase_edit'] 					= 'Düzenleme';
$lang['purchase_delete'] 				= 'silmek';
$lang['purchase_to'] 					= 'için';
$lang['purchase_from'] 					= 'itibaren';
$lang['purchase_mobile'] 				= 'seyyar';
$lang['purchase_ordered_by'] 			= 'Sipariş Edilen';
$lang['purchase_stamp_and_signature']	= 'Damga ve İmza';

//Purchase Return
$lang['purchase_return_list_purchase_return'] 		= 'Satın Alma İade Listesini Listele';
$lang['purchase_return_add_new_purchase_return'] 	= 'Yeni Satın Alma İadesi Ekleyin';
$lang['purchase_return_add_purchase_return'] 		= 'Satın Alma İadeyi Ekleyin';
$lang['purchase_return_grand_total'] 				= 'Genel Toplam : 0.00';
$lang['purchase_return_edit_purchase_return'] 		= 'Satın Alma İadesini Düzenle';
$lang['purchase_return_edit_grand_total'] 			= 'Genel Toplam :';

//sales
$lang['sales_list_sales'] 				= 'Satış Listeleme';
$lang['sales_add_new_sales'] 			= 'Yeni Satış Ekle';
$lang['sales_biller'] 					= 'Biller';
$lang['sales_client'] 				= 'Müşteri';
$lang['sales_sales_status'] 			= 'Satış Durumu';
$lang['sales_payment_status'] 			= 'Ödeme Durumu';
$lang['sales_paid'] 					= 'ödenmiş';
$lang['sales_complited'] 				= 'tamamladığı veya';
$lang['sales_pending'] 					= 'kadar';
$lang['sales_sales_details'] 			= 'Satış Ayrıntıları';
$lang['sales_add_payment'] 				= 'Ödeme Ekle';
$lang['sales_edit_sales'] 				= 'Satışları Düzenle';
$lang['sales_email_sales'] 				= 'E-posta Satışları';
$lang['sales_delete_sales'] 			= 'Satışları Sil';
$lang['sales_add_sales'] 				= 'Satış Ekleyin';
$lang['sales_select_biller'] 			= 'Biller seçeneğini seçin';
$lang['sales_select_client'] 			= 'Müşteri Seç';
$lang['sales_internal_note'] 			= 'Dahili Not';
$lang['sales_status'] 					= 'durum';
$lang['sales_balance'] 					= 'Denge';
$lang['sales_invoice'] 					= 'Fatura';
$lang['sales_client_details'] 		= 'Müşteri detayları';
$lang['sales_pos'] 						= 'POS';
$lang['sales_invoice_hash'] 			= 'Fatura #';
$lang['sales_address'] 					= 'Adres';
$lang['sales_product_wise_details'] 	= 'Ürünle İlgili Ayrıntılar';
$lang['sales_cgst'] 					= 'CGST';
$lang['sales_sgst'] 					= 'SGST';
$lang['sales_igst'] 					= 'IGST';
$lang['sales_total_sales'] 				= 'Satış Toplamı';
$lang['sales_remarks'] 					= 'Uyarılar:';
$lang['sales_summary'] 					= 'özet';
$lang['sales_amount'] 					= 'Tutar';
$lang['sales_total_invoice_value'] 		= 'Toplam Fatura Değeri';
$lang['sales_total_cgst'] 				= 'Toplam CGST';
$lang['sales_receivers_signature'] 		= 'Alıcının İmzası';
$lang['sales_senior_accounts_manager'] 	= 'Kıdemli Hesap Yöneticisi';
$lang['sales_total_sgst'] 				= 'Toplam SGST';
$lang['slaes_invoice_note'] 			= 'Not: Tüm çekleri Şirket adına ödenecek hale getirin';
$lang['sales_igst'] 					= 'Toplam IGST';
$lang['sales_thank_you'] 				= 'İşiniz için teşekkür ederim';
$lang['sales_edit_sales'] 				= 'Satışları Düzenle';
$lang['sales_pay']		 				= 'ödeme';
$lang['sales_list_invoice']		 		= 'Fatura Listeleme';
$lang['sales_sales_amount']		 		= 'Satış miktarı';
$lang['sales_paid_amount']		 		= 'Ödenen miktar';
$lang['sales_invoice_no']		 		= 'Fatura No';

//Sales Return
$lang['sales_return_list_sales_return'] 	= 'Listeleme Satış İade';
$lang['sales_return_add_new_sales_return'] 	= 'Yeni Satış İadesi Ekleyin';
$lang['sales_return_add_sales_return'] 		= 'Satış iadesi ekleme';
$lang['sales_return_edit_sales_return'] 	= 'Satış İadesini Düzenle';

//payment
$lang['payment_list_payment'] 				= 'Ödemeyi Listele';
$lang['payment_paying_by'] 					= 'Ödeme Şekli';
$lang['payment_edit_payment'] 				= 'Ödemeyi Düzenleyin';
$lang['payment_bank_name'] 					= 'Banka adı';
$lang['payment_cheque_no'] 					= 'Hayır/ı işaretleyin';
$lang['sales_amount'] 						= 'Tutar';

//Reports
$lang['reports_daily_reports'] 				= 'Günlük Raporlar';
$lang['reports_current_month_sales'] 		= 'Cari Ay Satışları :';
$lang['reports_profite'] 					= 'kâr :';
$lang['reports_product_reports'] 			= 'Ürünler Raporları';
$lang['reports_start_date'] 				= 'Başlangıç ​​tarihi';
$lang['reports_end_date'] 					= 'Bitiş tarihi';
$lang['reports_purchased'] 					= 'satın alındı';
$lang['reports_sold'] 						= 'Satıldı';
$lang['reports_profite_title'] 				= 'profite';
$lang['reports_purchase_reports'] 			= 'Satın Alma Raporları';
$lang['reports_created_by'] 				= 'Tarafından yaratıldı ';
$lang['reports_supplier'] 					= 'satıcı';
$lang['reports_product_qty'] 				= 'Ürün (Adet)';
$lang['reports_hide_show'] 					= 'Gizle / Göster';
$lang['reports_submit'] 					= 'Gönder';
$lang['reports_purchase_return_reports'] 	= 'Satın Alma İade Raporları';
$lang['reports_sales_reports'] 				= 'Satış Raporları';
$lang['reports_biller'] 					= 'Biller';
$lang['reports_client'] 					= 'Müşteri';
$lang['reports_sales_return_reports'] 		= 'Satış İadesi';

//Dashboard
$lang['dashboard_today'] 					= 'Bugün';
$lang['dashboard_this_week'] 				= 'Bu hafta';
$lang['dashboard_this_month'] 				= 'Bu ay';
$lang['dashboard_this_year'] 				= 'Bu yıl';
$lang['dashboard_all_time'] 				= 'Her zaman';
$lang['dashboard_new_items'] 				= 'Yeni öğeler';
$lang['dashboard_purchase_item'] 			= 'Satın Alınan Öğe';
$lang['dashboard_sold_items'] 				= 'Satılan Ürünler';
$lang['dashboard_purchase_value'] 			= 'Satın Alınan Değer';
$lang['dashboard_sales_value'] 				= 'Satış Değeri';
$lang['dashboard_yearly_sales'] 			= 'Yıllık Satışlar';
$lang['dashboard_total_sales'] 				= 'Toplam satış';
$lang['dashboard_value_in_warehouse'] 		= 'Depodaki değer';
$lang['dashboard_warehouse_products'] 		= 'Depo Ürünleri';
$lang['dashboard_no_of_items'] 				= 'Öğe Sayısı';
$lang['dashboard_rights_reserved'] 			= 'hakları saklıdır.';
$lang['dashboard_copyright'] 				= 'telif hakkı';
$lang['dashboard_version'] 					= 'versiyon';
$lang['dashboard_month'] 					= 'Ay';
$lang['dashboard_sales_performance'] 		= 'Satış performansı';
$lang['dashboard_sales_of_company'] 		= 'Şirketin Satışları';


/***   User    ***/

$lang['user_lable'] 	   		= 'Kullanıcılar';
$lang['user_lable_header'] 		= 'Kullanıcıları Listele';
$lang['user_btn_new'] 	   		= 'Yeni Kullanıcı Ekle';
$lang['user_lable_fname']  		= 'İsim';
$lang['user_lable_lname']  		= 'Soyadı';
$lang['user_lable_email']  		= 'E-posta';
$lang['user_lable_group']  		= 'grup';
$lang['user_lable_status'] 		= 'durum';
$lang['user_lable_action'] 		= 'Aksiyon';

$lang['add_user_header'] 		= 'Kullanıcı Ekle';
$lang['add_user_label'] 		= 'Yeni Kullanıcı Ekle';
$lang['add_user_company'] 		= 'Şirket Adı';
$lang['add_user_mobile'] 		= 'Telefon numarası';
$lang['add_user_password'] 	   	= 'Parola';
$lang['add_user_confpassword'] 	= 'Şifreyi Onayla';
$lang['add_user_btn'] 			= 'Eklemek';
$lang['add_user_btn_cancel'] 	= 'İptal etmek';
$lang['edit_user_header'] 		= 'Kullanıcıyı Düzenle';
$lang['edit_user_member'] 		= 'Grup üyesi';
$lang['edit_user_btn'] 			= 'Güncelleştirme';



/*****   Billers ***/

$lang['biller_lable'] 	   		= 'billers';
$lang['biller_header'] 	   		= 'Billers Liste';
$lang['biller_btn_add'] 	   	= 'Yeni Billers ekle';
$lang['biller_lable_no'] 	   	= 'Yok hayır';
$lang['biller_lable_name'] 	   	= 'isim';
$lang['biller_lable_company'] 	= 'şirket';
$lang['biller_lable_phone'] 	= 'Telefon';
$lang['biller_lable_email'] 	= 'E';
$lang['biller_lable_city'] 	    = 'Şehir';
$lang['biller_lable_country'] 	= 'ülke';
$lang['biller_lable_action'] 	= 'Aksiyon';


$lang['add_biller_label'] 		= 'Billerici ekle';
$lang['add_biller_header'] 		= 'Yeni Biller ekle';
$lang['add_biller_billname'] 	= 'Biller Adı';
$lang['add_biller_gst'] 		= 'GSTIN';
$lang['add_biller_select_branch'] = 'Şube Seçiniz';
$lang['add_biller_select']      = 'seçmek';
$lang['add_biller_address'] 	= 'Adres';
$lang['add_biller_state'] 		= 'Belirtmek, bildirmek';
$lang['add_biller_fax'] 		= 'Faks';
$lang['add_biller_telephone'] 	= 'Telefon';
$lang['add_biller_mobile'] 		= 'seyyar';
$lang['edit_biller_header'] 	= 'Biller Düzenleme';
$lang['edit_biller_btn'] 		= 'Güncelleştirme';

/***** Clients *******/

$lang['client_header'] 		= 'Müşteri';
$lang['client_label'] 		= 'Müşteriyi Listele';
$lang['client_btn_add'] 		= 'Yeni Müşteri Ekle';
$lang['add_client_label'] 	= 'Müşteri Ekle';
$lang['add_client_header'] 	= 'Yeni Müşteri Ekle';
$lang['add_client_cname'] 	= 'müşteri adı';
$lang['add_client_compname'] 	= 'Şirket Adı';
$lang['add_client_code'] 		= 'posta kodu';
$lang['edit_client_header'] 	= 'Müşteriyi Düzenle';


/****** Supplier ****/

$lang['supplier_header'] 		= 'satıcı';
$lang['supplier_label'] 		= 'Liste Tedarikçiler';
$lang['supplier_btn_add'] 		= 'Yeni Tedarikçiler Ekleyin';
$lang['supplier_add'] 			= 'Tedarikçi Ekle';
$lang['add_supplier_name'] 		= 'sağlayıcı adı';
$lang['edit_supplier_header'] 	= 'Tedarikçiyi Düzenle';


/**** Warehouse *********/

$lang['warehouse_header'] 		= 'Depo';
$lang['warehouse_label'] 		= 'Liste Deposu';
$lang['warehouse_label_no'] 	= 'Yok hayır';
$lang['warehouse_label_wname'] 	= 'Depo adı';
$lang['warehouse_label_bname'] 	= 'Şube Adı';
$lang['warehouse_label_uname'] 	= 'Kullanıcı adı';
$lang['warehouse_label_action'] = 'Eylemler';
$lang['warehouse_btn_new'] 		= 'Yeni Depo Ekle';

$lang['add_warehouse'] 			= 'Depo ekle';
$lang['add_warehouse_name'] 	= 'Depo adı';
$lang['edit_warehouse_header'] 	= 'Depoyu Düzenle';

//Category

$lang['category_add'] 						= 'Eklemek';
$lang['category_cancel'] 					= 'İptal etmek';
$lang['category_lable'] 					= 'Kategori';
$lang['category_lable_addcategory'] 		= 'Kategori Ekle';
$lang['category_lable_editcategory'] 		= 'Kategoriyi Düzenle';
$lang['category_lable_no'] 					= 'Yok hayır';
$lang['category_lable_code'] 				= 'Kategori Kodu';
$lang['category_lable_cname'] 				= 'Kategori adı';
$lang['category_lable_actions'] 			= 'Eylemler';
$lang['category_lable_lcategory'] 			= 'Liste Kategorisi';
$lang['category_lable_newcategory'] 		= 'Yeni Kategori Ekle';

//Subcategory
$lang['subcategory_add'] 					= 'Eklemek';
$lang['subcategory_cancel'] 				= 'İptal etmek';
$lang['subcategory_update'] 				= 'Güncelleştirme';
$lang['subcategory_label'] 					= 'Alt kategori';
$lang['subcategory_label_add'] 				= 'Altkategori Ekle';
$lang['subcategory_newcategory'] 			= 'Yeni Altkategori Ekle';
$lang['subcategory_label_select'] 			= 'Kategori seç';
$lang['subcategory_label_name'] 			= 'Altkategori Adı';
$lang['subcategory_label_listcategory'] 	= 'Alt Kategoriyi Listele';
$lang['subcategory_cancel'] 				= 'İptal etmek';
$lang['subcategory_label_code'] 			= 'Alt kategori kodu';
$lang['subcategory_label_main'] 			= 'Ana Kategori';
$lang['subcategory_label_name'] 			= 'Altkategori Adı';
$lang['subcategory_label_edit'] 			= 'Alt Kategoriyi Düzenleyin';

//Branch
$lang['branch_label'] 						= 'şube';
$lang['branch_label_name'] 					= 'Şube Adı';
$lang['branch_label_city'] 					= 'Şehir';
$lang['branch_label_address'] 				= 'Adres';
$lang['branch_label_add'] 					= 'Eklemek';
$lang['branch_label_newbranch'] 			= 'Yeni Şube Ekle';
$lang['branch_label_cancel'] 				= 'İptal etmek';
$lang['branch_label_addbranch'] 			= 'Şube Ekle';
$lang['branch_label_edit'] 					= 'Şubeyi Düzenle';

//Discount

$lang['discount_label_name'] 				= 'İndirim Adı';
$lang['discount_label_value'] 				= 'İndirim Değeri';
$lang['discount_label'] 					= 'İndirim';
$lang['discount_label_username'] 			= 'Kullanıcı adı';
$lang['discount_label_add']					= 'Eklemek';
$lang['discount_label_newbranch'] 			= 'Yeni İndirim Ekle';
$lang['discount_label_cancel'] 				= 'İptal etmek';
$lang['discount_label_addbranch'] 			= 'İndirim Ekle';
$lang['discount_label_list'] 				= 'İndirim Listesine';
$lang['discount_label_edit'] 				= 'İndirimde Düzenle';
$lang['discount_label_update'] 				= 'Güncelleştirme';

//Tax

$lang['tax_label_name'] 				= 'Vergi Adı';
$lang['tax_label_form'] 				= 'Dan başla';
$lang['tax_label_rnumber'] 				= 'Kayıt numarası';
$lang['tax_label_frequency'] 			= 'Dolum sıklığı';
$lang['tax_label_desc'] 				= 'Açıklama';
$lang['tax_label_applies'] 				= 'Vergi,';
$lang['tax_label_calculate'] 			= 'Hesapla Açık';
$lang['tax_label_salesrate'] 			= 'Satış Vergisi Oranı';
$lang['tax_label_addnew'] 				= 'Yeni Vergi ekle';
$lang['tax_label_add'] 					= 'Vergi ekle';
$lang['tax_label_purchaserate'] 		= 'Satınalma Vergisi Oranı';
$lang['tax_label_list'] 				= 'Liste Vergisi';
$lang['tax_label'] 						= 'Vergi';
$lang['tax_label_Edit'] 				= 'Vergi Düzenle';