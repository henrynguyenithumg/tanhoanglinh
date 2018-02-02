<?php
?>
<div class="images-container">
    <h4 class="title"><?php echo $instance['title'];?></h4>   
        <div class="row images-wrapper">
            <?php foreach ($instance['images'] as $key => $item): ?>
                <?php if($item['url']) {?>
                <div class="img-item col-md-<?php echo $item['width']; ?>">
                    <img id="img-grid-<?php echo $item['width']; ?>" class="img-grid" src="<?php echo wp_get_attachment_url($item['url']) ;?>" alt="<?php echo get_the_title($item['url'])
;?>" />
                </div>
                <?php } else {?>
                <div class="text-item col-md-<?php echo $item['width']; ?>">
                    <div class="text-grid"><?php echo $item['msg'] ;?></div>
                </div>
                <?php }?>
                    
            <?php endforeach;?>
        </div>
</div>
<div id="myModal" class="modal">

  <!-- The Close Button -->
  <span class="close">&times;</span>

  <!-- Modal Content (The Image) -->
  <img class="modal-content" id="img-local">

  <!-- Modal Caption (Image Text) -->
  <div id="caption"></div>
</div>
<style>
/* Style the Image Used to Trigger the Modal */
.text-grid{
    padding: 5px;
    background: rgba(0, 0, 0, 0.3);
    height: 100%;
}
.text-item{
    padding: 5px;
    margin: 0;
}
.img-item{
    padding: 5px;
    margin: 0;
}
.img-grid {
    border-radius: 4px;
    cursor: pointer;
    transition: 0.3s;
}

.img-grid:hover {opacity: 0.7;}

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
    top: calc( 50% - 50px );
    right: calc( 50% - 35px );
    color: #00000;
    font-size: 100px;
    font-weight: bold;
    transition: 0.3s;
    z-index: 9999;
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
// img.onclick = function(){
//     modal.style.display = "block";
//     modalImg.src = this.src;
//     captionText.innerHTML = this.alt;
// }
$(".img-grid").on('click', event => {
    const img = $(event.target); 
    modal.style.display = "block";
    modalImg.src = img.attr('src');
    captionText.innerHTML = mg.attr('alt');
})
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>