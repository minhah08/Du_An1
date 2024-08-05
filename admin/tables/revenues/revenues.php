<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Doanh thu cửa hàng</h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="">
                        <form action="" method="post">
                            <div class="row mt-3 px-5">
                                <div class="col-md-4 mb-3">
                                    <label for="startDate" class="form-label">Từ ngày:</label>
                                    <input type="date" class="form-control" value="" name="startDate">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="endDate" class="form-label">Đến ngày:</label>
                                    <input type="date" class="form-control" value="" name="endDate">
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="category" class="form-label">Danh mục:</label>
                                    <select class="form-select" name="id_category">
                                        <option value="0">Tất cả</option>
                                        <?php foreach ($getCategories as $category) : extract($category); ?>
                                            <option value="<?= $id ?>"><?= $name_category ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <button name="filter" type="submit" class="btn ms-5 px-5" style="background-color: #17c1e8;">Lọc</button>
                            <a href="?action=revenues"><button class="btn btn-secondary ms-2 px-4">Mặc định</button></a>
                        </form>
                    </div>

                    <table class="table align-items-center justify-content-between mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sản phẩm</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7">Doanh thu</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($getRevenues as $revenueProduct) :
                                extract($revenueProduct);
                            ?>
                                <tr>
                                    <td class="text-center p-2" style="width: 25px;">
                                        <span><?= $product_id ?></span>
                                    </td>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="<?= $pathImg . $image ?>" class="me-3" width="70px">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm text-truncate" style="width: 400px;"><?= $product_name ?></h6>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="text-center p-2">
                                        <p class="text-sm font-weight-bold mb-0"><?= $total_revenue ?></p>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 