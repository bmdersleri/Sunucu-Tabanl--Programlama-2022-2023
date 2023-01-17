function chooseLeftMenuItem(index){
    document.querySelectorAll(".menu-sections ul li")[index].classList.add("menu-selected")
}


function validate(evt,value) {
    var theEvent = evt || window.event;
    // if(value.length >= 3 )
    //   theEvent.returnValue = false;

    // Handle paste
    if (theEvent.type === 'paste') {
        key = event.clipboardData.getData('text/plain');
    } else {
    // Handle key press
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
    }
    
    var regex = /[0-9]|\./;
    if( !regex.test(key) ) {
      theEvent.returnValue = false;
      if(theEvent.preventDefault) theEvent.preventDefault();
    }

  }
