<?php
    //====================================
    // Real-time Shipment Tracking php example
    // You can find the API-Key and Secret from--https://app.kd100.com/api-management
    //====================================

    // Parameters setting
    $key = '';                                // Your account API-Key
    $secret = '';                             // Your account Secret
    $param = array (
        'account_id' => '',                   // Monthly statement or payment account
        'account_name' => '',                 // The username of your monthly statement
        'account_secret' => '',               // User password
        'account_key' => '',                  // Account parameter
        'code' => '',                         // Account parameter
        'carrier_id' => 'dhl',                // Carrier code, must user lowercase letters
        'ship_to' => array (
            'name' => 'Cindy Martinez',                             // 
            'mobile_phone' => '(86)13512345678',                    // 
            'address1' => 'Apoquindo 4001, of. 501. Las Condes',    // Receiving address  
            'address2' => 'Santiago, Chile',                        // Prefecture | Country: as a supplement to receiving address  
            'state_province' => '',                                 // State | Province: as a supplement to receiving address 
            'company' => 'Lamaignere Chile S.A.',                   // Company name
            'country_code' => 'CL',                                 // Country ISO code. For example, CN stands for China and US stands for United States of America.
            'city' => 'Santiago',                                   // 
            'postal_code' => '7550000',                             // 
            'landline_phone' => '+56 (9) 76164365',                 // Phone number
            'email' => '12344699@qq.com',                           // Email address
            'tax_id' => '',                                         // 
            'tax_type' => '',                                       // Taxpayer type
            'vat_number' => 'IOSS23249923',                         // VAT number; used in European countries, UK included.
            'eori_number' => 'IOSS23249923',                        // EORI number: used for customs clearance in the European Union
            'ioss_number' => 'IOSS23249923'                         // IOSS number
        ),
        'ship_from' => array (
            'name' => 'Kaka',                                       // 
            'mobile_phone' => '13500000000',                        // 
            'address1' => 'Kingdee Software Park',                  // Receiving address  
            'address2' => 'Hi-tech Park,Nanshang District',         // Prefecture | Country: as a supplement to receiving address  
            'state_province' => '',                                 // State | Province: as a supplement to receiving address 
            'company' => 'QIAN HAI BAI DI',                         // Company name
            'country_code' => 'CN',                                 // Country ISO code. For example, CN stands for China and US stands for United States of America.
            'city' => 'SHEN ZHEN',                                  // 
            'postal_code' => '518057',                              // 
            'landline_phone' => '0755-5890123',                     // Phone number
            'email' => '12344655@qq.com',                           // Email address
            'tax_id' => '',                                         // 
            'tax_type' => '',                                       // Taxpayer type
            'vat_number' => 'IOSS23249923',                         // VAT number; used in European countries, UK included.
            'eori_number' => 'IOSS23249923',                        // EORI number: used for customs clearance in the European Union
            'ioss_number' => 'IOSS23249923'                         // IOSS number
        ),
        'contents_explanation' => "test don't ship",                // Description of the goods
        'shipping_service' => 'parcel-normal',                      // Product type
        'notes' => 'just a test demo',                              // 
        'total_customs_value' => 10.00,                             // Declared value
        'unit_of_measurement' => 'SI',                              // Trade Terms: CFR, DAP, etc.
        'incoterm' => 'DAP',                                        // The tracking number you want to query
        'currency' => 'USD',                                        // Currency. CNY is the default.
        'packages' => array (                                       // Package info
            array (
                'height' => 11.00,                                  // Height. Unit: centimeter
                'width' => 20.00,                                   // Width. Unit: centimeter
                'length' => 10.00,                                  // Length. Unit: centimeter
                'weight' => 0.10,                                   // Weight. Unit: kilogram
                'reference' => 'just a user remark'                 // Some notes about the package
            )
        ),
        'customs_items' => array (                                  // Export info
            array (
                'net_weight' => 0.10,                               // Net weight. Unit: kilogram
                'gross_weight' => 0.10,                             // Gross weight. Unit: kilogram
                'country_code' => 'CN',                             // Manufacturing country
                'unit_price' => 10.00,                              // 
                'quantity' => 1,                                    // Quantity. 1 is the default.
                'units' => 'PCS',                                   // Counting unit (required). PCS if the default.
                'contents_explanation' => 'test',                   // Description of the goods
                'import_commodity_code' => '6109100021',            // Export commodity code. It is recommended to fill in this for faster customs clearance.
                'export_commodity_code' => '6109100021'             // Import commodity code. It is recommended to fill in this for faster customs clearance.
            )
        ),
        'customs_duties_payment' => array (                          // Customs duty payment. The recipient is going to pay customs duty by default.
            'paid_by' => 'DDU',                                      // Payment method.DDU: the receiver is responsible for paying the duties. DDP: the sender is responsible for paying the duties
            'account_id' => ''                                       // Account
        ),
        'shipping_cost_payment' => array (                           // Shipping cost payment method
            'paid_by' => 'SHIPPER',                                  // Paid by: Shipper or Consignee. Shipper is going to make payment by default.
            'account_id' => '601470543'                              // Account
        ),
        'customs_clearance' => array (                               // Customs Clearance information
            'purpose' => '',                                         // Export purpose
            'is_document' => false                                   // Is document? The default answer is ¡®True¡¯.
        ),
        'invoice' => array (
            'date' => '2021-08-12',                                  // Date of invoice (yyyy-mm-dd)
            'number' => '15462412',                                  // Invoice number
            'type' => '',                                            // Invoice number. The default is commercial invoice.
            'title' => 'test',                                       // Invoice title
            'signature' => 'base64 string or plain',                 // Invoice signature (base64 string)
            'paperless_invoice' => true                              // Start paperless trading? Choose ¡®True¡¯ or ¡®False¡¯.
        ),
        'route_id' => '9926933413',                                  // Route ID (Reauired for J&T International)
        'total_actual_weight' => 0.1                                 // Weight
    );
    
    // Request Json
    $json = json_encode($param, JSON_UNESCAPED_UNICODE);
    $signature = strtoupper(md5($json.$key.$secret));
    
    $url = 'https://app.kd100.com/sendAssistant/order/apiCall';    // Create-a-shipping-label request address
    
echo 'request headers key: '.$key;
echo '<br/>request headers signature: '.$signature;
echo '<br/>request json: '.$json;
    
    $headers = array (
        'Content-Type:application/json',
        'API-Key:'.$key,
        'signature:'.$signature,
        'Content-Length:'.strlen($json)
    );

    // Send post request
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $data = json_decode($result, true);

echo '<br/><br/>Return data:<br/><pre>';
echo print_r($data);
//echo var_dump($data);
echo '</pre>';
?>
