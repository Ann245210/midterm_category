<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../assets/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
  <!-- argon dashboard plugin -->
  <link rel="stylesheet" href="../assets/vendor/select2/dist/css/select2.min.css">
  <!-- 自定義樣式 -->
  <style>
    .input-width {
      width: 500px
    }

    .set-width {
      width: 700px;
    }

    .pagination .page-item.active .page-link {
      background-color: #dee2e6;
      border-color: #dee2e6;
      box-shadow: none;

    }
  </style>
</head>
<!-- 列表內容 (單獨拉出來避免初始化時被清空)-->
<!-- (template 不會被渲染到頁面) -->
<template id="item-template">
  <tr>
    <td class="text-center">
      <!--插入id .category-id -->
      <p class="mb-0 text-md category-id"></p>
    </td>
    <td class="text-center">
      <!--插入name .category-name -->
      <p class="text-md  mb-0 category-name"></p>
    </td>
    <td class="text-center">
      <div class="text-end">
        <button class="btn btn-primary btn-view" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          <i class="fa-solid fa-eye fa-fw text-white"></i></button>
        <button class="btn btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">
          <i class="fa-solid fa-pen-to-square fa-fw"></i></button>
        <button class="btn btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#confirmModal" role="button">
          <i class="fa-solid fa-trash-can fa-fw"></i></i></button>
      </div>

      <!-- MODAL模型 -->
      <div class="modal fade modal-view" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="staticBackdropLabel">

              </h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- 查看內容 -->
            <div class="modal-body">
              <div class="container">
                <div class="row">
                  <div class="col">
                    <table class="table table-bordered">
                      <tr>
                        <th>ID</th>
                        <td class="category-id border-end">
                        </td>
                      </tr>
                      <tr>
                        <th>主類別名稱</th>
                        <td class="border-end">
                          <p class="text-md  mb-0 category-name"></p>
                        </td>
                      </tr>
                      <tr class="border-end">
                        <th>次類別</th>
                        <td>
                          <ul class="list-unstyled secNameList">
                            <!-- 插入次類別名稱 -->
                          </ul>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer d-flex justify-content-lg-between">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">關閉</button>
              <div>
                <!-- 修改 -->
                <button class="btn btn-primary btn-edit" data-bs-toggle="modal" data-bs-target="#editModal ">
                  修改
                </button>
                <!-- 刪除 -->
                <button class="btn btn-danger btn-delete" data-bs-toggle="modal" data-bs-target="#confirmModal" role="button"><i class="fa-solid fa-trash-can fa-fw"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- 刪除按鈕 -->





      <!-- 按修改會跳出來的東西 (完成)-->
      <div class="modal fade modal-edit" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">修改資料</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- p-id = primary category id -->
            <!-- s-id = seconday category id -->
            <!-- p-name = primary name id -->
            <!-- s-name = seconday name id -->
            <!-- Form for editing user details -->
            <form action="api/set_category.php" method="post">
              <!-- 隱藏的input (只將資料傳送給後端) -->
              <input type="hidden" class="input-set-cate" name="p-id" value="">

              <table class="table table-bordered">
                <tr>
                  <th>主類別</th>
                  <td>
                    <input type="text" class="form-control input-set-cate-name" name="p-name" value="">
                  </td>
                </tr>
                <tr>
                  <th>次類別</th>
                  <td>
                    <select class="secondary-multiple-select form-control set-width" name="states[]" multiple="multiple">
                      <!-- 次類別項目 -->
                      <!-- <option value="AL">Alabama</option>-->
                    </select>
                  </td>
                </tr>
              </table>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
                <button type="submit" class="btn btn-danger">確認</button>
              </div>
            </form>
          </div>
        </div>
      </div>

      <!-- 按刪除會跳出來的東西 -->
      <div class="modal fade modal-delete" id="confirmModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h1 class="modal-title fs-5" id="exampleModalLabel">刪除主類別資料</h1>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              確認刪除?
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">取消</button>
              <a type="submit" class="btn btn-danger btn-delete deleteYes" role="button" data-bs-dismiss="modal">確認</a>
            </div>
          </div>
        </div>
      </div>
    </td>
  </tr>
</template>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-success position-absolute w-100"></div>
  <aside class="z-index-0 sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/argon-dashboard/pages/dashboard.html " target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold"> 城市生機</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class=" w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link " href="../member_pages/member.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-user text-dark text-sm opacity-10 fa-fw"></i>
            </div>
            <span class="nav-link-text ms-1">會員管理/註冊</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../product-list_pages/product-list.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-sharp fa-solid fa-leaf text-dark text-sm opacity-10 fa-fw"></i>
            </div>
            <span class="nav-link-text ms-1">商品管理</span>
          </a>
        </li>
        <li class="nav-item">
          <!-- 連結改 -->
          <a class="nav-link active" href="../product-category_pages/primary_category.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-table-list text-dark text-sm opacity-10 fa-fw"></i>
            </div>
            <span class="nav-link-text ms-1">商品類別管理</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../articles_pages/articles.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-message text-dark text-sm opacity-10 fa-fw"></i>
            </div>
            <span class="nav-link-text ms-1">文章管理</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../order_pages/order.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-store text-dark text-sm opacity-10 fa-fw"></i>
            </div>
            <span class="nav-link-text ms-1">訂單管理</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../teachers_pages/teachers.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-user-tie text-dark text-sm opacity-10 fa-fw"></i>
            </div>
            <span class="nav-link-text ms-1">講師管理</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../lecture_pages/lecture.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fa-solid fa-ticket-simple text-dark text-sm opacity-10 fa-fw"></i>
            </div>
            <span class="nav-link-text ms-1">課程管理</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../coupon_pages/coupon.php">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">優惠券管理</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">個人主頁</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/profile.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">個人檔案</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/sign-in.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">登入</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="../pages/sign-up.html">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-collection text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">登出</span>
          </a>
        </li>
      </ul>
    </div>

  </aside>
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3 ">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
          <div class="text-white px-4">
            HI, USER
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">登入</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- SEARCH -->
    <!-- 商品主類別列表 -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="d-flex justify-content-between">
                <h4>商品主類別列表</h4>
                <div class="d-flex">
                  <div class="me-2 pt-2">新增</div>
                  <a name="" id="" class="btn btn-primary" href="addPriCategory.php" role="button">
                    <i class="fa-solid fa-plus fa-fw"></i>
                  </a>
                </div>
              </div>
              <!-- 搜尋欄 -->
              <div class="col">
                <form action="">
                  <div class="input-group ">
                    <input style="height: 41px;" type="search" id="button-search-input" class="form-control box-sizing inline-block search-text" placeholder="商品主類別" name="search" />
                    <button class="btn btn-primary" type="submit" id="button-search"><i class="fa-solid fa-magnifying-glass fa-fw"></i></button>
                  </div>
                </form>
              </div>
              <div class="d-flex justify-content-between align-item-center">
                <div id="total-count">
                </div>
                <div class="d-flex">
                  <div class="me-2 pt-2">排序</div>
                  <div class="btn-group sort-group">
                    <a class="btn btn-primary btn-sort" data-action="sort-1-9" href="product-list.php?order=1&p=<?= $p ?>">id <i class="fa-solid fa-arrow-down-short-wide fa-fw"></i></a>
                    <a class="btn btn-primary btn-sort" data-action="sort-9-1" href="product-lst.php?order=2&p=<?= $p ?>">id <i class="fa-solid fa-arrow-down-wide-short fa-fw"></i></a>
                    <a class="btn btn-primary btn-sort" data-action="sort-a-z" href="product-list.php?order=3&p=<?= $p ?>">name <i class="fa-solid fa-arrow-down-short-wide fa-fw"></i></a>
                    <a class="btn btn-primary btn-sort" data-action="sort-z-a" href="product-list.php?order=4&p=<?= $p ?>">name<i class="fa-solid fa-arrow-down-wide-short fa-fw"></i></a>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead class="font-weight-bolder">
                    <tr>
                      <th class="text-center text-secondary font-weight-bolder opacity-7">編號</th>
                      <th class="text-center text-secondary font-weight-bolder opacity-7 ">主分類項目</th>
                      <th class="text-center text-secondary font-weight-bolder opacity-7 "></th>
                    </tr>
                  </thead>
                  <tbody class="items-container">
                    <!-- 內容拉到外面去 -->
                  </tbody>
                </table>
              </div>

            </div>
          </div>
        </div>
      </div>
      <!-- 新增類別 -->
      <div class="d-flex justify-content-end">
        <a class="btn btn-primary mb-0 mt-1 py-2 text-end" href="secondary_category.php" type="button"><i class="fa-solid fa-angles-right"></i> 進入次類別管理</a>
      </div>
      <!-- 分頁 -->
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center">
          <!-- <li class="page-item" id="page"><a class="page-link" href="primary_category.php?p=" id="p"></a></li> -->
        </ul>
      </nav>
    </div>
    </div>
  </main>

  <div class="fixed-plugin">
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
        <div class="d-flex my-3">
          <h6 class="mb-0">Navbar Fixed</h6>
          <div class="form-check form-switch ps-0 ms-auto my-auto">
            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
          </div>
        </div>
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
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <!-- argon dashboard plugin -->
  <script src="../assets/vendor/select2/dist/js/select2.min.js"></script>
  <script>
    $(document).ready(function() { //dom加載好後執行以下程式碼
      let search = ""
      let order = 0

      // init page
      fetchPage()
      // click page?
      $('.pagination').on('click', '.page-link', function() { //選擇有pagination類的元素(ul)，運用事件委託，在.page-link元素上綁定點擊事件(li)，當page-link被點擊到時觸發函數
        const page = this.getAttribute('data-page'); //定義page為點擊的那個頁碼
        fetchPage(page, search, order);
      });
      // click serach?
      $('#button-search').on('click', function() {
        search = $('.search-text').val() //將輸入搜尋欄的文字賦值給變數search
        fetchPage(1, search, order);
      })
      $('#button-search-input').on('input', function(event) { //運用input事件在元素的值發生改變時觸發，讓使用者清空搜尋欄位時重新加載頁面
        event.preventDefault();
        if (event.target.value == "") {
          search = "";
          fetchPage();
        }
      })
      $('#button-search-input').on('keydown', function(event) { //用enter鍵送出值
        // 檢查按下的鍵是否是 Enter 鍵
        if (event.key === "Enter" || event.keyCode === 13) {
          search = $('.search-text').val()
          fetchPage(1, search, order);
        }
      });
      // click order?
      $('.sort-group').on('click', '.btn-sort', function() {
        var action = $(this).data('action'); //獲取data-action的值
        switch (action) {
          case 'sort-1-9':
            order = 1;
            break;
          case 'sort-9-1':
            order = 2;
            break;
          case 'sort-a-z':
            order = 3;
            break;
          case 'sort-z-a':
            order = 4;
            break;
        }
        fetchPage(1, search, order);
      });
    })

    function fetchPage(page = 1, search = '', order = 0) {
      let url = "api/get_primary_category.php?p=" + page;
      if (search.length) //如果search.length>0，則url加上search字串值 
        url += '&search=' + search;
      if (order != 0) //如果有點選排序，則url加上order字串值
        url += '&order=' + order;

      $.ajax({
          method: "GET",
          url: url,
          dataType: "json",
        })
        .done(function(response) {
          $('.items-container').empty(); //初始化列表內容
          $('.pagination').empty(); //初始化分頁
          let items = response['data']
          let pageCount = response['pageCount']; //頁數
          let totalCount = response['totalCount']; //類別總數
          let sec_items = response['sec_data']; //次類別項目
          let paginationHTML = "";
          console.log(response);

          const pagination = document.querySelector(".pagination");

          $('#total-count').text(`共 ${totalCount} 筆`); //顯示幾筆資料
          var selectedValues = [];

          items.forEach(item => {
            const template = document.getElementById('item-template');
            const clone = document.importNode(template.content, true); //深度複製template裡面的內容
            clone.querySelectorAll('.btn-view').forEach(el => { //選擇 clone 元素中所有具有 btn-view 類別的元素。並返回一個 NodeList(包含所有匹配元素的集合)，並設置data-bs-target為屬性名。'#modal-view-' + item['id']為屬性值。
              el.setAttribute('data-bs-target', '#modal-view-' + item['id']);
            })
            clone.querySelector('.modal-view').setAttribute('id', 'modal-view-' + item['id']); //設置modal-view的id (與btn-view做對應)

            clone.querySelectorAll('.btn-edit').forEach(el => {
              el.setAttribute('data-bs-target', '#modal-edit-' + item['id']);
            })
            clone.querySelector('.modal-edit').setAttribute('id', 'modal-edit-' + item['id']);

            clone.querySelectorAll('.btn-delete').forEach(el => {
              el.setAttribute('data-bs-target', '#modal-delete-' + item['id']);
            })
            clone.querySelector('.modal-delete').setAttribute('id', 'modal-delete-' + item['id']);

            clone.querySelectorAll('.category-id').forEach((el) => { //串接列表的id
              el.textContent = item['id'];
            });

            clone.querySelectorAll('.category-name').forEach((el) => { //串接列表的name
              el.textContent = item['name']
            });

            clone.querySelector('.input-set-cate').value = item['id'];
            clone.querySelector('.input-set-cate-name').value = item['name']; //欄位的值顯示類別名稱


            sec_items.forEach(sec_item => { //foreach遍歷次類別欄位，並放進修改的次類別欄位中
              let tmp = `<option id="${sec_item['id']}" value="${sec_item['id']}">${sec_item['name']}</option>`;
              clone.querySelector('.secondary-multiple-select').innerHTML += tmp;
            })

            selectedValues = [] //用來存儲被選擇的次類別id
            item['sec_id'].forEach((obj) => {
              var sec_item = document.createElement("li"); //新增li元素 (用來包次類別名稱)
              sec_item.textContent = obj['name'];
              clone.querySelector('.secNameList').appendChild(sec_item); //把先前的sec_item內容放到ul(.secNameList)裡面
              selectedValues.push(obj['id']);
            })
            console.log(selectedValues)
            clone.querySelector('.secondary-multiple-select').setAttribute('id', 'sec-multi-' + item['id']); //將修改的次類別欄位設置id
            document.querySelector('.items-container').appendChild(clone); //把先前的clone內容放到tbody(.items-container)裡面
            $('#sec-multi-' + item['id']).select2({ //將slect2下拉選單設置對應 item 的（modal-edit-' + item['id']）中。
              dropdownParent: $('#modal-edit-' + item['id'])
            });

            $('#sec-multi-' + item['id']).val(selectedValues) //將 selectedValues 陣列中的值設置為選單的選中值，顯示哪些次類別被選中。
            $('#sec-multi-' + item['id']).trigger('change.select2');

          })

          for (let i = 1; i <= pageCount; i++) { //根據pagecount顯示正確頁碼
            if (i == page)
              paginationHTML += `<li class="page-item active"><button class="page-link" data-page="${i}" >${i}</button></li>`;
            else
              paginationHTML += `<li class="page-item"><button class="page-link" data-page="${i}" >${i}</button></li>`;
          }
          pagination.innerHTML = paginationHTML;


        })
        .fail(function() {
          alert("請求失敗");
        })
    }

    //



    function deleteItem(id) {
      let url = "api/api_DeleteCategory.php?id=" + id;
      $.ajax({
          method: "GET",
          url: url,
          dataType: "json",
        })
        .done(function(response) {
          console.log(response);
          let pri_Id = response['id'];
          fetchPage();
        })
        .fail(function(error) {
          console.log(error);
          alert("請求失敗");
        })
    }

    //click delete
    $('.items-container').on('click', '.btn-delete.deleteYes', function() {
      // 從被點擊的按鈕獲取 data-bs-target 属性的值
      var targetId = $(this).attr('data-bs-target');

      // 提取出 item['id']，它是在 "#modal-delete-" 之后的部分
      var itemId = targetId.replace('#modal-delete-', '');

      // 现在您可以使用 itemId 来进行删除操作或其他邏輯處理
      console.log("項目 ID:", itemId);
      deleteItem(itemId);
    });
  </script>
</body>

</html>