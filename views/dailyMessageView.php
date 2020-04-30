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


<!-- Modal -->
<div class="modal fade bd-example-modal-md" id="videomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="video">
        <div class="modal-content" style="background-color: #095779; color: white;">
            <div class="modal-header">
                <div class="parent-container-horizontal">
                    <h5 class="modal-title" id="exampleModalLongTitle" style="font-size: 1.1em; font-weight: 400; margin-left: 10px; text-align:center;"> 
                    We send love and prayers to Covid-19 patients, their families, and the courageous frontliners through our drawings and messages of hope. ❤ 
                        </h5>
                    </div>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="wrapper">
                        <img src="<?php echo $imageLocation?>" alt="" srcset="" width="100%" height="auto" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allowFullScreen="true" style="margin: 15px;">
                    </div>
                </div>
            </div>
        </div>




