<?php
$pro_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
?>
<div class="container">
    <h3>Biến thể của sản phẩm (ID: <?= $pro_id ?>)</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Kích thước</th>
                <th>Giá</th>
                <th>Chất liệu</th>
                <th>Giá giảm</th>
            </tr>
        </thead>
        <?php
        $pro_id = isset($_GET['id']) ? intval($_GET['id']) : 0;
        echo "Product ID: " . $pro_id;  // Kiểm tra xem pro_id có hợp lệ không
        ?>

    </table>

    <h4>Thêm biến thể mới</h4>
    <form method="post" action="index.php?page=addvariant">
        <input type="hidden" name="pro_id" value="<?= $pro_id ?>">
        <div class="form-group">
            <label>Kích thước</label>
            <input type="text" name="variant_size" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Giá</label>
            <input type="number" step="0.01" name="variant_price" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Chất liệu</label>
            <input type="text" name="variant_material" class="form-control">
        </div>
        <div class="form-group">
            <label>Giá giảm</label>
            <input type="number" step="0.01" name="variant_discounted_price" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Thêm biến thể</button>
    </form>
</div>