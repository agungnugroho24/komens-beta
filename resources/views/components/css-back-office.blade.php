<style type="text/css">
button.details-data {
    background: url('{{CSIRTHelper::csirt_asset("assets/general/datatables/images/vv.png")}}') no-repeat center center;
    padding: 10px;
    border: none;
    cursor: pointer;
}

button.details-data:focus {
    outline:none !important;
    cursor: pointer;
}

tr.shown button.details-data {
    background: url('{{CSIRTHelper::csirt_asset("assets/general/datatables/images/xx.png")}}') no-repeat center center;
}

tr.shown button.details-data:focus {
    outline:none !important;
}

input[type="checkbox"][readonly] {
  pointer-events: none;
}  

table.dataTable td, input {
  font-size: 13px;
}

table.dataTable th {
  font-size: 13.5px;
}

div.dataTables_wrapper{
  font-size: 13px;
}


</style>