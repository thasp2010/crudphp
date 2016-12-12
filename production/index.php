<?php
include_once "classes/DAO/ConfigDB.php";
include_once "classes/DAO/ClientDAO.php";
$stmt  = $Dao->listClient();

?>

<?php
include"header.php";
?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Clientes Cadastrados</h3>
      </div>
      
    </div>

    <div class="clearfix"></div>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <ul class="nav navbar-right panel_toolbox">
              <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
              
              
            </ul>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <table id="datatable" class="table table-striped table-bordered">
              <thead>                    

                <tr>
                  <th>Código</th>
                  <th>Nome</th>
                  <th>Sobrenome</th>
                  <th>Tipo de Pessoa</th>
                  <th>Editar</th>
                  <th>Deletar</th>
                  <th>E-mail</th>
                </tr>
              </thead>

              <tbody>

                <?php 
                while($row=$stmt->fetch(PDO::FETCH_ASSOC))
                {
                  ?>
                  <tr>
                    <td><?php echo($row['id_client']); ?></td>
                    <td><?php echo($row['first_name']); ?></td>
                    <td><?php echo($row['last_name']); ?></td>
                    <td> <?php if (strtoupper($row['type_person']) == ('F')){
                     echo('Pessoa Física');                          
                   }else{
                     echo('Pessoa Jurídica');
                   } 
                   ?>
                 </td>
                 <th> <a href="clientEdit.php?id_client=<?php echo($row['id_client']); ?>">
                  <button type="button" class="btn btn-warning btn-xs"  >Editar</button>
                </a>
              </th>
              <th>
                <a href="classes/ClientController.php?option=delete&&id_client=<?php echo($row['id_client']); ?>">
                  <button type="button" class="btn btn-danger btn-xs">Deletar</button> </a></th>
                  <th>
                    <a href="SendMail.php?id_client=<?php echo($row['id_client']); ?>">

                      <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg">Enviar e-mail</button></th>

                    </tr>
                    <?php 
                  }
                  ?>

                </tbody>
              </table>


              <form id="formPhone"  data-parsley-validate class="form-horizontal form-label-left" method="POST" name="formPhone" action="">
                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">

                      <!-- Telefone -->
                      <div class="x_panel">
                        <div class="x_title">
                          <h2>E-mails</h2>

                          <div class="clearfix"></div>
                        </div>
                        <div class="x_content">

                          <div class="ln_solid"></div>

                          <table class="table table-bordered" id="grid">
                            <thead>
                              <tr>
                                <th>Email</th>
                                <th>Selecionar</th>
                                
                              </tr>
                            </thead>
                            <tbody>

                            </tbody>
                          </table>

                          <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                              <button type="submit" class="btn btn-primary">Cancelar</button>
                              <button type="submit" class="btn btn-success">Enviar e-mail</button>
                            </div>
                          </div>

                        </div>
                      </div>
                    </div>  

                    <!-- end Telefone -->
                  </div>
                </div> <!-- end Modal -->
              </form> <!-- end form Modal -->


            </div>
          </div>
        </div>

      </div>
    </div>
    <!-- /page content -->



  </div>
</div>
<?php
include "footer.php";
?>

<!-- Datatables -->
<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
<script src="../vendors/datatables.net-scroller/js/datatables.scroller.min.js"></script>
<script src="../vendors/jszip/dist/jszip.min.js"></script>
<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

<!-- Datatables -->
<script>
$(document).ready(function() {
  var handleDataTableButtons = function() {
    if ($("#datatable-buttons").length) {
      $("#datatable-buttons").DataTable({
        dom: "Bfrtip",
        buttons: [
        {
          extend: "copy",
          className: "btn-sm"
        },
        {
          extend: "csv",
          className: "btn-sm"
        },
        {
          extend: "excel",
          className: "btn-sm"
        },
        {
          extend: "pdfHtml5",
          className: "btn-sm"
        },
        {
          extend: "print",
          className: "btn-sm"
        },
        ],
        responsive: true
      });
    }
  };

  TableManageButtons = function() {
    "use strict";
    return {
      init: function() {
        handleDataTableButtons();
      }
    };
  }();

  $('#datatable').dataTable();

  $('#datatable-keytable').DataTable({
    keys: true
  });

  $('#datatable-responsive').DataTable();

  $('#datatable-scroller').DataTable({
    ajax: "js/datatables/json/scroller-demo.json",
    deferRender: true,
    scrollY: 380,
    scrollCollapse: true,
    scroller: true
  });

  $('#datatable-fixed-header').DataTable({
    fixedHeader: true
  });

  var $datatable = $('#datatable-checkbox');

  $datatable.dataTable({
    'order': [[ 1, 'asc' ]],
    'columnDefs': [
    { orderable: false, targets: [0] }
    ]
  });
  $datatable.on('draw.dt', function() {
    $('input').iCheck({
      checkboxClass: 'icheckbox_flat-green'
    });
  });

  TableManageButtons.init();
});
</script>
<!-- /Datatables -->

</body>
</html>
