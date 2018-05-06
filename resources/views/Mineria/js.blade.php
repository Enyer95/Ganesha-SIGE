<script type="text/javascript">

    var nextQuery= ' ';
    var form = ' ';
    var coun = 0;

    var campos = [];
    
    function query(element) {

      var id= element.id;
      var value= element.value;

      este =  value.split('.')[1];
      campos.push(este);
      if(nextQuery == ' '){
        nextQuery = ' '+value;
        form = ' '+id;
        if(id == 'mpuentemasters'){
          coun=coun+1;
        }
      }
      else {
        nextQuery = nextQuery+', '+value;
        if(id == 'mpuentemasters' && coun == 0){
          form = form+', '+id;
          coun=coun+1;
        }
        else{
          if(id != 'mpuentemasters'){
            form = form+', '+id;
          }
        }
      }



      console.log(nextQuery+' FROM '+form+';');
      console.log(campos);
      $.get("/queryMineria/"+nextQuery+' FROM '+form+'', function(data){
          console.log(data);
          $('#divMostrar').remove();
          $('#divCantidad').append('<b id="divMostrar"><span class="notification-tag tag tag-default tag-danger float-xs-right m-0">'+data+'</span></b>');
          $('#minimo').attr('max', data);
          $('#maximo').attr('max', data);

          $('#newQuery').val(nextQuery+' FROM '+form);
          $('#celdas').val(campos);
      });
    }

</script>
