<?php 
$query_empresa=mysqli_query($con,"select * from perfil where id_perfil=1");
  $row=mysqli_fetch_array($query_empresa);
?>

<div class="navbar navbar-default navbar-fixed-bottom">
    <div class="container">
      <p class="navbar-text pull-left">&copy <?php echo date('d-m-Y');?> - Jbzeus 
           <a href="#" target="_blank" style="color: #ecf0f1"> Todos los Derechos Reservados </a>
      </p>
   </div>
</div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" ></script>