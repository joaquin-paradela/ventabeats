<x-admin-layout>
	<!-- Bootstrap 
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="css/style_nav.css" rel="stylesheet">-->
	<style>
		.content {
			margin-top: 80px;
		}
	</style>
 
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

<body>
	
	<div class="container">
		<div class="content">
			<h2>Productos &raquo; Agregar</h2>
			<hr />

			<form class="form-horizontal" action="" method="POST">
            @csrf
				<div class="form-group">
					<label class="col-sm-3 control-label">Nombre</label>
					<div class="col-sm-2">
						<input type="text" name="name" class="form-control" placeholder="Nombre" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">Descripcion</label>
					<div class="col-sm-3">
						<textarea name="descripcion" class="form-control" placeholder="Descripcion"></textarea>
					</div>
				</div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Imagen</label>
                    <div class="col-sm-3">
                    <input type="file" name="imagen" class="form-control-file">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Audio</label>
                    <div class="col-sm-3">
                    <input type="file" name="audio" class="form-control-file">
                    </div>
                </div>
  
				<div class="form-group">
					<label class="col-sm-3 control-label">Precio</label>
					<div class="col-sm-3">
						<input type="text" name="price" class="form-control" placeholder="Precio" required>
					</div>
				</div>
				
				<div class="form-group">
					<label class="col-sm-3 control-label">&nbsp;</label>
					<div class="col-sm-6">
						<input type="submit" name="add" id="add" class="btn btn-sm btn-primary" value="Guardar datos">
						<a href="index.php" class="btn btn-sm btn-danger">Cancelar</a>
					</div>
				</div>
			</form>
		</div>
	</div>
 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>


</x-admin-layout>