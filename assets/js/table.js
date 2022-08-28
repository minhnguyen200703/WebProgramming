function edit_row(no)
{
 document.getElementById("edit_button"+no).style.display="none";
 document.getElementById("save_button"+no).style.display="block";
	
 var name=document.getElementById("name_row"+no);
 var country=document.getElementById("country_row"+no);
 var age=document.getElementById("age_row"+no);
	
 var name_data=name.innerHTML;
 var country_data=country.innerHTML;
 var age_data=age.innerHTML;
	
 name.innerHTML="<input type='text' id='name_text"+no+"' value='"+name_data+"'>";
 country.innerHTML="<input type='text' id='country_text"+no+"' value='"+country_data+"'>";
 age.innerHTML="<input type='text' id='age_text"+no+"' value='"+age_data+"'>";
}

function save_row(no)
{
 var name_val=document.getElementById("name_text"+no).value;
 var country_val=document.getElementById("country_text"+no).value;
 var age_val=document.getElementById("age_text"+no).value;

 document.getElementById("name_row"+no).innerHTML=name_val;
 document.getElementById("country_row"+no).innerHTML=country_val;
 document.getElementById("age_row"+no).innerHTML=age_val;

 document.getElementById("edit_button"+no).style.display="block";
 document.getElementById("save_button"+no).style.display="none";
}

function delete_row(no)
{
 document.getElementById("row"+no+"").outerHTML="";
}

function add_row()
{
 var new_name=document.getElementById("new_no").value;
 var new_country=document.getElementById("new_id").value;
 var new_age=document.getElementById("new_name").value;
 var new_age=document.getElementById("new_address").value;
 var new_age=document.getElementById("new_customer").value;
 var new_age=document.getElementById("new_status").value;
	
 var table=document.getElementById("data_table");
 var table_len=(table.rows.length)-1;
 var row = table.insertRow(table_len).outerHTML="<tr id='row"+table_len+"'><td id='no_row"+table_len+"'>"+new_no+"</td><td id='id_row"+table_len+"'>"+new_id+"</td><td id='name_row"+table_len+"'>"+new_name+"</td><td id='address_row"+table_len+"'>"+new_address+"</td><td id='customer_row"+table_len+"'>"+new_customer+"</td><td id='status_row"+table_len+"'>"+new_status+"</td></tr>";

 document.getElementById("new_no").value="";
 document.getElementById("new_id").value="";
 document.getElementById("new_name").value="";
 document.getElementById("new_address").value="";
 document.getElementById("new_customer").value="";
 document.getElementById("new_status").value="";
}

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