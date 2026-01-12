<?php
    namespace lib_communication_context\Core
    {
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/ServiceData.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_domain_context/ICaller.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/PHP/lib_utilities/Utilities/JsonHelper.php';

        use lib_domain_context\ServiceData as ServiceData;
        use lib_domain_context\ICaller as ICaller;
        use lib_utilities\Utilities\JsonHelper as JsonHelper;

        class CallerServices implements ICaller
        {
            private static ?string $token = null;
            private static ?\DateTime $expires = null;
    
            public function Execute(array $data): array
            {
                $response = array();
                try
                {
                    $response = $this->Authenticate($data);
                    if ($response == null || 
                        array_key_exists("Error", $response))
                        return $response;
                    $response = array();
    
                    $url = $data["Url"];
                    unset($data["Url"]);
                    unset($data["UrlToken"]);
                    $data["Bearer"] = CallerServices::$token;
                    $stringData = JsonHelper::ConvertToString($data);
    
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => $stringData,
                        //CURLOPT_HTTPHEADER => array(
                        //    'Authorization: Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IkVDY09VNTNyLkRGRzc4NWRmZ2R2ZGY4OTQ1ODQ2ZmRnZiIsIm5iZiI6MTY3NTgwNTk1OCwiZXhwIjoxNjc1ODA5NTU4LCJpYXQiOjE2NzU4MDU5NTh9.vqHKbIY2tgpcuQEyZgfg6cPemnQeyXb5cE0ByxONB1c',
                        //    'Content-Type: application/json'
                        //),
                    ));
                    $resp = curl_exec($curl);
                    curl_close($curl);
                    $response = JsonHelper::ConvertToObject($resp, 1);
                    return $response;
                }
                catch (Exception $ex)
                {
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
            }
    
            public function Authenticate(array $data): array
            {
                $response = array();
                try
                {
                    if (CallerServices::$expires != null &&
                        CallerServices::$expires->getTimestamp() - strtotime(date('Y-m-d h:i:s')) > 3600)
                    {
                        $response["Response"] = "Ok";
                        return $response;
                    }
    
                    $url = $data["UrlToken"];
                    $temp = array();
                    $temp["User"] = ServiceData::$KeyToken;
                    $stringData = JsonHelper::ConvertToString($temp);
    
                    $curl = curl_init();
                    curl_setopt_array($curl, array(
                        CURLOPT_URL => $url,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS => $stringData,
                        CURLOPT_HTTPHEADER => array( 'Content-Type: text/json' ),
                    ));
                    $resp = curl_exec($curl);
                    curl_close($curl);
                    $response = JsonHelper::ConvertToObject($resp, 1);
                    CallerServices::$token = $response["Token"];
                    CallerServices::$expires = new \Datetime(date('m/d/Y h:i:s', strtotime($response["Expires"])));
                    return $response;
                }
                catch (Exception $ex)
                {
                    $response["Error"] = $ex->getMessage();
                    return $response;
                }
            }
        }
    }
?>