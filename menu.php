<script>
jQuery(document).ready(function(){  
		   $( "#main-menu .root" ).click(function() { 
               if ($(this).hasClass("root-active"))  
                   return;
                   
              $("#main-menu .submenu-panel-" + $("#main-menu .root-active").attr("rel")).hide(400 ,"linear");  
              $("#main-menu .root-active" ).removeClass("root-active");

              $(this).addClass("root-active"); 
              $("#main-menu .submenu-panel-" + $(this).attr("rel")).show(400 ,"linear");   

           });
});
</script>
<?php 
		 	    
    function pushMenuItem(&$arrMenuItem,$newMenuItem){
         global $security;
        
         $userkey =  base64_decode($_SESSION[$security->loginAdminSession]['id']); 
     
            //$security->setLog($newMenuItem['label']);
         if ( isset($newMenuItem['menu']) && count($newMenuItem['menu'][0]) == 0){ 
             return;
         } 
         
         if ( !empty($newMenuItem['securityObject']) &&  !$security->hasSecurityAccess( $userkey ,$security->getSecurityKey($newMenuItem['securityObject']),10) ) 
                 return;
             
         array_push($arrMenuItem ,$newMenuItem);
        
    }

    function buildMenu($arrMenu,$parent = '' ){ 
          
            $menu = '';
            
	        
            foreach ($arrMenu as $key=>$menuItem) { 
                
                    
                $class = "submenu";
                if (empty($parent))
                        $class="root hvr-sweep-to-right ";
                
                else if (isset($menuItem['menu']))
                         $class .= " submenu-header";
                
                $icon = '';
                if (!empty($menuItem['icon']))
                    $icon = '<div class="'.$menuItem['icon'].' icon"></div>';
                
                if (!empty($menuItem['phplist'])){
                    $menu .= '<div class="'.$class.' menu-child clickable" rel="'.$key.'" reladdr="'.$menuItem['phplist'].'" reltarget="'.$menuItem['target'].'">'.$icon.$menuItem['label'].'</div>';
                }else{
                    $menu .= '<div class="'.$class.' clickable" rel="'.$key.'">'.$icon.$menuItem['label'].'</div>';
                }
                
                if (isset($menuItem['menu'])){
                    if (empty($parent)) 
                        $menu .= '<div class="submenu-panel-'.$key.' submenu-panel">';
                     
                     
                    foreach ($menuItem['menu'] as $menuItemRow)  
                         $menu .= buildMenu($menuItemRow,$menuItem); 
                     
                    if (empty($parent)) 
                        $menu .= '</div>';
                } 
                 
            }
            
            

            if (empty($parent)) 
                $menu  .= '<div class="main-menu-closer"></div>';

            return $menu;
    }

	$menu = '';	 

    $arrMenu = array(); 

    $arrUser = array ('label' => 'User', 'icon' => 'fa fa-users', 'securityObject' => $employee->securityObject,   'phplist' => 'employeeList', 'target' => 'tab'   );  
    pushMenuItem ($arrMenu, $arrUser); 
 
 /*
    // BUSINESS PARTNER
    $arrBusinessPartner = array ('label' => $class->lang['businessPartner'], 'icon' => 'fa fa-users' );  
	$menuitem = array();
    pushMenuItem($menuitem , array ('label' => $class->lang['supplier'],   'securityObject' => $supplier->securityObject,   'phplist' => 'supplierList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['customer'],   'securityObject' => $customer->securityObject,   'phplist' => 'customerList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['employee'],   'securityObject' => $employee->securityObject,   'phplist' => 'employeeList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['employeeDivision'],   'securityObject' => $employeeCategory->securityObject,   'phplist' => 'employeeCategoryList', 'target' => 'tab' ));
    $arrBusinessPartner['menu'] = array();
    pushMenuItem ($arrBusinessPartner['menu'], $menuitem);  
    pushMenuItem ($arrMenu, $arrBusinessPartner); 
 
 
    // INVENTORY
    $arrInventory = array ('label' => $class->lang['inventory'], 'icon' => 'fa fa-cubes');  

    $arrInventory['menu'] = array(); 
 
    $menuitem = array();
    pushMenuItem($menuitem , array ('label' => $class->lang['item'],   'securityObject' => $item->securityObject,   'phplist' => 'itemList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['inventoryPreorderList'],   'securityObject' => $preorderItem->securityObject,   'phplist' => 'preorderItemList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['itemCategory'],   'securityObject' => $itemCategory->securityObject,   'phplist' => 'itemCategoryList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['itemUnit'],   'securityObject' => $itemUnit->securityObject,   'phplist' => 'itemUnitList', 'target' => 'tab' ));
     pushMenuItem($menuitem , array ('label' => $class->lang['pricelist'],   'securityObject' => $pricelist->securityObject,   'phplist' => 'pricelistList', 'target' => 'tab' ));
     
        // SUB MOVEMENT
         $arrSubMenu = array ('label' => $class->lang['itemMovement']);  
         $submenuitem = array();
         $arrSubMenu['menu'] = array();
         pushMenuItem($submenuitem , array ('label' => $class->lang['itemIn'],   'securityObject' => $itemIn->securityObject,   'phplist' => 'itemInList', 'target' => 'tab' ));
         pushMenuItem($submenuitem , array ('label' => $class->lang['itemOut'],   'securityObject' => $itemOut->securityObject,   'phplist' => 'itemOutList', 'target' => 'tab' ));
         pushMenuItem($submenuitem , array ('label' => $class->lang['itemAdjustment'],   'securityObject' => $itemAdjustment->securityObject,   'phplist' => 'itemAdjustmentList', 'target' => 'tab' ));
         pushMenuItem($submenuitem , array ('label' => $class->lang['warehouseTransfer'],   'securityObject' => $warehouseTransfer->securityObject,   'phplist' => 'warehouseTransferList', 'target' => 'tab' ));
         pushMenuItem($arrSubMenu['menu'], $submenuitem); 
         
         pushMenuItem($menuitem , $arrSubMenu);  

         // OTHERS
         $arrSubMenu = array ('label' => $class->lang['others']);  
         $submenuitem = array();
         $arrSubMenu['menu'] = array();
         pushMenuItem($submenuitem , array ('label' => $class->lang['warehouse'],   'securityObject' => $warehouse->securityObject,   'phplist' => 'warehouseList', 'target' => 'tab' ));
         pushMenuItem($submenuitem , array ('label' => $class->lang['brand'],   'securityObject' => $brand->securityObject,   'phplist' => 'brandList', 'target' => 'tab' ));
         pushMenuItem($submenuitem , array ('label' => $class->lang['itemFilter'],   'securityObject' => $itemFilter->securityObject,   'phplist' => 'itemFilterList', 'target' => 'tab' ));
         pushMenuItem($submenuitem , array ('label' => $class->lang['filterCategory'],   'securityObject' => $filterCategory->securityObject,   'phplist' => 'filterCategoryList', 'target' => 'tab' ));
         pushMenuItem ($arrSubMenu['menu'], $submenuitem); 
  
         pushMenuItem($menuitem , $arrSubMenu);  

    pushMenuItem ($arrInventory['menu'], $menuitem);   
    pushMenuItem ($arrMenu, $arrInventory); 

 
    // PURCHASE
    $arrPurchase = array ('label' => $class->lang['purchase'],'icon' => 'fa fa-credit-card'  );  
    $menuitem = array();
    pushMenuItem($menuitem , array ('label' => $class->lang['purchaseOrder'],   'securityObject' => $purchaseOrder->securityObject,   'phplist' => 'purchaseOrderList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['purchaseReceive'],   'securityObject' => $purchaseReceive->securityObject,   'phplist' => 'purchaseReceiveList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['purchaseReturn'],   'securityObject' => $purchaseReturn->securityObject,   'phplist' => 'purchaseReturnList', 'target' => 'tab' ));
    $arrPurchase['menu'] = array();
    pushMenuItem ($arrPurchase['menu'], $menuitem);   
    pushMenuItem ($arrMenu, $arrPurchase); 
 
   
    // SALES
    $arrSales = array ('label' => $class->lang['sales'],'icon' => 'fa fa-shopping-cart');  
    $menuitem = array();
    pushMenuItem($menuitem , array ('label' => $class->lang['salesOrder'],   'securityObject' => $salesOrder->securityObject,   'phplist' => 'salesOrderList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['salesDelivery'],   'securityObject' => $salesDelivery->securityObject,   'phplist' => 'salesDeliveryList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['pointofsales'],   'securityObject' => $salesOrder->securityObject,   'phplist' => 'pointofsales', 'target' => '_blank' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['salesReturn'],   'securityObject' => $salesReturn->securityObject,   'phplist' => 'salesReturnList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['preorderSales'],   'securityObject' => $preorder->securityObject,   'phplist' => 'preorderList', 'target' => 'tab' ));
    $arrSales['menu'] = array();
    pushMenuItem ($arrSales['menu'], $menuitem);   
    pushMenuItem ($arrMenu, $arrSales); 
 
    // GADAI
    $arrPawn = array ('label' => $class->lang['pawn'], 'icon' => 'fa fa-certificate', 'securityObject' => $pawnshop->securityObject,   'phplist' => 'pawnshopList', 'target' => 'tab'   );  
    pushMenuItem ($arrMenu, $arrPawn); 
    
  
    // FINANCE
    $arrFinance = array ('label' => $class->lang['finance'], 'icon' => 'fa fa-money'); 
 
    $menuitem = array();
    pushMenuItem($menuitem , array ('label' => $class->lang['cashIn'],   'securityObject' => $cashIn->securityObject,   'phplist' => 'cashInList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['cashOut'],   'securityObject' => $cashOut->securityObject,   'phplist' => 'cashOutList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['cashBankTransfer'],   'securityObject' => $cashBankTransfer->securityObject,   'phplist' => 'cashBankTransferList', 'target' => 'tab' ));
       
        // AR/AP
        $arrSubMenu = array ('label' => $class->lang['ar/ap']);  
        $submenuitem = array();
        $arrSubMenu['menu'] = array(); 
        pushMenuItem($submenuitem , array ('label' => $class->lang['accountsReceivable'],   'securityObject' => $ar->securityObject,   'phplist' => 'arList', 'target' => 'tab' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['accountsReceivablePayment'],   'securityObject' => $arPayment->securityObject,   'phplist' => 'arPaymentList', 'target' => 'tab' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['accountsPayable'],   'securityObject' => $ap->securityObject,   'phplist' => 'apList', 'target' => 'tab' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['accountsPayablePayment'],   'securityObject' => $apPayment->securityObject,   'phplist' => 'apPaymentList', 'target' => 'tab' ));
        pushMenuItem($arrSubMenu['menu'], $submenuitem); 
  
        pushMenuItem($menuitem , $arrSubMenu); 

        // GL
        $arrSubMenu = array ('label' => $class->lang['GL']);  
        $submenuitem = array();
        $arrSubMenu['menu'] = array(); 
        pushMenuItem($submenuitem , array ('label' => $class->lang['chartOfAccount'],   'securityObject' => $chartOfAccount->securityObject,   'phplist' => 'chartOfAccountList', 'target' => 'tab' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['generalJournal'],   'securityObject' => $generalJournal->securityObject,   'phplist' => 'generalJournalList', 'target' => 'tab' ));
        pushMenuItem ($arrSubMenu['menu'], $submenuitem); 

        pushMenuItem($menuitem , $arrSubMenu); 

        // OTHERS
        $arrSubMenu = array ('label' => $class->lang['others']);  
        $submenuitem = array();
        $arrSubMenu['menu'] = array(); 
        pushMenuItem($submenuitem , array ('label' => $class->lang['paymentConfirmation'],   'securityObject' => $paymentConfirmation->securityObject,   'phplist' => 'paymentConfirmationList', 'target' => 'tab' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['settlementType'],   'securityObject' => $termOfPayment->securityObject,   'phplist' => 'termOfPaymentList', 'target' => 'tab' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['paymentMethod'],   'securityObject' => $paymentMethod->securityObject,   'phplist' => 'paymentMethodList', 'target' => 'tab' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['currencyList'],   'securityObject' => $currency->securityObject,   'phplist' => 'currencyList', 'target' => 'tab' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['currencyRate'],   'securityObject' => $currencyRate->securityObject,   'phplist' => 'currencyRateList', 'target' => 'tab' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['billingStatement']  ,   'securityObject' => $billingStatement->securityObject,   'phplist' => 'billingStatementList', 'target' => 'tab' ));
        pushMenuItem ($arrSubMenu['menu'], $submenuitem); 

    pushMenuItem($menuitem , $arrSubMenu); 

    $arrFinance['menu'] = array();
    pushMenuItem ($arrFinance['menu'], $menuitem);  

    pushMenuItem ($arrMenu, $arrFinance); 
 

    // MEDIA
    $arrMedia = array ('label' => $class->lang['articleNewsAndMedia'], 'icon' => 'fa fa-newspaper-o');  
    $menuitem = array();
    pushMenuItem($menuitem , array ('label' => $class->lang['article'],   'securityObject' => $article->securityObject,   'phplist' => 'articleList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['articleCategory'],   'securityObject' => $articleCategory->securityObject,   'phplist' => 'articleCategoryList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['news'],   'securityObject' => $news->securityObject,   'phplist' => 'newsList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['newsCategory'],   'securityObject' => $newsCategory->securityObject,   'phplist' => 'newsCategoryList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['gallery'],   'securityObject' => $gallery->securityObject,   'phplist' => 'galleryList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['youtube'],   'securityObject' => $youtube->securityObject,   'phplist' => 'youtubeList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['banner'],   'securityObject' => $banner->securityObject,   'phplist' => 'bannerList', 'target' => 'tab' ));
    $arrMedia['menu'] = array();
    pushMenuItem ($arrMedia['menu'], $menuitem);   
    pushMenuItem ($arrMenu, $arrMedia); 
 
  
    // EVENT
    $arrEvent = array ('label' => $class->lang['event'], 'icon' => 'fa fa-calendar', 'securityObject' => $event->securityObject,   'phplist' => 'eventList', 'target' => 'tab'   );  
    pushMenuItem ($arrMenu, $arrEvent); 
  


    // PROMO & CAMPAIGN
    $arrOthers = array ('label' => $class->lang['promoAndCampaign'], 'icon' => 'fa fa-bullhorn');  
    $menuitem = array();
    pushMenuItem($menuitem , array ('label' => $class->lang['promoItem'],   'securityObject' => $itemPromo->securityObject,   'phplist' => 'itemPromoList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['rewardPoints'],   'securityObject' => $rewardsPoint->securityObject,   'phplist' => 'rewardsPointList', 'target' => 'tab' ));
    $arrOthers['menu'] = array();
    pushMenuItem ($arrOthers['menu'], $menuitem);   
    pushMenuItem ($arrMenu, $arrOthers); 
  
    $arrOthers = array ('label' => $class->lang['portfolio'], 'icon' => 'fa fa-file-archive-o');  
    $menuitem = array();
    pushMenuItem($menuitem , array ('label' => $class->lang['portfolio'],   'securityObject' => $portfolio->securityObject,   'phplist' => 'portfolioList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['portfolioCategory'],   'securityObject' => $portfolioCategory->securityObject,   'phplist' => 'portfolioCategoryList', 'target' => 'tab' ));
    $arrOthers['menu'] = array();
    pushMenuItem ($arrOthers['menu'], $menuitem);   
    pushMenuItem ($arrMenu, $arrOthers); 
  
    // OTHERS
    $arrOthers = array ('label' => $class->lang['others'], 'icon' => 'fa fa-ellipsis-h');  
    $menuitem = array();
    pushMenuItem($menuitem , array ('label' => $class->lang['shipment'],   'securityObject' => $shipment->securityObject,   'phplist' => 'shipmentList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['webpage'],   'securityObject' => $page->securityObject,   'phplist' => 'pageList', 'target' => 'tab' ));
  //  pushMenuItem($menuitem , array ('label' => $class->lang['survey'],   'securityObject' => $survey->securityObject,   'phplist' => 'surveyList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['testimonial'],   'securityObject' => $testimonial->securityObject,   'phplist' => 'testimonialList', 'target' => 'tab' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['contactUs'],   'securityObject' => $contact->securityObject,   'phplist' => 'contactUsList', 'target' => 'tab' ));

        // SETTINGS
        $arrSubMenu = array ('label' => $class->lang['setting']);  
        $submenuitem = array();
        $arrSubMenu['menu'] = array(); 
        pushMenuItem($submenuitem , array ('label' => $class->lang['variableSetting'],   'securityObject' => $setting->securityObject,   'phplist' => 'setting', 'target' => 'tab' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['codeSetting'],   'securityObject' => $autoCode->securityObject,   'phplist' => 'autoCodeForm', 'target' => 'tab' ));
        pushMenuItem ($arrSubMenu['menu'], $submenuitem); 

    pushMenuItem($menuitem , $arrSubMenu); 

    $arrOthers['menu'] = array();
    pushMenuItem ($arrOthers['menu'], $menuitem);   
    pushMenuItem ($arrMenu, $arrOthers); 
  
  
    // REPORT
    $arrReport = array ('label' => $class->lang['report'], 'icon' => 'fa fa-file-text-o');  
    $menuitem = array();
    pushMenuItem($menuitem , array ('label' => $class->lang['salesReport'],   'securityObject' => 'reportSalesOrder',   'phplist' => 'reportSalesOrder', 'target' => '_blank' ));
    pushMenuItem($menuitem , array ('label' => $class->lang['purchaseReport'],   'securityObject' => 'reportPurchaseOrder',   'phplist' => 'reportPurchaseOrder', 'target' => '_blank' ));
     
        // INVENTORY
        $arrSubMenu = array ('label' => $class->lang['inventory']);  
        $submenuitem = array();
        $arrSubMenu['menu'] = array(); 
        pushMenuItem($submenuitem , array ('label' => $class->lang['itemReport'],   'securityObject' => 'reportItem',   'phplist' => 'reportItem', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['itemFilterReport'],   'securityObject' => 'reportItemFilter',   'phplist' => 'reportItemFilter', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['itemInReport'],   'securityObject' => 'reportItemIn',   'phplist' => 'reportItemIn', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['itemOutReport'],   'securityObject' => 'reportItemOut',   'phplist' => 'reportItemOut', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['warehouseTransferReport'],   'securityObject' => 'reportWarehouseTransfer',   'phplist' => 'reportWarehouseTransfer', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['stockCardReport'],   'securityObject' => 'reportStockCard',   'phplist' => 'reportStockCard', 'target' => '_blank' ));
        pushMenuItem ($arrSubMenu['menu'], $submenuitem); 

    pushMenuItem($menuitem , $arrSubMenu); 

        // FINANCE REPORT
        $arrSubMenu = array ('label' => $class->lang['finance']);  
        $submenuitem = array();
        $arrSubMenu['menu'] = array(); 
        pushMenuItem($submenuitem , array ('label' => $class->lang['cashMovementReport'],   'securityObject' => 'reportCashFlow',   'phplist' => 'reportCashFlow', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['ARReport'],   'securityObject' => 'reportAR',   'phplist' => 'reportAR', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['ARPaymentReport'],   'securityObject' => 'reportARPayment',   'phplist' => 'reportARPayment', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['APReport'],   'securityObject' => 'reportAP',   'phplist' => 'reportAP', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['APPaymentReport'],   'securityObject' => 'reportAPPayment',   'phplist' => 'reportAPPayment', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['generalJournalReport'],   'securityObject' => 'reportGeneralJournal',   'phplist' => 'reportGeneralJournal', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['balanceSheetReport'],   'securityObject' => 'reportBalanceSheet',   'phplist' => 'reportBalanceSheet', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['workingSheetReport'],   'securityObject' => 'reportWorkingSheet',   'phplist' => 'reportWorkingSheet', 'target' => '_blank' ));
        pushMenuItem($submenuitem , array ('label' => $class->lang['incomeStatementReport'],   'securityObject' => 'reportIncomeStatement',   'phplist' => 'reportIncomeStatement', 'target' => '_blank' ));
        pushMenuItem ($arrSubMenu['menu'], $submenuitem); 

    pushMenuItem($menuitem , $arrSubMenu); 

     // OTHERS REPORT
        $arrSubMenu = array ('label' => $class->lang['others']);  
        $submenuitem = array();
        $arrSubMenu['menu'] = array(); 
        pushMenuItem($submenuitem , array ('label' => $class->lang['pointReport'],   'securityObject' => 'reportRewardsPoint',   'phplist' => 'reportRewardsPoint', 'target' => '_blank' ));
        pushMenuItem ($arrSubMenu['menu'], $submenuitem); 

    pushMenuItem($menuitem , $arrSubMenu); 

    $arrReport['menu'] = array();
    pushMenuItem ($arrReport['menu'], $menuitem);   
    pushMenuItem ($arrMenu, $arrReport); 
  */
    $menu = buildMenu($arrMenu);  
 
    echo $menu; 
?>
