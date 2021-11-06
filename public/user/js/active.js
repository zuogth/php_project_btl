class activeButton{
  constructor(myBtn, btn, warp) {
    this.myBtn = myBtn;
    this.btn = btn;
    this.warp = warp;
  }
  activeMethod(){
    let hehe = this.warp.trim()
 
    var header = document.querySelector(this.myBtn);
    var btn1 = header.querySelectorAll(this.btn);
    var btns =  Array.from(btn1)
    for (var i = 0; i < btns.length; i++) {
      btns[i].addEventListener("click", function() {
      var current = document.getElementsByClassName(hehe);
 
      current[0].className = current[0].className.replace(" "+hehe, "");
    
      this.className += " "+hehe;
      });
    }
  }
}

  // var header = document.getElementById("myBtn");
  // console.log(header)
  // var btns = header.getElementsByClassName("btn");
  // for (var i = 0; i < btns.length; i++) {
  //   btns[i].addEventListener("click", function() {
  //   var current = document.getElementsByClassName("active-warp");
  //   console.log(this)
  //   current[0].className = current[0].className.replace(" active-warp", "");
  //   this.className += " active-warp";
  //   });
  // }


 