function edit_row(no)
{
 document.getElementById("edit_button"+no).style.display="none";
 document.getElementById("save_button"+no).style.display="block";
	
 var non=document.getElementById("no_row"+no);
 var id=document.getElementById("id_row"+no);
 var name=document.getElementById("name_row"+no);
 var address=document.getElementById("address_row"+no);
 var customer=document.getElementById("customer_row"+no);
 var status=document.getElementById("status_row"+no);
	
 var non_data=non.innerHTML;
 var id_data=id.innerHTML;
 var name_data=name.innerHTML;
 var address_data=address.innerHTML;
 var customer_data=customer.innerHTML;
 var status_data=status.innerHTML;
	
 non.innerHTML="<input type='text' id='no_text"+no+"' value='"+non_data+"'>";
 id.innerHTML="<input type='text' id='id_text"+no+"' value='"+id_data+"'>";
 name.innerHTML="<input type='text' id='name_text"+no+"' value='"+name_data+"'>";
 address.innerHTML="<input type='text' id='address_text"+no+"' value='"+address_data+"'>";
 customer.innerHTML="<input type='text' id='customer_text"+no+"' value='"+customer_data+"'>";
 status.innerHTML="<input type='text' id ='status_text"+no+"' value='"+status_data+"'>";
}

function save_row(no)
{
 var non_val=document.getElementById("non_text"+no).value;
 var id_val=document.getElementById("id_text"+no).value;
 var name_val=document.getElementById("name_text"+no).value;
 var address_val=document.getElementById("address_text"+no).value;
 var customer_val=document.getElementById("customer_text"+no).value;
 var status_val=document.getElementById("status_text"+no).value;

 document.getElementById("non_row"+no).innerHTML=non_val;
 document.getElementById("id_row"+no).innerHTML=id_val;
 document.getElementById("name_row"+no).innerHTML=name_val;
 document.getElementById("address_row"+no).innerHTML=address_val;
 document.getElementById("customer_row"+no).innerHTML=customer_val;
 document.getElementById("status_row"+no).innerHTML=status_val;

 document.getElementById("edit_button"+no).style.display="block";
 document.getElementById("save_button"+no).style.display="none";
}

function delete_row(no)
{
 document.getElementById("row"+no+"").outerHTML="";
}


function add_row()
{
 var new_non=document.getElementById("new_non").value;
 var new_id=document.getElementById("new_id").value;
 var new_name=document.getElementById("new_name").value;
 var new_address=document.getElementById("new_address").value;
 var new_customer=document.getElementById("new_customer").value;
 var new_status=document.getElementById("new_status").value;
	
 var table=document.getElementById("data_table");
 var table_len=(table.rows.length)-1;
 var row = table.insertRow(table_len).outerHTML="<tr id='row"+table_len+"'><td id='non_row"+table_len+"'>"+new_non+"</td><td id='id_row"+table_len+"'>"+new_id+"</td><td id='name_row"+table_len+"'>"+new_name+"</td><td id='address_row"+table_len+"'>"+new_address+"</td><td id='customer_row"+table_len+"'>"+new_customer+"</td><td id='status_row"+table_len+"'>"+new_status+"</td></tr>";

 document.getElementById("new_non").value="";
 document.getElementById("new_id").value="";
 document.getElementById("new_name").value="";
 document.getElementById("new_address").value="";
 document.getElementById("new_customer").value="";
 document.getElementById("new_status").value="";
}




