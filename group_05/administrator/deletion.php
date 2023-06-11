<?php
    include_once('../api.php');
    //根據各類id來刪除對應的資料
    $all_id;
    if(isset($_GET['oid'])){
        $oid = trim($_GET['oid']);
        $all_id = $oid;
        deleteOrderByOID($oid);
    }else if(isset($_GET['id'])){
        $id = trim($_GET['id']);
        $all_id = $id;
        deleteUserByID($id);
    }else if(isset($_GET['uid'])){
        $uid = trim($_GET['uid']);
        $all_id = $uid;
        deleteMerchandiseByUID($uid);
    }else if(isset($_GET['aid'])){
        $aid = trim($_GET['aid']);
        $all_id = $aid;
        deleteAnnByAID($aid);
    }
    
    echo $all_id;
?>