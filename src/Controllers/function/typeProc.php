<?php

//get all products
function getAllType($db)
{
$sql = 'Select t.TId, t.TypeName, t.Type.Desc from type t ';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get product by id

/*function getType($db, $Id)
{
$sql = 'Select t.TypeName, t.TID, t.TypeDesc from  type t ';
$sql .= 'Where t.TId = :Id';
$stmt = $db->prepare ($sql);
$Id = (int) $Id;
$stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
} */


//add new product
function createProduct($db, $form_data) {
    $sql = 'Insert into product (ProductName, TypeId, ProductPack, ProductLife) ';
    $sql .= 'values (:ProductName, :TypeId, :ProductPack, :ProductLife) ';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':ProductName', $form_data['ProductName']);
    $stmt->bindParam(':ProductPack', $form_data['ProductPack']);
    $stmt->bindParam(':ProductLife', ($form_data['ProductLife']));
    $stmt->bindParam(':TypeId', ($form_data['TypeId']));
    $stmt->execute();
    return $db->lastInsertID();//insert last number.. continue
    }

    //delete product by id
function deleteProduct($db,$Id) {
    $sql = ' Delete from products where Id = :Id ';
    $stmt = $db->prepare($sql);
    $Id = (int)$productId;
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
    $stmt->execute();
    }
    
    //update product by id
    function updateProduct($db,$form_dat,$productId,$date) {
     $sql = 'UPDATE products SET ProductName = :ProductName, TypeId = :TypeId, ProductPack = :ProductPack, ProductLife = :ProductLife ';
     $sql .=' WHERE ProductId = :ProductId';
     $stmt = $db->prepare ($sql);
     $id = (int)$productId;
     $mod = $date;
     $stmt->bindParam(':ProductId', $id, PDO::PARAM_INT);
     $stmt->bindParam(':ProductName', $form_data['ProductName']);
    $stmt->bindParam(':ProductPack', $form_data['ProductPack']);
    $stmt->bindParam(':ProductLife', ($form_data['ProductLife']));
    $stmt->bindParam(':TypeId', ($form_data['TypeId']));
     $stmt->execute();
    
    }