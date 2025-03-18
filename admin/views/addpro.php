<form action="index.php?page=addpro" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="cate_id">Danh mục sản phẩm</label>
        <select name="cate_id" id="cate_id" class="form-control" required>
            <?php
            if (isset($categories) && !empty($categories)) {
                foreach ($categories as $item) {
                    echo '<option value="' . htmlspecialchars($item['cate_id']) . '">' . htmlspecialchars($item['cate_name']) . '</option>';
                }
            } else {
                echo '<option value="">Không có danh mục nào</option>';
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="pro_name">Tên sản phẩm</label>
        <input type="text" name="pro_name" id="pro_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="pro_price">Giá sản phẩm</label>
        <input type="number" name="pro_price" id="pro_price" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="pro_description">Mô tả sản phẩm</label>
        <textarea name="pro_description" id="pro_description" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label for="pro_image">Hình ảnh</label>
        <input type="file" name="pro_image" id="pro_image" class="form-control">
    </div>

    <input type="submit" name="addpro" value="Thêm sản phẩm" class="btn btn-primary mt-3">
</form>