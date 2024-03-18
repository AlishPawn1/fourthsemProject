<?php 


include("../include/connect_database.php");
include("../function/commonfunction.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/ecommerce/css/all.css">
    <link rel="stylesheet" href="style.css">
    <!-- Add your custom CSS file if needed -->
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
              <a class="navbar-brand" href="#">Admin Dashboard</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php?insert_product">insert product</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?view_products">view product</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?insert_categories">insert Categories</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?insert_tags">insert tags</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="index.php?add_stock">add stock</a>
                  </li>
                  <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    insert navigation
                    </a>
                    <ul class="dropdown-menu">
                      <li><a class="dropdown-item" href="index.php?insert_menu">Insert menu</a></li>
                      <li><a class="dropdown-item" href="index.php?insert_sub_menu">Insert sub menu</a></li>
                      <li><a class="dropdown-item" href="index.php?insert_sub_sub_menu">Insert sub sub menu</a></li>
                    </ul>
                  </li>
                </ul>
                <div class="logout-btn">
                  <a href="">Logout</a>
                </div>
              </div>
            </div>
          </nav>
    </header>

    <section>
        <div class="container">
            <?php
                if (isset($_GET['insert_menu'])) {
                    include('insert_menu.php');
                } 
                elseif (isset($_GET['insert_sub_menu'])) {
                    include('insert_sub_menu.php');
                } 
                elseif (isset($_GET['insert_sub_sub_menu'])) {
                    include('insert_sub_sub_menu.php');
                } 
                elseif (isset($_GET['insert_product'])) {
                    include('insert_product.php');
                } 
                elseif (isset($_GET['insert_tags'])) {
                    include('insert_tags.php');
                } 
                elseif (isset($_GET['insert_categories'])) {
                    include('insert_categories.php');
                }
                elseif (isset($_GET['view_products'])) {
                    include('view_products.php');
                }
                elseif (isset($_GET['edit_product'])) {
                    include('edit_product.php');
                }
                elseif (isset($_GET['add_stock'])) {
                  include('add_stock.php');
                }
                elseif (isset($_GET['add_stock_edit'])) {
                    include('add_stock_edit.php');
                }
                elseif (isset($_GET['delete_product'])) {
                    include('delete_product.php');
                }
                else {
                    // Your default index.php content here
                    // This part will be executed when no specific parameter is set in the URL
                }
            ?>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js" integrity="sha512-X/YkDZyjTf4wyc2Vy16YGCPHwAY8rZJY+POgokZjQB2mhIRFJCckEGc6YyX9eNsPfn0PzThEuNs+uaomE5CO6A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> -->
    <!-- Add your custom JavaScript file if needed -->
</body>
</html>
