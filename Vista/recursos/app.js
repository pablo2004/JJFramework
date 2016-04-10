

$(document).on('click', ".boton-ajax", function(e){
     
     var boton = $(this);
     var formulario = $(boton.data('formulario'));

     $.ajax({
          'type': formulario.attr('method'),
          'url': formulario.attr('url'),
          'data': formulario.serialize(),
          'success': function(mensajes){
               mensajes = $.parseJSON(mensajes);
               formulario.find('.forma-mensaje').hide();

               if(mensajes.length > 0)
               {
                    for(var indice in mensajes)
                    {
                          mensaje = mensajes[indice];
                          mensajeCaja = $('#'+mensaje['nombre']+'Mensaje');
                          mensajeCaja.html(mensaje['mensaje']);
                          mensajeCaja.show();
                    }
               }
               else
               {
                     formulario[0].reset();
                     var alerta = $('<div />', {'class': 'alerta'});
                     var botonCerrar = $('<button />', {'class': 'boton boton-rojo', 'type': 'button', 'text': 'Cerrar'});
                     botonCerrar.on("click", function(e){ 
                          alerta.hide();
                     });
               	     
                     alerta.append('<div class="alerta-titulo">Correcto</div>');
                     alerta.append('<div class="alerta-mensaje">Registro Guardado.</div>');
                     alerta.append(botonCerrar);
                     alerta.appendTo($('body'));
                     alerta.show();
               }
          }
     });

});

$(document).on('click', ".borrar-ajax", function(e){
     
     e.preventDefault();
     var enlace = $(this);
    
     var alerta = $('<div />', {'class': 'alerta'});
     var botonCancelar = $('<button />', {'class': 'boton', 'type': 'button', 'text': 'Cancelar'});
     botonCancelar.on("click", function(e){ 
          alerta.hide();
     });

     var botonBorrar = $('<button />', {'class': 'boton boton-rojo', 'type': 'button', 'text': 'Confirmar'});
     botonBorrar.on("click", function(e){ 
          $.ajax({
               'url': enlace.attr('href'),
               'type': 'GET',
               'success': function(mensajes){
                    location.reload();
               }
          });
     });
                     
     alerta.append('<div class="alerta-titulo">Confirmar</div>');
     alerta.append('<div class="alerta-mensaje">&iquest;Deseas borrar el registro?</div>');
     alerta.append(botonBorrar);
     alerta.append(botonCancelar);
     alerta.appendTo($('body'));
     alerta.show();
     
});