<?php

use Phalcon\Http\Response;
use Phalcon\Http\Request;

class APIController extends \Phalcon\Mvc\Controller
{
    public function getAction()
    {
        $this->view->disable();

        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", "*");
        
        $request = new Request();

        if ($request->isGet()) {

            $returnData = [
                "code" => "200",
                "response" => "success",
                "message" => "OK",
            ];

            $patient = Patient::find();

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData, "results" => $patient]);

        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }

     public function getByIdAction($id)
     {

         $this->view->disable();

         $response = new Response();
         $response->setHeader("Access-Control-Allow-Origin", "*");

         $request = new Request();
 
         if ($request->isGet()) {

             $returnData = [
                 "code" => "200",
                 "response" => "success",
                 "message" => "OK",
             ];
 
             $patient = Patient::find($id);
 
             $response->setStatusCode(200, 'OK');
 
             $response->setJsonContent(["status" => $returnData, "results" => $patient]);
 
         } else {
 
             $response->setStatusCode(405, 'Method Not Allowed');

             $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
         }
 
         $response->send();
     }

    public function postAction()
    {
        $this->view->disable();
        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", "*");

        $request = new Request();

        if ($request->isPost()) {

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

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData, "results" => $patient ]);

        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }

    public function putAction($id) 
    {
        $this->view->disable();

        $response = new Response();
        $response->setHeader("Access-Control-Allow-Origin", '*');
        $response->setHeader("Access-Control-Allow-Methods", 'GET, PUT, POST, DELETE, OPTIONS');
        $response->setHeader("Access-Control-Allow-Headers", 'Origin, X-Requested-With, Content-Range, Content-Disposition, Content-Type, Authorization');
        $response->setHeader("Access-Control-Allow-Credentials", true);

        $request = new Request();

        if ($id) {

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

            $response->setStatusCode(200, 'OK');

            $response->setJsonContent(["status" => $returnData, "results" => []]);

        } else {

            $response->setStatusCode(405, 'Method Not Allowed');

            $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
        }

        $response->send();
    }

    public function deleteAction($id)
    {

         $this->view->disable();

         $response = new Response();
         $response->setHeader("Access-Control-Allow-Origin", '*');
         $response->setHeader("Access-Control-Allow-Methods", 'GET, PUT, POST, DELETE, OPTIONS');

         $request = new Request();
 
         if ($id) {
 
             $returnData = [
                 "code" => "200",
                 "response" => "success",
                 "message" => "Delete Patient Successfully",
             ];
 
             $patient = Patient::find($id);
             $patient->delete();

             $response->setStatusCode(200, 'OK');
 
             $response->setJsonContent(["status" => $returnData, "results" => []]);
 
         } else {

             $response->setStatusCode(405, 'Method Not Allowed');

             $response->setJsonContent(["status" => false, "error" => "Method Not Allowed"]);
         }
 
         $response->send();
    }
}