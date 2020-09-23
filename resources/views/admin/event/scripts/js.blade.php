@include('plugins.fullcalendar')
@push('page-js')
    <script>
        function changeAllDay(el) {
            let chk = $(el).prop('checked');
            $('.row-times input[type="time"]').val('').prop('disabled', chk);
        }

        function showEventForm(date) {
            let txtTitle = '', viewId = '';
            switch (date.view.type) {
                case 'dayGridMonth':
                    viewId = 'month-view';
                    if (date.hasOwnProperty('startStr')) {
                        let start = moment(date.startStr).format('DD/MM/YYYY'),
                            end = moment(date.endStr).subtract(1, 'day').format('DD/MM/YYYY');
                        txtTitle = `${start} - ${end}`;
                    } else {
                        txtTitle = `${moment(date.dateStr).format('DD/MM/YYYY')}`;
                    }
                    break;
                case 'timeGridWeek':
                    viewId = 'week-view';
                    if (date.hasOwnProperty('startStr')) {
                        let start = moment(date.startStr).format('DD/MM/YYYY HH:mm'),
                            end = moment(date.endStr).subtract(1, 'day').format('DD/MM/YYYY HH:mm');
                        txtTitle = `${start} - ${end}`;
                    } else {
                        let allDay = date.allDay ? ' - Dia Inteiro' : moment(date.dateStr).format('HH:mm');
                        txtTitle = `${moment(date.dateStr).format('DD/MM/YYYY')} ${allDay}`;
                    }
                    break;
                case 'timeGridDay':
                    viewId = 'day-view';
                    if (date.hasOwnProperty('startStr')) {
                        let start = moment(date.startStr).format('DD/MM/YYYY HH:mm'),
                            end = moment(date.endStr).format('HH:mm');
                        txtTitle = `${start} - ${end}`;
                    } else {
                        let allDay = date.allDay ? ' - Dia Inteiro' : moment(date.dateStr).format('HH:mm');
                        txtTitle = `${moment(date.dateStr).format('DD/MM/YYYY')} ${allDay}`;
                    }
                    break;
            }

            let templateView = $(`#${viewId}`).clone();
            templateView.attr('id', templateView.attr('id') + '-clone');
            templateView.find('input').each(function () {
                $(this).attr('id', $(this).attr('id') + '-clone');
            });
            templateView.find('label').each(function () {
                $(this).attr('for', $(this).attr('for') + '-clone');
            });
            templateView.find('.label-date-range').text(txtTitle);
            templateView.find('input[type="time"]').val('').prop('disabled', false);
            Swal.fire({
                title: 'Novo evento',
                html: templateView.show(),
                confirmButtonText: 'Salvar',
                showCancelButton: true,
                cancelButtonText: 'Fechar',
                showLoaderOnConfirm: true,
                allowOutsideClick: () => !Swal.isLoading(),
                preConfirm() {
                    let $form = $(`#${templateView.attr('id')}`).find('form'), inputData = {};
                    $form.serializeArray().map(t => inputData[t.name] = t.value);
                    inputData._token = `{{ csrf_token() }}`;
                    inputData.startDate = date.startStr || date.dateStr;
                    inputData.endDate = date.endStr
                        ? moment(date.endStr).subtract(1, 'day').format('YYYY-MM-DD')
                        : date.dateStr;

                    return $.post('event/store', inputData).done(res => res).fail(xhr => {
                        Swal.showValidationMessage(`Request failed: ${xhr.responseJSON.message}`);
                        Swal.hideLoading();
                    });
                }
            }).then(result => {
                if (result.isConfirmed) {
                    __toast.fire({icon: 'success', html: '&nbsp;&nbsp;Evento cadastrado!'});
                }
            });
        }

        $(document).ready(function () {
            let divCalendar = document.getElementById('calendar');
            let calendar = new FullCalendar.Calendar(divCalendar, {
                locale: 'pt-br',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                selectable: true,
                dateClick: date => {
                    showEventForm(date);
                },
                select: date => {
                    showEventForm(date);
                },
            });
            calendar.render();
        });
    </script>
@endpush
