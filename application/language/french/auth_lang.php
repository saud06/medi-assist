<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
* Name:  Auth Lang - English
*
* Author: Ben Edmunds
* 		  ben.edmunds@gmail.com
*         @benedmunds
*
* Author: Benoit LIETAER
*         @gmail.com
*
* Adjustments by ggallon
*
* Location: http://github.com/benedmunds/ion_auth/
*
* Created:  14.02.2014
*
* Description:  French language file for Ion Auth example views
*
*/

// Errors
$lang['error_csrf'] = 'La validation de ce formulaire a échoué.';

// Login
$lang['login_heading']         = 'Se connecter';
$lang['login_subheading']      = 'Veuillez vous connecter avec votre nom d\'utilisateur et votre mot de passe.';
$lang['login_identity_label']  = 'E-mail/Nom d\'utilisateur :';
$lang['login_password_label']  = 'Mot de passe :';
$lang['login_remember_label']  = 'Rester connecté :';
$lang['login_submit_btn']      = 'Se connecter';
$lang['login_forgot_password'] = 'Mot de passe oublié ?';

// Index
$lang['index_heading']           = 'Utilisateurs';
$lang['index_subheading']        = 'Ci-dessous se trouve la liste des utilisateurs.';
$lang['index_fname_th']          = 'Prénom';
$lang['index_lname_th']          = 'Nom';
$lang['index_email_th']          = 'Email';
$lang['index_groups_th']         = 'Groupes';
$lang['index_status_th']         = 'Statut';
$lang['index_action_th']         = 'Action';
$lang['index_active_link']       = 'Activer';
$lang['index_inactive_link']     = 'Désactiver';
$lang['index_create_user_link']  = 'Créer un nouvel utilisateur';
$lang['index_create_group_link'] = 'Créer un nouveau groupe';

// Deactivate User
$lang['deactivate_heading']                  = 'Désactiver un utilisateur';
$lang['deactivate_subheading']               = 'Êtes-vous certain de vouloir désactiver l\'utilisateur : %s';
$lang['deactivate_confirm_y_label']          = 'Oui :';
$lang['deactivate_confirm_n_label']          = 'Non :';
$lang['deactivate_submit_btn']               = 'Envoyer';
$lang['deactivate_validation_confirm_label'] = 'Confirmation';
$lang['deactivate_validation_user_id_label'] = 'Identifiant';

// Create User
$lang['create_user_heading']                           = 'Créer un utilisateur';
$lang['create_user_subheading']                        = 'Veuillez entrer les informations ci-dessous.';
$lang['create_user_fname_label']                       = 'Prénom :';
$lang['create_user_lname_label']                       = 'Nom :';
$lang['create_user_identity_label']                    = 'Identité :';
$lang['create_user_company_label']                     = 'Société :';
$lang['create_user_email_label']                       = 'Email :';
$lang['create_user_phone_label']                       = 'Téléphone :';
$lang['create_user_password_label']                    = 'Mot de passe :';
$lang['create_user_password_confirm_label']            = 'Confirmer le mot de passe :';
$lang['create_user_submit_btn']                        = 'Créer l\'utilisateur';
$lang['create_user_validation_fname_label']            = 'Prénom';
$lang['create_user_validation_lname_label']            = 'Nom';
$lang['create_user_validation_identity_label']         = 'Identité :';
$lang['create_user_validation_email_label']            = 'Adresse Email';
$lang['create_user_validation_phone_label']            = 'Téléphone';
$lang['create_user_validation_company_label']          = 'Société';
$lang['create_user_validation_password_label']         = 'Mot de passe';
$lang['create_user_validation_password_confirm_label'] = 'Confirmation du mot de passe';

// Edit User
$lang['edit_user_heading']                           = 'Éditer l\'utilisateur';
$lang['edit_user_subheading']                        = 'Veuillez entrer les données de l\'utilisateur ci-dessous.';
$lang['edit_user_fname_label']                       = 'Prénom :';
$lang['edit_user_lname_label']                       = 'Nom :';
$lang['edit_user_company_label']                     = 'Société :';
$lang['edit_user_email_label']                       = 'E-mail :';
$lang['edit_user_phone_label']                       = 'Téléphone :';
$lang['edit_user_password_label']                    = 'Mot de passe (si modifié) :';
$lang['edit_user_password_confirm_label']            = 'Confirmer le mot de passe :';
$lang['edit_user_groups_heading']                    = 'Membre du groupe';
$lang['edit_user_submit_btn']                        = 'Enregistrer les modifications';
$lang['edit_user_validation_fname_label']            = 'Prénom';
$lang['edit_user_validation_lname_label']            = 'Nom';
$lang['edit_user_validation_email_label']            = 'Adresse email';
$lang['edit_user_validation_phone_label']            = 'Téléphone';
$lang['edit_user_validation_company_label']          = 'Société';
$lang['edit_user_validation_groups_label']           = 'Groupes';
$lang['edit_user_validation_password_label']         = 'Mot de passe';
$lang['edit_user_validation_password_confirm_label'] = 'Confirmation du Mot de passe';

// Create Group
$lang['create_group_title']                  = 'Créer le Groupe';
$lang['create_group_heading']                = 'Créer le Groupe';
$lang['create_group_subheading']             = 'Veuillez entrer les informations du groupe ci-dessous.';
$lang['create_group_name_label']             = 'Nom du groupe :';
$lang['create_group_desc_label']             = 'Description :';
$lang['create_group_submit_btn']             = 'Créer le Groupe';
$lang['create_group_validation_name_label']  = 'Nom du Groupe';
$lang['create_group_validation_desc_label']  = 'Description';

// Edit Group
$lang['edit_group_title']                  = 'Éditer le Groupe';
$lang['edit_group_saved']                  = 'Groupe enregistré';
$lang['edit_group_heading']                = 'Éditer le  Groupe';
$lang['edit_group_subheading']             = 'Veuillez entrer les informations du groupe ci-dessous.';
$lang['edit_group_name_label']             = 'Nom du Groupe :';
$lang['edit_group_desc_label']             = 'Description :';
$lang['edit_group_submit_btn']             = 'Enregister les mofifications';
$lang['edit_group_validation_name_label']  = 'Nom du Groupe';
$lang['edit_group_validation_desc_label']  = 'Description';

// Change Password
$lang['change_password_heading']                               = 'Changer le mot de passe';
$lang['change_password_old_password_label']                    = 'Ancien mot de passe :';
$lang['change_password_new_password_label']                    = 'Le nouveau mot de passe (doit contenir %s caractères minimum) :';
$lang['change_password_new_password_confirm_label']            = 'Confirmer le nouveau mot de passe :';
$lang['change_password_submit_btn']                            = 'Enregistrer';
$lang['change_password_validation_old_password_label']         = 'Ancien mot de passe';
$lang['change_password_validation_new_password_label']         = 'Nouveau mot de passe';
$lang['change_password_validation_new_password_confirm_label'] = 'Confirmer le nouveau mot de passe';

// Forgot Password
$lang['forgot_password_heading']                 = 'Mot de passe oublié';
$lang['forgot_password_subheading']              = 'Veuillez entrer votre %s pour que nous puissions vous envoyer votre nouveau mot de passe.';
$lang['forgot_password_email_label']             = '%s :';
$lang['forgot_password_submit_btn']              = 'Envoyer';
$lang['forgot_password_validation_email_label']  = 'Adresse Email';
$lang['forgot_password_username_identity_label'] = 'Nom d\'utilisateur';
$lang['forgot_password_email_identity_label']    = 'Email';
$lang['forgot_password_email_not_found']         = 'Cette adresse email n\'est pas enregistrée chez nous.';
$lang['forgot_password_identity_not_found']         = 'No record of that username address.';

// Reset Password
$lang['reset_password_heading']                               = 'Modifier le mot de passe';
$lang['reset_password_new_password_label']                    = 'Nouveau mot de passe (doit contenir %s caractères minimum) :';
$lang['reset_password_new_password_confirm_label']            = 'Confirmez le nouveau mot de passe :';
$lang['reset_password_submit_btn']                            = 'Enregistrer';
$lang['reset_password_validation_new_password_label']         = 'Nouveau mot de passe';
$lang['reset_password_validation_new_password_confirm_label'] = 'Confirmer le nouveau mot de passe';

// Activation Email
$lang['email_activate_heading']    = 'Activer le compte pour %s';
$lang['email_activate_subheading'] = 'Veuillez cliquer sur le lien pour %s';
$lang['email_activate_link']       = 'Activer votre compte';

// Forgot Password Email
$lang['email_forgot_password_heading']    = 'Changer le mot de passe pour %s';
$lang['email_forgot_password_subheading'] = 'Veuillez cliquer sur ce lien pour %s';
$lang['email_forgot_password_link']       = 'Changer votre mot de passe';

// New Password Email
$lang['email_new_password_heading']    = 'Nouveau mot de passe pour %s';
$lang['email_new_password_subheading'] = 'Votre mot de passe a été changé pour : %s';

$lang['header_sign_out'] = 'Déconnexion';
$lang['header_online'] = 'En ligne';
$lang['header_main_navidation'] = 'PRINCIPALE NAVIGATION';
$lang['header_dashboard'] = 'Tableau de bord';
$lang['header_product'] = 'Produit';
$lang['header_list'] = 'Liste';
$lang['header_add'] = 'Ajouter';
$lang['header_product_alert'] = 'Alerte produit';
$lang['header_purchase'] = 'Achat';
$lang['header_purchase_return'] = 'Retour d\'achat';
$lang['header_transfers'] = 'Transferts';
$lang['header_sales'] = 'Ventes';
$lang['header_sales_return'] = 'Rendement des ventes';
$lang['header_payment'] = 'Paiement';
$lang['header_invoice'] = 'Facture d\'achat';
$lang['header_reports'] = 'Rapports';
$lang['header_daily'] = 'du quotidien';
$lang['header_people'] = 'Gens';
$lang['header_users'] = 'Utilisateurs';
$lang['header_billers'] = 'Billers';
$lang['header_clients'] = 'Les clients';
$lang['header_suppliers'] = 'Fournisseurs';
$lang['header_setting'] = 'Réglage';
$lang['header_company_setting'] = 'Cadre de l\'entreprise';
$lang['header_category'] = 'Catégorie';
$lang['header_sub_category'] = 'Sous-catégorie';
$lang['header_branch'] = 'Branche';
$lang['header_brand']  = 'marque';	
$lang['header_discount'] = 'Remise';
$lang['header_tax'] = 'Impôt';
$lang['header_warehouse'] = 'Entrepôt';
$lang['header_assign_warehouse'] = 'Affecter l\'entrepôt';

//Company Settings
$lang['company_setting_name'] 				= 'prénom';
$lang['company_setting_site_short_name'] 	= 'Nom abrégé du site';
$lang['company_setting_country'] 			= 'Pays';
$lang['company_setting_select'] 			= 'Sélectionner';
$lang['company_setting_state'] 				= 'Etat';
$lang['company_setting_city'] 				= 'Ville';
$lang['company_setting_street'] 			= 'rue';
$lang['company_setting_zip_code'] 			= 'Code postal';
$lang['company_setting_email'] 				= 'Email';
$lang['company_setting_mobile'] 			= 'Mobile';
$lang['company_setting_default_language'] 	= 'Langage par défaut';
$lang['company_setting_default_currency'] 	= 'devise par défaut';
$lang['company_setting_submit'] 			= 'Soumettre';
$lang['company_setting_cancel'] 			= 'Annuler';

//Product
$lang['product_list_product'] 			= 'Liste du produit';
$lang['product_add_new_product'] 		= 'Ajouter un nouveau produit';
$lang['product_no'] 					= 'Non';
$lang['product_image'] 					= 'Image';
$lang['product_code'] 					= 'Code';
$lang['product_hsn_sac_code'] 			= 'Code HSN / SAC';
$lang['product_name'] 					= 'prénom';
$lang['product_category'] 				= 'Catégorie';
$lang['product_cost'] 					= 'Coût';
$lang['product_price'] 					= 'Prix';
$lang['product_quantity'] 				= 'Quantité';
$lang['product_unit'] 					= 'Unité';
$lang['product_alert_quantity'] 		= 'Quantité d\'alerte';
$lang['product_available_quantity'] 	= 'quantité disponible';
$lang['product_action'] 				= 'action';
$lang['product_add_product'] 			= 'Ajouter un produit';
$lang['product_product_code'] 			= 'Code produit';
$lang['product_product_name'] 			= 'Nom du produit';
$lang['product_hsn_sac_lookup'] 		= 'Recherche HSN / SAC';
$lang['product_select_category'] 		= 'Choisir une catégorie';
$lang['product_select'] 				= 'Sélectionner';
$lang['product_select_subcategory'] 	= 'Sélectionnez la sous-catégorie';
$lang['product_product_unit'] 			= 'Unité de produit';
$lang['product_product_size'] 			= 'Taille du produit';
$lang['product_product_cost'] 			= 'Coût du produit';
$lang['product_product_price'] 			= 'Prix ​​net du concessionnaire';
$lang['product_select_product_tax'] 	= 'Sélectionnez la taxe sur les produits';
$lang['product_no_tax'] 				= 'Pas de taxes';
$lang['product_product_image'] 			= 'Image du produit';
$lang['product_product_details'] 		= 'Détails du produit pour la facture';
$lang['product_add'] 					= 'Ajouter';
$lang['product_cancel'] 				= 'Annuler';
$lang['product_hsn'] 					= 'HSN';
$lang['product_sac'] 					= 'SAC';
$lang['product_chapter'] 				= 'Chapitre';
$lang['product_hsn_code'] 				= 'Codes HSN #';
$lang['product_description'] 			= 'La description';
$lang['product_sac_code'] 				= 'Codes SAC #';
$lang['product_close'] 					= 'Fermer';
$lang['product_apply'] 					= 'Appliquer';
$lang['header_edit_product'] 			= 'Modifier le produit';
$lang['product_update'] 				= 'Mettre à jour';
$lang['product_delete_conform'] 		= 'Bien sûr de supprimer ce disque?';

//Product Alert
$lang['product_alert_pdf'] 				= 'PDF';
$lang['header_list_product_alert'] 		= 'Liste de l\'alerte produit';

//transfer
$lang['transfer_dashboard']	 		=	'Tableau de bord';
$lang['transfer_transfers']	 		=	'Transferts';
$lang['transfer_listtransfers']	 	=	'Transferts par liste';
$lang['transfer_add_new_transfer']	=	'Ajouter un nouveau transfert';
$lang['transfer_no']	 			=	'Non';
$lang['transfer_date']	 			=	'Rendez-vous amoureux';
$lang['transfer_warehouse_from'] 	=	'Entrepôt (à partir de)';
$lang['transfer_warehouse_to']	 	=	'Entrepôt (To)';
$lang['transfer_total']	 			=	'Total';
$lang['transfer_actions']	 		=	'actes';
$lang['transfer_add_transfer']	 	=	'Ajouter un transfert';
$lang['transfer_to_warehouse']	 	=	'À l\'entrepôt';
$lang['transfer_from_warehouse']	=	'De l\'entrepôt';
$lang['transfer_select_product']	=	'Sélectionnez le produit';
$lang['transfer_select']	 		=	'Sélectionner';
$lang['transfer_inventory_items']	=	'Articles d\'inventaire';
$lang['transfer_code']	 			=	'Code';
$lang['transfer_quantity']	 		=	'Quantité';
$lang['transfer_available_qty']	 	=	'Qté disponible';
$lang['transfer_unit']	 			=	'Unité';
$lang['transfer_cost']	 			=	'Coût';
$lang['transfer_sub_total']	 		=	'Sub Total';
$lang['transfer_grand_total']	 	=	'somme finale ';
$lang['transfer_note']	 			=	'Remarque';
$lang['transfer_add']	 			=	'Ajouter';
$lang['transfer_edit_transfer']	 	=	'Modifier le transfert';
$lang['transfer_save']	 			=	'sauvegarder';

//assaign warehouse
$lang['assign_warehouse']						=	"Affecter l\'entrepôt";
$lang['assign_warehouse_add_assign_warehouse']	=	"Ajouter Assign Warehouse";
$lang['assign_warehouse_user_name']				=	"Nom d'utilisateur";
$lang['assign_warehouse_select']				=	"Sélectionner";
$lang['assign_warehouse_warehouse_name']		=	"Nom de l'entrepôt";
$lang['assign_warehouse_cancel']				=	"Annuler";
$lang['assign_warehouse_add']					=	"Ajouter";
$lang['assign_warehouse_list_assign_warehouse']	=	"Liste de l\'entrepôt d\'assaign";
$lang['assign_warehouse_no']					=	"Non";
$lang['assign_warehouse_actions']				=	"actes";

//Purchase
$lang['purchase_list_purchase'] 		= 'Liste d\'achat';
$lang['purchase_add_new_purchase'] 		= 'Ajouter un nouvel achat';
$lang['purchase_date'] 					= 'Rendez-vous amoureux';
$lang['purchase_reference_no'] 			= 'Numéro de référence';
$lang['purchase_supplier'] 				= 'Fournisseur';
$lang['purchase_purchase_status'] 		= 'Statut d\'achat';
$lang['purchase_grand_total'] 			= 'somme finale';
$lang['purchase_received'] 				= 'Reçu';
$lang['purchase_purchase_details'] 		= 'Les détails d\'achat';
$lang['purchase_edit_purchase'] 		= 'Modifier l\'achat';
$lang['purchase_download_as_pdf'] 		= 'Télécharger en tant que PDf';
$lang['purchase_email_purchase'] 		= 'Achat de courrier électronique';
$lang['purchase_delete_purchase'] 		= 'Supprimer l\'achat';
$lang['purchase_add_purchase'] 			= 'Ajouter un achat';
$lang['purchase_select_warehouse'] 		= 'Sélectionnez Entrepôt';
$lang['purchase_select_supplier'] 		= 'Sélectionnez Fournisseur';
$lang['purchase_select_product'] 		= 'Sélectionnez le produit';
$lang['purchase_inventory_items'] 		= 'Articles d\'inventaire';
$lang['purchase_product_description'] 	= 'Description du produit';
$lang['purchase_sub_total'] 			= 'Sub Total';
$lang['purchase_taxable_value'] 		= 'Valeur imposable';
$lang['purchase_total'] 				= 'Total';
$lang['purchase_total_value'] 			= 'Valeur totale';
$lang['purchase_total_discount'] 		= 'Réduction totale';
$lang['purchase_total_tax'] 			= 'Taxe totale';
$lang['purchase_note'] 					= 'Remarque';
$lang['purchase_total_sales'] 			= 'Ventes totales';
$lang['purchase_total_amount'] 			= 'Montant total';
$lang['purchase_edit'] 					= 'modifier';
$lang['purchase_delete'] 				= 'Effacer';
$lang['purchase_to'] 					= 'À';
$lang['purchase_from'] 					= 'De';
$lang['purchase_mobile'] 				= 'Mobile';
$lang['purchase_ordered_by'] 			= 'Commander par';
$lang['purchase_stamp_and_signature']	= 'Timbre et signature';

//Purchase Return
$lang['purchase_return_list_purchase_return'] 		= 'Liste de retour d\'achat';
$lang['purchase_return_add_new_purchase_return'] 	= 'Ajouter un nouveau retour d\'achat';
$lang['purchase_return_add_purchase_return'] 		= 'Ajouter un retour d\'achat';
$lang['purchase_return_grand_total'] 				= 'somme finale: 0.00';
$lang['purchase_return_edit_purchase_return'] 		= 'Modifier le retour d\'achat';
$lang['purchase_return_edit_grand_total'] 			= 'somme finale :';

//sales
$lang['sales_list_sales'] 				= 'Liste des ventes';
$lang['sales_add_new_sales'] 			= 'Ajouter de nouvelles ventes';
$lang['sales_biller'] 					= 'Biller';
$lang['sales_client'] 				= 'Client';
$lang['sales_sales_status'] 			= 'Statut des ventes';
$lang['sales_payment_status'] 			= 'Statut de paiement';
$lang['sales_paid'] 					= 'Payé';
$lang['sales_complited'] 				= 'Complété';
$lang['sales_pending'] 					= 'en attendant';
$lang['sales_sales_details'] 			= 'Détails des ventes';
$lang['sales_add_payment'] 				= 'Ajouter un paiement';
$lang['sales_edit_sales'] 				= 'Ajouter un paiement';
$lang['sales_email_sales'] 				= 'Ventes de courrier électronique';
$lang['sales_delete_sales'] 			= 'Supprimer les ventes';
$lang['sales_add_sales'] 				= 'Ajouter des ventes';
$lang['sales_select_biller'] 			= 'Sélectionnez Biller';
$lang['sales_select_client'] 			= 'Sélectionnez un client';
$lang['sales_internal_note'] 			= 'Note interne';
$lang['sales_status'] 					= 'Statut';
$lang['sales_balance'] 					= 'Équilibre';
$lang['sales_invoice'] 					= 'Facture d\'achat';
$lang['sales_client_details'] 		= 'Détails du client';
$lang['sales_pos'] 						= 'POS';
$lang['sales_invoice_hash'] 			= 'Facture d\'achat #';
$lang['sales_address'] 					= 'Adresse';
$lang['sales_product_wise_details'] 	= 'Détails sur le produit';
$lang['sales_cgst'] 					= 'CGST';
$lang['sales_sgst'] 					= 'SGST';
$lang['sales_igst'] 					= 'IGST';
$lang['sales_total_sales'] 				= 'Total des ventes';
$lang['sales_remarks'] 					= 'Remarques:';
$lang['sales_summary'] 					= 'Résumé';
$lang['sales_amount'] 					= 'Montant';
$lang['sales_total_invoice_value'] 		= 'Valeur totale de la facture ';
$lang['sales_total_cgst'] 				= 'Total CGST';
$lang['sales_receivers_signature'] 		= 'Signature du destinataire';
$lang['sales_senior_accounts_manager'] 	= 'Gestionnaire des comptes senior';
$lang['sales_total_sgst'] 				= 'Total SGST';
$lang['slaes_invoice_note'] 			= 'Remarque: Faites tous les chèques à l\'ordre du nom de l\'entreprise';
$lang['sales_igst'] 					= 'Total IGST';
$lang['sales_thank_you'] 				= 'Merci pour votre entreprise';
$lang['sales_edit_sales'] 				= 'Modifier les ventes';
$lang['sales_pay']		 				= 'Payer';
$lang['sales_list_invoice']		 		= 'Liste des factures';
$lang['sales_sales_amount']		 		= 'Montant des ventes';
$lang['sales_paid_amount']		 		= 'Montant payé';
$lang['sales_invoice_no']		 		= 'Numéro de facture';

//Sales Return
$lang['sales_return_list_sales_return'] 	= 'Liste des ventes';
$lang['sales_return_add_new_sales_return'] 	= 'Ajouter un nouveau rendement des ventes';
$lang['sales_return_add_sales_return'] 		= 'Ajouter le retour des ventes';
$lang['sales_return_edit_sales_return'] 	= 'Modifier le retour des ventes';

//payment
$lang['payment_list_payment'] 				= 'Liste de paiement';
$lang['payment_paying_by'] 					= 'Payer par';
$lang['payment_edit_payment'] 				= 'Modifier le paiement';
$lang['payment_bank_name'] 					= 'Nom de banque';
$lang['payment_cheque_no'] 					= 'No de contrôle';
$lang['sales_amount'] 						= 'Montant';

//Reports
$lang['reports_daily_reports'] 				= 'Rapports quotidiens';
$lang['reports_current_month_sales'] 		= 'Ventes courantes du mois:';
$lang['reports_profite'] 					= 'Profit :';
$lang['reports_product_reports'] 			= 'Rapports sur les produits';
$lang['reports_start_date'] 				= 'Date de début';
$lang['reports_end_date'] 					= 'Date de fin';
$lang['reports_purchased'] 					= 'Acheté';
$lang['reports_sold'] 						= 'Vendu';
$lang['reports_profite_title'] 				= 'Profitable';
$lang['reports_purchase_reports'] 			= 'Rapports d\'achat';
$lang['reports_created_by'] 				= 'Créé par ';
$lang['reports_supplier'] 					= 'Fournisseur';
$lang['reports_product_qty'] 				= 'Produit (Qté)';
$lang['reports_hide_show'] 					= 'Hide / Show';
$lang['reports_submit'] 					= 'Soumettre';
$lang['reports_purchase_return_reports'] 	= 'Rapports de retour d\'achat';
$lang['reports_sales_reports'] 				= 'Rapports de vente';
$lang['reports_biller'] 					= 'Biller';
$lang['reports_client'] 					= 'Client';
$lang['reports_sales_return_reports'] 		= 'Rendement des ventes';

//Dashboard
$lang['dashboard_today'] 					= 'Aujourd\'hui';
$lang['dashboard_this_week'] 				= 'Cette semaine';
$lang['dashboard_this_month'] 				= 'Ce mois-ci';
$lang['dashboard_this_year'] 				= 'Cette année';
$lang['dashboard_all_time'] 				= 'Tout le temps';
$lang['dashboard_new_items'] 				= 'Nouveaux articles';
$lang['dashboard_purchase_item'] 			= 'Article acheté';
$lang['dashboard_sold_items'] 				= 'Articles vendus';
$lang['dashboard_purchase_value'] 			= 'Valeur achetée';
$lang['dashboard_sales_value'] 				= 'La valeur des ventes';
$lang['dashboard_yearly_sales'] 			= 'Ventes annuelles';
$lang['dashboard_total_sales'] 				= 'Ventes totales';
$lang['dashboard_value_in_warehouse'] 		= 'Valeur dans l\'entrepôt';
$lang['dashboard_warehouse_products'] 		= 'Produits d\'entrepôt';
$lang['dashboard_no_of_items'] 				= 'Nombre d\'articles';
$lang['dashboard_rights_reserved'] 			= 'droits réservés.';
$lang['dashboard_copyright'] 				= 'droits d\'auteur';
$lang['dashboard_version'] 					= 'Version';
$lang['dashboard_month'] 					= 'Mois';
$lang['dashboard_sales_performance'] 		= 'Performance de ventes';
$lang['dashboard_sales_of_company'] 		= 'Ventes de la société';


/***   User    ***/

$lang['user_lable'] 	   		= 'Utilisateurs';
$lang['user_lable_header'] 		= 'Liste des utilisateurs';
$lang['user_btn_new'] 	   		= 'Ajouter un nouvel utilisateur';
$lang['user_lable_fname']  		= 'Prénom';
$lang['user_lable_lname']  		= 'Nom de famille';
$lang['user_lable_email']  		= 'Email';
$lang['user_lable_group']  		= 'Groupe';
$lang['user_lable_status'] 		= 'Statut';
$lang['user_lable_action'] 		= 'action';

$lang['add_user_header'] 		= 'Ajouter un utilisateur';
$lang['add_user_label'] 		= 'Ajouter un nouvel utilisateur';
$lang['add_user_company'] 		= 'Nom de la compagnie';
$lang['add_user_mobile'] 		= 'Mobile No';
$lang['add_user_password'] 	   	= 'Mot de passe';
$lang['add_user_confpassword'] 	= 'Confirmez le mot de passe';
$lang['add_user_btn'] 			= 'Ajouter';
$lang['add_user_btn_cancel'] 	= 'Annuler';
$lang['edit_user_header'] 		= 'Modifier l\'utilisateur';
$lang['edit_user_member'] 		= 'Membre de groupes';
$lang['edit_user_btn'] 			= 'Mettre à jour';



/*****   Billers ***/

$lang['biller_lable'] 	   		= 'Billers';
$lang['biller_header'] 	   		= 'Liste des Billers';
$lang['biller_btn_add'] 	   	= 'Ajouter de nouveaux Billards';
$lang['biller_lable_no'] 	   	= 'Non';
$lang['biller_lable_name'] 	   	= 'prénom';
$lang['biller_lable_company'] 	= 'Compagnie';
$lang['biller_lable_phone'] 	= 'Téléphone';
$lang['biller_lable_email'] 	= 'Adresse e-mail';
$lang['biller_lable_city'] 	    = 'Ville';
$lang['biller_lable_country'] 	= 'Pays';
$lang['biller_lable_action'] 	= 'action';


$lang['add_biller_label'] 		= 'Ajouter Biller';
$lang['add_biller_header'] 		= 'Ajouter de nouveaux Billards';
$lang['add_biller_billname'] 	= 'Nom du Biller';
$lang['add_biller_gst'] 		= 'GSTIN';
$lang['add_biller_select_branch'] = 'Sélectionnez une branche';
$lang['add_biller_select']      = 'Sélectionner';
$lang['add_biller_address'] 	= 'Adresse';
$lang['add_biller_state'] 		= 'Etat';
$lang['add_biller_fax'] 		= 'Fax';
$lang['add_biller_telephone'] 	= 'Fax';
$lang['add_biller_mobile'] 		= 'Mobile';
$lang['edit_biller_header'] 	= 'Edit Biller';
$lang['edit_biller_btn'] 		= 'Mettre à jour';

/***** Clients *******/

$lang['client_header'] 		= 'Client';
$lang['client_label'] 		= 'Liste des clients';
$lang['client_btn_add'] 		= 'Ajouter un nouveau client';
$lang['add_client_label'] 	= 'Ajouter un client';
$lang['add_client_header'] 	= 'Ajouter un nouveau client';
$lang['add_client_cname'] 	= 'Nom du client';
$lang['add_client_compname'] 	= 'Nom de la compagnie';
$lang['add_client_code'] 		= 'Postal Code';
$lang['edit_client_header'] 	= 'Modifier le client';


/****** Supplier ****/

$lang['supplier_header'] 		= 'Fournisseur';
$lang['supplier_label'] 		= 'Liste Fournisseurs';
$lang['supplier_btn_add'] 		= 'Ajouter de nouveaux fournisseurs';
$lang['supplier_add'] 			= 'Ajouter des fournisseurs';
$lang['add_supplier_name'] 		= 'Nom du fournisseur';
$lang['edit_supplier_header'] 	= 'Modifier le fournisseur';


/**** Warehouse *********/

$lang['warehouse_header'] 		= 'Entrepôt';
$lang['warehouse_label'] 		= 'List Warehouse';
$lang['warehouse_label_no'] 	= 'Non';
$lang['warehouse_label_wname'] 	= 'Nom de l\'entrepôt';
$lang['warehouse_label_bname'] 	= 'Nom de la filiale';
$lang['warehouse_label_uname'] 	= 'Nom d\'utilisateur';
$lang['warehouse_label_action'] = 'actes';
$lang['warehouse_btn_new'] 		= 'Ajouter un nouvel entrepôt';
$lang['add_warehouse'] 			= 'Ajouter un magasin';
$lang['add_warehouse_name'] 	= 'Nom de l\'entrepôt';
$lang['edit_warehouse_header'] 	= 'Modifier entrepôt';

//Category

$lang['category_add'] 						= 'Ajouter';
$lang['category_cancel'] 					= 'Annuler';
$lang['category_lable'] 					= 'Catégorie';
$lang['category_lable_addcategory'] 		= 'ajouter une catégorie';
$lang['category_lable_editcategory'] 		= 'Modifier la catégorie';
$lang['category_lable_no'] 					= 'Non';
$lang['category_lable_code'] 				= 'Code de catégorie';
$lang['category_lable_cname'] 				= 'Nom de catégorie';
$lang['category_lable_actions'] 			= 'actes';
$lang['category_lable_lcategory'] 			= 'Catégorie de liste';
$lang['category_lable_newcategory'] 		= 'Ajouter une nouvelle catégorie';

//Subcategory
$lang['subcategory_add'] 					= 'Ajouter';
$lang['subcategory_cancel'] 				= 'Annuler';
$lang['subcategory_update'] 				= 'Mettre à jour';
$lang['subcategory_label'] 					= 'Sous-catégorie';
$lang['subcategory_label_add'] 				= 'Ajouter une sous-catégorie';
$lang['subcategory_newcategory'] 			= 'Ajouter une nouvelle sous-catégorie';
$lang['subcategory_label_select'] 			= 'Choisir une catégorie';
$lang['subcategory_label_name'] 			= 'Sous-catégorie Nom';
$lang['subcategory_label_listcategory'] 	= 'Sous-catégorie de liste';
$lang['subcategory_cancel'] 				= 'Annuler';
$lang['subcategory_label_code'] 			= 'Sous-catégorie Code';
$lang['subcategory_label_main'] 			= 'catégorie principale';
$lang['subcategory_label_name'] 			= 'Sous-catégorie Nom';
$lang['subcategory_label_edit'] 			= 'Modifier la sous-catégorie';

//Branch
$lang['branch_label'] 						= 'Branche';
$lang['branch_label_name'] 					= 'Nom de la filiale';
$lang['branch_label_city'] 					= 'Ville';
$lang['branch_label_address'] 				= 'Adresse';
$lang['branch_label_add'] 					= 'Ajouter';
$lang['branch_label_newbranch'] 			= 'Ajouter une nouvelle succursale';
$lang['branch_label_cancel'] 				= 'Cancel';
$lang['branch_label_addbranch'] 			= 'Ajouter une succursale';
$lang['branch_label_edit'] 					= 'Modifier la branche';

//Discount

$lang['discount_label_name'] 				= 'Nom de réduction';
$lang['discount_label_value'] 				= 'Valeur de réduction';
$lang['discount_label'] 					= 'Remise';
$lang['discount_label_username'] 			= 'Nom d\'utilisateur';
$lang['discount_label_add']					= 'Ajouter';
$lang['discount_label_newbranch'] 			= 'Ajouter une nouvelle remise';
$lang['discount_label_cancel'] 				= 'Annuler';
$lang['discount_label_addbranch'] 			= 'Ajouter une remise';
$lang['discount_label_list'] 				= 'Liste de remise';
$lang['discount_label_edit'] 				= 'Modifier la remise';
$lang['discount_label_update'] 				= 'Mettre à jour';

//Tax

$lang['tax_label_name'] 				= 'Nom de l\'impôt';
$lang['tax_label_form'] 				= 'Commencer à partir de';
$lang['tax_label_rnumber'] 				= 'Numéro d\'immatriculation';
$lang['tax_label_frequency'] 			= 'Fréquence de remplissage';
$lang['tax_label_desc'] 				= 'La description';
$lang['tax_label_applies'] 				= 'Tax s\'applique à';
$lang['tax_label_calculate'] 			= 'Calculer sur';
$lang['tax_label_salesrate'] 			= 'Taux d\'imposition des ventes ';
$lang['tax_label_addnew'] 				= 'Ajouter une nouvelle taxe';
$lang['tax_label_add'] 					= 'Ajouter une taxe';
$lang['tax_label_purchaserate'] 		= 'Taux d\'imposition des achats';
$lang['tax_label_list'] 				= 'Liste des impôts';
$lang['tax_label'] 						= 'Impôt';
$lang['tax_label_Edit'] 				= 'Modifier la taxe';