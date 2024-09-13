<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Full Calendar</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.0/locales/id.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <style>
        .color-sample {
            display: inline-block;
            width: 20px;
            height: 20px;
            margin-right: 5px;
            vertical-align: middle;
            border: 1px solid #ccc;
            border-radius: 50%;
        }
    </style>
</head>

<body>
    <!-- Modal Create Start -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Buat Agenda Rapat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul Rapat</label>
                        <input type="text" class="form-control" id="judul">
                        <span id="judulError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal</label>
                        <input type="text" class="form-control" id="perihal">
                        <span id="perihalError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="tempat" class="form-label">Tempat</label>
                        <select class="form-control form-select" id="tempat">
                            <option value="">Pilih Tempat Rapat</option>
                            <option value="Tempat1">Tempat 1</option>
                            <option value="Tempat2">Tempat 2</option>
                            <option value="Tempat3">Tempat 3</option>
                            <option value="Tempat4">Tempat 4</option>
                        </select>
                        <span id="tempatError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="pemimpin" class="form-label">Pemimpin Rapat</label>
                        <select class="form-control form-select" id="pemimpin">
                            <option value="">Pilih Pegawai</option>
                            <option value="1">Pegawai 1</option>
                            <option value="2">Pegawai 2</option>
                            <option value="3">Pegawai 3</option>
                            <option value="4">Pegawai 4</option>
                        </select>
                        <span id="pemimpinError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="start-time" class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-control" id="start-time">
                        <span id="startTimeError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="end-time" class="form-label">Waktu Selesai</label>
                        <input type="time" class="form-control" id="end-time">
                        <span id="endTimeError" class="text-danger"></span>
                    </div>
                    <label for="color-selection">Pilih Warna Label Rapat</label>
                    <div class="mb-3" id="color-selection">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="colorOptions" id="colorRed"
                                value="#d50000">
                            <label class="form-check-label" for="colorRed">
                                <span class="color-sample" style="background-color: #d50000;"></span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="colorOptions" id="colorBlue"
                                value="#039ae5">
                            <label class="form-check-label" for="colorBlue">
                                <span class="color-sample" style="background-color: #039ae5;"></span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="colorOptions" id="colorGreen"
                                value="#33b679">
                            <label class="form-check-label" for="colorGreen">
                                <span class="color-sample" style="background-color: #33b679;"></span>
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveBtn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Create End -->

    {{-- Modal Edit Start --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Rapat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Judul Rapat</label>
                        <input type="text" class="form-control" id="editTitle">
                        <span id="titleError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="start-time" class="form-label">Waktu Mulai</label>
                        <input type="time" class="form-control" id="editStartTime">
                        <span id="startTimeError" class="text-danger"></span>
                    </div>
                    <div class="mb-3">
                        <label for="end-time" class="form-label">Waktu Selesai</label>
                        <input type="time" class="form-control" id="editEndTime">
                        <span id="endTimeError" class="text-danger"></span>
                    </div>
                    <label for="color-selection">Pilih Warna Label Rapat</label>
                    <div class="mb-3" id="color-selection">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="editColorOptions" id="editColorRed"
                                value="#d50000">
                            <label class="form-check-label" for="colorRed">
                                <span class="color-sample" style="background-color: #d50000;"></span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="editColorOptions"
                                id="editColorBlue" value="#039ae5">
                            <label class="form-check-label" for="colorBlue">
                                <span class="color-sample" style="background-color: #039ae5;"></span>
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="editColorOptions"
                                id="editColorGreen" value="#33b679">
                            <label class="form-check-label" for="colorGreen">
                                <span class="color-sample" style="background-color: #33b679;"></span>
                            </label>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger" id="eventDeleteBtn">Hapus Rapat</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="updateBtn" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Edit End --}}

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-center mt-5">Daftar Rapat</h3>
                <div class="col-md-11 offset-1 mt-5 mb-5">

                    <div id="calendar">

                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var agenda = @json($events);

            $(`#calendar`).fullCalendar({
                header: {
                    left: 'prev,next',
                    center: 'title',
                    // right: 'month,agendaWeek,agendaDay'
                    right: 'today'
                },
                events: agenda,
                selectable: true,
                selectHelper: true,
                select: function(start, end, allDay) {
                    // prevent user to select past date
                    const todayDate = moment().format('YYYY-MM-DD');
                    const dateToCheck = moment(start).format('YYYY-MM-DD');
                    if (dateToCheck < todayDate) {
                        return;
                    }

                    // display modal to create event
                    $('#bookingModal').modal('show');

                    $('#saveBtn').click(function() {
                        const judul = $('#judul').val();
                        const perihal = $('#perihal').val();
                        const tempat = $('#tempat').val();
                        const pemimpinRapat = $('#pemimpin').val();
                        const startTime = $('#start-time').val();
                        const endTime = $('#end-time').val();
                        const color = $('input[name=colorOptions]:checked').val();
                        const start_date = moment(start).format('YYYY-MM-DD');
                        const startDateTime = `${start_date} ${startTime}`;
                        const endDateTime = `${start_date} ${endTime}`;

                        if (!judul.trim()) {
                            $('#judulError').text('judul is required');
                            return;
                        }

                        if (!startTime) {
                            $('#startTimeError').text('Start time is required');
                            return;
                        }

                        if (!endTime) {
                            $('#endTimeError').text('End time is required');
                            return;
                        }

                        $.ajax({
                            url: '{{ route('rapat.store') }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                judul: judul,
                                perihal: perihal,
                                tempat: tempat,
                                pemimpinRapat: pemimpinRapat,
                                waktuMulai: startDateTime,
                                waktuSelesai: endDateTime,
                                warnaLabel: color,
                            },
                            success: function(response) {
                                $('#bookingModal').modal('hide');
                                $('#calendar').fullCalendar('renderEvent', {
                                    'id': response.id,
                                    'title': response.title,
                                    'start': response.start,
                                    'end': response.end,
                                    'color': response.color,
                                });

                                // Clear form fields
                                $('#title').val('');
                                $('#start-time').val('');
                                $('#end-time').val('');
                                $('input[name=colorOptions]').prop('checked',
                                    false);
                            },
                            error: function(error) {
                                if (error.responseJSON.errors) {
                                    $('#titleError').text(error.responseJSON.errors
                                        .title);
                                }
                            }
                        });
                    });
                },

                // enable drag and drop agenda
                editable: true,

                // Callback function for when an event is dragged and dropped
                eventDrop: function(event) {
                    const id = event.id;

                    // Get the new date from the event drop
                    const newStartDate = event.start.format('YYYY-MM-DD');
                    const newEndDate = event.end.format('YYYY-MM-DD');

                    // Combine new date with original time
                    const newStartDateTime = `${newStartDate} ${event.startTime}`;
                    const newEndDateTime = `${newEndDate} ${event.endTime}`;

                    // Perform AJAX request to update the event
                    $.ajax({
                        url: '{{ route('rapat.update', '') }}' + '/' + id,
                        type: 'PATCH',
                        dataType: 'json',
                        data: {
                            start_date: newStartDateTime,
                            end_date: newEndDateTime
                        },
                        success: function(response) {
                            swal("Berhasil", "Rapat berhasil diperbarui", "success");
                        },
                        error: function(error) {
                            if (error.responseJSON.errors) {
                                $('#titleError').text(error.responseJSON.errors
                                    .title);
                            }
                        }
                    });
                },

                eventClick: function(event) {
                    const id = event.id;

                    $('#editTitle').val(event.title);
                    $('#editStartTime').val(moment(event.start).format('HH:mm'));
                    $('#editEndTime').val(moment(event.end).format('HH:mm'));
                    $(`input[name=editColorOptions][value="${event.color}"]`).prop('checked', true);
                    $('#editModal').modal('show');

                    $('#eventDeleteBtn').click(function() {
                        if (confirm('Are you sure you want to delete this event?')) {
                            $.ajax({
                                url: '{{ route('rapat.destroy', '') }}' + '/' + id,
                                type: 'DELETE',
                                dataType: 'json',
                                success: function(response) {
                                    $('#editModal').modal('hide');
                                    $('#calendar').fullCalendar('removeEvents',
                                        response.id);
                                    swal("Berhasil", "Rapat berhasil dihapus",
                                        "success");
                                },
                                error: function(error) {
                                    swal("Error", "Failed to delete event",
                                        "error");
                                }
                            });
                        }
                    });

                    $('#updateBtn').click(function() {
                        const title = $('#editTitle').val();
                        const color = $('input[name=editColorOptions]:checked').val();
                        const startTime = $('#editStartTime').val();
                        const endTime = $('#editEndTime').val();
                        const start_date = moment(event.start).format('YYYY-MM-DD');
                        const startDateTime = `${start_date} ${startTime}`;
                        const endDateTime = `${start_date} ${endTime}`;

                        if (!title.trim()) {
                            $('#titleError').text('Title is required');
                            return;
                        }

                        if (!startTime) {
                            $('#startTimeError').text('Start time is required');
                            return;
                        }

                        if (!endTime) {
                            $('#endTimeError').text('End time is required');
                            return;
                        }

                        $.ajax({
                            url: '{{ route('rapat.update', '') }}' + '/' + id,
                            type: 'PATCH',
                            dataType: 'json',
                            data: {
                                title: title,
                                start_date: startDateTime,
                                end_date: endDateTime,
                                color: color,
                            },
                            success: function(response) {
                                $('#editModal').modal('hide');

                                // Update the event in the calendar
                                let updatedEvent = $('#calendar').fullCalendar(
                                    'clientEvents', id)[0];
                                updatedEvent.title = response.title;
                                updatedEvent.start = moment(response.start);
                                updatedEvent.end = moment(response.end);
                                updatedEvent.color = response.color;
                                $('#calendar').fullCalendar('updateEvent',
                                    updatedEvent);

                                // Clear form fields
                                $('#editTitle').val('');
                                $('#editStartTime').val('');
                                $('#editEndTime').val('');
                                $('input[name=editColorOptions]').prop('checked',
                                    false);
                            },
                            error: function(error) {
                                if (error.responseJSON.errors) {
                                    $('#titleError').text(error.responseJSON.errors
                                        .title);
                                }
                            }
                        });
                    });
                },

                selectAllow: function(event) {
                    return moment(event.start).utcOffset(false).isSame(moment(event.end).subtract(1,
                        'second').utcOffset(false), 'day');
                },


                // Customize the day names and the month names
                dayNamesShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
                dayNames: ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'],
                buttonText: {
                    today: 'Hari ini',
                    month: 'Bulan',
                    week: 'Minggu',
                    day: 'Hari'
                },

                // Customize the date formats
                views: {
                    month: {
                        titleFormat: 'MMMM YYYY', // Full month name and year
                        columnFormat: 'ddd' // Short day name and day/month
                    },
                    week: {
                        titleFormat: 'D MMMM YYYY', // Day Month Year for the entire week view title
                        columnFormat: 'ddd D/M' // Short day name and day/month
                    },
                    day: {
                        titleFormat: 'dddd, D MMMM YYYY', // Full day name, day, full month name, and year
                        columnFormat: 'dddd D/M' // Full day name and day/month
                    }
                },

                // Customize the time formats
                timeFormat: 'H:mm', // Time format without AM/PM (24-hour format)
                slotLabelFormat: 'H:mm', // Time format for the left-side labels (24-hour format)
                eventTimeFormat: { // For events' time display
                    hour: '2-digit',
                    minute: '2-digit',
                    meridiem: false, // Disable AM/PM
                    hour12: false // Use 24-hour format
                },

                // Callback function for rendering each event
                eventAfterRender: function(event, element) {
                    // This callback function is executed after each event is rendered

                    // Convert the start time of the event to ISO 8601 format and extract just the time part (HH:mm)
                    // For example, this will convert 2024-09-04T10:33:05.000Z to 10:33
                    var startTime = event.start.toISOString().split('T')[1].substring(0, 5);

                    // Find the `.fc-time` element within the current event element and update its text with the formatted time
                    element.find('.fc-time').text(startTime);
                }
            });

            $('#bookingModal').on('hidden.bs.modal', function() {
                $('#saveBtn').unbind();
            });

            $('.fc-event').css('font-size', '14px');
            $('.fc-event').css('border-radius', '5px');
        });
    </script>
</body>

</html>
