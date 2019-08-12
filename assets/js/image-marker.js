

document.body.ondblclick = function changeContent(event) {

var paras = document.getElementsByClassName('marker');

while(paras[0]) {
    paras[0].parentNode.removeChild(paras[0]);
}


var newDiv = document.createElement("div");
newDiv.setAttribute("class", "marker");
newDiv.style.position = "absolute";
newDiv.style.height = "40px";
newDiv.style.width = "40px";
newDiv.style.borderRadius = "50%";
newDiv.style.left = (event.pageX - 20) + "px";
newDiv.style.top = (event.pageY - 20) + "px";
newDiv.style.background = "tomato";

  if ((event.pageX >= 210) && (event.pageX <= 1100)) {
  document.body.appendChild(newDiv);
}


}

//
// var newDiv = document.createElement("div");
// var parentDiv = document.getElementsByClassName("image-wrap")[0];
// var placement = document.getElementsByTagName("img")[0];
//
// newDiv.style.position = "absolute";
// newDiv.style.height = "20px";
// newDiv.style.width = "20px";
// newDiv.style.background = "yellow";
// newDiv.setAttribute("id", "thing");
//
// parentDiv.insertBefore(newDiv, placement);
// //
//
//
function addElement (event) {
  var x = (event.offsetX / 736) * 90;
  var y = (event.offsetY / 1308) * 90;
  var newDiv = document.createElement("div");
  newDiv.setAttribute("class", "marker");
  newDiv.style.position = "fixed";
  newDiv.style.width = "20%";
  newDiv.style.padding = "10px";
  newDiv.style.borderRadius = "5px";
  newDiv.style.right = "10px";
  newDiv.style.bottom = "10px";
  newDiv.style.background = "tomato";
  newDiv.style.color = "white";
  newDiv.innerHTML = "Left Coord - " + x.toFixed(1) + "%" + " Top Coord - " + y.toFixed(1) + "%" ;
  document.body.appendChild(newDiv);

}


// var inputSelected = document.getElementsByClassName("coords");
// var inputSelected = inputSelected[0].getElementsByTagName("input");
// var imageSelected = document.getElementsByClassName("image-wrap")[0];
// var imageDef = document.getElementsByTagName("img")[0];
// var topPos = document.getElementById("acf-field_5b914d29ab01c-row-0-field_5b914d30ab01d-acfcloneindex-field_5d4ad36b467e9");
// var topPos1 = topPos.getElementsByTagName("input")[0];
document.ondblclick = printMousePos;

function printMousePos(event) {
  var x = (event.offsetX / 736) * 90;
  var y = (event.offsetY / 1308) * 90;
  if ((event.pageX >= 210) && (event.pageX <= 1100)) {
  addElement(event);
}
   console.log("Left Coord - " + x.toFixed(1) + "%" + " Top Coord - " + y.toFixed(1) + "%" );

  // console.log("Left Page - " + event.pageX + " Top Page - " + event.pageY);

}
