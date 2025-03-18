<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Thêm người dùng</h4>
                        <p class="category"></p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <form action="" method="post" enctype="multipart/form-data">
                            <label for="">Tên người dùng</label>
                            <input type="text" name="full_name" id="full_name" class="form-control">
                            <label for="">Địa chỉ</label>
                            <input type="text" name="address" id="address" class="form-control">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                            <label for="">Tên đăng nhập</label>
                            <input type="text" name="account" id="account" class="form-control" required>
                            <label for="">Mật khẩu</label>
                            <input type="password" name="password" id="pass" class="form-control" required>
                            <label for="phone">Số điện thoại</label>
                            <input name="phone" id="phone" class="form-control" required>
                            <label for="role">Role</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="admin">admin</option>
                                <option value="user">user</option>
                            </select>
                            <input type="submit" value="Thêm người dùng" onclick="" name="adduser">
                        </form>

                    </div>

                </div>
            </div>