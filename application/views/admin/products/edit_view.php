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
                <h2>Edit Product</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT PRODUCT
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
                            <form method="post" action="<?php echo base_url('Product/update_product/'.$product_info_by_id->id);?>">
                                <label for="cat_name">Product Category Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                    <select id="category_id" name="category_id">
										<?php foreach($all_published_category as $single_category){?>
										<option value="<?php echo $single_category->id;?>"><?php echo $single_category->name;?></option>
										<?php }?>
                                    </select>
                                    </div>
                                </div>

                                <label for="cat_name">Product Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address" value="<?php echo $product_info_by_id->name;?>" name="name" class="form-control">
                                    </div>
                                </div>

                                <label for="cat_description">Product Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="editor" class="form-control" name="description">
                                            <?php echo $product_info_by_id->description;?>
                                        </textarea>
                                    </div>
                                </div>

                                <label for="cat_name">Product Image</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        
                                        <input class="form-control" name="image" id="image" type="file"/>
                                        <input class="form-control" name="product_delete_image" value="<?php echo base_url('uploads/'.$product_info_by_id->image);?>" type="hidden"/>

                                       
                                        <?php if (!empty($product_info_by_id->image)) : ?>
                                            <img style="width:50px;" src="<?php echo base_url('uploads/'.$product_info_by_id->image);?>">
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <label for="cat_name">Product Type</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <select class="form-line" name="type" required>
                                            <option value=""><?php echo $product_info_by_id->type;?></option>
                                            <option name="new" value="New">New</option>
                                            <option name="fetured" value="Featured">Featured</option>
                                        </select>
                                    </div>
                                </div>

                                <label for="cat_name">Product Price</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="email_address" value="<?php echo $product_info_by_id->price;?>" name="price" class="form-control">
                                    </div>
                                </div>

                                <label for="cat_name">Product Quanitty</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="number" id="email_address" value="<?php echo $product_info_by_id->quantityonhand;?>" name="quantityonhand" class="form-control">
                                    </div>
                                </div>

                                <br>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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