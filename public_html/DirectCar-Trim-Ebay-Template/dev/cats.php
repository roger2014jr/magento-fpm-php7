<?php
/**
 * Copyright 2014 David T. Sadler
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

/**
 * Include the SDK by using the autoloader from Composer.
 */


require __DIR__.'/../../vendor/autoload.php';



/**
 * Include the configuration values.
 *
 * Ensure that you have edited the configuration.php file
 * to include your application keys.
 *
 * For more information about getting your application keys, see:
 * http://devbay.net/sdk/guides/application-keys/
 */
$config = require __DIR__.'/ebay-sdk-examples/configuration.php';

/**
 * The namespaces provided by the SDK.
 */
use \DTS\eBaySDK\Constants;
use \DTS\eBaySDK\Trading\Services;
use \DTS\eBaySDK\Trading\Types;
use \DTS\eBaySDK\Trading\Enums;

/**
 * Create the service object.
 *
 * For more information about creating a service object, see:
 * http://devbay.net/sdk/guides/getting-started/#service-object
 */
$service = new Services\TradingService(array(
    'apiVersion' => $config['tradingApiVersion'],
    'siteId' => Constants\SiteIds::US
));

/**
 * Create the request object.
 *
 * For more information about creating a request object, see:
 * http://devbay.net/sdk/guides/getting-started/#request-object
 */
$request = new Types\GetStoreRequestType();
$request2 = new Types\GetCategoriesRequestType();

/**
 * An user token is required when using the Trading service.
 *
 * NOTE: eBay will use the token to determine which store to return.
 *
 * For more information about getting your user tokens, see:
 * http://devbay.net/sdk/guides/application-keys/
 */
$request->RequesterCredentials = new Types\CustomSecurityHeaderType();
$request->RequesterCredentials->eBayAuthToken = $config['production']['userToken'];

$request->DetailLevel = array('ReturnAll');

/**
 * Send the request to the GetStore service operation.
 *
 * For more information about calling a service operation, see:
 * http://devbay.net/sdk/guides/getting-started/#service-operation
 */


$request->OutputSelector = array(
    'CategoryArray.Category.CategoryID',
    'CategoryArray.Category.CategoryParentID',
    'CategoryArray.Category.CategoryLevel',
    'CategoryArray.Category.CategoryName'
);

$response  = $service->getStore($request);

//$response = $service->getCategories($request);


 
/**
 * Output the result of calling the service operation.
 *
 * For more information about working with the service response object, see:
 * http://devbay.net/sdk/guides/getting-started/#response-object
 */
if (isset($response->Errors)) {
    foreach ($response->Errors as $error) {
        printf("%s: %s\n%s\n\n",
            $error->SeverityCode === Enums\SeverityCodeType::C_ERROR ? 'Error' : 'Warning',
            $error->ShortMessage,
            $error->LongMessage
        );
    }
}

    
    
if ($response->Ack !== 'Failure') {
    $store = $response->Store;
    $output = '';
    $output = '<div id="cssmenu">';
    
    $i = 0;
    
    
     
    

    
    
    $categories = $store->CustomCategories->CustomCategory;
    $mCats2 = (array)($categories);
    
    
    

    
    
    
    $x = 0;
    foreach( $mCats2 as $mCat ) {
		
		if (is_array($mCat)) {
            foreach( $mCat as $cat ) {
           
          $mNCat[$x] = array( $cat->CategoryID, $cat->Name, $cat->Order) ;

            if ( count($cat->ChildCategory) > 0 ) { //echo 'has childs' ;  
                
                $i = 0;
                foreach ($cat->ChildCategory as $c ) {
                    
                    $tA = array ($c->CategoryID , $c->Name, $c->Order);
                    $mNCat[$x]['kids'][] = $tA; 
                    $X = $x + 1;  
                     
                    $y = 0;
                    if ( count($c->ChildCategory) > 0 ) { //echo 'childs have childs' ;  
                        foreach ($c->ChildCategory as $d ) {

                            $tB = array ($d->CategoryID , $d->Name, $d->Order);

                            $mNCat[$x]['kids'][$i]['kids'][] = $tB; 
                            $y = $y + 1;   
                        }
                    }

              $i = $i +1;
              }
              
         }
                
       $x = $x + 1;  } 
	    }
    }




                    
                 
                    
    $sort = array();
    foreach ($mNCat as $key => $row)
    {
        $sort[$key] = $row[2];
    }
    array_multisort($sort, SORT_ASC, $mNCat);

 

    
    
    
 


   $categories  = $mNCat;

   
   $output .= '<ul id="mCats1">';  
     
    $i = 0;
    foreach ($categories as $category) {
		
		
		$sort = array();
		if(isset($category['kids'])){
			foreach ($category['kids'] as $key => $row)
			{
				$sort[$key] = $row[1];
			}
			array_multisort($sort, SORT_ASC, $category['kids']);
		}
		
		
        if ( $i > 0 ) {
            printCategory2($category, 1);
        }
        $i++;
    }
    
    $output .= '</ul>';
    
    
    

    $output .= '</div>';
    
    
}




function printCategory2($category, $level) {
        
		$has_kids = false;
		
		
		if (isset($category['kids']) ) {
			$has_kids = true;
	    } else { 
			$has_kids = false; 
	    }
		
		
		if ($has_kids) {
			if ( count($category['kids']) > 0 ) {
		
				$GLOBALS['output'] .= '<li class="has-sub';
				$GLOBALS['output'] .= ' level';
				$GLOBALS['output'] .= strval($level);
				$GLOBALS['output'] .= ' "  ><a href="http://stores.ebay.com/directcartrim/' .
					  $category[1] . '/_i.html?_fsub=' .
					  $category[0] . '" target="_self" >'; 
				
				$GLOBALS['output'] .= $category[1];
				$GLOBALS['output'] .= '</a>';
				
				$GLOBALS['output'] .= '<ul class="ul1" >';
				
				$i = 0;
				
				foreach ($category['kids'] as $category) {
				
				
					$sort = array();
					if(isset($category['kids'])) {
						foreach ($category['kids'] as $key => $row) {
							$sort[$key] = $row[1];
						}
					
						if( is_array($category['kids']) ) {
							array_multisort($sort, SORT_ASC, $category['kids']);
						}
					}
					printCategory2($category, $level + 1);
					$i++;
					
				}
				$GLOBALS['output'] .= '</ul></li>';
		
			
			} 
		
		} else {
            //else we dont have subs
            $GLOBALS['output'] .= '<li   ><a href="http://stores.ebay.com/directcartrim/' .
            $category[1] . '/_i.html?_fsub=' .
            $category[0] . '" target="_self" >';  
        
            $GLOBALS['output'] .= $category[1];
            $GLOBALS['output'] .= '</a></li>';
        }
        
        
        
 
}






?>document.write('<?=$output?>');