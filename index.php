<?php 
include "include/header.php";
?>
<div class="main">
  <div class="main-inner">
    <div class="container" id="contenedor">

    </div>
  </div>
</div>
<div id="vistas" style="display:none">
  <?php
  include "include/dashboard.php";
  include "include/formulario_equipo.php";
  ?>
  <div id="comentarios">
    <li class="from_user {POSICION}"> <a href="#" class="avatar"><img src="{IMAGEN}"></a>
      <div class="message_wrap"> <span class="arrow"></span>
        <div class="info"> <a class="name">{NOMBRE}</a> <span class="time">{TIEMPO}</span>
        </div>
        <div class="text">
          {COMENTARIO}
        </div>
      </div>
    </li>
  </div>
</div>
<?php 
include "include/modals.php";
include "include/footer.php";
?>
