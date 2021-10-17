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
$lang['error_csrf'] = 'This form post did not pass our security checks.';

// Login
$lang['login_heading']         = 'Login';
$lang['login_subheading']      = 'Please login with your user ID and password below.';
$lang['login_identity_label']  = 'User ID:';
$lang['login_password_label']  = 'Password:';
$lang['login_remember_label']  = 'Remember Me:';
$lang['login_submit_btn']      = 'Login';
$lang['login_forgot_password'] = 'Forgot your password?';

// Index
$lang['index_heading']           = 'Users';
$lang['index_subheading']        = 'Below is a list of the users.';
$lang['index_fname_th']          = 'First Name';
$lang['index_lname_th']          = 'Last Name';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Groups';
$lang['index_status_th']         = 'Status';
$lang['index_action_th']         = 'Action';
$lang['index_active_link']       = 'Active';
$lang['index_inactive_link']     = 'Inactive';
$lang['index_create_user_link']  = 'Create a new user';
$lang['index_create_group_link'] = 'Create a new group';

// Deactivate User
$lang['deactivate_heading']                  = 'Deactivate User';
$lang['deactivate_subheading']               = 'Are you sure you want to deactivate the user \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Yes:';
$lang['deactivate_confirm_n_label']          = 'No:';
$lang['deactivate_submit_btn']               = 'Submit';
$lang['deactivate_validation_confirm_label'] = 'confirmation';
$lang['deactivate_validation_user_id_label'] = 'user ID';

// Create User
$lang['create_user_heading']                           = 'Create User';
$lang['create_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['create_user_fname_label']                       = 'First Name:';
$lang['create_user_lname_label']                       = 'Last Name:';
$lang['create_user_company_label']                     = 'Company Name:';
$lang['create_user_identity_label']                    = 'Identity:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_phone_label']                       = 'Phone:';
$lang['create_user_password_label']                    = 'Password:';
$lang['create_user_password_confirm_label']            = 'Confirm Password:';
$lang['create_user_submit_btn']                        = 'Create User';
$lang['create_user_validation_fname_label']            = 'First Name';
$lang['create_user_validation_lname_label']            = 'Last Name';
$lang['create_user_validation_identity_label']         = 'Identity';
$lang['create_user_validation_email_label']            = 'Email Address';
$lang['create_user_validation_phone_label']            = 'Phone';
$lang['create_user_validation_company_label']          = 'Company Name';
$lang['create_user_validation_password_label']         = 'Password';
$lang['create_user_validation_password_confirm_label'] = 'Password Confirmation';

// Edit User
$lang['edit_user_heading']                           = 'Edit User';
$lang['edit_user_subheading']                        = 'Please enter the user\'s information below.';
$lang['edit_user_fname_label']                       = 'First Name:';
$lang['edit_user_lname_label']                       = 'Last Name:';
$lang['edit_user_company_label']                     = 'Company Name:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Phone:';
$lang['edit_user_password_label']                    = 'Password: (if changing password)';
$lang['edit_user_password_confirm_label']            = 'Confirm Password: (if changing password)';
$lang['edit_user_groups_heading']                    = 'Member of groups';
$lang['edit_user_submit_btn']                        = 'Save User';
$lang['edit_user_validation_fname_label']            = 'First Name';
$lang['edit_user_validation_lname_label']            = 'Last Name';
$lang['edit_user_validation_email_label']            = 'Email Address';
$lang['edit_user_validation_phone_label']            = 'Phone';
$lang['edit_user_validation_company_label']          = 'Company Name';
$lang['edit_user_validation_groups_label']           = 'Groups';
$lang['edit_user_validation_password_label']         = 'Password';
$lang['edit_user_validation_password_confirm_label'] = 'Password Confirmation';

// Create Group
$lang['create_group_title']                  = 'Create Group';
$lang['create_group_heading']                = 'Create Group';
$lang['create_group_subheading']             = 'Please enter the group information below.';
$lang['create_group_name_label']             = 'Group Name:';
$lang['create_group_desc_label']             = 'Description:';
$lang['create_group_submit_btn']             = 'Create Group';
$lang['create_group_validation_name_label']  = 'Group Name';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Edit Group';
$lang['edit_group_saved']                  = 'Group Saved';
$lang['edit_group_heading']                = 'Edit Group';
$lang['edit_group_subheading']             = 'Please enter the group information below.';
$lang['edit_group_name_label']             = 'Group Name:';
$lang['edit_group_desc_label']             = 'Description:';
$lang['edit_group_submit_btn']             = 'Save Group';
$lang['edit_group_validation_name_label']  = 'Group Name';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Change Password';
$lang['change_password_old_password_label']                    = 'Old Password:';
$lang['change_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['change_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['change_password_submit_btn']                            = 'Change';
$lang['change_password_validation_old_password_label']         = 'Old Password';
$lang['change_password_validation_new_password_label']         = 'New Password';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Forgot Password
$lang['forgot_password_heading']                 = 'Forgot Password';
$lang['forgot_password_subheading']              = 'Please enter your %s so we can send you an email to reset your password.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Submit';
$lang['forgot_password_validation_email_label']  = 'Email Address';
$lang['forgot_password_identity_label'] 		 = 'Identity';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'No record of that email address.';

// Reset Password
$lang['reset_password_heading']                               = 'Change Password';
$lang['reset_password_new_password_label']                    = 'New Password (at least %s characters long):';
$lang['reset_password_new_password_confirm_label']            = 'Confirm New Password:';
$lang['reset_password_submit_btn']                            = 'Change';
$lang['reset_password_validation_new_password_label']         = 'New Password';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirm New Password';

// Header
$lang['header_sign_out'] 			= 'Sign out';
$lang['header_online'] 				= 'Online';
$lang['header_main_navidation'] 	= 'MAIN NAVIGATION';
$lang['header_dashboard'] 			= 'Dashboard';
$lang['header_product'] 			= 'Product';
$lang['header_list'] 				= 'List';
$lang['header_add'] 				= 'Add';
$lang['header_type'] 				= 'Type';
$lang['header_product_alert'] 		= 'Product Alert';
$lang['header_purchase'] 			= 'Purchase';
$lang['header_purchase_return'] 	= 'Purchase Return';
$lang['header_transfers'] 			= 'Tranfers';
$lang['header_sales'] 				= 'Sales';
$lang['header_sales_return'] 		= 'Sales Return';
$lang['header_payment'] 			= 'Payment';
$lang['header_invoice'] 			= 'Invoice';
$lang['header_reports'] 			= 'Reports';
$lang['header_daily'] 				= 'Daily';
$lang['header_people'] 				= 'People';
$lang['header_users'] 				= 'Users';
$lang['header_billers'] 			= 'Billers';
$lang['header_clients'] 			= 'Clients';
$lang['header_suppliers'] 			= 'Suppliers';
$lang['header_setting'] 			= 'Setting';
$lang['header_company_setting'] 	= 'Company Setting';
$lang['header_category'] 			= 'Category';
$lang['header_sub_category'] 		= 'Subcategory';
$lang['header_branch'] 				= 'Branch';
$lang['header_brand']				= 'Brand';	
$lang['header_discount'] 			= 'Discount';
$lang['header_tax'] 				= 'Tax';
$lang['header_warehouse'] 			= 'Warehouse';
$lang['header_assign_warehouse'] 	= 'Assign Warehouse';

//Company Settings
$lang['company_setting_name'] 				= 'Name';
$lang['company_setting_site_short_name'] 	= 'Site Short Name';
$lang['company_setting_country'] 			= 'Country';
$lang['company_setting_select'] 			= 'Select';
$lang['company_setting_state'] 				= 'State';
$lang['company_setting_city'] 				= 'City';
$lang['company_setting_street'] 			= 'Street';
$lang['company_setting_zip_code'] 			= 'Zip Code';
$lang['company_setting_email'] 				= 'Email';
$lang['company_setting_mobile'] 			= 'Mobile';
$lang['company_setting_default_language'] 	= 'Default Language';
$lang['company_setting_default_currency'] 	= 'Default Currency';
$lang['company_setting_submit'] 			= 'Submit';
$lang['company_setting_cancel'] 			= 'Cancel';

//Product
$lang['product_list_product'] 			= 'List Product';
$lang['product_add_new_product'] 		= 'Add New Product';
$lang['product_no'] 					= 'No';
$lang['product_image'] 					= 'Image';
$lang['product_code'] 					= 'Code';
$lang['product_hsn_sac_code'] 			= 'HSN/SAC Code';
$lang['product_name'] 					= 'Name';
$lang['product_category'] 				= 'Category';
$lang['product_cost'] 					= 'Cost';
$lang['product_price'] 					= 'Price';
$lang['product_quantity'] 				= 'Quantity';
$lang['product_unit'] 					= 'Unit';
$lang['product_alert_quantity'] 		= 'Alert Quantity';
$lang['product_available_quantity'] 	= 'Available Quantity';
$lang['product_action'] 				= 'Action';
$lang['product_add_product'] 			= 'Add Product';
$lang['product_product_code'] 			= 'Product Code';
$lang['product_product_name'] 			= 'Product Name';
$lang['product_hsn_sac_lookup'] 		= 'HSN/SAC Lookup';
$lang['product_select_category'] 		= 'Select Category';
$lang['product_select'] 				= 'Select';
$lang['product_select_subcategory'] 	= 'Select Subcategory';
$lang['product_product_unit'] 			= 'Product Unit';
$lang['product_product_size'] 			= 'Product Size';
$lang['product_product_cost'] 			= 'Product Cost';
$lang['product_product_price'] 			= 'Net Dealer Price';
$lang['product_select_product_tax'] 	= 'Select Product Tax';
$lang['product_no_tax'] 				= 'No Tax';
$lang['product_product_image'] 			= 'Product Image';
$lang['product_product_details'] 		= 'Product Detail for Invoice';
$lang['product_add'] 					= 'Add';
$lang['product_cancel'] 				= 'Cancel';
$lang['product_hsn'] 					= 'HSN';
$lang['product_sac'] 					= 'SAC';
$lang['product_chapter'] 				= 'Chapter';
$lang['product_hsn_code'] 				= 'HSN Codes#';
$lang['product_description'] 			= 'Description';
$lang['product_sac_code'] 				= 'SAC Codes#';
$lang['product_close'] 					= 'Close';
$lang['product_apply'] 					= 'Apply';
$lang['header_edit_product'] 			= 'Edit Product';
$lang['product_update'] 				= 'Update';
$lang['product_delete_conform'] 		= 'Sure To Remove This Record ?';

//Product Alert
$lang['product_alert_pdf'] 				= 'PDF';
$lang['header_list_product_alert'] 		= 'List Product Alert';

//transfer
$lang['transfer_dashboard']	 		=	'Dashboard';
$lang['transfer_transfers']	 		=	'Transfers';
$lang['transfer_listtransfers']	 	=	'List Transfers';
$lang['transfer_add_new_transfer']	=	'Add New Transfer';
$lang['transfer_no']	 			=	'No';
$lang['transfer_date']	 			=	'Date';
$lang['transfer_warehouse_from'] 	=	'Warehouse(From)';
$lang['transfer_warehouse_to']	 	=	'Warehouse(To)';
$lang['transfer_total']	 			=	'Total';
$lang['transfer_actions']	 		=	'Actions';
$lang['transfer_add_transfer']	 	=	'Add Transfer';
$lang['transfer_to_warehouse']	 	=	'To Warehouse';
$lang['transfer_from_warehouse']	=	'From Warehouse';
$lang['transfer_select_product']	=	'Select Product';
$lang['transfer_select']	 		=	'Select';
$lang['transfer_inventory_items']	=	'Inventory Items';
$lang['transfer_code']	 			=	'Code';
$lang['transfer_quantity']	 		=	'Quantity';
$lang['transfer_available_qty']	 	=	'Available Qty';
$lang['transfer_unit']	 			=	'Unit';
$lang['transfer_cost']	 			=	'Cost';
$lang['transfer_sub_total']	 		=	'Sub Total';
$lang['transfer_grand_total']	 	=	'Grand Total ';
$lang['transfer_note']	 			=	'Note';
$lang['transfer_add']	 			=	'Add';
$lang['transfer_edit_transfer']	 	=	'Edit Transfer';
$lang['transfer_save']	 			=	'Save';

//assaign warehouse
$lang['assign_warehouse']						=	"Assign Warehouse";
$lang['assign_warehouse_add_assign_warehouse']	=	"Add Assign Warehouse";
$lang['assign_warehouse_user_name']				=	"User Name";
$lang['assign_warehouse_select']				=	"Select";
$lang['assign_warehouse_warehouse_name']		=	"Warehouse Name";
$lang['assign_warehouse_cancel']				=	"Cancel";
$lang['assign_warehouse_add']					=	"Add";
$lang['assign_warehouse_list_assign_warehouse']	=	"List Assign Warehouse";
$lang['assign_warehouse_no']					=	"No";
$lang['assign_warehouse_actions']				=	"Actions";

//Purchase
$lang['purchase_list_purchase'] 		= 'List Purchase';
$lang['purchase_add_new_purchase'] 		= 'Add New Purchase';
$lang['purchase_date'] 					= 'Date';
$lang['purchase_reference_no'] 			= 'Reference No';
$lang['purchase_supplier'] 				= 'Supplier';
$lang['purchase_purchase_status'] 		= 'Purchase Status';
$lang['purchase_grand_total'] 			= 'Grand Total';
$lang['purchase_received'] 				= 'Received';
$lang['purchase_purchase_details'] 		= 'Purchase Details';
$lang['purchase_edit_purchase'] 		= 'Edit Purchase';
$lang['purchase_download_as_pdf'] 		= 'Download as PDf';
$lang['purchase_email_purchase'] 		= 'Email Purchase';
$lang['purchase_delete_purchase'] 		= 'Delete Purchase';
$lang['purchase_add_purchase'] 			= 'Add Purchase';
$lang['purchase_select_warehouse'] 		= 'Select Warehouse';
$lang['purchase_select_supplier'] 		= 'Select Supplier';
$lang['purchase_select_product'] 		= 'Select Product';
$lang['purchase_inventory_items'] 		= 'Inventory Items';
$lang['purchase_product_description'] 	= 'Product Description';
$lang['purchase_sub_total'] 			= 'Sub Total';
$lang['purchase_taxable_value'] 		= 'Taxable Value';
$lang['purchase_total'] 				= 'Total';
$lang['purchase_total_value'] 			= 'Total Value';
$lang['purchase_total_discount'] 		= 'Total Discount';
$lang['purchase_total_tax'] 			= 'Total Tax';
$lang['purchase_note'] 					= 'Note';
$lang['purchase_total_sales'] 			= 'Total Sales';
$lang['purchase_total_amount'] 			= 'Total Amount';
$lang['purchase_edit'] 					= 'Edit';
$lang['purchase_delete'] 				= 'Delete';
$lang['purchase_to'] 					= 'To';
$lang['purchase_from'] 					= 'From';
$lang['purchase_mobile'] 				= 'Mobile';
$lang['purchase_ordered_by'] 			= 'Ordered By';
$lang['purchase_stamp_and_signature']	= 'Stamp & Signature';

//Purchase Return
$lang['purchase_return_list_purchase_return'] 		= 'List Purchase Return';
$lang['purchase_return_add_new_purchase_return'] 	= 'Add New Purchase Return';
$lang['purchase_return_add_purchase_return'] 		= 'Add Purchase Return';
$lang['purchase_return_grand_total'] 				= 'Grand Total : 0.00';
$lang['purchase_return_edit_purchase_return'] 		= 'Edit Purchase Return';
$lang['purchase_return_edit_grand_total'] 			= 'Grand Total :';

//sales
$lang['sales_list_sales'] 				= 'List Sales';
$lang['sales_add_new_sales'] 			= 'Add New Sales';
$lang['sales_biller'] 					= 'Biller';
$lang['sales_client'] 				= 'Client';
$lang['sales_sales_status'] 			= 'Sales Status';
$lang['sales_payment_status'] 			= 'Payment Status';
$lang['sales_paid'] 					= 'Paid';
$lang['sales_complited'] 				= 'Complited';
$lang['sales_pending'] 					= 'Pending';
$lang['sales_sales_details'] 			= 'Sales Details';
$lang['sales_add_payment'] 				= 'Add Payment';
$lang['sales_edit_sales'] 				= 'Edit Sales';
$lang['sales_email_sales'] 				= 'Email Sales';
$lang['sales_delete_sales'] 			= 'Delete Sales';
$lang['sales_add_sales'] 				= 'Add Sales';
$lang['sales_select_biller'] 			= 'Select Biller';
$lang['sales_select_client'] 			= 'Select Client';
$lang['sales_internal_note'] 			= 'Internal Note';
$lang['sales_status'] 					= 'Status';
$lang['sales_balance'] 					= 'Balance';
$lang['sales_invoice'] 					= 'Invoice';
$lang['sales_client_details'] 		= 'Client Details';
$lang['sales_pos'] 						= 'POS';
$lang['sales_invoice_hash'] 			= 'Invoice #';
$lang['sales_address'] 					= 'Address';
$lang['sales_product_wise_details'] 	= 'Product-wise Details';
$lang['sales_cgst'] 					= 'CGST';
$lang['sales_sgst'] 					= 'SGST';
$lang['sales_igst'] 					= 'IGST';
$lang['sales_total_sales'] 				= 'Sales Total';
$lang['sales_remarks'] 					= 'Remarks:';
$lang['sales_summary'] 					= 'Summary';
$lang['sales_amount'] 					= 'Amount';
$lang['sales_total_invoice_value'] 		= 'Total Invoice Value';
$lang['sales_total_cgst'] 				= 'Total CGST';
$lang['sales_receivers_signature'] 		= 'Receiver\'s Signature';
$lang['sales_senior_accounts_manager'] 	= 'Senior Accounts Manager';
$lang['sales_total_sgst'] 				= 'Total SGST';
$lang['slaes_invoice_note'] 			= 'Note: Make all cheques payable to Company Name';
$lang['sales_igst'] 					= 'Total IGST';
$lang['sales_thank_you'] 				= 'Thank you for your Business';
$lang['sales_edit_sales'] 				= 'Edit Sales';
$lang['sales_pay']		 				= 'Pay';
$lang['sales_list_invoice']		 		= 'List Invoice';
$lang['sales_sales_amount']		 		= 'Sales Amount';
$lang['sales_paid_amount']		 		= 'Paid Amount';
$lang['sales_invoice_no']		 		= 'Invoice No';

//Sales Return
$lang['sales_return_list_sales_return'] 	= 'List Sales Return';
$lang['sales_return_add_new_sales_return'] 	= 'Add New Sales Return';
$lang['sales_return_add_sales_return'] 		= 'Add Sales Return';
$lang['sales_return_edit_sales_return'] 	= 'Edit Sales Return';

//payment
$lang['payment_list_payment'] 				= 'List Payment';
$lang['payment_paying_by'] 					= 'Paying By';
$lang['payment_edit_payment'] 				= 'Edit Payment';
$lang['payment_bank_name'] 					= 'Bank Name';
$lang['payment_cheque_no'] 					= 'Cheque No';
$lang['sales_amount'] 						= 'Amount';

//Reports
$lang['reports_daily_reports'] 				= 'Daily Reports';
$lang['reports_current_month_sales'] 		= 'Current Month Sales :';
$lang['reports_profite'] 					= 'Profit :';
$lang['reports_product_reports'] 			= 'Products Reports';
$lang['reports_start_date'] 				= 'Start Date';
$lang['reports_end_date'] 					= 'End Date';
$lang['reports_purchased'] 					= 'Purchased';
$lang['reports_sold'] 						= 'Sold';
$lang['reports_profite_title'] 				= 'Profit';
$lang['reports_purchase_reports'] 			= 'Purchase Reports';
$lang['reports_created_by'] 				= 'Created By ';
$lang['reports_supplier'] 					= 'Supplier';
$lang['reports_product_qty'] 				= 'Product(Qty)';
$lang['reports_hide_show'] 					= 'Hide/Show';
$lang['reports_submit'] 					= 'Submit';
$lang['reports_purchase_return_reports'] 	= 'Purchase Return Reports';
$lang['reports_sales_reports'] 				= 'Sales Reports';
$lang['reports_biller'] 					= 'Biller';
$lang['reports_client'] 					= 'Client';
$lang['reports_sales_return_reports'] 		= 'Sales Return';

//Dashboard
$lang['dashboard_today'] 					= 'Today';
$lang['dashboard_this_week'] 				= 'This Week';
$lang['dashboard_this_month'] 				= 'This Month';
$lang['dashboard_this_year'] 				= 'This Year';
$lang['dashboard_all_time'] 				= 'All Time';
$lang['dashboard_new_items'] 				= 'New Items';
$lang['dashboard_purchase_item'] 			= 'Purchased Item';
$lang['dashboard_sold_items'] 				= 'Sold Items';
$lang['dashboard_purchase_value'] 			= 'Purchased Value';
$lang['dashboard_sales_value'] 				= 'Sales Value';
$lang['dashboard_yearly_sales'] 			= 'Yearly Sales';
$lang['dashboard_total_sales'] 				= 'Total Sales';
$lang['dashboard_value_in_warehouse'] 		= 'Value in Warehouse';
$lang['dashboard_warehouse_products'] 		= 'Warehouse Products';
$lang['dashboard_no_of_items'] 				= 'No of Items';
$lang['dashboard_rights_reserved'] 			= 'rights reserved.';
$lang['dashboard_copyright'] 				= 'Copyright';
$lang['dashboard_version'] 					= 'Version';
$lang['dashboard_month'] 					= 'Month';
$lang['dashboard_sales_performance'] 		= 'Sales Performance';
$lang['dashboard_sales_of_company'] 		= 'Sales of Company';


/***   User    ***/

$lang['user_lable'] 	   		= 'Users';
$lang['user_lable_header'] 		= 'List Users';
$lang['user_btn_new'] 	   		= 'Add New User';
$lang['user_lable_fname']  		= 'First Name';
$lang['user_lable_lname']  		= 'Last Name';
$lang['user_lable_email']  		= 'Email';
$lang['user_lable_group']  		= 'Group';
$lang['user_lable_status'] 		= 'Status';
$lang['user_lable_action'] 		= 'Action';

$lang['add_user_header'] 		= 'Add User';
$lang['add_user_label'] 		= 'Add New User';
$lang['add_user_company'] 		= 'Company Name';
$lang['add_user_mobile'] 		= 'Mobile No';
$lang['add_user_password'] 	   	= 'Password';
$lang['add_user_confpassword'] 	= 'Confirm Password';
$lang['add_user_btn'] 			= 'Add';
$lang['add_user_btn_cancel'] 	= 'Cancel';
$lang['edit_user_header'] 		= 'Edit User';
$lang['edit_user_member'] 		= 'Member of groups';
$lang['edit_user_btn'] 			= 'Update';



/*****   Billers ***/

$lang['biller_lable'] 	   		= 'Billers';
$lang['biller_header'] 	   		= 'List Billers';
$lang['biller_btn_add'] 	   	= 'Add New Billers';
$lang['biller_lable_no'] 	   	= 'No';
$lang['biller_lable_name'] 	   	= 'Name';
$lang['biller_lable_company'] 	= 'Company';
$lang['biller_lable_phone'] 	= 'Phone';
$lang['biller_lable_email'] 	= 'Email Address';
$lang['biller_lable_city'] 	    = 'City';
$lang['biller_lable_country'] 	= 'Country';
$lang['biller_lable_action'] 	= 'Action';


$lang['add_biller_label'] 		= 'Add Biller';
$lang['add_biller_header'] 		= 'Add New Biller';
$lang['add_biller_billname'] 	= 'Biller Name';
$lang['add_biller_gst'] 		= 'GSTIN';
$lang['add_biller_select_branch'] = 'Select Branch';
$lang['add_biller_select']      = 'Select';
$lang['add_biller_address'] 	= 'Address';
$lang['add_biller_state'] 		= 'State';
$lang['add_biller_fax'] 		= 'Fax';
$lang['add_biller_telephone'] 	= 'Telephone';
$lang['add_biller_mobile'] 		= 'Mobile';
$lang['edit_biller_header'] 	= 'Edit Biller';
$lang['edit_biller_btn'] 		= 'Update';

/***** Clients *******/

$lang['client_header'] 		= 'Client';
$lang['client_label'] 		= 'List Client';
$lang['client_type'] 			= 'Client Type';
$lang['client_btn_add'] 		= 'Add New Client';
$lang['add_client_label'] 	= 'Add Client';
$lang['add_client_type'] 	    = 'Add Client Type';
$lang['add_client_header'] 	= 'Add New Client';
$lang['add_client_cname'] 	= 'Client Name';
$lang['add_client_compname'] 	= 'Company Name';
$lang['add_client_code'] 		= 'Postal Code';
$lang['edit_client_header'] 	= 'Edit Client';


/****** Supplier ****/

$lang['supplier_header'] 		= 'Supplier';
$lang['supplier_label'] 		= 'List Suppliers';
$lang['supplier_btn_add'] 		= 'Add New Suppliers';
$lang['supplier_add'] 			= 'Add Suppliers';
$lang['add_supplier_name'] 		= 'Supplier Name';
$lang['edit_supplier_header'] 	= 'Edit Supplier';


/**** Warehouse *********/

$lang['warehouse_header'] 		= 'Warehouse';
$lang['warehouse_label'] 		= 'List Warehouse';
$lang['warehouse_label_no'] 	= 'No';
$lang['warehouse_label_wname'] 	= 'Warehouse Name';
$lang['warehouse_label_bname'] 	= 'Branch Name';
$lang['warehouse_label_uname'] 	= 'User Name';
$lang['warehouse_label_action'] = 'Actions';
$lang['warehouse_btn_new'] 		= 'Add New Warehouse';

$lang['add_warehouse'] 			= 'Add Warehouse';
$lang['add_warehouse_name'] 	= 'Warehouse Name';
$lang['edit_warehouse_header'] 	= 'Edit Warehouse';

//Category

$lang['category_add'] 						= 'Add';
$lang['category_cancel'] 					= 'Cancel';
$lang['category_lable'] 					= 'Category';
$lang['category_lable_addcategory'] 		= 'Add Category';
$lang['category_lable_editcategory'] 		= 'Edit Category';
$lang['category_lable_no'] 					= 'No';
$lang['category_lable_code'] 				= 'Category Code';
$lang['category_lable_cname'] 				= 'Category Name';
$lang['category_lable_desc'] 				= 'Category Description';
$lang['category_lable_status'] 				= 'Category Status';
$lang['category_status_y_label']          = 'Active:';
$lang['category_status_n_label']          = 'Inactive:';
$lang['category_lable_actions'] 			= 'Actions';
$lang['category_lable_lcategory'] 			= 'List Category';
$lang['category_lable_newcategory'] 		= 'Add New Category';

//Subcategory
$lang['subcategory_add'] 					= 'Add';
$lang['subcategory_cancel'] 				= 'Cancel';
$lang['subcategory_update'] 				= 'Update';
$lang['subcategory_label'] 					= 'Subcategory';
$lang['subcategory_label_add'] 				= 'Add Subcategory';
$lang['subcategory_newcategory'] 			= 'Add New Subcategory';
$lang['subcategory_label_select'] 			= 'Select Category';
$lang['subcategory_label_name'] 			= 'Subcategory Name';
$lang['subcategory_label_listcategory'] 	= 'List Subcategory';
$lang['subcategory_cancel'] 				= 'Cancel';
$lang['subcategory_label_code'] 			= 'Subcategory Code';
$lang['subcategory_label_main'] 			= 'Main Category';
$lang['subcategory_label_name'] 			= 'Subcategory Name';
$lang['subcategory_label_edit'] 			= 'Edit Subcategory';

//Branch
$lang['branch_label'] 						= 'Branch';
$lang['branch_label_name'] 					= 'Branch Name';
$lang['branch_label_city'] 					= 'City';
$lang['branch_label_address'] 				= 'Address';
$lang['branch_label_add'] 					= 'Add';
$lang['branch_label_newbranch'] 			= 'Add New Branch';
$lang['branch_label_cancel'] 				= 'Cancel';
$lang['branch_label_addbranch'] 			= 'Add Branch';
$lang['branch_label_edit'] 					= 'Edit Branch';

//Discount

$lang['discount_label_name'] 				= 'Discount Name';
$lang['discount_label_value'] 				= 'Discount Value';
$lang['discount_label'] 					= 'Discount';
$lang['discount_label_username'] 			= 'User Name';
$lang['discount_label_add']					= 'Add';
$lang['discount_label_newbranch'] 			= 'Add New Discount';
$lang['discount_label_cancel'] 				= 'Cancel';
$lang['discount_label_addbranch'] 			= 'Add Discount';
$lang['discount_label_list'] 				= 'List Discount';
$lang['discount_label_edit'] 				= 'Edit Discount';
$lang['discount_label_update'] 				= 'Update';

//Tax

$lang['tax_label_name'] 				= 'Tax Name';
$lang['tax_label_form'] 				= 'Start From';
$lang['tax_label_rnumber'] 				= 'Registration Number';
$lang['tax_label_frequency'] 			= 'Filling frequency';
$lang['tax_label_desc'] 				= 'Description';
$lang['tax_label_applies'] 				= 'Tax applies to';
$lang['tax_label_calculate'] 			= 'Calculate On';
$lang['tax_label_salesrate'] 			= 'Sales Tax Rate';
$lang['tax_label_addnew'] 				= 'Add New Tax';
$lang['tax_label_add'] 					= 'Add Tax';
$lang['tax_label_purchaserate'] 		= 'Purchase Tax Rate';
$lang['tax_label_list'] 				= 'List Tax';
$lang['tax_label'] 						= 'Tax';
$lang['tax_label_Edit'] 				= 'Edit Tax';