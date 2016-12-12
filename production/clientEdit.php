<?php
include_once "classes/DAO/ConfigDB.php";
include_once "classes/DAO/ClientDAO.php";
include_once "classes/DAO/AddressDAO.php";
include_once "classes/DAO/PhoneDAO.php";
include_once "classes/DAO/EmailDAO.php";

if(isset($_GET['id_client'])){
  $stmt = $Dao->returnClient($_GET['id_client']);
  $row  = $stmt->fetch(PDO::FETCH_ASSOC);
  $stmtPhone = $PhoneDao->listPhones($_GET['id_client']);
  $stmtAddress = $AddressDao->listAddress($_GET['id_client']);
}
?>

<?php
include"header.php";
?>
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Editar Cliente</h3>
      </div>

      
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">

            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />
            <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left" method="POST" name="newClient" action="classes/ClientController.php?option=update">

              <input name="idClient" id="idClient" value="<?php echo $row['id_client']; ?>" hidden>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Nome <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="first-name" required="required" class="form-control col-md-7 col-xs-12"
                  value="<?php echo $row['first_name']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Sobrenome <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="last-name" name="last-name" required="required" class="form-control col-md-7 col-xs-12"
                  value="<?php echo $row['last_name']; ?>">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="typeperson">Tipo de Pessoa <span class="required">*</span></label>
                <div class="col-md-6 col-sm-6 col-xs-12">

                  <select class="form-control" name="typeperson" id="typeperson" name="typeperson" onchange="SelectChanged();" required="required">


                   <?php  if($row['type_person']=="J") { ?>

                   <option value="J" > Jurídica </option>
                   <option value="F" > Física </option>

                   <?php } else{ ?>
                   <option value="F"  >Física </option>
                   <option value="J" > Jurídica </option>
                   <?php } ?>
                   
                 </select>
               </div>
             </div>
             
             <!-- Pessoa Física -->
             <div id="PF"  style="display: none;">
              <div class="form-group">
                <label for="individualRegistration" class="control-label col-md-3 col-sm-3 col-xs-12">CPF</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="individualRegistration" class="form-control col-md-7 col-xs-12" type="text" name="individualRegistration"
                  value="<?php echo $row['individual_registration']; ?>"  required="required">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sexo</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div id="gender" class="btn-group" data-toggle="buttons">
                    <label class="btn btn-default" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" id="gender" name="gender" value="M"> &nbsp; Feminino &nbsp;
                    </label>
                    <label class="btn btn-primary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                      <input type="radio" name="gender" id="gender" value="F"> Masculino
                    </label>
                  </div>
                </div>
              </div>

            </div>   
            <!-- Pessoa Jurídica -->
            <div id="PJ"  style="display: none;">

              <div class="form-group">
                <label for="legalPersonRegistration" class="control-label col-md-3 col-sm-3 col-xs-12">CNPJ</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="legalPersonRegistration" class="form-control col-md-7 col-xs-12" type="text" name="legalPersonRegistration"
                  value="<?php echo $row['legal_person_registration']; ?>">
                </div>
              </div>

              <div class="form-group">
                <label for="stateRegistration" class="control-label col-md-3 col-sm-3 col-xs-12">Inscrição Estadual</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="stateRegistration" class="form-control col-md-7 col-xs-12" type="text" name="stateRegistration"
                  value="<?php echo $row['state_registration']; ?>">
                </div>
              </div>


              <div class="form-group">
                <label for="fancyName" class="control-label col-md-3 col-sm-3 col-xs-12">Nome Fantasia</label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="fancyName" class="form-control col-md-7 col-xs-12" type="text" name="fancyName"
                  value="<?php echo $row['company_fancy_name']; ?>">
                </div>
              </div>

            </div>

            <script type="text/javascript">
            onload =  function () {
             if (document.newClient.typeperson.value == "F")  {
               document.getElementById("PF").style.display = "block";
               document.getElementById("PJ").style.display = "none";
               
             }else
             if (document.newClient.typeperson.value == "J"){
               document.getElementById("PF").style.display = "none";
               document.getElementById("PJ").style.display = "block";
             }else{
               document.getElementById("PF").style.display = "none";
               document.getElementById("PJ").style.display = "none";            

             } 
           }
           </script>



           <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
            <!-- Telefone -->
            <div class="x_panel">
              <div class="x_title">
                <h2>Telefone(s)</h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Descrição <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="descricao"  name="descricao" class="form-control col-md-7 col-xs-12" type="text" name="middle-name" onClick="validCharClick(this.id);"
                    placeholder="Ex: celular.." onkeypress="validCharKeyPress(this.id);" >
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Telefone <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="telefone" name="telefone"  class="form-control col-md-7 col-xs-12" onClick="validCharClick(this.id);" onkeypress="validCharKeyPress(this.id);">
                  </div>
                </div>
                
                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                   <input  class="btn btn-round btn-info" id="#Phone" name="#Phone" type="button" value="Adicionar"  onClick="AddPhone();"/>
                 </div>
               </div>
               <table class="table table-bordered" id="gridPhone">
                <thead>
                  <tr>
                    <th>Telefone</th>
                    <th>Descrição</th>
                    <th>Excluir</th>
                  </tr>
                </thead>
                <tbody>
                 <?php
                 while($rowPhone=$stmtPhone->fetch(PDO::FETCH_ASSOC))
                 {
                  ?>
                  <tr>
                    <td><?php print($rowPhone['phone_number']); ?></td> 
                    <td><?php print($rowPhone['description']); ?></td>                              
                    <td><button type="button" class="fa fa-remove btn btn-danger btn-xs" onclick="deleteRow(this.parentNode.parentNode.rowIndex);" /></td> 
                  </tr>  

                  <?php } ?>   
                  
                </tbody>
              </table>   

              <div id="insertPhone">
                <fieldset style="display: none;">
                  <?php
                  $stmtPhone = $PhoneDao->listPhones($_GET['id_client']);
                  while($rowPhone=$stmtPhone->fetch(PDO::FETCH_ASSOC))
                  {
                    ?>
                    <input type="hiddens" name="telefoneHiden[]" value="<?php print($rowPhone['phone_number']); ?>" id="<?php print($rowPhone['phone_number']); ?>"/>
                    <input type="hidden" name="descricaoHiden[]" value="<?php print($rowPhone['description']); ?>" id="<?php print($rowPhone['phone_number']); ?>"/>

                    <?php } ?>   
                  </fieldset>  
                </div>                                          

              </div>
            </div>




            <!-- Endereço -->
            <div class="x_panel">
              <div class="x_title">
                <h2>Endereço(s)</h2>
                
                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Descrição</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" id="descriptionAddress" name="descriptionAddress" class="form-control" placeholder="Ex: casa.."
                    onClick="validCharClick(this.id);" onkeypress="validCharKeyPress(this.id);" >
                  </div>
                </div>
                
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Endereço</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <input type="text" class="form-control" id="street" name="street" onClick="validCharClick(this.id);" onkeypress="validCharKeyPress(this.id);">
                  </div>
                </div>
                <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">CEP</label>
                  <div class="col-md-3 col-sm-6 col-xs-12">
                    <input id="cep"  name="cep" class="form-control col-md-7 col-xs-12" type="text" name="middle-name" onClick="validCharClick(this.id);" onkeypress="validCharKeyPress(this.id);">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Estado</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control" id="estados" name="state" onchange="validCharKeyPress(this.id);" onClick="validCharClick(this.id);">
                      <option></option>
                      <option value=""></option>
                      
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Cidade</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                    <select class="form-control" name="city" id="cidades" onclick="validCharClick(this);">
                      <option value=""></option>
                      
                    </select>
                  </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                   <input  class="btn btn-round btn-info" id="#Address" name="#Address" type="button" value="Adicionar"  onClick="AddAddress();"/>
                 </div>
               </div>
               <table class="table table-bordered" id="gridAddress">
                <thead>
                  <tr>
                    <th>CEP</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Excluir</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $stmtAddress = $AddressDao->listAddress($_GET['id_client']);
                  while($rowAddress=$stmtAddress->fetch(PDO::FETCH_ASSOC))
                  {
                    ?>

                    <tr>
                      <td><?php print($rowAddress['cep']); ?></td> 
                      <td><?php print($rowAddress['city']); ?></td>                              
                      <td><?php print($rowAddress['state']); ?></td>                              
                      <td><button type="button" class="fa fa-remove btn btn-danger btn-xs" onclick="deleteRowAddress(this.parentNode.parentNode.rowIndex);" /></td> 
                    </tr>  

                    <?php } ?>  
                    
                  </tbody>
                </table>

              </div>
            </div>

            <div id="insertAddress">
              <fieldset style="display: none;">
               <?php
               $stmtAddress = $AddressDao->listAddress($_GET['id_client']);
               while($rowAddress=$stmtAddress->fetch(PDO::FETCH_ASSOC))
               {
                ?>
                
                <input type="hiddens" name="descriptionAddressHidden[]" value="<?php print($rowAddress['description']); ?>" id="<?php print($rowAddress['cep']); ?>"/>
                <input type="hidden" name="streetHidden[]" value="<?php print($rowAddress['street']); ?>" id="<?php print($rowAddress['cep']); ?>"/> 
                <input type="hidden" name="cepHidden[]" value="<?php print($rowAddress['cep']); ?>" id="<?php print($rowAddress['cep']); ?>"/> 
                <input type="hidden" name="stateHidden[]" value="<?php print($rowAddress['state']); ?>" id="<?php print($rowAddress['cep']); ?>"/>                                                                                        
                <input type="hidden" name="cityHidden[]" value="<?php print($rowAddress['city']); ?>" id="<?php print($rowAddress['cep']); ?>"/>                                                                                        

                <?php } ?>  
              </fieldset>  
            </div>


            <!-- Email -->
            <div class="x_panel">
              <div class="x_title">
                <h2>E-mail(s)</h2>

                <div class="clearfix"></div>
              </div>
              <div class="x_content">

                <div class="form-group">
                  <label for="middle-name" class="control-label col-md-3 col-sm-3 col-xs-12">Descrição <span class="required">*</span></label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="descricaoEmail"  name="descricaoEmail" class="form-control col-md-7 col-xs-12" type="text" name="middle-name" onClick="validCharClick(this.id);"
                    placeholder="Ex: pessoal.." onkeypress="validCharKeyPress(this.id);" >
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Email <span class="required">*</span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="email" name="email"  class="form-control col-md-7 col-xs-12" onClick="validCharClick(this.id);" onkeypress="validCharKeyPress(this.id);">
                  </div>
                </div>

                <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <input  class="btn btn-round btn-info" id="Mail" name="Mail" type="button" value="Adicionar"  onClick="AddMail();"/>
                  </div>
                </div>
                <table class="table table-bordered" id="gridMail">
                  <thead>
                    <tr>
                      <th>Email</th>
                      <th>Descrição</th>
                      <th>Excluir</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $stmtEmail = $EmailDao->listEmails($_GET['id_client']);
                    while($rowEmail=$stmtEmail->fetch(PDO::FETCH_ASSOC))
                    {
                      ?>

                      <tr>
                        <td><?php print($rowEmail['description']); ?></td> 
                        <td><?php print($rowEmail['email']); ?></td>                              

                        <td><button type="button" class="fa fa-remove btn btn-danger btn-xs" onclick="deleteRowMail(this.parentNode.parentNode.rowIndex);" /></td> 
                      </tr>  

                      <?php } ?>  

                    </tbody>
                  </table>


                  <div id="insertMail">
                    <fieldset style="display: none;">
                     <?php
                     $stmtEmail = $EmailDao->listEmails($_GET['id_client']);
                     while($rowEmail=$stmtEmail->fetch(PDO::FETCH_ASSOC))
                     {
                      ?>

                      <input type="hidden" name="descricaoEmailHidden[]" value="<?php print($rowEmail['description']); ?>" id="<?php print($rowEmail['email']); ?>"/>
                      <input type="hidden" name="emailHidden[]" value="<?php print($rowEmail['email']); ?>" id="<?php print($rowEmail['email']); ?>"/> 


                      <?php } ?>  
                    </fieldset>  
                  </div>

                </div>
              </div>


              <br/>
              <br/>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                 <a href="index.php">
                  <button type="button" class="btn btn-primary" id="btncancel">Cancelar</button>
                </a>
                <button type="submit" class="btn btn-success" id="btnsave" name="btnsave">Atualizar</button>
              </div>
            </div>
          </div>	
        </div>


      </form>
    </div>
  </div>
</div>
</div>

<?php
include "footer.php";
?>


<!-- bootstrap-daterangepicker -->
<script src="../vendors/moment/min/moment.min.js"></script>
<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap-wysiwyg -->
<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="../vendors/google-code-prettify/src/prettify.js"></script>
<!-- jQuery Tags Input -->
<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
<!-- Switchery -->
<script src="../vendors/switchery/dist/switchery.min.js"></script>
<!-- Select2 -->
<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Parsley -->
<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
<!-- Autosize -->
<script src="../vendors/autosize/dist/autosize.min.js"></script>
<!-- jQuery autocomplete -->
<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
<!-- starrr -->
<script src="../vendors/starrr/dist/starrr.js"></script>

<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

<!-- bootstrap-daterangepicker -->
<script>
$(document).ready(function() {
  $('#birthday').daterangepicker({
    singleDatePicker: true,
    calender_style: "picker_4"
  }, function(start, end, label) {
    console.log(start.toISOString(), end.toISOString(), label);
  });
});
</script>
<!-- /bootstrap-daterangepicker -->

<!-- bootstrap-wysiwyg -->
<script>
$(document).ready(function() {
  function initToolbarBootstrapBindings() {
    var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
    'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
    'Times New Roman', 'Verdana'
    ],
    fontTarget = $('[title=Font]').siblings('.dropdown-menu');
    $.each(fonts, function(idx, fontName) {
      fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
    });
    $('a[title]').tooltip({
      container: 'body'
    });
    $('.dropdown-menu input').click(function() {
      return false;
    })
    .change(function() {
      $(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
    })
    .keydown('esc', function() {
      this.value = '';
      $(this).change();
    });

    $('[data-role=magic-overlay]').each(function() {
      var overlay = $(this),
      target = $(overlay.data('target'));
      overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
    });

    if ("onwebkitspeechchange" in document.createElement("input")) {
      var editorOffset = $('#editor').offset();

      $('.voiceBtn').css('position', 'absolute').offset({
        top: editorOffset.top,
        left: editorOffset.left + $('#editor').innerWidth() - 35
      });
    } else {
      $('.voiceBtn').hide();
    }
  }

  function showErrorAlert(reason, detail) {
    var msg = '';
    if (reason === 'unsupported-file-type') {
      msg = "Unsupported format " + detail;
    } else {
      console.log("error uploading file", reason, detail);
    }
    $('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
      '<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
  }

  initToolbarBootstrapBindings();

  $('#editor').wysiwyg({
    fileUploadError: showErrorAlert
  });

  window.prettyPrint;
  prettyPrint();
});
</script>
<!-- /bootstrap-wysiwyg -->

<!-- Select2 -->
<script>
$(document).ready(function() {
  $(".select2_single").select2({
    placeholder: "Select a state",
    allowClear: true
  });
  $(".select2_group").select2({});
  $(".select2_multiple").select2({
    maximumSelectionLength: 4,
    placeholder: "With Max Selection limit 4",
    allowClear: true
  });
});
</script>
<!-- /Select2 -->

<!-- jQuery Tags Input -->
<script>
function onAddTag(tag) {
  alert("Added a tag: " + tag);
}

function onRemoveTag(tag) {
  alert("Removed a tag: " + tag);
}

function onChangeTag(input, tag) {
  alert("Changed a tag: " + tag);
}

$(document).ready(function() {
  $('#tags_1').tagsInput({
    width: 'auto'
  });
});
</script>
<!-- /jQuery Tags Input -->

<!-- Parsley -->
<script>
$(document).ready(function() {
  $.listen('parsley:field:validate', function() {
    validateFront();
  });
  $('#demo-form2.btn').on('click', function() {
    $('#demo-form2').parsley().validate();
    validateFront();
  });
  var validateFront = function() {
    if (true === $('#demo-form2').parsley().isValid()) {
      $('.bs-callout-info').removeClass('hidden');
      $('.bs-callout-warning').addClass('hidden');
    } else {
      $('.bs-callout-info').addClass('hidden');
      $('.bs-callout-warning').removeClass('hidden');
    }
  };
});

$(document).ready(function() {
  $.listen('parsley:field:validate', function() {
    validateFront();
  });
  $('#demo-form2 .btn').on('click', function() {
    $('#demo-form2').parsley().validate();
    validateFront();
  });
  var validateFront = function() {
    if (true === $('#demo-form2').parsley().isValid()) {
      $('.bs-callout-info').removeClass('hidden');
      $('.bs-callout-warning').addClass('hidden');
    } else {
      $('.bs-callout-info').addClass('hidden');
      $('.bs-callout-warning').removeClass('hidden');
    }
  };
});
try {
  hljs.initHighlightingOnLoad();
} catch (err) {}
</script>
<!-- /Parsley -->

<!-- Autosize -->
<script>
$(document).ready(function() {
  autosize($('.resizable_textarea'));
});
</script>
<!-- /Autosize -->

<!-- jQuery autocomplete -->
<script>
$(document).ready(function() {
  var countries = { AD:"Andorra",A2:"Andorra Test",AE:"United Arab Emirates",AF:"Afghanistan",AG:"Antigua and Barbuda",AI:"Anguilla",AL:"Albania",AM:"Armenia",AN:"Netherlands Antilles",AO:"Angola",AQ:"Antarctica",AR:"Argentina",AS:"American Samoa",AT:"Austria",AU:"Australia",AW:"Aruba",AX:"Åland Islands",AZ:"Azerbaijan",BA:"Bosnia and Herzegovina",BB:"Barbados",BD:"Bangladesh",BE:"Belgium",BF:"Burkina Faso",BG:"Bulgaria",BH:"Bahrain",BI:"Burundi",BJ:"Benin",BL:"Saint Barthélemy",BM:"Bermuda",BN:"Brunei",BO:"Bolivia",BQ:"British Antarctic Territory",BR:"Brazil",BS:"Bahamas",BT:"Bhutan",BV:"Bouvet Island",BW:"Botswana",BY:"Belarus",BZ:"Belize",CA:"Canada",CC:"Cocos [Keeling] Islands",CD:"Congo - Kinshasa",CF:"Central African Republic",CG:"Congo - Brazzaville",CH:"Switzerland",CI:"Côte d’Ivoire",CK:"Cook Islands",CL:"Chile",CM:"Cameroon",CN:"China",CO:"Colombia",CR:"Costa Rica",CS:"Serbia and Montenegro",CT:"Canton and Enderbury Islands",CU:"Cuba",CV:"Cape Verde",CX:"Christmas Island",CY:"Cyprus",CZ:"Czech Republic",DD:"East Germany",DE:"Germany",DJ:"Djibouti",DK:"Denmark",DM:"Dominica",DO:"Dominican Republic",DZ:"Algeria",EC:"Ecuador",EE:"Estonia",EG:"Egypt",EH:"Western Sahara",ER:"Eritrea",ES:"Spain",ET:"Ethiopia",FI:"Finland",FJ:"Fiji",FK:"Falkland Islands",FM:"Micronesia",FO:"Faroe Islands",FQ:"French Southern and Antarctic Territories",FR:"France",FX:"Metropolitan France",GA:"Gabon",GB:"United Kingdom",GD:"Grenada",GE:"Georgia",GF:"French Guiana",GG:"Guernsey",GH:"Ghana",GI:"Gibraltar",GL:"Greenland",GM:"Gambia",GN:"Guinea",GP:"Guadeloupe",GQ:"Equatorial Guinea",GR:"Greece",GS:"South Georgia and the South Sandwich Islands",GT:"Guatemala",GU:"Guam",GW:"Guinea-Bissau",GY:"Guyana",HK:"Hong Kong SAR China",HM:"Heard Island and McDonald Islands",HN:"Honduras",HR:"Croatia",HT:"Haiti",HU:"Hungary",ID:"Indonesia",IE:"Ireland",IL:"Israel",IM:"Isle of Man",IN:"India",IO:"British Indian Ocean Territory",IQ:"Iraq",IR:"Iran",IS:"Iceland",IT:"Italy",JE:"Jersey",JM:"Jamaica",JO:"Jordan",JP:"Japan",JT:"Johnston Island",KE:"Kenya",KG:"Kyrgyzstan",KH:"Cambodia",KI:"Kiribati",KM:"Comoros",KN:"Saint Kitts and Nevis",KP:"North Korea",KR:"South Korea",KW:"Kuwait",KY:"Cayman Islands",KZ:"Kazakhstan",LA:"Laos",LB:"Lebanon",LC:"Saint Lucia",LI:"Liechtenstein",LK:"Sri Lanka",LR:"Liberia",LS:"Lesotho",LT:"Lithuania",LU:"Luxembourg",LV:"Latvia",LY:"Libya",MA:"Morocco",MC:"Monaco",MD:"Moldova",ME:"Montenegro",MF:"Saint Martin",MG:"Madagascar",MH:"Marshall Islands",MI:"Midway Islands",MK:"Macedonia",ML:"Mali",MM:"Myanmar [Burma]",MN:"Mongolia",MO:"Macau SAR China",MP:"Northern Mariana Islands",MQ:"Martinique",MR:"Mauritania",MS:"Montserrat",MT:"Malta",MU:"Mauritius",MV:"Maldives",MW:"Malawi",MX:"Mexico",MY:"Malaysia",MZ:"Mozambique",NA:"Namibia",NC:"New Caledonia",NE:"Niger",NF:"Norfolk Island",NG:"Nigeria",NI:"Nicaragua",NL:"Netherlands",NO:"Norway",NP:"Nepal",NQ:"Dronning Maud Land",NR:"Nauru",NT:"Neutral Zone",NU:"Niue",NZ:"New Zealand",OM:"Oman",PA:"Panama",PC:"Pacific Islands Trust Territory",PE:"Peru",PF:"French Polynesia",PG:"Papua New Guinea",PH:"Philippines",PK:"Pakistan",PL:"Poland",PM:"Saint Pierre and Miquelon",PN:"Pitcairn Islands",PR:"Puerto Rico",PS:"Palestinian Territories",PT:"Portugal",PU:"U.S. Miscellaneous Pacific Islands",PW:"Palau",PY:"Paraguay",PZ:"Panama Canal Zone",QA:"Qatar",RE:"Réunion",RO:"Romania",RS:"Serbia",RU:"Russia",RW:"Rwanda",SA:"Saudi Arabia",SB:"Solomon Islands",SC:"Seychelles",SD:"Sudan",SE:"Sweden",SG:"Singapore",SH:"Saint Helena",SI:"Slovenia",SJ:"Svalbard and Jan Mayen",SK:"Slovakia",SL:"Sierra Leone",SM:"San Marino",SN:"Senegal",SO:"Somalia",SR:"Suriname",ST:"São Tomé and Príncipe",SU:"Union of Soviet Socialist Republics",SV:"El Salvador",SY:"Syria",SZ:"Swaziland",TC:"Turks and Caicos Islands",TD:"Chad",TF:"French Southern Territories",TG:"Togo",TH:"Thailand",TJ:"Tajikistan",TK:"Tokelau",TL:"Timor-Leste",TM:"Turkmenistan",TN:"Tunisia",TO:"Tonga",TR:"Turkey",TT:"Trinidad and Tobago",TV:"Tuvalu",TW:"Taiwan",TZ:"Tanzania",UA:"Ukraine",UG:"Uganda",UM:"U.S. Minor Outlying Islands",US:"United States",UY:"Uruguay",UZ:"Uzbekistan",VA:"Vatican City",VC:"Saint Vincent and the Grenadines",VD:"North Vietnam",VE:"Venezuela",VG:"British Virgin Islands",VI:"U.S. Virgin Islands",VN:"Vietnam",VU:"Vanuatu",WF:"Wallis and Futuna",WK:"Wake Island",WS:"Samoa",YD:"People's Democratic Republic of Yemen",YE:"Yemen",YT:"Mayotte",ZA:"South Africa",ZM:"Zambia",ZW:"Zimbabwe",ZZ:"Unknown or Invalid Region" };

  var countriesArray = $.map(countries, function(value, key) {
    return {
      value: value,
      data: key
    };
  });

        // initialize autocomplete with custom appendTo
        $('#autocomplete-custom-append').autocomplete({
          lookup: countriesArray
        });
      });
</script>
<!-- /jQuery autocomplete -->

<!-- Starrr -->
<script>
$(document).ready(function() {
  $(".stars").starrr();

  $('.stars-existing').starrr({
    rating: 4
  });

  $('.stars').on('starrr:change', function (e, value) {
    $('.stars-count').html(value);
  });

  $('.stars-existing').on('starrr:change', function (e, value) {
    $('.stars-count-existing').html(value);
  });
});
</script>
<!-- /Starrr -->

<!-- Type Person -->
<script type="text/javascript">
function SelectChanged() {
 if (document.newClient.typeperson.value == "F")  {
   document.getElementById("PF").style.display = "block";
   document.getElementById("PJ").style.display = "none";
   
 }else
 if (document.newClient.typeperson.value == "J"){
   document.getElementById("PF").style.display = "none";
   document.getElementById("PJ").style.display = "block";
 }else{
   document.getElementById("PF").style.display = "none";
   document.getElementById("PJ").style.display = "none";            

 } 
}
</script>

<script type="text/javascript">
function deleteRow(i){
        //document.getElementById('gridPhone').deleteRow(i);
        var table, row;
        
        table = document.getElementById('gridPhone').rows;
        for(j=0;j< table.length;j++){
         if (table[j].rowIndex == i){
           row = table[j];
           break; 
         } 
         
       }
        //alert(row.firstElementChild.innerHTML);
        id = row.firstElementChild.innerHTML;
        hiddens = document.getElementById('insertPhone').getElementsByTagName('input');

        for(k=0;k<hiddens.length;k++){
          if (hiddens[k].id == id){
            input = hiddens[k];
            break;
          }
        }

        input.remove();     
        document.getElementById('gridPhone').deleteRow(i);  
        
      }
      </script>

      <!-- cadastro temporário telefone -->
      <script type="text/javascript">
      function AddPhone(){

        if (document.getElementById('descricao').value == "") {
          document.getElementById('descricao').style.backgroundColor = "#FAEDEC";
          document.getElementById('descricao').style.border          = "1px solid #E85445";
          exit();
        }
        if (document.getElementById('telefone').value == "") {
          document.getElementById('telefone').style.backgroundColor = "#FAEDEC";
          document.getElementById('telefone').style.border          = "1px solid #E85445";
          exit();
        }


        $(document).ready(function(){
          var $this = $( this );
          

          var tr = '<tr>'+
          '<td>'+$this.find("input[name='telefone']").val()+'</td>'+
          '<td>'+$this.find("input[name='descricao']").val()+'</td>'+
          '<td><button type="button" class="fa fa-remove btn btn-danger btn-xs" onclick="deleteRow(this.parentNode.parentNode.rowIndex)" ></button></td>'+
          '</tr>'
          $('#gridPhone').find('tbody').append( tr );

          var hiddens = '<input type="hidden" name="telefoneHiden[]" value="'+$this.find("input[name='telefone']").val()+'" id="'+$this.find("input[name='telefone']").val()+'" />'+
          '<input type="hidden" name="descricaoHiden[]" value="'+$this.find("input[name='descricao']").val()+'" id="'+$this.find("input[name='telefone']").val()+'"/>';

          $('#insertPhone').find('fieldset').append( hiddens );

          //alert(hiddens);

          $this.find("input[name='telefone']").val("");
          $this.find("input[name='descricao']").val("");            

          return false;
          
        });
}
</script>

<script type="text/javascript">
function validCharClick(id){  

  document.getElementById(id).style.border = "1px solid #ccc";
  
}

function validCharKeyPress(id){
  document.getElementById(id).style.backgroundColor = "#fff";
}
</script>


<script type="text/javascript">

function deleteRowAddress(i){
        //document.getElementById('gridPhone').deleteRow(i);
        var table, row;
        
        table = document.getElementById('gridAddress').rows;
        for(j=0;j< table.length;j++){
         if (table[j].rowIndex == i){
           row = table[j];
           break; 
         } 
         
       }
        //alert(row.firstElementChild.innerHTML);
        id = row.firstElementChild.innerHTML;
        hiddens = document.getElementById('insertAddress').getElementsByTagName('input');

        for(k=0;k<hiddens.length;k++){
          if (hiddens[k].id == id){
            input = hiddens[k];
            break;
          }
        }

        input.remove();     
        document.getElementById('gridAddress').deleteRow(i);  
        
      }

  </script>

      <script type="text/javascript"> 
      
      $(document).ready(function () {

        $.getJSON('estados_cidades.json', function (data) {
          var items = [];
          var options = '<option value=""></option>';  
          $.each(data, function (key, val) {
            options += '<option value="' + val.nome + '">' + val.nome + '</option>';
          });         
          $("#estados").html(options);        
          
          $("#estados").change(function () {        

            var options_cidades = '';
            var str = "";         
            
            $("#estados option:selected").each(function () {
              str += $(this).text();
            });
            
            $.each(data, function (key, val) {
              if(val.nome == str) {             
                $.each(val.cidades, function (key_city, val_city) {
                  options_cidades += '<option value="' + val_city + '">' + val_city + '</option>';
                });             
              }
            });
            $("#cidades").html(options_cidades);
            
          }).change();    
          
        });

});

</script> 



<script type="text/javascript">
function AddAddress(){

  if (document.getElementById('descriptionAddress').value == "") {
    document.getElementById('descriptionAddress').style.backgroundColor = "#FAEDEC";
    document.getElementById('descriptionAddress').style.border          = "1px solid #E85445";
    exit();
  }
  if (document.getElementById('street').value == "") {
    document.getElementById('street').style.backgroundColor = "#FAEDEC";
    document.getElementById('street').style.border          = "1px solid #E85445";
    exit();
  }

  if (document.getElementById('cep').value == "") {
    document.getElementById('cep').style.backgroundColor = "#FAEDEC";
    document.getElementById('cep').style.border          = "1px solid #E85445";
    exit();
  }

  if (document.getElementById('estados').value == "") {
    document.getElementById('estados').style.backgroundColor = "#FAEDEC";
    document.getElementById('estados').style.border          = "1px solid #E85445";
    exit();
  }

  if (document.getElementById('cidades').value == "") {
    document.getElementById('cidades').style.backgroundColor = "#FAEDEC";
    document.getElementById('cidades').style.border          = "1px solid #E85445";
    exit();
  }


  $(document).ready(function(){
    var $this = $( this );
    

    var tr = '<tr>'+
    '<td>'+$this.find("input[name='cep']").val()+'</td>'+
    '<td>'+$this.find("select[name='city']").val()+'</td>'+
    '<td>'+$this.find("select[name='state']").val()+'</td>'+            
    '<td><button type="button" class="fa fa-remove btn btn-danger btn-xs" onclick="deleteRowAddress(this.parentNode.parentNode.rowIndex)" ></button></td>'+
    '</tr>'
    $('#gridAddress').find('tbody').append( tr );

    var hiddens = '<input type="hidden" name="descriptionAddressHidden[]" value="'+$this.find("input[name='descriptionAddress']").val()+'" id="'+$this.find("input[name='cep']").val()+'" />'+
    '<input type="hidden" name="streetHidden[]" value="'+$this.find("input[name='street']").val()+'" id="'+$this.find("input[name='cep']").val()+'"/>'+
    '<input type="hidden" name="cepHidden[]" value="'+$this.find("input[name='cep']").val()+'" id="'+$this.find("input[name='cep']").val()+'"/>'+
    '<input type="hidden" name="stateHidden[]" value="'+$this.find("select[name='state']").val()+'" id="'+$this.find("select[name='cep']").val()+'"/>'+
    '<input type="hidden" name="cityHidden[]" value="'+$this.find("select[name='city']").val()+'" id="'+$this.find("select[name='city']").val()+'"/>';

    $('#insertAddress').find('fieldset').append( hiddens );

          //alert(hiddens);

          $this.find("input[name='descriptionAddress']").val("");
          $this.find("input[name='cep']").val("");
          $this.find("select[name='city']").val("");           
          $this.find("select[name='state']").val("");            
          $this.find("input[name='street']").val("");                         

          return false;
          
        });
}
</script>


<!-- cadastro temporário email -->
<script type="text/javascript">
function AddMail(){

  if (document.getElementById('descricaoEmail').value == "") {
    document.getElementById('descricaoEmail').style.backgroundColor = "#FAEDEC";
    document.getElementById('descricaoEmail').style.border          = "1px solid #E85445";
    exit();
  }
  if (document.getElementById('email').value == "") {
    document.getElementById('email').style.backgroundColor = "#FAEDEC";
    document.getElementById('email').style.border          = "1px solid #E85445";
    exit();
  }


  $(document).ready(function(){
    var $this = $( this );
    

    var tr = '<tr>'+
    '<td>'+$this.find("input[name='email']").val()+'</td>'+
    '<td>'+$this.find("input[name='descricaoEmail']").val()+'</td>'+
    '<td><button type="button" class="fa fa-remove btn btn-danger btn-xs" onclick="deleteRowMail(this.parentNode.parentNode.rowIndex)" ></button></td>'+
    '</tr>'
    $('#gridMail').find('tbody').append( tr );

    var hiddens = '<input type="hidden" name="emailHidden[]" value="'+$this.find("input[name='email']").val()+'" id="'+$this.find("input[name='email']").val()+'" />'+
    '<input type="hidden" name="descricaoEmailHidden[]" value="'+$this.find("input[name='descricaoEmail']").val()+'" id="'+$this.find("input[name='email']").val()+'"/>';

    $('#insertMail').find('fieldset').append( hiddens );

          //alert(hiddens);

          $this.find("input[name='email']").val("");
          $this.find("input[name='descricaoEmail']").val("");            

          return false;
          
        });
}
</script>

<script type="text/javascript">

function deleteRowMail(i){

  var table, row;

  table = document.getElementById('gridMail').rows;
  for(j=0;j< table.length;j++){
   if (table[j].rowIndex == i){
     row = table[j];
     break; 
   } 

 }

 id = row.firstElementChild.innerHTML;
 hiddens = document.getElementById('insertMail').getElementsByTagName('input');

 for(k=0;k<hiddens.length;k++){
  if (hiddens[k].id == id){
    input = hiddens[k];
    break;
  }
}

input.remove();     
document.getElementById('gridMail').deleteRow(i);  

}

</script>



