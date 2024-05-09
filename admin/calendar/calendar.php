<div class="card card-outline card-primary">
<div id='calendar'></div>

</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
  var calendarEl = document.getElementById('calendar');

  var calendar = new FullCalendar.Calendar(calendarEl, {
    initialView: 'dayGridMonth',
    height: 650,
    events: 'http://localhost:8080/sms/classes/fetchEvents.php',
    
    selectable: true,
    select: async function (start, end, allDay) {
      const { value: formValues } = await Swal.fire({
        title: 'Add Event',
        confirmButtonText: 'Submit',
        showCloseButton: true,
		    showCancelButton: true,
        html:
          '<input id="swalEvtTitle" class="swal2-input" placeholder="Enter title">' +
          '<textarea id="swalEvtDesc" class="swal2-input" placeholder="Enter description"></textarea>' +
          '',
        focusConfirm: false,
        preConfirm: () => {
          return [
            document.getElementById('swalEvtTitle').value,
            document.getElementById('swalEvtDesc').value,
            // document.getElementById('swalEvtURL').value
          ]
        }
      });

      if (formValues) {
        // alert(formValues);
        // Add event
        const forms =new FormData()
        forms.append("title", formValues[0])
        forms.append("description", formValues[1])
        // forms.append("url", formValues[2])
        forms.append("start", start.startStr)
        forms.append("end", start.endStr)
        forms.append("type", "addEvent")
        
        console.log(formValues)
        axios.post("http://localhost:8080/sms/classes/eventHandler.php", forms ,{
          headers: {
        'Content-Type': 'multipart/form-data',
      },
        })
.then(response => {
  if (response.status !== 200) {
        throw new Error('Network response was not ok');
    }else{
      Swal.fire("The event has been added successful", '', 'success')
    }
    calendar.refetchEvents();

    console.log(response.data);
})

.catch(error => {
    console.error('Error:', error);
});
}
    
    },

    eventClick: function(info) {
      info.jsEvent.preventDefault();
      
      // change the border color
      info.el.style.borderColor = 'red';
      
      Swal.fire({
        title: info.event.title,
        icon: 'info',
        html:'<p>'+info.event.extendedProps.description+'</p>',
        showCloseButton: true,
        showCancelButton: true,
        showDenyButton: true,
        cancelButtonText: 'Close',
        confirmButtonText: 'Delete',
        denyButtonText: 'Edit',
      }).then((result) => {
        if (result.isConfirmed) {
          // Delete event
          const forms =new FormData()
        forms.append("id", info.event.id)

        forms.append("type", "deleteEvent")
        
        // console.log(formValues)
        axios.post("http://localhost:8080/sms/classes/eventHandler.php", forms ,{
          headers: {
        'Content-Type': 'multipart/form-data',
      },
        })
          
          .then(response => response)
          .then(data => {
       
              Swal.fire('Event deleted successfully!', '', 'success');
              calendar.refetchEvents();

            
            // Refetch events from all sources and rerender
            calendar.refetchEvents();
          })
          .catch(console.error);
        } else if (result.isDenied) {
          // Edit and update event
          Swal.fire({
            title: 'Edit Event',
            html:
              '<input id="swalEvtTitle_edit" class="swal2-input" placeholder="Enter title" value="'+info.event.title+'">' +
              '<textarea id="swalEvtDesc_edit" class="swal2-input" placeholder="Enter description">'+info.event.extendedProps.description+'</textarea>' +
              '',
            focusConfirm: false,
            confirmButtonText: 'Submit',
            preConfirm: () => {
            return [
              document.getElementById('swalEvtTitle_edit').value,
              document.getElementById('swalEvtDesc_edit').value,
              // document.getElementById('swalEvtURL_edit').value
            ]
            }
          }).then((result) => {
            if (result.value) {
              // Edit event
              const forms =new FormData()
        forms.append("title", result.value[0])
        forms.append("description", result.value[1])
        // forms.append("url", result.value[2])
        forms.append("start", info.event.startStr)
        forms.append("end", info.event.endStr)
        forms.append("id", info.event.id)
        forms.append("type", "editEvent")
        
        axios.post("http://localhost:8080/sms/classes/eventHandler.php", forms ,{
          headers: {
        'Content-Type': 'multipart/form-data',
      },
        })
.then(response => {
  if (response.status !== 200) {
        throw new Error('Network response was not ok');
    }else{
      Swal.fire("The event has been edited successful", '', 'success')
    }
    calendar.refetchEvents();

    console.log(response.data);
})

              .catch(console.error);
            }
          });
        } else {
          Swal.close();
        }
      });
    }
  });
  calendar.render();
});
</script>