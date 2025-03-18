<?php
$user = $data['user'];
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Cập nhật người dùng</h4>
                        <p class="category">Chỉnh sửa thông tin người dùng</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="full_name">Tên người dùng</label>
                            <input type="text" name="full_name" id="full_name" class="form-control" value="<?= htmlspecialchars($user['full_name']) ?>" required>

                            <label for="address">Địa chỉ</label>
                            <input type="text" name="address" id="address" class="form-control" value="<?= htmlspecialchars($user['address']) ?>">

                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>

                            <label for="account">Tên đăng nhập</label>
                            <input type="text" name="account" id="account" class="form-control" value="<?= htmlspecialchars($user['account']) ?>" required>

                            <label for="password">Mật khẩu</label>
                            <input type="password" name="password" id="password" class="form-control">
                            <small>(Để trống nếu không muốn đổi mật khẩu)</small>

                            <label for="phone">Số điện thoại</label>
                            <input type="text" name="phone" id="phone" class="form-control" value="<?= htmlspecialchars($user['phone']) ?>">

                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control">
                                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                            </select>

                            <input type="hidden" name="user_id" value="<?= htmlspecialchars($user['user_id']) ?>">
                            <input type="submit" value="Cập nhật người dùng" name="edituser" class="btn btn-primary mt-3">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>