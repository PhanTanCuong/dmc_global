<?php
    class Media extends Controller{
        function displayNews(){
            //Model
            $news=$this->model("MediaModel");
            
            //View
            $this->view("admin/home",[
                "news" => $news->getNews(),
                "page"=>"displayMedia"
            ]);
        }
    }
?>