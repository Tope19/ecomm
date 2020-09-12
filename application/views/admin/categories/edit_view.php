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
                <h2>Edit Category</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                EDIT CATEGORY
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
                            <form method="post" action="<?php echo base_url('Category/update_category/'.$category_info_by_id->id);?>">
                                <label for="cat_name">Category Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address" value="<?php echo $category_info_by_id->name;?>" name="name" class="form-control">
                                    </div>
                                </div>

                                <label for="cat_description">Category Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="editor" class="form-control" name="description">
                                            <?php echo $category_info_by_id->description;?>
                                        </textarea>
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