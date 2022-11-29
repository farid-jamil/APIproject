<?php
use Slim\Http\Request; //namespace
use Slim\Http\Response; //namespace

//include productsProc.php file
include __DIR__ . '/function/typeProc.php';

$app->options('/{routes:+)', function ($request, $response, $args) {

    return $response;
    
    });
    
    $app->add(function ($req, $res, $next) {
    
    $response = $next($req, $res);
    
    return $response
    
    ->withHeader('Access-Control-Allow-Origin', '*')
    
    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-with, Content-Type, Accept, Origin, Authorization')
    
    ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    
    });



//read table products
$app->get('/type', function (Request $request, Response $response, array
$arg){
 return $this->response->withJson(array('data' => 'success'), 200);
});

// read all data from table products
$app->get('/alltype',function (Request $request, Response $response, array $arg)
{
 $data = getAllType($this->db);
if (is_null($data)) {
 return $this->response->withHeader('Access-Control-Allow-Origin', '*')->withJson(array('error' => 'no data'), 404);
}
return $this->response->withJson(array('data' => $data), 200);
});

//request table products by condition (product id)
$app->get('/type/[{Id}]', function ($request, $response, $args){

    $TypeId = $args['Id'];
    if (!is_numeric($TId)) {
    
        return $this->response->withJson(array('error' => 'numeric paremeter required'), 500);
    }
    $data = getType($this->db,$TId);
    if (empty($data)) {
    return $this->response->withJson(array('error' => 'no data'), 500);
   }
    return $this->response->withJson(array('data' => $data), 200);
});

//create type 

$app->post('/type/add', function ($request, $response, $args) {
    $form_data = $request->getParsedBody();
    $data = createType($this->db, $form_data);
    if ($data <= 0) {
    return $this->response->withJson(array('error' => 'add data fail'), 500);
    }
    return $this->response->withJson(array('add data' => 'success'), 200);
    }
   );

   //delete row
$app->delete('/type/del/[{Id}]', function ($request, $response, $args){

    $TypeId = $args['Id'];
   if (!is_numeric($Id)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
   }
   $data = deleteType($this->db,$TypeId);
   if (empty($data)) {
   return $this->response->withJson(array($TypeId=> 'is successfully deleted'), 202);};
   });

   //put table products
   $app->put('/type/put/[{id}]', function ($request, $response, $args){
    $TypeId = $args['id'];
    $date = date("Y-m-j h:i:s");
   
   if (!is_numeric($productId)) {
    return $this->response->withJson(array('error' => 'numeric paremeter required'), 422);
   }
    $form_dat=$request->getParsedBody();
   
   $data=updateType($this->db,$form_dat,$TypeId,$date);
   if ($data <=0)
   return $this->response->withJson(array('data' => 'successfully updated'), 200);
});