<form action="index.php?page=editpro" method="post" enctype="multipart/form-data">
    <input type="hidden" name="pro_id" value="<?= htmlspecialchars($product['pro_id']) ?>">
    <input type="hidden" name="current_image" value="<?= htmlspecialchars($product['pro_image']) ?>">

    <div class="form-group">
        <label for="pro_name">Tên sản phẩm</label>
        <input type="text" name="pro_name" id="pro_name" class="form-control"
            value="<?= htmlspecialchars($product['pro_name']) ?>" required>
    </div>

    <div class="form-group">
        <label for="pro_price">Giá sản phẩm</label>
        <input type="number" name="pro_price" id="pro_price" class="form-control"
            value="<?= htmlspecialchars($product['pro_price']) ?>" required step="1" min="1">
    </div>

    <div class="form-group">
        <label for="cate_id">Danh mục sản phẩm</label>
        <select name="cate_id" id="cate_id" class="form-control">
            <?php foreach ($categories as $category): ?>
                <option value="<?= htmlspecialchars($category['cate_id']) ?>"
                    <?= $category['cate_id'] == $product['cate_id'] ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['cate_name']) ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="pro_description">Mô tả sản phẩm</label>
        <textarea name="pro_description" id="pro_description" class="form-control" required><?= htmlspecialchars($product['pro_description']) ?></textarea>
    </div>

    <div class="form-group">
        <label for="pro_image">Hình ảnh mới (Chọn nếu muốn thay đổi)</label>
        <input type="file" name="pro_image" id="pro_image" class="form-control">
        <p>
            Hình ảnh hiện tại:
            <a href="../public/layout/image/products/<?= htmlspecialchars($product['pro_image']) ?>" target="_blank">
                <?= htmlspecialchars($product['pro_image']) ?>
            </a>
            <br>
            <img src="../public/layout/image/products/<?= htmlspecialchars($product['pro_image']) ?>"
                alt="Product Image" style="max-width: 150px; margin-top: 10px;">
        </p>
    </div>

    <input type="submit" value="Cập nhật sản phẩm" class="btn btn-primary">
</form>