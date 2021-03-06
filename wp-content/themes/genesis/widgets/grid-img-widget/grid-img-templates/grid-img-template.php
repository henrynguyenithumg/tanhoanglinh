<?php
?>
<div class="images-container">
    <h4 class="title"><?php echo $instance['title'];?></h4>   
        <div class="row images-wrapper">
            <?php foreach ($instance['images'] as $key => $item): ?>
                <div class="item col-md-<?php echo $instance['width']; ?>" 
                    style="background: url(<?php echo wp_get_attachment_url($item['url']) ;?>)" data-url="<?php echo wp_get_attachment_url($item['url']) ;?>" data-link="<?php echo $item['link'];?>">
                <?php if($item['msg']) {?>
                    <?php if($item['url']) {?>
                        <div class="text-grid"><?php echo $item['msg'] ;?></div>
                    <?php } else {?>
                        <div class="only-text-grid"><?php echo $item['msg'] ;?></div>
                    <?php }?>
                <?php }?>
                </div>
                    
            <?php endforeach;?>
        </div>
</div>
<div id="myModal" class="modal">


  <!-- Modal Content (The Image) -->
  <div id="link-goto-project"></div>
  <img class="modal-content" id="img-local">
  <!-- The Close Button -->
  <div class="close"></div>

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
<style>
/* Style the Image Used to Trigger the Modal */
#link-goto-project {
    position: fixed;
    top: calc( 50% - 70px);
    left: calc( 50% - 110px);
    z-index: 10;
    font-size: 48px;
    font-weight: 600;
}
.item{
    position: relative;
    padding: 0;
    margin: 0;
    height: <?php echo $instance['images'];?>px;
    background-size: cover !important;
}
.only-text-grid{
    position: absolute;
    padding: 5px 15px;
    background: #ffffff;
    color: #000;
    height: 100%;
    width: 100%;
    transition: 0.1s;
    opacity: 1
}
.text-grid{
    position: absolute;
    padding: 5px 15px;
    background: rgba(0, 0, 0, 0.6);
    color: #fff;
    height: 100%;
    width: 100%;
    transition: 0.1s;
    opacity: 0
}
.img-grid {
    position: absolute;
    cursor: pointer;
    transition: 0.3s;
}
.only-text-grid:hover {
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
}
.text-grid:hover {opacity: 1;}

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (Image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image (Image Text) - Same Width as the Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}
/* Add Animation - Zoom in the Modal */
.modal-content, #caption { 
    animation-name: zoom;
    animation-duration: 0.6s;
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
<script>
var modal = document.getElementById('myModal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
// var img = document.getElementById('myImg');
var modalImg = document.getElementById("img-local");
var captionText = document.getElementById("caption");
$(".item").on('click', event => {
    const url = $(event.currentTarget).data("url");
    const link = $(event.currentTarget).data("link");
    console.log(url, link)
    if ( url ) {
        modal.style.display = "block";
        modalImg.src = url;
        if (link) {
            console.log(link)
            $('#link-goto-project').html(`<a href='${link}'>Goto project</a>`);
        } else {
            $('#link-goto-project').html('');
        }
    }
})
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>