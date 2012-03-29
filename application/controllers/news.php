<?php

include_once "business_logic/productsStuff.php";
include_once "business_logic/newsStuff.php";

class News extends CI_Controller {
    public function index()
    {
         $newsStuff = new NewsStuff();
         $stuff = $newsStuff->getNews(NULL, 0, 100);
         $data['newsStuff']=$stuff;
         $data['activeLink']= 1;
         $this->load->view('main_top', $data); 
         $this->load->view('news',$data);
         $this->load->view('main_footer');
    }
}