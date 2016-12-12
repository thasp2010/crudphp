<?php
include_once "Classes/DAO/ConfigDB.php";
include_once "Classes/DAO/EmailDAO.php";

if(isset($_GET['id_client'])){
	$stmtEmail = $EmailDao->listEmails($_GET['id_client']);
}
?>

<?php
include"header.php";
?>

<div class="right_col" role="main">
	<div class="">
		<div class="page-title">
			<div class="title_left">
				<h3>Enviar E-mail</h3>
			</div>

			<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

				<div class="x_panel">
					<div class="x_title">
						<h2>Telefone(s)</h2>

						<div class="clearfix"></div>
					</div>
					<div class="x_content">

						<form method="POST" action="classes/MailController.php">

							<table class="table table-bordered" id="gridPhone">
								<thead>
									<tr>
										<th>Telefone</th>
										<th>Descrição</th>
										<th>Selecionar</th>
									</tr>
								</thead>
								<tbody>
									<tbody>
										<?php
										$stmtEmail = $EmailDao->listEmails($_GET['id_client']);
										while($rowEmail=$stmtEmail->fetch(PDO::FETCH_ASSOC))
										{
											?>

											<tr>
												<td><?php print($rowEmail['description']); ?></td> 
												<td><?php print($rowEmail['email']); ?></td>                              

												<td><input type="checkbox" name="mail[]" value="<?php print($rowEmail['email']); ?>"></td>
											</tr>  

											<?php } ?>  

										</tbody>
									</tbody>
								</table>

								<div id="insertPhone">
									<fieldset style="display: none;"></fieldset>  
								</div>

							</div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
									<button type="submit" class="btn btn-primary">Cancelar</button>
									<button type="submit" class="btn btn-success">Enviar e-mail de teste</button>
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