<?php
    
    namespace Mvc\Controllers;
    
    use Core\Controller;
    class Footer extends Controller{
        function fetchFooterData(){
            try{
                $footerData = $this->model("SettingModel");

                $footerData=[
                    "icons" => $footerData->getFooterIconInfor(),
                    "bg_footer" => $footerData->getBackgroundbyId(8),
                    "footer_icon" => $footerData->getIconbyId(14),
                    "phone_icon" => $footerData->getIconbyId(16),
                    "footer_data" => $footerData->getDataFooter(),
                ];

                return $footerData;
                    
            }catch(\Exception $e){
                echo $e->getMessage();
            }
        }
    }
?>