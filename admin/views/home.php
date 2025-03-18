<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh mục các sản phẩm</h4>
                        <div>
                            <a href="index.php?page=addCon"><button type="button" class="btn btn-primary">
                                    Thêm sản phẩm
                                </button></a>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Giá</th>
                                <th>Hình ảnh</th>
                                <th>Chức năng</th>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data['products'] as $item) {
                                    extract($item);
                                    echo '
                                     <tr>
                                    <td>' . $id . '</td>
                                    <td>' . $title . '</td>
                                    <td>' . $price . '</td>
                                    <td><img src="../public/upload/images/' . $image . '" alt="" height="80px" width="100px"></td>
                                    <td><a href="index.php?page=edit&id=' . $id . '">Sửa</a> | <a href="index.php?page=delete&id=' . $id . '">Xóa</a></td>
                                </tr>
                                    
                                    
                                    ';
                                }


                                ?>

                            </tbody>
                        </table>

                    </div>
                    <ul class="pagination-list">
                        <li class="pagination-item">
                            <a href="" class="pagination-link">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">1</a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">2</a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">3</a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">...</a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">10</a>
                        </li>
                        <li class="pagination-item">
                            <a href="" class="pagination-link">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <footer class="footer">
                <div class="container-fluid">

                    <p class="copyright pull-right">
                        &copy; <script>
                            document.write(new Date().getFullYear())
                        </script> <a href="http://www.creative-tim.com"></a>
                    </p>
                </div>
            </footer>


        </div>
    </div>


    </body>

    <!--   Core JS Files   -->
    <script src="javascripts/jquery.3.2.1.min.js" type="text/javascript"></script>
    <script src="javascripts/bootstrap.min.js" type="text/javascript"></script>

    <!--  Charts Plugin -->
    <script src="javascripts/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="javascripts/bootstrap-notify.js"></script>

    <!--  Google Maps Plugin    -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

    <!-- Light Bootstrap Table Core javascript and methods for Demo purpose -->
    <script src="javascripts/light-bootstrap-dashboard.js?v=1.4.0"></script>

    <!-- Light Bootstrap Table DEMO methods, don't include it in your project! -->
    <script src="javascripts/demo.js"></script>


    </html>