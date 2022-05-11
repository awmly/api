<?php

/*
 * REST API Class
 * Handles GET, PUT, POST, DELETE
 **/

class API
{

    /*
    * GET
    * 
    * @param string $url        Destination URL for the request
    * @param array  $data       Data to be included within the request
    * @param array  $options    Options for the request
    */
    public function get($url, $data, $options)
    {
        if (!$options['contentType'])
        {
            $options['contentType'] = 'text';
        }

        return $this->request('GET', $url, $data, $options);
    }


    /*
    * POST
    * 
    * @param string $url        Destination URL for the request
    * @param array  $data       Data to be included within the request
    * @param array  $options    Options for the request
    */
    public function post($url, $data, $options)
    {
        if (!$options['contentType'])
        {
            $options['contentType'] = 'form';
        }

        return $this->request('POST', $url, $data, $options);
    }


    /*
    * PUT
    * 
    * @param string $url        Destination URL for the request
    * @param array  $data       Data to be included within the request
    * @param array  $options    Options for the request
    */
    public function put($url, $data, $options)
    {
        if (!$options['contentType'])
        {
            $options['contentType'] = 'form';
        }

        return $this->request('PUT', $url, $data, $options);
    }


    /*
    * DELETE
    * 
    * @param string $url        Destination URL for the request
    * @param array  $data       Data to be included within the request
    * @param array  $options    Options for the request
    */
    public function delete($url, $data, $options)
    {
        if (!$options['contentType'])
        {
            $options['contentType'] = 'form';
        }

        return $this->request('DELETE', $url, $data, $options);
    }

    /*
    * PRIVATE: REQUEST
    * 
    * @param string $method     HTTP method
    * @param string $url        Destination URL for the request
    * @param array  $data       Data to be included within the request
    * @param array  $options    Options for the request
    */
    private function request($method, $url, $data, $options)
    {

        // Sent content type to send data
        if ($options['contentType'] == 'json')
        {
             $contentType = 'application/json';
             $encodedData = json_encode($data);
        }
        else if ($options['contentType'] == 'form')
        {
             $contentType = 'application/x-www-form-urlencoded';
             $encodedData = http_build_query($data);
        }
        else if ($options['contentType'] == 'form-data')
        {
             $contentType = 'multipart/form-data';
             $encodedData = $data;
        }
        else if ($options['contentType'] == 'text')
        {
             $contentType = 'text/plain';
             $encodedData = false;
             if (count($data))
             {
                 $url .= '?' . http_build_query($data);
             }
        }
        else
        {
            $contentType = $options['contentType'];
            $encodedData = http_build_query($data);
        }

        if (!isset($options['responseType']))
        {
            $options['responseType'] = 'text';
        }

        // Construct CURL request
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL             => $url,
            CURLOPT_CONNECTTIMEOUT  => 5,
            CURLOPT_TIMEOUT         => 5,
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_CUSTOMREQUEST   => $method
        ]);

        // Set headers
        $headers = [];
        
        if ($contentType)
        {
            $headers[] = "Content-Type: ". $contentType . "; charset=utf-8";
        }

        if (isset($options['authBearer']))
        {
            $headers[] = "Authorization: Bearer " . $options['authBearer'];
        }

        if (count($headers))
        {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }

        if ($encodedData)
        {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        }

        if (isset($options['authHeader']))
        {
            curl_setopt($ch, CURLOPT_USERPWD, $options['authHeader']);  
        }

        // Execute request
        $return = curl_exec($ch);

        // Handle returned data
        if ($options['responseType'] == 'json')
        {
            $json = json_decode($return);
            if (is_object($json))
            {
                $return = $json;
            }
        }
        
        // Debugging
        if (isset($options['debug']) || isset($options['debugFile']))
        {
            if (isset($options['debugFile']))
            {
                ob_start();
            }

            print_r(date(DATE_RFC2822) . "\n");
            print_r($method . " > " . $url . "\n");
            print_r($data);
            print_r($options);
            print_r($return);

            if (isset($options['debugFile']))
            {
                file_put_contents($options['debugFile'], ob_get_clean());
            }
        }

        // Return
        return $return;

    }


}