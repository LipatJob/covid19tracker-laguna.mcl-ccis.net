    <!-- INCLUDE NAVBAR -->
    <?php include_once 'template/navbar.php' ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4">
                <div class="alert alert-light" style="text-align: center;" role="alert">
                    Currently Updating Data
                </div>
            </div>
            <div class="col-lg-4"></div>

        </div>
    </div>

    <!-- SCRIPTS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js" type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"> </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <!-- FOOTER -->
    <div class="row" style="margin: 0px;">
        <div class="item-container footer">

            <div style="font-size: 14px; color: white !important;">Disclaimer: Data in this case tracker is based on the daily update posted from the social media account of the different LGUs in the province of Laguna. <br> Copyright © 2020 Malayan Colleges Laguna. All rights reserved.</div>

        </div>
    </div>
    <!-- END OF FOOTER-->

    <script>
        //INITIALIZE NAVBAR
        $("#indexNav a").addClass("disabled");
        $("#individualNav a").addClass("disabled");
    </script>
