<?php

namespace Mvc\Controllers;

use Core\Controller;
use Mvc\Services\SidebarService;
class Setting extends Controller
{
    function fetchFooterData()
    {
        try {
            $footerData = $this->model("SettingModel");

            return $footerData = [
                "icons" => $footerData->getFooterIconInfor(),
                "bg_footer" => $footerData->getBackgroundbyId(8),
                "footer_icon" => $footerData->getIconbyId(14),
                "phone_icon" => $footerData->getIconbyId(16),
                "footer_data" => $footerData->getDataFooter(),
            ];
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    function fetchHeaderData()
    {
        try {
            $headerData = $this->model("SettingModel");
            return $headerData = [
                "header_icon" => $headerData->getIconbyId(2),
                "head" => $headerData->getHeadInfor(),
                "menu_items" => $headerData->getNavBarItem()
            ];
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    function fetchSideBarData()
    {
        try {
            $sidebarService = new SidebarService();
            $footerData = $this->model("SettingModel");
            return [
                "sidebar_data"  => $sidebarService->getSidebarData(),
                "icon" => $footerData->getFooterIconInfor(),
            ];

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>