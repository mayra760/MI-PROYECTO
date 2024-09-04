$(document).ready(function() {
  $("#calendar").fullCalendar({
    header: {
      left: "prev,next today",
      center: "title",
      right: "month,agendaWeek,agendaDay"
    },
    locale: 'es',
    defaultView: "month",
    navLinks: true,
    editable: true,
    eventLimit: true,
    selectable: true,
    selectHelper: false,

    // Nuevo Evento
    select: function(start, end) {
      $("#exampleModal").modal();
      $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY'));
       
      var valorFechaFin = end.format("DD-MM-YYYY");
      var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); // Le resto 1 día
      $('input[name=fecha_fin]').val(F_final);  
    },

    events: function(start, end, timezone, callback) {
      $.ajax({
        url: 'obtenerEventos.php',
        dataType: 'json',
        success: function(data) {
          var events = [];
          $(data).each(function() {
            events.push({
              id: this.id,
              title: this.evento,
              start: this.fecha_inicio,
              end: this.fecha_fin,
              color: this.color_evento
            });
          });
          callback(events);
        }
      });
    },

    // Eliminar Evento
    eventRender: function(event, element) {
      element
        .find(".fc-content")
        .prepend("<span id='btnCerrar' class='closeon material-icons'>&#xe5cd;</span>");

      // Eliminar evento
      element.find(".closeon").on("click", function() {
        var pregunta = confirm("Deseas Borrar este Evento?");
        if (pregunta) {
          $("#calendar").fullCalendar("removeEvents", event.id);

          $.ajax({
            type: "POST",
            url: 'borrarEvento.php',
            data: {id: event.id},
            success: function() {
              $(".alert-danger").show();
              setTimeout(function () {
                $(".alert-danger").slideUp(500);
              }, 3000);
            }
          });
        }
      });
    },

    // Moviendo Evento arrastrar y saltar
    eventDrop: function (event) {
      var idEvento = event.id;
      var start = event.start.format('DD-MM-YYYY');
      var end = event.end ? event.end.format('DD-MM-YYYY') : start;

      $.ajax({
        url: 'arrastrar_soltar_evento.php',
        data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
        type: "POST"
      });
    },

    // Modificar Evento del Calendario
    eventClick: function(event) {
      $('input[name=idEvento]').val(event.id);
      $('input[name=evento]').val(event.title);
      $('input[name=fecha_inicio]').val(event.start.format('DD-MM-YYYY'));
      $('input[name=fecha_fin]').val(event.end ? event.end.format('DD-MM-YYYY') : '');

      $("#modalUpdateEvento").modal();
    }
  });

  // Oculta mensajes de Notificación
  setTimeout(function () {
    $(".alert").slideUp(300);
  }, 3000);
});
