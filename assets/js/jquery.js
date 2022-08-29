// jquery for editting table directly

$(function(){
    $("td").click(function(event){
      if($(this).children("input").length > 0)
            return false;
  
      var tdObj = $(this);
      var preText = tdObj.html();
      var inputObj = $("<input type='text' />");
      tdObj.html("");
  
      inputObj.width(tdObj.width())
              .height(tdObj.height())
              .css({border:"0px",fontSize:"17px"})
              .val(preText)
              .appendTo(tdObj)
              .trigger("focus")
              .trigger("select");
  
      inputObj.keyup(function(event){
        if(13 == event.which) { // press ENTER-key
          var text = $(this).val();
          tdObj.html(text);
        }
        else if(27 == event.which) {  // press ESC-key
          tdObj.html(preText);
        }
      });
  
      inputObj.click(function(){
        return false;
      });
    });
  });