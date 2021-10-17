<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class LanguageSwitcher extends CI_Controller
{
    public function __construct() {
        parent::__construct();     
    }
 
    function switchLang($language = "") {
        $language = ($language != "") ? $language : "english";
        $this->session->set_userdata('site_lang', $language);
        redirect($_SERVER['HTTP_REFERER']);
    }
    /*$total = $data[0]->total+$data[0]->shipping_charge;
         $this->load->library('email'); 
   
         $this->email->from($email->from_address ,$email->from_name); 
         $this->email->to($data[0]->email);
         $this->email->subject("Sales order No : ".$data[0]->reference_no." From ".$company[0]->name); 
         $this->email->message("Date : ".$data[0]->date."   \nTotal : ".$total." \n\n\nComapany Name : ".$company[0]->name."\nAddress : ".$company[0]->street." ".$company[0]->country_name."\nMobile No :".$company[0]->phone); 
         //Send mail 
         if($this->email->send()) 
         $message = "Email sent successfully.";
         else 
         $message = "Error in sending Email."; */
}