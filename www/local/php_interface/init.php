<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

AddEventHandler("main", "OnBuildGlobalMenu", ["Myclass", "MyOnBuildGlobalMenu"]);

class Myclass
{
    function MyOnBuildGlobalMenu(&$aGlobalMenu, &$aModuleMenu) {
        global $USER;
        $isAdmin = false;
        $isManager = false;
        $idGroupContent = CGroup::GetList (
            "c_sort",
            "asc",
            Array ("STRING_ID" => 'content_editor')
        )->Fetch()['ID'];
    
        $res = CUser::GetUserGroupList($USER->GetID());
        while ($arGroup = $res->Fetch()){
            // print "<pre>"; print_r($arGroup); print "</pre>";
            if ($arGroup["GROUP_ID"] == 1) {
                $isAdmin = true;
            }
            if ($arGroup["GROUP_ID"] == $idGroupContent) {
                $isManager = true;
            }
        }
    
        if (!$isAdmin && $isManager) {
            foreach ($aModuleMenu as $item) {
                if ($item['items_id'] == 'menu_iblock_/news') {
                    $aModuleMenu = [$item];
                    break;
                }
            }
            $aGlobalMenu = ['global_menu_content' => $aGlobalMenu['global_menu_content']];
        }
    }
}