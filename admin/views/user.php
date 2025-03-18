<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Danh sách người dùng</h4>
                        <div>
                            <a href="index.php?page=adduser"><button type="button" class="btn btn-primary">
                                    Thêm người dùng
                                </button></a>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <form action="" method="post" enctype="multipart/form-data">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <th>ID</th>
                                    <th>Tên người dùng</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Tên đăng nhập</th>
                                    <th>Mật khẩu</th>
                                    <th>Role</th>
                                    <th>Chức năng</th>
                                </thead>
                                <tbody>
                                    <?php
                                    $listuser = $data['danhSach'] ?? [];
                                    if (empty($listuser)) {
                                        echo '<p>Không có dữ liệu người dùng.</p>';
                                    } else {
                                        foreach ($listuser as $item) {
                                            echo '<tr>
                                                    <td>' . ($item['user_id'] ?? $item['id'] ?? 'N/A') . '</td>
                                                    <td>' . ($item['full_name'] ?? 'Không có tên') . '</td>
                                                    <td>' . ($item['address'] ?? 'Không có địa chỉ') . '</td>
                                                    <td>' . ($item['email'] ?? 'Không có email') . '</td>
                                                    <td>' . ($item['account'] ?? 'Không có tài khoản') . '</td>
                                                    <td>' . ($item['password'] ?? 'Không có mật khẩu') . '</td>
                                                    <td>' . ($item['role'] ?? 'Không có role') . '</td>
                                                    <td><a href="index.php?page=edituser&id=' . ($item['user_id'] ?? $item['id']) . '">Sửa</a> | <a href="index.php?page=deluser&id=' . ($item['user_id'] ?? $item['id']) . '">Xóa</a></td>
                                                </tr>';
                                        }
                                    }

                                    ?>
                                </tbody>
                            </table>
                        </form>
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