<?php $this->load->view('admin/_htmlhead'); ?>
<body class="theme-red">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->
    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->
    <!-- Search Bar -->
    <div class="search-bar">
        <div class="search-icon">
            <i class="material-icons">search</i>
        </div>
        <input type="text" placeholder="START TYPING...">
        <div class="close-search">
            <i class="material-icons">close</i>
        </div>
    </div>
    <!-- #END# Search Bar -->
    <?php $this->load->view('admin/_navbar'); ?>
    <section>
        <?php $this->load->view('admin/_sidebar'); ?>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>Add Product</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD PRODUCT
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <?php echo validation_errors(); ?>
                        <?php if ($this->session->flashdata(SUCCESS_MESSAGE)) : ?>
                            <?php echo  '<p class="alert alert-success">' . $this->session->flashdata(SUCCESS_MESSAGE) . '</p>' ?>
                        <?php endif; ?>
                        <?php if ($this->session->flashdata(ERROR_MESSAGE)) : ?>
                            <?php echo  '<p class="alert alert-danger">' . $this->session->flashdata(ERROR_MESSAGE) . '</p>' ?>
                        <?php endif; ?>
                        <div class="body">
                        <form method="post" action="<?php echo base_url(); ?>Product/save_product" enctype="multipart/form-data">
                            <label for="cat_name">Category Name</label>
                                <div class="form-group">
                                <select class="form-group" name="category_id">
                                    <?php foreach($all_published_category as $single_product){?>
                                    <option value="<?php echo $single_product->id;?>"><?php echo $single_product->name;?></option>
                                    <?php }?>
                                </select>
                                </div>

                                <label for="cat_name">Product Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address" name="name" class="form-control" placeholder="Enter your Product name">
                                    </div>
                                </div>

                                <label for="cat_description">Product Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="editor" class="form-control" name="description"></textarea>
                                    </div>
                                </div>

                                <label for="image">Product Image</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="file"  name="image" id="image" class="form-control">
                                    </div>
                                </div>

                                <label for="cat_name">Product Type</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-line" name="type" required>
                                            <option name="new" value="New">New</option>
                                            <option name="fetured" value="Featured">Featured</option>
                                        </select>
                                    </div>
                                </div>

                                <label for="cat_name">Product Price</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="email_address" name="price" class="form-control" placeholder="Enter your Product price">
                                    </div>
                                </div>

                                <label for="cat_name">Product Quanitty</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="email_address" name="quantityonhand" class="form-control" placeholder="Enter your Product Quantity">
                                    </div>
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                VIEW PRODUCTS
                            </h2>
                            <ul class="header-dropdown m-r--5">
                                <li class="dropdown">
                                    <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                                        <i class="material-icons">more_vert</i>
                                    </a>
                                    <ul class="dropdown-menu pull-right">
                                        <li><a href="javascript:void(0);">Action</a></li>
                                        <li><a href="javascript:void(0);">Another action</a></li>
                                        <li><a href="javascript:void(0);">Something else here</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Product Name</th>
                                        <th>Product Description</th>
                                        <th>Product Image</th>
                                        <th>Product Type</th>
                                        <th>Product Price</th>
                                        <th>Available Quantity(s)</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            foreach($get_all_product as $single_product){
                                        ?>
                                        <tr>
                                        <td class="center"><?php echo $single_product->id;?></td>
                                            <td class="center"><?php echo $single_product->name;?></td>
                                            <td class="center"><?php echo $single_product->description;?></td>
                                            <td class="center"><img src="<?php echo base_url('uploads/'.$single_product->image);?>" style="width:200px;height:75px"/></td>
                                            <td class="center"><?php echo $single_product->type;?></td>
                                            <td class="center">$<?php echo $single_product->price;?> </td>
                                            <td class="center"><?php echo $single_product->quantityonhand;?></td>
                                            <td><?php echo date("F j, Y, g:i a", strtotime($single_product->created_at)); ?></td>
                                            <td class="center"><a href="<?php echo base_url() . 'Product/edit_product/' . $single_product->id ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a id="delReg" href="<?php echo base_url() . 'Product/delete_prduct/' . $single_product->id ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </td> 
                                        </tr>
                                        <?php } ?>
                                        </tr>
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- #END# Exportable Table -->
        </div>
    </section>
    <?php $this->load->view('admin/_scripts'); ?>
    <script>
        ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
</body>
</html>