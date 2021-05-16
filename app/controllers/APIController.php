<?php

use Phalcon\Http\Response;
use Phalcon\Http\Request;

class APIController extends \Phalcon\Mvc\Controller
{

    /**
     * Simple GET API Request
     * 
     * @method GET
     * @link /api/get
     */
    public function getAction()
    {
        // Disable View File Content
        $this->view->disable();

        // Getting a response instance
        // https://docs.phalcon.io/3.4/en/response.html
        $response = new Response();

        $response->setHeader("Access-Control-Allow-Origin", "*");

        // Getting a request instance
        // https://docs.phalcon.io/3.4/en/request
        $request = new Request();

        // Check whether the request was made with method GET ( $this->request->isGet() )
        if ($request->isGet()) {

            // Check whether the request was made with Ajax ( $request->isAjax() )

            // Use Model for database Query
            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "OK",
            ];

            $patient = Patient::find();

            // Set status code
            $response->setStatusCode(200, 'OK');

            // Set the content of the response
            $response->setJsonContent(["status" => $returnData, "results" => $patient]);

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Simple GET API Request
     * 
     * @method GET
     * @link /api/get
     */
     public function getByIdAction($id)
     {
         // Disable View File Content
         $this->view->disable();
 
         // Getting a response instance
         // https://docs.phalcon.io/3.4/en/response.html
         $response = new Response();
 
         $response->setHeader("Access-Control-Allow-Origin", "*");
 
         // Getting a request instance
         // https://docs.phalcon.io/3.4/en/request
         $request = new Request();
 
         // Check whether the request was made with method GET ( $this->request->isGet() )
         if ($request->isGet()) {
 
             // Check whether the request was made with Ajax ( $request->isAjax() )
 
             // Use Model for database Query
             $returnData = [
                 "code" => "200",
                 "response" => "success",
                 "message" => "OK",
             ];
 
             $patient = Patient::find($id);
 
             // Set status code
             $response->setStatusCode(200, 'OK');
 
             // Set the content of the response
             $response->setJsonContent(["status" => $returnData, "results" => $patient]);
 
         } else {
 
             // Set status code
             $response->setStatusCode(405, 'Method Not Allowed');
 
             // Set the content of the response
             // $response->setContent("Sorry, the page doesn't exist");
             $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
         }
 
         // Send response to the client
         $response->send();
     }

    /**
     * Simple POST API Request without Param Data
     * 
     * @method POST
     * @link /api/post
     */
    public function postAction()
    {
        // Disable View File Content
        $this->view->disable();

        // Getting a response instance
        // https://docs.phalcon.io/3.4/en/response.html
        $response = new Response();

        $response->setHeader("Access-Control-Allow-Origin", "*");

        // Getting a request instance
        // https://docs.phalcon.io/3.4/en/request
        $request = new Request();

        // Check whether the request was made with method POST ( $this->request->isPost() )
        if ($request->isPost()) {

            // Check whether the request was made with Ajax ( $request->isAjax() )

            // Use Model for database Query
            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "Add Patient Success",
            ];

            $data = $request->getPost();

            $patient = new Patient();
            $patient->name      = $data["name"];
            $patient->sex       = $data["sex"];
            $patient->religion  = $data["religion"];
            $patient->phone     = $data["phone"];
            $patient->address   = $data["address"];
            $patient->nik       = $data["nik"];

            $savedSuccessfully = $patient->save();

            // Set status code
            $response->setStatusCode(200, 'OK');

            // Set the content of the response
            $response->setJsonContent(["status" => $returnData, "results" => $patient ]);

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Simple PUT API Request with Param Data
     * 
     * @method PUT
     * @link /api/put/{paramData}
     */
    public function putAction($id) 
    {
        // Disable View File Content
        $this->view->disable();

        // Getting a response instance
        // https://docs.phalcon.io/3.4/en/response.html
        $response = new Response();

        $response->setHeader("Access-Control-Allow-Origin", '*');
        $response->setHeader("Access-Control-Allow-Methods", 'GET, PUT, POST, DELETE, OPTIONS');
        $response->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization');
        $response->setHeader("Access-Control-Allow-Credentials", true);

        // Getting a request instance
        // https://docs.phalcon.io/3.4/en/request
        $request = new Request();

        // Check whether the request was made with method PUT ( $this->request->isPut() )
        if ($id) {

            // Check whether the request was made with Ajax ( $request->isAjax() )

            // Use Model for database Query
            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "Update Patient Successfully",
            ];

            $patient = Patient::findFirst('id', $id);

            $patients = $request->getJsonRawBody("id");
            
            $patient->id = $id;
            $patient->name = $patients["name"];
            $patient->religion = $patients["religion"];
            $patient->phone = $patients["phone"];
            $patient->address = $patients["address"];
            $patient->sex = $patients["sex"];
            $patient->nik = $patients["nik"];

            $savedSuccessfully = $patient->update();

            // Set status code
            $response->setStatusCode(200, 'OK');
 
            // Set the content of the response
            $response->setJsonContent(["status" => $returnData, "results" => []]);

        } else {

            // Set status code
            $response->setStatusCode(405, 'Method Not Allowed');

            // Set the content of the response
            // $response->setContent("Sorry, the page doesn't exist");
            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        // Send response to the client
        $response->send();
    }

    /**
     * Simple DELETE API Request with Param Data
     * 
     * @method DELETE
     * @link /api/delete/{paramData}
     */
    public function deleteAction($id)
    {
         // Disable View File Content
         $this->view->disable();
 
         // Getting a response instance
         // https://docs.phalcon.io/3.4/en/response.html
         $response = new Response();

         $response->setHeader("Access-Control-Allow-Origin", '*');
         $response->setHeader("Access-Control-Allow-Methods", 'GET, PUT, POST, DELETE, OPTIONS');
        //  $response->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization');
        //  $response->setHeader("Access-Control-Allow-Credentials", true);

         // Getting a request instance
         // https://docs.phalcon.io/3.4/en/request
         $request = new Request();
 
         // Check whether the request was made with method DELETE ( $this->request->isDelete() )
         if ($id) {
 
             // Check whether the request was made with Ajax ( $request->isAjax() )
 
             // Use Model for database Query
             $returnData = [
                 "code" => "200",
                 "response" => "success",
                 "message" => "Delete Patient Successfully",
             ];
 
             $patient = Patient::find($id);
             $patient->delete();
 
             // Set status code
             $response->setStatusCode(200, 'OK');
 
             // Set the content of the response
             $response->setJsonContent(["status" => $returnData, "results" => []]);
 
         } else {
 
             // Set status code
             $response->setStatusCode(405, 'Method Not Allowed');
 
             // Set the content of the response
             // $response->setContent("Sorry, the page doesn't exist");
             $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
         }
 
         // Send response to the client
         $response->send();
    }
}