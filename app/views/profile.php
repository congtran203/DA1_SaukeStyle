<div class="main">
    <div class="container">
        <div class="row">
            <div class="col-8 info-box">
                <h1>Thông tin tài khoản</h1>
                <p>Xin chào, <span class="highlight"><?= htmlspecialchars($userInfo['full_name'] ?? 'Chưa có tên'); ?></span></p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Đơn hàng</th>
                            <th>Ngày</th>
                            <th>Giá trị đơn hàng</th>
                            <th>Trạng thái thanh toán</th>
                            <th>Trạng thái giao hàng</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>011168</td>
                            <td>11/2/2024</td>
                            <td>900,000đ</td>
                            <td>Đã thanh toán</td>
                            <td>Giao hàng thành công</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-4 details-box">
                <h2>Tài khoản của tôi</h2>
                <div class="account-info">
                    <div class="account-item">
                        <strong>Tên tài khoản:</strong>
                        <span><?= htmlspecialchars($userInfo['full_name'] ?? 'Chưa có tên'); ?></span>
                    </div>
                    <div class="account-item">
                        <strong>Điện thoại:</strong>
                        <span><?= htmlspecialchars($userInfo['phone'] ?? 'Chưa có số điện thoại'); ?></span> 
                    </div>
                    <div class="account-item">
                        <strong>Địa chỉ:</strong>
                        <span><?= htmlspecialchars($userInfo['address'] ?? 'Chưa có địa chỉ'); ?></span>
                    </div>
                    <div class="account-item">
                        <strong>Email:</strong>
                        <span><?= htmlspecialchars($userInfo['email'] ?? 'Chưa có email'); ?></span>
                    </div>
                </div>
                <button class="btn">Cập nhật thông tin</button>
            </div>
        </div>
    </div>
</div>
