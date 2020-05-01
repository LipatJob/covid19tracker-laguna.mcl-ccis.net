<?php
    $images = [ "imgs/imagesoftheday/0.jpg",
                "imgs/imagesoftheday/1.jpg",
                "imgs/imagesoftheday/2.jpg",
                "imgs/imagesoftheday/3.jpg",
                "imgs/imagesoftheday/4.jpg"];

    $currentDate = intval(date("d"));
    $imageIndex = $currentDate % 5;
    $imageLocation = $images[$imageIndex];
?>

<style>
@media (min-width: 992px) {
  .modal-dialog {
    max-width: 40%;
  }
}
</style>


<!-- Modal -->
<div class="modal fade" id="videomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="video">
        <div class="modal-content" style="background-color: #095779; color: white;">
            <div class="modal-header" style = "border-bottom:none;">
                <div class="parent-container-horizontal">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 1.2em; font-weight: 400; margin-left: 10px; text-align:center;">
                        We send love and prayers to Covid-19 patients, their families, and the courageous frontliners
                        through our drawings and messages of hope. ❤
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style = "color:white;">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="wrapper">
                    <img src="<?php echo $imageLocation?>" alt="" srcset="" width="100%" height="auto"
                        style="border:none;overflow:hidden; margin: 15px; margin-top:0px" scrolling="no" frameborder="0" allowTransparency="true"
                        allowFullScreen="true" class = "shadow-sm mx-auto">
                    </div>
                </div>
            </div>
        </div>
        
