    <?php 
        if(isset($_SESSION['user']))
            $home_page = "./dashboard";
        else
            $home_page = "./";
    ?>
    <div id="app">
        <div class="container top-header">
            <a href="./"><img src="assets/images/logo.jpeg" alt=""></a><span>|</span> Error page
        </div>

        <div class="theForm container">
            <div class="row">

                <div class="col-md-6">
                    <h1>404 | Page not found</h1>
                    <h3 class="influencer-text">Oops! The page you requested for was not found, we'll probably put is up soon ):</h3>
                    <p>..<?php echo $url; ?></p>
                    <div class="row terms">
                        <div class="col-md-12">
                            <p class="left"> <a href="<?php echo $home_page; ?>">Go to home</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

<?php // require "inc/footer.php"; ?>