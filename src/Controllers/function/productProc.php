<?php

//get all products
function getAllProducts($db)
{
$sql = 'Select p.Id, p.ProductName, p.ProductPack, p.ProductLife, t.TypeName as TypeId from  product p ';
$sql .='Inner Join Type t on p.TypeId = t.TId';
$stmt = $db->prepare ($sql);
$stmt ->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

//get product by id
function getProduct($db, $Id)
{
$sql = 'Select p.ProductName, p.ProductPack, p.ProductLife, t.TypeName from  product p ';
$sql .= 'Inner Join Type t on p.TypeId = t.TId ';
$sql .= 'Where p.Id = :Id';
$stmt = $db->prepare ($sql);
$Id = (int) $Id;
$stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

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
function deleteProduct($db, $Id) {
    $sql = ' Delete from product where Id = :Id ';
    $stmt = $db->prepare($sql);
    $Id = (int)$Id;
    $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
    $stmt->execute();
    }
    
    //update product by id
    function updateProduct($db,$form_dat,$Id,$date) {
     $sql = 'UPDATE product SET ProductName = :ProductName, TypeId = :TypeId, ProductPack = :ProductPack, ProductLife = :ProductLife ';
     $sql .=' WHERE Id = :Id ';
     $stmt = $db->prepare ($sql);
     $Id = (int)$Id;
     $mod = $date;
     $stmt->bindParam(':Id', $id, PDO::PARAM_INT);
     $stmt->bindParam(':ProductName', $form_data['ProductName']);
    $stmt->bindParam(':ProductPack', $form_data['ProductPack']);
    $stmt->bindParam(':ProductLife', ($form_data['ProductLife']));
    $stmt->bindParam(':TypeId', ($form_data['TypeId']));
     $stmt->execute();
    
    }
    
