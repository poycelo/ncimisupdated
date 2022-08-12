
<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
  <title>DataTables example - With ColReorder</title>
  <link rel="shortcut icon" type="image/png" href="/media/images/favicon.png">
  <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="http://www.datatables.net/rss.xml">
  <link rel="stylesheet" type="text/css" href="/media/css/site-examples.css?_=6a23f3bca2453d0655063d05483e97a4">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/colreorder/1.5.2/css/colReorder.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedheader/3.1.7/css/fixedHeader.dataTables.min.css">
  <style type="text/css" class="init">
  
  </style>
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/colreorder/1.5.2/js/dataTables.colReorder.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.flash.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.print.min.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/fixedheader/3.1.7/js/dataTables.fixedHeader.min.js"></script>
  <script type="text/javascript" class="init">
  




$(document).ready(function() {

      // Setup - add a text input to each footer cell
      $('#example thead tr').clone(true).appendTo( '#example thead' );
      $('#example thead tr:eq(1) th').each( function (i) {
          var title = $(this).text();
          $(this).html( '<input type="text"/>' );
   
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  
                table
                      .column(i)
                      .search( this.value )
                      .draw();
              }
          } );
      } );


      var table = $('#example').DataTable( {
        
        "dom": 'Bfrtip',
        "buttons": [
            {
                "extend": 'copyHtml5',
                "exportOptions": {
                    "columns": [ 0, ':visible' ]
                }
            },
            {
                "extend": 'excelHtml5',
                "exportOptions": {
                    "columns": ':visible'
                }
            },
            {
                "extend": 'csvHtml5',
                "exportOptions": {
                    "columns": ':visible'
                }
            },
            {
                "extend": 'pdfHtml5',
                "exportOptions": {
                    "columns": ':visible'
                }
            }
        ],
        "responsive": true,
        "colReorder": true,
        "scrollY": "400px",
        "scrollX": true,
        "paging": false,
        "orderCellsTop": true,
        "fixedHeader": true
      } );

      $('a.toggle-vis').on('click', function (e) {
        e.preventDefault();

        // Get the column API object
        var column = table.column( $(this).attr('data-column') );

        // Toggle the visibility
        column.visible( ! column.visible() );
        $(this).find('input[type=checkbox]').prop("checked", !$(this).find('input[type=checkbox]').prop("checked"));
      
      } );

    } );


  </script>
</head>
<body class="wide comments example">
  <div class="fw-container">
    <div class="fw-body">
      <div class="content">
        <h1 class="page_title">Table ni menmen</h1>
        <div class="demo-html">

           <div class="collapse" id="collapseExample">

                  <b>Select Columns to Show</b></label><br>
                  <a class="btn btn-sm btn-select-col toggle-vis" data-column="0" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;First Name</a>
                  <a class="btn btn-sm btn-select-col toggle-vis" data-column="1" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;Last Name</a>
                  <a class="btn btn-sm btn-select-col toggle-vis" data-column="2" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;Position</a>
                  <a class="btn btn-sm btn-select-col toggle-vis" data-column="3" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;Office</a>
                  <a class="btn btn-sm btn-select-col toggle-vis" data-column="4" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;Age</a>
                  <a class="btn btn-sm btn-select-col toggle-vis" data-column="5" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;Start date</a>
                  <a class="btn btn-sm btn-select-col toggle-vis" data-column="6" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;Salary</a>
                  <a class="btn btn-sm btn-select-col toggle-vis" data-column="7" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;Ext</a>
                  <a class="btn btn-sm btn-select-col toggle-vis" data-column="8" ><input type="checkbox" class="cb-element" checked=""/>&nbsp;Email</a>

                  <br><br>

          </div>

          <table id="example" class="display nowrap" style="width:100%">
            <thead>
              <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
                <th>Start date</th>
                <th>Salary</th>
                <th>Extn.</th>
                <th>E-mail</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>Tiger</td>
                <td>Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
              </tr>
              <tr>
                <td>Garrett</td>
                <td>Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
                <td>8422</td>
                <td>g.winters@datatables.net</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
              </tr>
              <tr>
                <td>Ashton</td>
                <td>Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
                <td>1562</td>
                <td>a.cox@datatables.net</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
                <td>5421</td>
                <td>t.nixon@datatables.net</td>
              </tr>
              
            </tbody>
          </table>
        </div>
       
</body>
</html>