var loadFile = function(event) {
    var image = document.querySelector('.avt_block');
    image.src = URL.createObjectURL(event.target.files[0]);
};

var avtBlock = document.querySelector('.avt_block');
var cameraIcon = document.querySelector(".edit_btn i")
cameraIcon.addEventListener("mouseover", mouseOver);
cameraIcon.addEventListener("mouseout", mouseOut);
avtBlock.addEventListener("mouseover", mouseOver);
avtBlock.addEventListener("mouseout", mouseOut);

function mouseOver() {
    cameraIcon.style.display = "block"
    avtBlock.style.filter = "brightness(50%)";
    avtBlock.style["background-image"] = "linear-gradient(to bottom, rgba(0,0,0,0.5), rgba(0,0,0,0.8))";
}

function mouseOut() {
    if (avtBlock.src == "http://127.0.0.1:5500/asset/img/mock_avt2.png") {
        return false
    }
    cameraIcon.style.display = "none"
    avtBlock.style.filter = "unset";
    avtBlock.style["background-image"] = "unset";
}