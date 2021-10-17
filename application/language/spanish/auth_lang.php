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
* Author: Josue Ibarra
*         @josuetijuana
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  03.09.2013
*
* Description:  Spanish language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'Este formulario no pasó nuestras pruebas de seguridad.';

// Login
$lang['login_heading']         = 'Ingresar';
$lang['login_subheading']      = 'Por favor, introduce tu email/usuario y contraseña.';
$lang['login_identity_label']  = 'Email/Usuario:';
$lang['login_password_label']  = 'Contraseña:';
$lang['login_remember_label']  = 'Recuérdame:';
$lang['login_submit_btn']      = 'Ingresar';
$lang['login_forgot_password'] = '¿Has olvidado tu contraseña?';

// Index
$lang['index_heading']           = 'Usuarios';
$lang['index_subheading']        = 'Debajo está la lista de usuarios.';
$lang['index_fname_th']          = 'Nombre';
$lang['index_lname_th']          = 'Apellidos';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Grupos';
$lang['index_status_th']         = 'Estado';
$lang['index_action_th']         = 'Acción';
$lang['index_active_link']       = 'Activo';
$lang['index_inactive_link']     = 'Inactivo';
$lang['index_create_user_link']  = 'Crear nuevo usuario';
$lang['index_create_group_link'] = 'Crear nuevo grupo';

// Deactivate User
$lang['deactivate_heading']                  = 'Desactivar usuario';
$lang['deactivate_subheading']               = '¿Estás seguro que quieres desactivar el usuario \'%s\'';
$lang['deactivate_confirm_y_label']          = 'Sí:';
$lang['deactivate_confirm_n_label']          = 'No:';
$lang['deactivate_submit_btn']               = 'Enviar';
$lang['deactivate_validation_confirm_label'] = 'confirmación';
$lang['deactivate_validation_user_id_label'] = 'ID de usuario';

// Create User
$lang['create_user_heading']                           = 'Crear Usuario';
$lang['create_user_subheading']                        = 'Por favor, introduzce la información del usuario.';
$lang['create_user_fname_label']                       = 'Nombre:';
$lang['create_user_lname_label']                       = 'Apellidos:';
$lang['create_user_identity_label']                    = 'Identity:';
$lang['create_user_company_label']                     = 'Compañía:';
$lang['create_user_email_label']                       = 'Email:';
$lang['create_user_phone_label']                       = 'Teléfono:';
$lang['create_user_password_label']                    = 'Contraseña:';
$lang['create_user_password_confirm_label']            = 'Confirmar contraseña:';
$lang['create_user_submit_btn']                        = 'Crear Usuario';
$lang['create_user_validation_fname_label']            = 'Nombre';
$lang['create_user_validation_lname_label']            = 'Apellidos';
$lang['create_user_validation_identity_label']         = 'Identity';
$lang['create_user_validation_email_label']            = 'Correo electrónico';
$lang['create_user_validation_phone_label']            = 'Teléfono';
$lang['create_user_validation_company_label']          = 'Nombre de la compañía';
$lang['create_user_validation_password_label']         = 'Contraseña';
$lang['create_user_validation_password_confirm_label'] = 'Confirmación de contraseña';

// Edit User
$lang['edit_user_heading']                           = 'Editar Usuario';
$lang['edit_user_subheading']                        = 'Por favor introduzca la nueva información del usuario.';
$lang['edit_user_fname_label']                       = 'Nombre:';
$lang['edit_user_lname_label']                       = 'Apellidos:';
$lang['edit_user_company_label']                     = 'Compañía:';
$lang['edit_user_email_label']                       = 'Email:';
$lang['edit_user_phone_label']                       = 'Teléfono:';
$lang['edit_user_password_label']                    = 'Contraseña: (si quieres cambiarla)';
$lang['edit_user_password_confirm_label']            = 'Confirmar contraseña: (si quieres cambiarla)';
$lang['edit_user_groups_heading']                    = 'Miembro de grupos';
$lang['edit_user_submit_btn']                        = 'Guardar Usuario';
$lang['edit_user_validation_fname_label']            = 'Nombre';
$lang['edit_user_validation_lname_label']            = 'Apellidos';
$lang['edit_user_validation_email_label']            = 'Correo electrónico';
$lang['edit_user_validation_phone_label']            = 'Teléfono';
$lang['edit_user_validation_company_label']          = 'Compañía';
$lang['edit_user_validation_groups_label']           = 'Grupos';
$lang['edit_user_validation_password_label']         = 'Contraseña';
$lang['edit_user_validation_password_confirm_label'] = 'Confirmación de contraseña';

// Create Group
$lang['create_group_title']                  = 'Crear Grupo';
$lang['create_group_heading']                = 'Crear Grupo';
$lang['create_group_subheading']             = 'Por favor introduce la información del grupo.';
$lang['create_group_name_label']             = 'Nombre de Grupo:';
$lang['create_group_desc_label']             = 'Descripción:';
$lang['create_group_submit_btn']             = 'Crear Grupo';
$lang['create_group_validation_name_label']  = 'Nombre de Grupo';
$lang['create_group_validation_desc_label']  = 'Descripcion';

// Edit Group
$lang['edit_group_title']                  = 'Editar Grupo';
$lang['edit_group_saved']                  = 'Grupo Guardado';
$lang['edit_group_heading']                = 'Editar Grupo';
$lang['edit_group_subheading']             = 'Por favor, registra la informacion del grupo.';
$lang['edit_group_name_label']             = 'Nombre de Grupo:';
$lang['edit_group_desc_label']             = 'Descripción:';
$lang['edit_group_submit_btn']             = 'Guardar Grupo';
$lang['edit_group_validation_name_label']  = 'Nombre de Grupo';
$lang['edit_group_validation_desc_label']  = 'Descripción';

// Change Password
$lang['change_password_heading']                               = 'Cambiar Contraseña';
$lang['change_password_old_password_label']                    = 'Antigua Contraseña:';
$lang['change_password_new_password_label']                    = 'Nueva Contraseña (de al menos %s caracteres de longitud):';
$lang['change_password_new_password_confirm_label']            = 'Confirmar Nueva Contraseña:';
$lang['change_password_submit_btn']                            = 'Cambiar';
$lang['change_password_validation_old_password_label']         = 'Antigua Contraseña';
$lang['change_password_validation_new_password_label']         = 'Nueva Contraseña';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirmar Nueva Contraseña';

// Forgot Password
$lang['forgot_password_heading']                 = 'He olvidado mi Contraseña';
$lang['forgot_password_subheading']              = 'Por favor, introduce tu %s para que podamos enviarte un email para restablecer tu contraseña.';
$lang['forgot_password_email_label']             = '%s:';
$lang['forgot_password_submit_btn']              = 'Enviar';
$lang['forgot_password_validation_email_label']  = 'Correo Electrónico';
$lang['forgot_password_username_identity_label'] = 'Usuario';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'El correo electrónico no existe.';
$lang['forgot_password_identity_not_found']         = 'No record of that username address.';

// Reset Password
$lang['reset_password_heading']                               = 'Cambiar Contraseña';
$lang['reset_password_new_password_label']                    = 'Nueva Contraseña (de al menos %s caracteres de longitud):';
$lang['reset_password_new_password_confirm_label']            = 'Confirmar Nueva Contraseña:';
$lang['reset_password_submit_btn']                            = 'Guardar';
$lang['reset_password_validation_new_password_label']         = 'Nueva Contraseña';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirmar Nueva Contraseña';

// Activation Email
$lang['email_activate_heading']    = 'Activar cuenta por %s';
$lang['email_activate_subheading'] = 'Por favor ingresa en este link para %s.';
$lang['email_activate_link']       = 'activar tu cuenta';

// Forgot Password Email
$lang['email_forgot_password_heading']    = 'Reestablecer contraseña para %s';
$lang['email_forgot_password_subheading'] = 'Por favor ingresa en este link para %s.';
$lang['email_forgot_password_link']       = 'Restablecer Tu Contraseña';

// New Password Email
$lang['email_new_password_heading']    = 'Nueva contraseña para %s';
$lang['email_new_password_subheading'] = 'Tu contraseña ha sido restablecida a: %s';



// Header
$lang['header_sign_out'] 			= 'desconectar';
$lang['header_online'] 				= 'En línea';
$lang['header_main_navidation'] 	= 'NAVEGACIÓN PRINCIPAL';
$lang['header_dashboard'] 			= 'Tablero';
$lang['header_product'] 			= 'Producto';
$lang['header_list'] 				= 'Lista';
$lang['header_add'] 				= 'Añadir';
$lang['header_product_alert'] 		= 'Alerta de Producto';
$lang['header_purchase'] 			= 'Compra';
$lang['header_purchase_return'] 	= 'Devolución de compra';
$lang['header_transfers'] 			= 'Transferencias';
$lang['header_sales'] 				= 'Ventas';
$lang['header_sales_return'] 		= 'Vuelta de ventas';
$lang['header_payment'] 			= 'Pago';
$lang['header_invoice'] 			= 'Factura';
$lang['header_reports'] 			= 'Informes';
$lang['header_daily'] 				= 'Diariamente';
$lang['header_people'] 				= 'Gente';
$lang['header_users'] 				= 'Usuarios';
$lang['header_billers'] 			= 'Facturador';
$lang['header_clients'] 			= 'Clientes';
$lang['header_suppliers'] 			= 'Proveedores';
$lang['header_setting'] 			= 'Ajuste';
$lang['header_company_setting'] 	= 'Configuración de la empresa';
$lang['header_category'] 			= 'Categoría';
$lang['header_sub_category'] 		= 'Subcategoría';
$lang['header_branch'] 				= 'Rama';
$lang['header_brand']				= 'Marca';	
$lang['header_discount'] 			= 'Descuento';
$lang['header_tax'] 				= 'Impuesto';
$lang['header_warehouse'] 			= 'Almacén';
$lang['header_assign_warehouse'] 	= 'Asignar Almacén';

//Company Settings
$lang['company_setting_name'] 				= 'Nombre';
$lang['company_setting_site_short_name'] 	= 'Nombre corto del Sitio';
$lang['company_setting_country'] 			= 'País';
$lang['company_setting_select'] 			= 'Seleccionar';
$lang['company_setting_state'] 				= 'Estado';
$lang['company_setting_city'] 				= 'Ciudad';
$lang['company_setting_street'] 			= 'Calle';
$lang['company_setting_zip_code'] 			= 'Código postal';
$lang['company_setting_email'] 				= 'Email';
$lang['company_setting_mobile'] 			= 'Móvil';
$lang['company_setting_default_language'] 	= 'Idioma predeterminado';
$lang['company_setting_default_currency'] 	= 'Moneda predeterminada';
$lang['company_setting_submit'] 			= 'Enviar';
$lang['company_setting_cancel'] 			= 'Cancelar';

//Product
$lang['product_list_product'] 			= 'Listar Producto';
$lang['product_add_new_product'] 		= 'Añadir nuevo producto';
$lang['product_no'] 					= 'No';
$lang['product_image'] 					= 'Imagen';
$lang['product_code'] 					= 'Código';
$lang['product_hsn_sac_code'] 			= 'Código HSN / SAC';
$lang['product_name'] 					= 'Nombre';
$lang['product_category'] 				= 'Categoría';
$lang['product_cost'] 					= 'Costo';
$lang['product_price'] 					= 'Precio';
$lang['product_quantity'] 				= 'Cantidad';
$lang['product_unit'] 					= 'Unidad';
$lang['product_alert_quantity'] 		= 'Cantidad de alerta';
$lang['product_available_quantity'] 	= 'Cantidad disponible';
$lang['product_action'] 				= 'Acción';
$lang['product_add_product'] 			= 'Agregar producto';
$lang['product_product_code'] 			= 'Código de producto';
$lang['product_product_name'] 			= 'nombre del producto';
$lang['product_hsn_sac_lookup'] 		= 'Búsqueda HSN / SAC';
$lang['product_select_category'] 		= 'selecciona una categoría';
$lang['product_select'] 				= 'Seleccionar';
$lang['product_select_subcategory'] 	= 'Seleccionar subcategoría';
$lang['product_product_unit'] 			= 'Unidad de producto';
$lang['product_product_size'] 			= 'Tamaño del producto';
$lang['product_product_cost'] 			= 'Costo del producto';
$lang['product_product_price'] 			= 'Precio de distribuidor neto';
$lang['product_select_product_tax'] 	= 'Seleccione el impuesto sobre el producto';
$lang['product_no_tax'] 				= 'Sin impuestos';
$lang['product_product_image'] 			= 'Imagen del producto';
$lang['product_product_details'] 		= 'Detalles del producto para Invoice';
$lang['product_add'] 					= 'Añadir';
$lang['product_cancel'] 				= 'Cancelar';
$lang['product_hsn'] 					= 'HSN';
$lang['product_sac'] 					= 'SACO';
$lang['product_chapter'] 				= 'Capítulo';
$lang['product_hsn_code'] 				= 'Códigos HSN #';
$lang['product_description'] 			= 'Descripción';
$lang['product_sac_code'] 				= 'Códigos SAC #';
$lang['product_close'] 					= 'Cerca';
$lang['product_apply'] 					= 'Aplicar';
$lang['header_edit_product'] 			= 'Editar producto';
$lang['product_update'] 				= 'Actualizar';
$lang['product_delete_conform'] 		= 'Seguro de eliminar este registro ?';

//Product Alert
$lang['product_alert_pdf'] 				= 'PDF';
$lang['header_list_product_alert'] 		= 'Lista de Alertas de Producto';

//transfer
$lang['transfer_dashboard']	 		=	'Tablero';
$lang['transfer_transfers']	 		=	'Transferencias';
$lang['transfer_listtransfers']	 	=	'Transferencias de lista';
$lang['transfer_add_new_transfer']	=	'Agregar nueva transferencia';
$lang['transfer_no']	 			=	'No';
$lang['transfer_date']	 			=	'Fecha';
$lang['transfer_warehouse_from'] 	=	'Almacén (De)';
$lang['transfer_warehouse_to']	 	=	'Almacén (A)';
$lang['transfer_total']	 			=	'Total';
$lang['transfer_actions']	 		=	'Comportamiento';
$lang['transfer_add_transfer']	 	=	'Agregar transferencia';
$lang['transfer_to_warehouse']	 	=	'Al almacén';
$lang['transfer_from_warehouse']	=	'Desde almacén';
$lang['transfer_select_product']	=	'Seleccionar producto';
$lang['transfer_select']	 		=	'Seleccionar';
$lang['transfer_inventory_items']	=	'Artículos de inventario';
$lang['transfer_code']	 			=	'Código';
$lang['transfer_quantity']	 		=	'Cantidad';
$lang['transfer_available_qty']	 	=	'Cantidad disponible';
$lang['transfer_unit']	 			=	'Unidad';
$lang['transfer_cost']	 			=	'Costo';
$lang['transfer_sub_total']	 		=	'Sub Total';
$lang['transfer_grand_total']	 	=	'Gran total ';
$lang['transfer_note']	 			=	'Nota';
$lang['transfer_add']	 			=	'Añadir';
$lang['transfer_edit_transfer']	 	=	'Editar transferencia';
$lang['transfer_save']	 			=	'Salvar';

//assaign warehouse
$lang['assign_warehouse']						=	"Asignar Almacén";
$lang['assign_warehouse_add_assign_warehouse']	=	"Añadir Asignar almacén";
$lang['assign_warehouse_user_name']				=	"Nombre de usuario";
$lang['assign_warehouse_select']				=	"Seleccionar";
$lang['assign_warehouse_warehouse_name']		=	"Nombre del almacén";
$lang['assign_warehouse_cancel']				=	"Cancelar";
$lang['assign_warehouse_add']					=	"Añadir";
$lang['assign_warehouse_list_assign_warehouse']	=	"Lista Asignar Almacén";
$lang['assign_warehouse_no']					=	"No";
$lang['assign_warehouse_actions']				=	"Comportamiento";

//Purchase
$lang['purchase_list_purchase'] 		= 'Compra de lista';
$lang['purchase_add_new_purchase'] 		= 'Añadir nueva compra';
$lang['purchase_date'] 					= 'Fecha';
$lang['purchase_reference_no'] 			= 'Numero de referencia';
$lang['purchase_supplier'] 				= 'Proveedor';
$lang['purchase_purchase_status'] 		= 'Estado de la compra';
$lang['purchase_grand_total'] 			= 'Gran total';
$lang['purchase_received'] 				= 'Recibido';
$lang['purchase_purchase_details'] 		= 'Detalles de la compra';
$lang['purchase_edit_purchase'] 		= 'Editar compra';
$lang['purchase_download_as_pdf'] 		= 'Descargar como PDf';
$lang['purchase_email_purchase'] 		= 'Compra de correo electrónico';
$lang['purchase_delete_purchase'] 		= 'Eliminar compra';
$lang['purchase_add_purchase'] 			= 'Añadir Compra';
$lang['purchase_select_warehouse'] 		= 'Seleccione Depósito';
$lang['purchase_select_supplier'] 		= 'Seleccione el proveedor';
$lang['purchase_select_product'] 		= 'Seleccionar producto';
$lang['purchase_inventory_items'] 		= 'Artículos de inventario';
$lang['purchase_product_description'] 	= 'Descripción del producto';
$lang['purchase_sub_total'] 			= 'Sub Total';
$lang['purchase_taxable_value'] 		= 'Valor imponible';
$lang['purchase_total'] 				= 'Total';
$lang['purchase_total_value'] 			= 'Valor total';
$lang['purchase_total_discount'] 		= 'Descuento total';
$lang['purchase_total_tax'] 			= 'Total impuestos';
$lang['purchase_note'] 					= 'Nota';
$lang['purchase_total_sales'] 			= 'Ventas totales';
$lang['purchase_total_amount'] 			= 'Cantidad total';
$lang['purchase_edit'] 					= 'Editar';
$lang['purchase_delete'] 				= 'Borrar';
$lang['purchase_to'] 					= 'A';
$lang['purchase_from'] 					= 'De';
$lang['purchase_mobile'] 				= 'Móvil';
$lang['purchase_ordered_by'] 			= 'Ordenado por';
$lang['purchase_stamp_and_signature']	= 'Sello y firma';

//Purchase Return
$lang['purchase_return_list_purchase_return'] 		= 'Lista de devoluciones';
$lang['purchase_return_add_new_purchase_return'] 	= 'Añadir nuevo reembolso de compra';
$lang['purchase_return_add_purchase_return'] 		= 'Agregar Devolución de Compra';
$lang['purchase_return_grand_total'] 				= 'Total general: 0.00';
$lang['purchase_return_edit_purchase_return'] 		= 'Editar devoluciones de compra';
$lang['purchase_return_edit_grand_total'] 			= 'Gran total :';

//sales
$lang['sales_list_sales'] 				= 'Lista de ventas';
$lang['sales_add_new_sales'] 			= 'Añadir nuevas ventas';
$lang['sales_biller'] 					= 'Facturador';
$lang['sales_client'] 				= 'Cliente';
$lang['sales_sales_status'] 			= 'Estado de ventas';
$lang['sales_payment_status'] 			= 'Estado de pago';
$lang['sales_paid'] 					= 'Pagado';
$lang['sales_complited'] 				= 'Completado';
$lang['sales_pending'] 					= 'Pendiente';
$lang['sales_sales_details'] 			= 'Detalles de ventas';
$lang['sales_add_payment'] 				= 'Añadir pago';
$lang['sales_edit_sales'] 				= 'Editar Ventas';
$lang['sales_email_sales'] 				= 'Ventas por correo electrónico';
$lang['sales_delete_sales'] 			= 'Eliminar ventas';
$lang['sales_add_sales'] 				= 'Añadir Ventas';
$lang['sales_select_biller'] 			= 'Seleccione Facturador';
$lang['sales_select_client'] 			= 'Seleccione Cliente';
$lang['sales_internal_note'] 			= 'Nota interna';
$lang['sales_status'] 					= 'Estado';
$lang['sales_balance'] 					= 'Equilibrar';
$lang['sales_invoice'] 					= 'Factura';
$lang['sales_client_details'] 		= 'Detalles del cliente';
$lang['sales_pos'] 						= 'POS';
$lang['sales_invoice_hash'] 			= 'Factura #';
$lang['sales_address'] 					= 'Dirección';
$lang['sales_product_wise_details'] 	= 'Detalles del producto';
$lang['sales_cgst'] 					= 'CGST';
$lang['sales_sgst'] 					= 'SGST';
$lang['sales_igst'] 					= 'IGST';
$lang['sales_total_sales'] 				= 'Ventas Total';
$lang['sales_remarks'] 					= 'Observaciones:';
$lang['sales_summary'] 					= 'Resumen';
$lang['sales_amount'] 					= 'Cantidad';
$lang['sales_total_invoice_value'] 		= 'Valor total de la factura';
$lang['sales_total_cgst'] 				= 'Total CGST';
$lang['sales_receivers_signature'] 		= 'Firma del receptor';
$lang['sales_senior_accounts_manager'] 	= 'Gerente de Cuentas Senior';
$lang['sales_total_sgst'] 				= 'SGST total';
$lang['slaes_invoice_note'] 			= 'Nota: Haga todos los cheques a nombre de la Compañía';
$lang['sales_igst'] 					= 'IGST total';
$lang['sales_thank_you'] 				= 'Gracias por hacer negocios';
$lang['sales_edit_sales'] 				= 'Editar Ventas';
$lang['sales_pay']		 				= 'Paga';
$lang['sales_list_invoice']		 		= 'Lista de facturas';
$lang['sales_sales_amount']		 		= 'Cantidad de ventas';
$lang['sales_paid_amount']		 		= 'Monto de pago';
$lang['sales_invoice_no']		 		= 'Factura no';

//Sales Return
$lang['sales_return_list_sales_return'] 	= 'Lista de devoluciones de ventas';
$lang['sales_return_add_new_sales_return'] 	= 'Añadir nuevo retorno de ventas';
$lang['sales_return_add_sales_return'] 		= 'Añadir Ventas';
$lang['sales_return_edit_sales_return'] 	= 'Editar la devolución de ventas';

//payment
$lang['payment_list_payment'] 				= 'Pago de lista';
$lang['payment_paying_by'] 					= 'Pagando por';
$lang['payment_edit_payment'] 				= 'Editar pago';
$lang['payment_bank_name'] 					= 'Nombre del banco';
$lang['payment_cheque_no'] 					= 'Marque No';
$lang['sales_amount'] 						= 'Cantidad';

//Reports
$lang['reports_daily_reports'] 				= 'Reportes diarios';
$lang['reports_current_month_sales'] 		= 'Ventas del mes actual :';
$lang['reports_profite'] 					= 'Lucro :';
$lang['reports_product_reports'] 			= 'Productos Informes';
$lang['reports_start_date'] 				= 'Fecha de inicio';
$lang['reports_end_date'] 					= 'Fecha final';
$lang['reports_purchased'] 					= 'Comprado';
$lang['reports_sold'] 						= 'Vendido';
$lang['reports_profite_title'] 				= 'Profite';
$lang['reports_purchase_reports'] 			= 'Informes de compra';
$lang['reports_created_by'] 				= 'Creado por ';
$lang['reports_supplier'] 					= 'Proveedor';
$lang['reports_product_qty'] 				= 'Producto (Cantidad)';
$lang['reports_hide_show'] 					= 'Ocultar mostrar';
$lang['reports_submit'] 					= 'Enviar';
$lang['reports_purchase_return_reports'] 	= 'Informes de devoluciones de compras';
$lang['reports_sales_reports'] 				= 'Informes de Ventas';
$lang['reports_biller'] 					= 'Facturador';
$lang['reports_client'] 					= 'Cliente';
$lang['reports_sales_return_reports'] 		= 'Vuelta de ventas';

//Dashboard
$lang['dashboard_today'] 					= 'Hoy';
$lang['dashboard_this_week'] 				= 'Esta semana';
$lang['dashboard_this_month'] 				= 'Este mes';
$lang['dashboard_this_year'] 				= 'Este año';
$lang['dashboard_all_time'] 				= 'Todo el tiempo';
$lang['dashboard_new_items'] 				= 'Nuevos objetos';
$lang['dashboard_purchase_item'] 			= 'Artículo comprado';
$lang['dashboard_sold_items'] 				= 'Artículos vendidos';
$lang['dashboard_purchase_value'] 			= 'Valor comprado';
$lang['dashboard_sales_value'] 				= 'Valor de las ventas';
$lang['dashboard_yearly_sales'] 			= 'Ventas anuales';
$lang['dashboard_total_sales'] 				= 'Ventas totales';
$lang['dashboard_value_in_warehouse'] 		= 'Valor en Almacén';
$lang['dashboard_warehouse_products'] 		= 'Productos de almacén';
$lang['dashboard_no_of_items'] 				= 'Nº de artículos';
$lang['dashboard_rights_reserved'] 			= 'Derechos reservados.';
$lang['dashboard_copyright'] 				= 'Derechos de autor';
$lang['dashboard_version'] 					= 'Versión';
$lang['dashboard_month'] 					= 'Mes';
$lang['dashboard_sales_performance'] 		= 'Rendimiento de las ventas';
$lang['dashboard_sales_of_company'] 		= 'Ventas de la empresa';


/***   User    ***/

$lang['user_lable'] 	   		= 'Usuarios';
$lang['user_lable_header'] 		= 'Listar usuarios';
$lang['user_btn_new'] 	   		= 'Añadir nuevo usuario';
$lang['user_lable_fname']  		= 'Nombre de pila';
$lang['user_lable_lname']  		= 'Apellido';
$lang['user_lable_email']  		= 'Email';
$lang['user_lable_group']  		= 'Grupo';
$lang['user_lable_status'] 		= 'Estado';
$lang['user_lable_action'] 		= 'Acción';

$lang['add_user_header'] 		= 'Añadir usor';
$lang['add_user_label'] 		= 'Añadir nuevo usuario';
$lang['add_user_company'] 		= 'nombre de empresa';
$lang['add_user_mobile'] 		= 'No móviles';
$lang['add_user_password'] 	   	= 'Contraseña';
$lang['add_user_confpassword'] 	= 'Confirmar contraseña';
$lang['add_user_btn'] 			= 'Añadir';
$lang['add_user_btn_cancel'] 	= 'Cancelar';
$lang['edit_user_header'] 		= 'editar usuario';
$lang['edit_user_member'] 		= 'Miembro de grupos';
$lang['edit_user_btn'] 			= 'Actualizar';



/*****   Billers ***/

$lang['biller_lable'] 	   		= 'Facturador';
$lang['biller_header'] 	   		= 'Listado de Facturador';
$lang['biller_btn_add'] 	   	= 'Añadir nuevos Facturador';
$lang['biller_lable_no'] 	   	= 'No';
$lang['biller_lable_name'] 	   	= 'Nombre';
$lang['biller_lable_company'] 	= 'Empresa';
$lang['biller_lable_phone'] 	= 'Teléfono';
$lang['biller_lable_email'] 	= 'Dirección de correo electrónico';
$lang['biller_lable_city'] 	    = 'Ciudad';
$lang['biller_lable_country'] 	= 'País';
$lang['biller_lable_action'] 	= 'Acción';


$lang['add_biller_label'] 		= 'Añadir Facturador';
$lang['add_biller_header'] 		= 'Añadir Nuevo Facturador';
$lang['add_biller_billname'] 	= 'Nombre del Encargado';
$lang['add_biller_gst'] 		= 'GSTIN';
$lang['add_biller_select_branch'] = 'Seleccionar sucursal';
$lang['add_biller_select']      = 'Seleccionar';
$lang['add_biller_address'] 	= 'Dirección';
$lang['add_biller_state'] 		= 'Estado';
$lang['add_biller_fax'] 		= 'Fax';
$lang['add_biller_telephone'] 	= 'Teléfono';
$lang['add_biller_mobile'] 		= 'Móvil';
$lang['edit_biller_header'] 	= 'Editar Facturador';
$lang['edit_biller_btn'] 		= 'Actualizar';

/***** Clients *******/

$lang['client_header'] 		= 'Cliente';
$lang['client_label'] 		= 'Lista de clientes';
$lang['client_btn_add'] 		= 'Añadir nuevo cliente';
$lang['add_client_label'] 	= 'Agregar cliente';
$lang['add_client_header'] 	= 'Añadir nuevo cliente';
$lang['add_client_cname'] 	= 'Nombre del cliente';
$lang['add_client_compname'] 	= 'nombre de empresa';
$lang['add_client_code'] 		= 'código postal';
$lang['edit_client_header'] 	= 'Editar cliente';


/****** Supplier ****/

$lang['supplier_header'] 		= 'Proveedor';
$lang['supplier_label'] 		= 'Lista de proveedores';
$lang['supplier_btn_add'] 		= 'Añadir nuevos proveedores';
$lang['supplier_add'] 			= 'Añadir Proveedores';
$lang['add_supplier_name'] 		= 'Nombre del proveedor';
$lang['edit_supplier_header'] 	= 'Editar proveedor';


/**** Warehouse *********/

$lang['warehouse_header'] 		= 'Almacén';
$lang['warehouse_label'] 		= 'Almacén de la lista';
$lang['warehouse_label_no'] 	= 'No';
$lang['warehouse_label_wname'] 	= 'Nombre del almacén';
$lang['warehouse_label_bname'] 	= 'Nombre de sucursal';
$lang['warehouse_label_uname'] 	= 'Nombre de usuario';
$lang['warehouse_label_action'] = 'Comportamiento';
$lang['warehouse_btn_new'] 		= 'Añadir nuevo almacén';

$lang['add_warehouse'] 			= 'Añadir Almacén';
$lang['add_warehouse_name'] 	= 'Nombre del almacén';
$lang['edit_warehouse_header'] 	= 'Editar almacén';

//Category

$lang['category_add'] 						= 'Añadir';
$lang['category_cancel'] 					= 'Cancelar';
$lang['category_lable'] 					= 'Categoría';
$lang['category_lable_addcategory'] 		= 'añadir categoría';
$lang['category_lable_editcategory'] 		= 'Editar categoría';
$lang['category_lable_no'] 					= 'No';
$lang['category_lable_code'] 				= 'Código de Categoría';
$lang['category_lable_cname'] 				= 'nombre de la categoría';
$lang['category_lable_actions'] 			= 'Comportamiento';
$lang['category_lable_lcategory'] 			= 'Categoría de la lista';
$lang['category_lable_newcategory'] 		= 'Añadir nueva categoria';

//Subcategory
$lang['subcategory_add'] 					= 'Añadir';
$lang['subcategory_cancel'] 				= 'Cancelar';
$lang['subcategory_update'] 				= 'Actualizar';
$lang['subcategory_label'] 					= 'Subcategoría';
$lang['subcategory_label_add'] 				= 'Añadir subcategoría';
$lang['subcategory_newcategory'] 			= 'Añadir nueva subcategoría';
$lang['subcategory_label_select'] 			= 'selecciona una categoría';
$lang['subcategory_label_name'] 			= 'Nombre de subcategoría';
$lang['subcategory_label_listcategory'] 	= 'Subcategoría de la lista';
$lang['subcategory_cancel'] 				= 'Cancelar';
$lang['subcategory_label_code'] 			= 'Subcategoría Código';
$lang['subcategory_label_main'] 			= 'categoria principal';
$lang['subcategory_label_name'] 			= 'Nombre de subcategoría';
$lang['subcategory_label_edit'] 			= 'Editar subcategoría';

//Branch
$lang['branch_label'] 						= 'Rama';
$lang['branch_label_name'] 					= 'Nombre de sucursal';
$lang['branch_label_city'] 					= 'Ciudad';
$lang['branch_label_address'] 				= 'Dirección';
$lang['branch_label_add'] 					= 'Añadir';
$lang['branch_label_newbranch'] 			= 'Añadir Nueva Sucursal';
$lang['branch_label_cancel'] 				= 'Cancelar';
$lang['branch_label_addbranch'] 			= 'Añadir Rama';
$lang['branch_label_edit'] 					= 'Editar sección';

//Discount

$lang['discount_label_name'] 				= 'Nombre de descuento';
$lang['discount_label_value'] 				= 'Valor de descuento';
$lang['discount_label'] 					= 'Descuento';
$lang['discount_label_username'] 			= 'Nombre de usuario';
$lang['discount_label_add']					= 'Añadir';
$lang['discount_label_newbranch'] 			= 'Añadir nuevo descuento';
$lang['discount_label_cancel'] 				= 'Cancelar';
$lang['discount_label_addbranch'] 			= 'Añadir descuento';
$lang['discount_label_list'] 				= 'Descuento por lista';
$lang['discount_label_edit'] 				= 'Editar descuento';
$lang['discount_label_update'] 				= 'Actualizar';

//Tax

$lang['tax_label_name'] 				= 'Nombre del impuesto';
$lang['tax_label_form'] 				= 'Empezar desde';
$lang['tax_label_rnumber'] 				= 'Número de registro';
$lang['tax_label_frequency'] 			= 'Frecuencia de llenado';
$lang['tax_label_desc'] 				= 'Descripción';
$lang['tax_label_applies'] 				= 'El impuesto se aplica a';
$lang['tax_label_calculate'] 			= 'Calcular en';
$lang['tax_label_salesrate'] 			= 'Tasa de impuesto de ventas';
$lang['tax_label_addnew'] 				= 'Añadir nuevo impuesto';
$lang['tax_label_add'] 					= 'Añadir impuesto';
$lang['tax_label_purchaserate'] 		= 'Tasa de Impuestos de Compra';
$lang['tax_label_list'] 				= 'Lista de impuestos';
$lang['tax_label'] 						= 'Impuesto';
$lang['tax_label_Edit'] 				= 'Editar impuesto';
