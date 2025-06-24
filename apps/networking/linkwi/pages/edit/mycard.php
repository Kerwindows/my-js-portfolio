<?php display_msg(); ?>
<style>
.image-container {
  position: relative;
  display: inline-block;
  height: 300px;
    width: 300px;
    position: absolute;
    top: 78px;
    left: 198px;
}

.image-container img {
  display: block;
  max-width: 100%;
}

.color-burn-overlay {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgb(241 240 236);
    mix-blend-mode: multiply;
    opacity:0.8;
}
 .image-canvas-container {
            position: relative;
            display: inline-block;
        }
</style>
<section class="content-header">
    <div class="container-fluid">
        <div class='row mb-2'>
            <div class='col-sm-6'>
                <h1 class='m-0'>My Orders</h1>
            </div>
            <!-- /.col -->
            <div class='col-sm-6'>
                <ol class='breadcrumb float-sm-right'>
                    <li class='breadcrumb-item'><a href='/profile/<?php echo $P_Username ?>' target='_blank'>View
                            Profile</a> </li>
                    <li class='breadcrumb-item active'><a href='?edit-profile'>My Card</a> </li>
                </ol>
            </div>
            <!-- /.col -->
        </div>
        
<div class="row">
  <div class="card relative" style='background-image:url("./images/blank-cards/blank-card.png");background-size:contain;background-repeat: no-repeat;width:680px;height:480px;position:relative'>
    <canvas id="imageCanvas" width="680" height="480"></canvas>
    <div class="corner top-left"></div>
    <div class="corner top-right"></div>
    <div class="corner bottom-left"></div>
    <div class="corner bottom-right"></div>
  </div>
  <div class="form-container">
    <form>
      <input id='fileInput' class="image-profile popup__form-input" name="profile_img" type="file" accept="image/png, image/gif, image/jpeg" />
      <button class="btn btn-default">Add name</button>
    </form>                
  </div>
</div>
	

    </div>
    <!-- /.container-fluid-->
</section>
<script>
function getMousePos(canvas, evt) {
  const rect = canvas.getBoundingClientRect();
  return {
    x: evt.clientX - rect.left,
    y: evt.clientY - rect.top
  };
}
imageCanvas.addEventListener('mousedown', function(e) {
  e.preventDefault();
  const mousePos = getMousePos(imageCanvas, e);
  // ...
});

imageCanvas.addEventListener('mousemove', function(e) {
  e.preventDefault();
  const mousePos = getMousePos(imageCanvas, e);
  // ...
});

imageCanvas.addEventListener('mouseup', function(e) {
  e.preventDefault();
  const mousePos = getMousePos(imageCanvas, e);
  // ...
});
const fileInput = document.getElementById('fileInput');
const imageCanvas = document.getElementById('imageCanvas');
const ctx = imageCanvas.getContext('2d');

let isDragging = false;
let startX, startY, translateX = 0, translateY = 0;
let img = new Image();
let scale = 1;

fileInput.addEventListener('change', function(event) {
  const file = event.target.files[0];
  const reader = new FileReader();

  reader.addEventListener('load', function() {
    const imageUrl = reader.result;
    img.src = imageUrl;
    img.onload = function() {
      ctx.drawImage(img, 0, 0, imageCanvas.width, imageCanvas.height);
    };
  });

  reader.readAsDataURL(file);
});

function getMousePos(canvas, evt) {
  const rect = canvas.getBoundingClientRect();
  return {
    x: evt.clientX - rect.left,
    y: evt.clientY - rect.top
  };
}

imageCanvas.addEventListener('mousedown', function(e) {
  e.preventDefault();
  const mousePos = getMousePos(imageCanvas, e);

  const points = [
    { x: translateX, y: translateY },
    { x: translateX + imageCanvas.width - 10, y: translateY },
    { x: translateX, y: translateY + imageCanvas.height - 10 },
    { x: translateX + imageCanvas.width - 10, y: translateY + imageCanvas.height - 10 },
  ];

  activePoint = points.findIndex(point => isPointClicked(mousePos.x, mousePos.y, point));

  if (activePoint >= 0) {
    isResizing = true;
  } else {
    isDragging = true;
    startX = mousePos.x - translateX;
    startY = mousePos.y - translateY;
  }
});

imageCanvas.addEventListener('mousemove', function(e) {
  e.preventDefault();
  const mousePos = getMousePos(imageCanvas, e);

  if (isResizing) {
    // ...
  } else if (isDragging) {
    translateX = mousePos.x - startX;
    translateY = mousePos.y - startY;
    redrawImage();
  }
});

imageCanvas.addEventListener('mouseup', function(e) {
  e.preventDefault();
  const mousePos = getMousePos(imageCanvas, e);

  isDragging = false;
  isResizing = false;
});

// ... Rest of the code remains the same ...

</script>