<html>

   <head>
      <title>The jQuery Example</title>
      <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
       
      <script>
         $(document).ready(function() {
           
            $("#driver").click(function(event){
               
               $.post(
                  "serealize.php",
                  $("#testform").serializeArray(),
                  function(data) {
                     $('#stage1').html(data);
                  }
               );
                   
               var fields = $("#testform").serializeArray();
               $("#stage2").empty();
                   
               jQuery.each(fields, function(i, field){
                  $("#stage2").append(field.value + " ");
               });
                   
            });
               
         });
      </script>
   </head>
   
   <body>
   
      <p>Click on the button to load result.html file:</p>
       
      <div id = "stage1" style = "background-color:maroon;color:white;">
         STAGE - 1
      </div>
       
      <br />
       
      <div id = "stage2" style = "background-color:maroon;color:white;">
         STAGE - 2
      </div>
       
      <form id = "testform">
       
         <table>
           
            <tr>
               <td><p>Name:</p></td>
               <td><input type = "text" name = "name[]" size = "40" /></td>
            </tr>
            
            <tr>
               <td><p>Name2:</p></td>
               <td><input type = "text" name = "name[]" size = "40" /></td>
            </tr>
            <tr>
               <td><p>Age:</p></td>
               <td><input type = "text" name = "age" size = "40" /></td>
            </tr>
               
            <tr>
               <td><p>Sex:</p></td>
               <td> <select name = "sex">
                  <option value = "Male" selected>Male</option>
                  <option value = "Female" selected>Female</option>
               </select></td>
            </tr>
               
            <tr>
               <td colspan = "2">
                  <input type = "button" id = "driver" value = "Load Data" />
               </td>
            </tr>  
               
         </table>
           
      </form>
       
   </body>
   
</html>