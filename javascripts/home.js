function swapImgs() {
  var img1 = document.getElementById("im1");
  var img2 = document.getElementById("im2");
  var img3 = document.getElementById("im3");

  var temp = img1.src;
  img1.src = img2.src;
  img2.src = img3.src;
  img3.src = temp;
}

setInterval(swapImgs,5000);
  