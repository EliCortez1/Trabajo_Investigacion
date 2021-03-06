<?php if(!isset($Translation)){ @header('Location: index.php?signIn=1'); exit; } ?>
<?php include_once("$currDir/header.php"); ?>

<?php if($_GET['loginFailed']){ ?>
	<div class="alert alert-danger"><?php echo $Translation['login failed']; ?></div>
<?php } ?>

<div class="row">
	<div class="col-sm-6 col-lg-8" id="login_splash">
		<!-- customized splash content here -->
	</div>
	<div class="col-sm-6 col-lg-4">
		<div class="panel panel-success">

			<div class="panel-heading">
				<h1 class="panel-title"><strong>Formulario Ingreso<?php echo $Translation['']; ?></strong></h1>
				<?php if(sqlValue("select count(1) from membership_groups where allowSignup=1")){ ?>
					<a class="btn btn-success pull-right" href="membership_signup.php"><?php echo $Translation['']; ?></a>
				<?php } ?>
				<div class="clearfix"></div>
			</div>

			<div class="panel-body">
				<form method="post" action="index.php">
					<div class="form-group">
						<label class="control-label" for="username">Usuario<?php echo $Translation['']; ?></label>
						<input class="form-control" name="username" id="username" type="text" placeholder="<?php echo $Translation['username']; ?>" required>
					</div>
					<div class="form-group">
						<label class="control-label" for="password">Contraseña<?php echo $Translation['']; ?></label>
						<input class="form-control" name="password" id="password" type="password" placeholder="<?php echo $Translation['password']; ?>" required>
						<span class="help-block"><?php echo $Translation['']; ?></span>
					</div>
					<div class="checkbox">
						<label class="control-label" for="rememberMe">
							<input type="checkbox" name="rememberMe" id="rememberMe" value="1"> Recordar Contraseña <?php echo $Translation['']; ?>
						</label>
					</div>

					<div class="row">
						<div class="col-sm-offset-3 col-sm-6">
							<button name="signIn" type="submit" id="submit" value="signIn" class="btn btn-primary btn-lg btn-block">Ingresar<?php echo $Translation['']; ?></button>
						</div>
					</div>
				</form>
			</div>

			<?php if(is_array(getTableList()) && count(getTableList())){ /* if anon. users can see any tables ... */ ?>
				<div class="panel-footer">
					<?php echo $Translation['browse as guest']; ?>
				</div>
			<?php } ?>

		</div>
	</div>
</div>

<script>document.getElementById('username').focus();</script>
<?php include_once("$currDir/footer.php"); ?>
