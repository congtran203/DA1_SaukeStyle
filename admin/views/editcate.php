<form action="" method="post" enctype="multipart/form-data">
    <input type="hidden" name="cate_id" value="<?= $cate['cate_id'] ?>">
    <input type="hidden" name="image_old" value="<?= $cate['cate_image'] ?>">

    <label for="">Tên danh mục</label>
    <input type="text" name="cate_name" id="cate_name" class="form-control"
        value="<?= htmlspecialchars($cate['cate_name']) ?>" required>

    <label for="">Ảnh danh mục (nếu muốn thay đổi)</label>
    <input type="file" name="cate_image" id="cate_image" class="form-control">

    <?php if (!empty($cate['cate_image'])): ?>
        <p>Ảnh hiện tại:</p>
        <img src="../../public/layout/image/categories/<?= htmlspecialchars($cate['cate_image']) ?>"
            alt="Category Image" width="100">
    <?php endif; ?>

    <input type="submit" value="Cập nhật danh mục" name="editcate" class="btn btn-success mt-3">
</form>