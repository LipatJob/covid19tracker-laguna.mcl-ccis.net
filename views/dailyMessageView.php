<?php
    $images = [ "imgs/imagesoftheday/MessagesofHope.001.jpeg",
                "imgs/imagesoftheday/MessagesofHope.002.jpeg",
                "imgs/imagesoftheday/MessagesofHope.003.jpeg",
                "imgs/imagesoftheday/MessagesofHope.004.jpeg",
                "imgs/imagesoftheday/MessagesofHope.005.jpeg",
                "imgs/imagesoftheday/MessagesofHope.006.jpeg",
                "imgs/imagesoftheday/MessagesofHope.006.jpeg",
                "imgs/imagesoftheday/MessagesofHope.007.jpeg",
                "imgs/imagesoftheday/MessagesofHope.008.jpeg",
                "imgs/imagesoftheday/MessagesofHope.009.jpeg",
                "imgs/imagesoftheday/MessagesofHope.010.jpeg",
                "imgs/imagesoftheday/MessagesofHope.011.jpeg",
                "imgs/imagesoftheday/MessagesofHope.012.jpeg"
                ];

    $currentDate = intval(date("i"));
    $imageIndex = $currentDate % 5;
    $imageLocation = $images[$imageIndex];
?>

<style>
@media (min-width: 992px) {
    .modal-dialog {
        max-width: 45%;
    }
}
</style>

<link href="https://fonts.googleapis.com/css2?family=Neucha&display=swap" rel="stylesheet">

<!-- Modal -->
<div class="modal fade" id="videomodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered" role="video">
        <div class="modal-content" style="background-color: #00000; color: black;">
            <div class="modal-header" style="border-bottom:none;">
                <div class="parent-container-horizontal">
                    <p class="mx-auto" style="font-weight:bold; font-size:1.3em">
                        A Message of Hope
                    </p>
                    <p id="exampleModalLongTitle" style="font-size: 1.2em; font-weight: 400; 
                    margin-left: 10px; text-align:center;">
                        We send love and prayers to Covid-19 patients, their families, and the courageous frontliners
                        through drawings and messages of hope. ❤
                    </p>
                </div>
            </div>
            <div class="modal-body">
                <div class="wrapper">
                    <img src="<?php echo $imageLocation?>" alt="" srcset="" width="100%" height="auto"
                        style="border:none;overflow:hidden; margin: 15px; margin-top:0px" scrolling="no" frameborder="0"
                        allowTransparency="true" allowFullScreen="true" class=" mx-auto">
                </div>
                <div class = "row">
                    <button type="button" class="btn btn-outline-secondary mx-auto" data-dismiss="modal" aria-label="Close"
                        style="">
                        <span aria-hidden="true" style="color:black;">Close</span>
                    </button>
                </div>
            </div>
        </div>
    </div>