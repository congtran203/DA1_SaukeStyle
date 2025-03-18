<?php
ob_start();
require_once('views/header.php');
require_once('../admin/models/database.php');
require_once('../admin/models/CategoryModel.php');
require_once('../admin/models/ProductModel.php');
require_once('../admin/models/UserModel.php');
require_once('../admin/controller/AdCategoryController.php');
require_once('../admin/controller/AdProductController.php');
require_once('../admin/controller/AdHomeController.php');
require_once('../admin/controller/AdUserController.php');

$data = new Database();
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    switch ($page) {
        case 'variants':
            $variants = new AdProductController();
            break;
        case 'category':
            $viewcate = new AdCategoryController();
            $viewcate->viewCate();
            break;
        case 'addcate':
            $viewadd = new AdCategoryController();
            $viewadd->viewAddCate();
            $addcate = new AdCategoryController();
            $addcate->addCate();
            break;
        case 'delcate':
            $delcate = new AdCategoryController();
            $delcate->delCate();
            break;
        case 'editcate':
            $viewedit = new AdCategoryController();
            $viewedit->viewEditCate();
            $editcate = new AdCategoryController();
            $editcate->editCate();
            break;
        case 'addpro':
            $addPro = new AdProductController();
            $addPro->addPro();
            break;
        case 'editpro':
            $editpro = new AdProductController();
            $editpro->editPro();
            break;
        case 'variants':
            $controller = new AdProductController();
            $controller->variants();
            break;
        case 'addvariant':
            $controller = new AdProductController();
            $controller->addVariant();
            break;
        case 'delpro':
            $controller = new AdProductController();
            $controller->delPro();
            break;
        case 'user':
            $viewuser = new AdUserController();
            $viewuser->viewUser();
            break;
        case 'adduser':
            $adduser = new AdUserController();
            $adduser->addUser();
            break;
        case 'deluser':
            $deluser = new AdUserController();
            $deluser->delUser();
            break;
        case 'edituser':
            $viewedit = new AdUserController();
            $viewedit->viewEditUser();
            $edituser = new AdUserController();
            $edituser->editUser();
            break;
        default:
            $home = new AdHomeController();
            $home->home();
            break;
    }
} else {
    $home = new AdHomeController();
    $home->home();
}
require_once('views/footer.php');
ob_end_flush();
