<?php
$getCountAccounts = getCountAccounts();
$getLoyalCustomers = getLoyalCustomers();
$getCountCategories = count(load_all_category());
$getCountProduct = count(getAllProducts());
$getCountOrders = count(getAllOrders());

$year = date('Y');
$oldYear = $year - 1;
$getRevenuesByNewMonth = getRevenuesByMonth($year);
$getRevenuesByOldMonth = getRevenuesByMonth($oldYear);

$name_months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$revenues_months = [];
$revenues_old_months = [];
for ($i = 0; $i < 12; $i++) {
    $revenues_months[$i] = 0;
    $revenues_old_months[$i] = 0;
}

foreach ($getRevenuesByNewMonth as $revenue) {
    extract($revenue);
    $order_month = $order_month;
    $total_revenue = $total_revenue;
    for ($i = 0; $i < 12; $i++) {
        if ($order_month == $i + 1) {
            $revenues_months[$i] = $total_revenue;
        }
    }
}
foreach ($getRevenuesByOldMonth as $revenue) {
    extract($revenue);
    $order_month = $order_month;
    $total_revenue = $total_revenue;
    for ($i = 0; $i < 12; $i++) {
        if ($order_month == $i + 1) {
            $revenues_old_months[$i] = $total_revenue;
        }
    }
}

echo "<script> var revenues_months = " . json_encode($revenues_months) . ";</script>";
echo "<script> var revenues_old_months = " . json_encode($revenues_old_months) . ";</script>";


?>
<div class="container-fluid py-4 pb-0">
    <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Khách hàng</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?= $getCountAccounts['count']; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa-solid fa-users" style="color: #ffffff;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Danh mục</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?= $getCountCategories; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa-solid fa-tag" style="color: #ffffff;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Sản phẩm</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?= $getCountProduct; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa-brands fa-buffer" style="color: #ffffff;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Đơn hàng</p>
                                <h5 class="font-weight-bolder mb-0">
                                    <?= $getCountOrders; ?>
                                </h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="fa-solid fa-basket-shopping" style="color: #ffffff;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-5 mb-lg-0 mb-4">
            <div class="card z-index-2">
                <div class="card-body p-3">
                    <div class="bg-gradient-dark border-radius-lg py-3 pe-1 mb-3">
                        <div class="chart">
                            <canvas id="chart-bars" class="chart-canvas" height="280"></canvas>
                        </div>
                    </div>
                    <h6 class="text-center text-uppercase ms-2 mt-4 mb-0"> Tổng doanh thu theo tháng (Đơn vị: VND) </h6>
                    <div class="container border-radius-lg">
                        <div class="row">
                            <div class="col-12 py-3 ps-0">
                                <div class="progress w-100">
                                    <div class="progress-bar bg-dark w-100" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card z-index-2">
                <div class="card-header pb-0 text-center text-uppercase mt-3">
                    <h6>So sánh doanh thu năm trước (Đơn vị: VND)</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="324"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Khách hàng thân thiết</h6>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tài khoản</th>
                                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Đã chi tiêu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($getLoyalCustomers as $loyalCustomer) :
                                    extract($loyalCustomer);
                                ?>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-2 py-1">
                                                <div>
                                                    <img src="../assets/img/accounts/<?= $avatar ?>" class="avatar avatar-sm me-3" alt="xd">
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="mb-0 text-sm"><?= $username ?></h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center text-sm">
                                            <span class="text-xs font-weight-bold"><?= number_format($total_amount) . " VND" ?></span>
                                        </td>  
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card h-100">
                <div class="card-header pb-0">
                    <h6>Trạng thái đơn hàng</h6>
                </div>
                <div class="card-body p-3">
                    <div class="timeline timeline-one-side">
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fa-solid fa-check" style="color: #00ff00;"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0"><?= getStatusOrder(4)['status_name'] ?></h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= getStatusOrder(4)['order_count'];
                                                                                                ?> Sản phẩm</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fa-solid fa-truck" style="color: #00e1ff;"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0"><?= getStatusOrder(3)['status_name'] ?></h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= getStatusOrder(3)['order_count'];
                                                                                                ?> Sản phẩm</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fa-solid fa-box" style="color: #ff8800;"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0"><?= getStatusOrder(2)['status_name'] ?></h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= getStatusOrder(2)['order_count'];
                                                                                                ?> Sản phẩm</p>
                            </div>
                        </div>
                        <div class="timeline-block mb-3">
                            <span class="timeline-step">
                                <i class="fa-solid fa-circle-check" style="color: #00ff00;"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0"><?= getStatusOrder(1)['status_name'] ?></h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= getStatusOrder(1)['order_count'];
                                                                                                ?> Sản phẩm</p>
                            </div>
                        </div>
                        <div class="timeline-block">
                            <span class="timeline-step">
                                <i class="fas fa-clock"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0"><?= getStatusOrder(0)['status_name'] ?></h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= getStatusOrder(0)['order_count'];
                                                                                                ?> Sản phẩm</p>
                            </div>
                        </div>
                        <div class="timeline-block">
                            <span class="timeline-step">
                                <i class="fa-solid fa-ban" style="color: #ff0000;"></i>
                            </span>
                            <div class="timeline-content">
                                <h6 class="text-dark text-sm font-weight-bold mb-0"><?= getStatusOrder(5)['status_name'] ?></h6>
                                <p class="text-secondary font-weight-bold text-xs mt-1 mb-0"><?= getStatusOrder(5)['order_count'];
                                                                                                ?> Sản phẩm</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/js/plugins/chartjs.min.js"></script>

    <script> 
        var ctx = document.getElementById("chart-bars").getContext("2d");

        new Chart(ctx, {
            type: "bar",
            data: {
                labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                datasets: [{
                    label: "Sales",
                    tension: 0.4,
                    borderWidth: 0,
                    borderRadius: 4,
                    borderSkipped: false,
                    backgroundColor: "#fff",
                    data: revenues_months,
                    maxBarThickness: 6
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                        },
                        ticks: {
                            suggestedMin: 0,
                            suggestedMax: 500,
                            beginAtZero: true,
                            padding: 15,
                            font: {
                                size: 14,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                            color: "#fff"
                        },
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false
                        },
                        ticks: {
                            display: false
                        },
                    },
                },
            },
        });


        var ctx2 = document.getElementById("chart-line").getContext("2d");

        var gradientStroke1 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
        gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

        var gradientStroke2 = ctx2.createLinearGradient(0, 230, 0, 50);

        gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
        gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
        gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

        new Chart(ctx2, {
            type: "line",
            data: {
                labels: ["Tháng 1", "Tháng 2", "Tháng 3", "Tháng 4", "Tháng 5", "Tháng 6", "Tháng 7", "Tháng 8", "Tháng 9", "Tháng 10", "Tháng 11", "Tháng 12"],
                datasets: [{
                        label: "Năm nay",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#cb0c9f",
                        borderWidth: 3,
                        backgroundColor: gradientStroke1,
                        fill: true,
                        data: revenues_months,
                        maxBarThickness: 6

                    },
                    {
                        label: "Năm ngoái",
                        tension: 0.4,
                        borderWidth: 0,
                        pointRadius: 0,
                        borderColor: "#3A416F",
                        borderWidth: 3,
                        backgroundColor: gradientStroke2,
                        fill: true,
                        data: revenues_old_months,
                        maxBarThickness: 6
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    }
                },
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#b2b9bf',
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: false,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            color: '#b2b9bf',
                            padding: 20,
                            font: {
                                size: 11,
                                family: "Open Sans",
                                style: 'normal',
                                lineHeight: 2
                            },
                        }
                    },
                },
            },
        }); 
    </script>