<main class="main-content bgc-grey-100">
  <div id="mainContent">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12"><div id="calendar"></div></div>
      </div>
    </div>
  </div>
</main>
  
<script src="<?php echo base_url();?>node_modules/fullcalendar/main.js"></script>
<script src="<?php echo base_url();?>node_modules/fullcalendar/locales/id.js"></script>
<script>
  const agenda = <?php echo json_encode($agenda);  ?>;
  var arr_events = [];

  agenda.forEach(agendaFunction);

  function agendaFunction(item, index) {
    arr_events[index] = {
      title: item.nama,
      start: item.tanggal
    }
  }

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: 'dayGridMonth',
      locale: 'id',
      selectable: true,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      dateClick: function(info) {
        var clicked_date = info.dateStr;
        window.location.href = "agenda/v/harian/" + clicked_date;
      },
      events: arr_events,
      textColor : 'white'
    });
    calendar.render();
  });

</script>
  
