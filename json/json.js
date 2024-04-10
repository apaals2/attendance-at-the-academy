$(function() {
   var row = [];

   $.getJSON("work.json",function(data) {
       $.each(data.row, function(i, f) {
          var tblRow = "<tr>" + "<td>" + f.SIGUN_NM + "</td>" +
           "<td>" + f.CENTER_NM + "</td>" + "<td>" + f.TELNO_INFO + "</td>" + "<td>" + f.REFINE_LOTNO_ADDR + "</td>" + "</tr>"
           $(tblRow).appendTo("#userdata tbody");
     });

   });

});