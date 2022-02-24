const dept = document.getElementById('department-appointment');
const doc = document.getElementById('doctor-appointment');
const doc_item = [];
for(var it of doc.options){
  doc_item.push(it);
}
dept.addEventListener('change',function(event){
  if(event.target.value != 'none'){
    for(var i=0;i < doc_item.length;i++){
      var departmentid = doc_item[i].getAttribute('data-department');
      if(departmentid !== null){
        if(departmentid !== event.target.value){
          if(document.querySelector("#doctor-appointment option[value='"+doc_item[i].value+"']")){
            doc.removeChild(doc_item[i]);
          }
        }else{
          doc.appendChild(doc_item[i]);
        }
      }
    }
  }
});
