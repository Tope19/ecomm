<?php $this->load->view('admin/_htmlhead',[ 'pageTitle' =>  'Add  Category | Admin' , 'activeGroup'  => 'add_categories', 'activePage' => 'add_categories']); ?>
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
                <h2>Add Category</h2>
            </div>

            <!-- Vertical Layout -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                ADD CATEGORY
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
                            <form method="post" action="<?php echo base_url(); ?>Category/save_category">
                                <label for="cat_name">Category Name</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <input type="text" id="email_address" name="name" class="form-control" placeholder="Enter your Category name">
                                    </div>
                                </div>

                                <label for="cat_description">Category Description</label>
                                <div class="form-group">
                                    <div class="form-line">
                                        <textarea id="editor" class="form-control" name="description"></textarea>
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
                                EXPORTABLE TABLE
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
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Creation Date</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            foreach ($all_categroy as $single_category) {

                                        ?>
                                        <tr>
                                            <td><?php echo $single_category->id ?></td>
                                            <td><?php echo $single_category->name ?></td>
                                            <td><?php echo $single_category->description ?></td>
                                            <td><?php echo date("F j, Y, g:i a", strtotime($single_category->created_at)); ?></td>
                                            <td class="center"><a href="<?php echo base_url() . 'Category/edit_category/' . $single_category->id ?>" class="btn btn-primary btn-sm">Edit</a>
                                                <a id="delReg" href="<?php echo base_url() . 'Category/delete_category/' . $single_category->id ?>" class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        <?php } ?>
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