<div class="table-responsive">

<table class="table table-striped table-bordered table-hover">
     <thead>
          <tr>
               <th>Id</th>
               <th>App</th>
               <th>Tipo</th>
               <th>Version</th>
               <th>Url</th>
               <th>Datos</th>
               <th>Mensaje</th>
               <th>Ip</th>
               <th>Navegador</th>
               <th>Fecha</th>
          </tr>
     </thead>
     <tbody>
     	
     <?php
          foreach ($logs as $log) 
          {
               echo '
               <tr>
                    <td>#'.$log['Log__id'].'</td>
                    <td>'.$log['Log__app'].'</td>
                    <td>'.$log['Log__tipo'].'</td>
                    <td>'.$log['Log__version'].'</td>
                    <td>'.$log['Log__url'].'</td>
                    <td><textarea class="muestra-info form-control">'.htmlentities($log['Log__datos']).'</textarea></td>
                    <td><textarea class="muestra-info form-control">'.htmlentities($log['Log__mensaje']).'</textarea></td>
                    <td><a target="_blank" href="http://whatismyipaddress.com/ip/'.$log['Log__ip'].'">'.$log['Log__ip'].'</a></td>
                    <td>'.$log['Log__navegador'].'</td>
                    <td>'.$log['Log__fecha'].'</td>
               </tr>';
               //
               //

          }
     ?>

     </tbody>
</table>

</div>