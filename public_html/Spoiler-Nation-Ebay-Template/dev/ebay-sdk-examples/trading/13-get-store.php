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
require __DIR__.'/../../../../vendor/autoload.php';
echo __DIR__.'/../../../../vendor/autoload.php';

/**
 * Include the configuration values.
 *
 * Ensure that you have edited the configuration.php file
 * to include your application keys.
 *
 * For more information about getting your application keys, see:
 * http://devbay.net/sdk/guides/application-keys/
 */
$config = require __DIR__.'/../configuration.php';

echo __DIR__.'/../configuration.php';
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
$response = $service->getStore($request);

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

/*    printf("Name: %s\nDescription: %s\nURL: %s\n\n",
        $store->Name,
        $store->Description,
        $store->URL
    );
    echo '<pre>';
    print_r($store);
    echo '</pre>';*/
    
    echo '<div id="cssmenu">';
    
    $i = 0;
    foreach ($store->CustomCategories->CustomCategory as $category) {
        
        if ( $i >0 ) {
            echo '<ul>';
            printCategory($category, 0);
            echo '</ul>';
        }
        ++$i;
    }
    
    
    echo '</div>';
    
    
}

/**
 * Helper function to print some information about the passed category.
 */
function printCategory($category, $level)
{
        
/*    printf("%s%s : (%s)\n",
        str_pad('', $level * 4),
        $category->Name,
        $category->CategoryID); */
         
         
         
         
        if ( count($category->ChildCategory) > 0 ) {
        echo '<li class="has-sub';
        echo ' level';
        print_r($level);
        echo ' "  ><a >';
        
        
              /*href="http://stores.ebay.com/directcartrim/' .
              $category->Name . '/_i.html?_fsub=' .
              $category->CategoryID . '" target="_self" >';*/
        
        echo $category->Name;
        echo '</a>';
        
        echo '<ul>';
        foreach ($category->ChildCategory as $category) {
        
            printCategory($category, $level + 1);
        }
        echo '</ul></li>';
    
        
       
        
        
        } else {
            //else we dont have subs
              echo '<li   ><a >';
              
               
              /*href="http://stores.ebay.com/directcartrim/' .
              $category->Name . '/_i.html?_fsub=' .
              $category->CategoryID . '" target="_self" >'; */
        
        echo $category->Name;
        echo '</a></li>';
        }
        
        
        
        

    
}
