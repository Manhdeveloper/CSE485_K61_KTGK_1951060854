<?php

require_once 'model/DocGiaModel.php';
class DocGiaController{
    function index(){
        $bdModal = new DocGiaModal();
        $bdonor = $bdModal->getAllBD();
        require_once 'view/DocGia/index.php';
    }
    function admin(){
        $bdModal = new DocGiaModal();
        $bdonor = $bdModal->getAllBD();
        require_once 'view/DocGia/admin.php';
    }
    function add(){
        $error = '';
        if(isset($_POST['submit'])){
            $madg = $_POST['madg'];
            $hovaten = $_POST['hovaten'];
            // $gioitinh = $_POST['gioitinh'];
            $namsinh = $_POST['namsinh'];
            $nghenghiep = $_POST['nghenghiep'];
            $ngaycapthe = $_POST['ngaycapthe'];
            $ngayhethan = $_POST['ngayhethan'];
            $diachi = $_POST['diachi'];


            if(empty($madg) || empty($hovaten)|| empty($_POST['gioitinh']) || empty($namsinh) || empty($nghenghiep) || empty($ngaycapthe) || empty($diachi)|| empty($diachi)){
                $error = 'Thông tin chưa đầy đủ!';
            }else{
                $gioitinh = $_POST['gioitinh'];
                $bdModal = new DocGiaModal();
                $bdArr = [
                    'madg' => $madg,
                    'hovaten' => $hovaten,
                    'gioitinh' => $gioitinh,
                    'namsinh' => $namsinh,
                    'nghenghiep' => $nghenghiep,
                    'ngaycapthe' => $ngaycapthe,
                    'ngayhethan' =>  $ngayhethan,
                    'diachi' => $diachi,
                ];
            
                $isAdd = $bdModal->insert($bdArr);
                if ($isAdd) {
                    $TT=  "Thêm mới thành công";
                }
                else {
                    $TT= "Thêm mới thất bại";
                }
                header("Location: index.php?controller=docgia&action=admin&tt=$TT");
                exit();
            }

        }
        require_once 'view/DocGia/add.php';
    }
    function edit(){
        if (!isset($_GET['madg'])) {
            $_SESSION['error'] = "Tham số không hợp lệ";
            header("Location: index.php?controller=book&action=admin");
            return;
        }
      
        $madg = $_GET['madg'];
        $bdModal = new DocGiaModal();
        $BD = $bdModal->getBDById($madg);
        $error = '';
        if (isset($_POST['submit'])) {
            $madg = $_POST['madg'];
            $hovaten = $_POST['hovaten'];
            // $gioitinh = $_POST['gioitinh'];
            $namsinh = $_POST['namsinh'];
            $nghenghiep = $_POST['nghenghiep'];
            $ngaycapthe = $_POST['ngaycapthe'];
            $ngayhethan = $_POST['ngayhethan'];
            $diachi = $_POST['diachi'];
            if(empty($madg) || empty($hovaten)|| empty($_POST['gioitinh']) || empty($namsinh) || empty($nghenghiep) || empty($ngaycapthe) || empty($ngayhethan)|| empty($diachi)){
                $error = 'Thông tin chưa đầy đủ!';
            }
            else {
                
                $bdArr = [
                    'madg' => $madg,
                    'hovaten' => $hovaten,
                    'gioitinh' => $gioitinh,
                    'namsinh' => $namsinh,
                    'nghenghiep' => $nghenghiep,
                    'ngaycapthe' => $ngaycapthe,
                    'ngayhethan' =>  $ngayhethan,
                    'diachi' => $diachi
                ];
                $isAdd = $bdModal->update($bdArr);

                if ($isAdd) {
                    $TT= "Sửa thành công";
                }
                else {
                    $TT = "Sửa thất bại";
                }
                header("Location: index.php?controller=DocGia&action=admin&tt=$TT");
                exit();
            }
        }
        require_once 'view/DocGia/edit.php';
    }
    function delete(){
        $madg = $_GET['madg'];
        $bdModal = new DocGiaModal();
        $isDelete = $bdModal->delete($madg);
        if ($isDelete) {
            
            $TT=  "Xóa bản ghi thành công";
        }
        else {
            
            $TT = "Xóa bản ghi thất bại";
        }
        header("Location: index.php?controller=DocGia&action=admin&tt=$TT");
        exit();
    }
}

?>