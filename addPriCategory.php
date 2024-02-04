<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Argon Dashboard 2 by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <!-- argon dashboard plugin -->
  <!-- <link rel="stylesheet" href="../assets/vendor/select2/dist/css/select2.min.css"> -->
  <style>
    .set-width {
      width: 200px;
    }


  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  <div class="position-absolute w-100 min-height-300 top-0">
    <span class="mask bg-primary"></span>
  </div>

  <div class="main-content position-relative max-height-vh-100 h-100">
    <!-- Navbar -->


    <div class="container-fluid py-5">
      <div class="row">
        <div class="col-md-8 mx-auto d-flex justify-content-center">
          <div class="card w-60">
            <div class="card-header pb-0">
              <a class="btn btn-primary " href="primary_category.php" role="button"><i class="fa-solid fa-angles-left fa-fw"></i>回主類別列表</a>
              <div class="d-flex align-items-center pt-2">
                <h4 class="mb-0">新增主類別資料</h4>
              </div>
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-5">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label fs-6">主類別名稱：</label>
                    <input class="form-control" id="pri_name" type="text" value="">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col">
                <label for="example-text-input" class="form-control-label fs-6">次類別</label>
                  <ul class="list-group check">
                    <!-- <li class="list-group-item">
                      <input class="form-check-input me-1" type="checkbox" value="" aria-label="...">
                      First checkbox
                    </li> -->
                  </ul>
                </div>
                <div class="d-flex justify-content-end">
                  <button class="btn btn-primary mx-0 my-0  d-flex justify-content-center fs-6 w-25 " id="add">新增</button>
                </div>


              </div>
            </div>
          </div>

        </div>


      </div>
    </div>
    <div class="fixed-plugin">
      <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
      </a>
      <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3 ">
          <div class="float-start">
            <h5 class="mt-3 mb-0">Argon Configurator</h5>
            <p>See our dashboard options.</p>
          </div>
          <div class="float-end mt-4">
            <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
              <i class="fa fa-close"></i>
            </button>
          </div>
          <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0 overflow-auto">
          <!-- Sidebar Backgrounds -->
          <div>
            <h6 class="mb-0">Sidebar Colors</h6>
          </div>
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors my-2 text-start">
              <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
              <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
              <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
              <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
              <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
              <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
            </div>
          </a>
          <!-- Sidenav Type -->
          <div class="mt-3">
            <h6 class="mb-0">Sidenav Type</h6>
            <p class="text-sm">Choose between 2 different sidenav types.</p>
          </div>
          <div class="d-flex">
            <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
            <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default" onclick="sidebarType(this)">Dark</button>
          </div>
          <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
          <!-- Navbar Fixed -->
          <hr class="horizontal dark my-sm-4">
          <div class="mt-2 mb-5 d-flex">
            <h6 class="mb-0">Light / Dark</h6>
            <div class="form-check form-switch ps-0 ms-auto my-auto">
              <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version" onclick="darkMode(this)">
            </div>
          </div>
          <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free Download</a>
          <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View documentation</a>
          <div class="w-100 text-center">
            <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
            <h6 class="mt-3">Thank you for sharing!</h6>
            <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
              <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
            </a>
            <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
              <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
            </a>
          </div>
        </div>
      </div>
    </div>
    <!--   Core JS Files   -->
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script>
      var win = navigator.platform.indexOf('Win') > -1;
      if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
          damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
      }
    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>
    <!-- <script src="../assets/vendor/select2/dist/js/select2.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
      $(document).ready(function() {

        $.ajax({
            method: "GET",
            url: "api/get_primary_category.php",
            dataType: "json",
          })
          .done(function(response) {
            // console.log(response);
            const check = document.querySelector(".check")
            let sec_items = response['sec_data'].filter(item => {
              return item['primary_id'] == 0;
            });
            let checkboxHTML = "";
            sec_items.forEach(item => {
              checkboxHTML += `<li class="list-group-item set-width">
                      <input class="form-check-input me-1 border" data-check data-id="${item['id']}" type="checkbox" value="${item["primary_id"]}" aria-label="...">
                      ${item["name"]}</li>`


            })
            check.innerHTML = checkboxHTML;
            //新增
            $('#add').on('click', function(event) {
                event.preventDefault();
                var priName = $('#pri_name').val(); //獲取 #pri_name 的值
                var checkedIds = []; // 用於存儲被選中的 checkbox 的值
                var secIds = []; // 用于存儲被選中的 checkbox 的 sec_id

                // 選擇所有被選中的具有 data-check 和data-id 屬性的 checkbox
                $('input[data-check]:checked').each(function() {
                  checkedIds.push($(this).val()); // 獲取 checkbox 的 value 并添加到数组中
                  secIds.push($(this).data('id')); // 獲取每個被選中的複選框的 data-id 並添加到数组中
                  console.log(priName, checkedIds, secIds);
                });

                $.ajax({
                    method: "POST", // 使用 POST 方法發送數據
                    url: "api/api_addPriCategory.php", // 指定後端處理文件的路徑
                    data: {
                      priName: priName, // 主類別名稱
                      checkedIds: checkedIds, // 被選中的次類別中的primary_id
                      secIds: secIds
                    },
                    dataType: "json" // 期望從後端接收的數據類型
                  })
                  .done(function(response) {
                    // console.log("數據提交成功:", response);
                    alert("主類別新增成功!")
                    $('#pri_name').val(""); //新增成功後清空欄位
                    $('input[data-check]:checked').closest('.list-group-item').remove(); //新增成功後清空被勾選的次類別
                  })
                  .fail(function() {
                    alert("POST請求失敗");
                  })
              })
              .fail(function() {
                alert("請求失敗");
              })

          });
      })
    </script>
</body>

</html>