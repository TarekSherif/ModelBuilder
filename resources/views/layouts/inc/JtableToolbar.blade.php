toolbar: {
    items: [
    @if ($Permission["DataToPrint"]) 
          {
              Tooltip: '@lang("messages.tipPrint")',
              icon: '{{url("/")}}/images/printer.png',
              text: '@lang("messages.Print")',
             
              click: function (e) {
                 var jtable=$('.jtable'); 
                 var newWindow = window.open();
                  var html=`<!DOCTYPE html>
                  <html>
                     <head>
                             <title>{{$view_name}}-Report</title>
                             <link rel="stylesheet" href="{{url("/")}}/css/print.css">
                     </head>
                     <body>
                         <table>`
                             + $(jtable).html() +
                         `</table>
                     </body>`;
                
                  newWindow.document.write(html);
                  newWindow.print();
                  e.preventDefault();
              }
          },
    @endif
    @if ($Permission["DataToExcel"]) 
        {
        tooltip: '@lang("messages.tipExcel")',
        icon: '{{url("/")}}/Images/excel.png',
        text: '@lang("messages.Excel")',
        click: function (e) {
                 $(".jtable").table2excel({
                 exclude: ".noExl",
                 name: "Excel Document Name",
                 filename: "{{$view_name}}",
                 fileext: ".xls",
                 exclude_img: true,
                 exclude_links: true,
                 exclude_inputs: true
             });
             e.preventDefault();
         
        }
    }
    @endif
    ]
}