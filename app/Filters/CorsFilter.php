<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class CorsFilter implements FilterInterface{
    
     /**
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    public function before(RequestInterface $request, $arguments = null){

        /** @var ResponseInterface $response */
        $response = service('response');

        $origin = $request->getHeaderLine('Origin');

        $allowedOrigins = [
            // ip front end
            'http://192.168.1.2:5173',
            'http://localhost:5173'
            // Outros IPS
        ];

        if(in_array($origin, $allowedOrigins)){

            $response->setHeader('Access-Control-Allow-Origin', $origin);

        }

        if($request->is('OPTIONS')){

            $response->setStatusCode(204);
            
            // set headers to allow 
            $response->setHeader(
                'Access-Control-Allow-Headers',
                'X-API-KEY, X-Requested-With, Content-Type, Accept, Authorization'
            );

            // set methods to allow 
            $response->setHeader(
                'Access-Control-Allow-Methods',
                'GET, POST, OPTIONS, PUT, PATCH, DELETE'
            );

            // set how many seconds the results of a preflight request can be cached.
            $response->setHeader('Access-Control-Allow-Max-Age', '3600');

            return $response;

        }

    }


     /**
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
