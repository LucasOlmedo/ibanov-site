@include('plugins.fullcalendar')
@include('plugins.custom-loadTable')
@push('page-js')
    <script>
        let $calendar = null;
        let _tableEvent;

        function changeAllDay(el) {
            let chk = $(el).prop('checked');
            $('.row-times input[type="time"]').val('').prop('disabled', chk);
        }

        function showEventForm(date) {
            let txtTitle = '', viewId = '', input_allDay = false;
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
                            end = date.allDay ? moment(date.endStr).subtract(1, 'day').format('DD/MM/YYYY HH:mm')
                                : moment(date.endStr).format('DD/MM/YYYY HH:mm');
                        txtTitle = `${start} - ${end}`;
                    } else {
                        let allDay = date.allDay ? ' - Dia Inteiro' : moment(date.dateStr).format('HH:mm');
                        txtTitle = `${moment(date.dateStr).format('DD/MM/YYYY')} ${allDay}`;
                    }
                    input_allDay = date.allDay;
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
                    input_allDay = date.allDay;
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
                title: 'Novo Evento',
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
                        ? (date.allDay ?
                            moment(date.endStr).subtract(1, 'day').format('YYYY-MM-DD')
                            : date.endStr)
                        : date.dateStr;
                    if (input_allDay) {
                        inputData['all-day'] = input_allDay;
                    }

                    return $.post('event/store', inputData).done(res => res).fail(xhr => {
                        Swal.showValidationMessage(`Request failed: ${xhr.responseJSON.message}`);
                        Swal.hideLoading();
                    });
                }
            }).then(result => {
                if (result.isConfirmed) {
                    __toast.fire({icon: 'success', html: '&nbsp;&nbsp;Evento cadastrado!'});
                    $calendar.refetchEvents();
                }
            });
        }

        function dragEvent(event) {
            let inputData = {}, dragEvent = event.event;
            inputData._token = `{{ csrf_token() }}`;
            inputData.title = dragEvent.title;
            inputData.startDate = dragEvent.startStr || moment(dragEvent.start).format('YYYY-MM-DD HH:mm:ss');
            inputData.endDate = dragEvent.endStr
                ? (dragEvent.allDay ?
                    moment(dragEvent.endStr).subtract(1, 'day').format('YYYY-MM-DD')
                    : dragEvent.endStr)
                : (dragEvent.end
                    ? moment(dragEvent.end).format('YYYY-MM-DD HH:mm:ss') : inputData.startDate);

            if (!inputData.endDate) {
                inputData.endDate = inputData.startDate;
            }

            if (dragEvent.allDay) {
                inputData['all-day'] = dragEvent.allDay;
            }
            $.post(`event/drag/${dragEvent.id}`, inputData)
                .done(res => {
                    __toast.fire({icon: 'success', html: '&nbsp;&nbsp; Evento atualizado!'});
                    $calendar.refetchEvents();
                })
                .fail(xhr => {
                    __toast.fire({icon: 'error', html: '&nbsp;&nbsp; Erro ao atualizar evento!'});
                    $calendar.refetchEvents();
                });
        }

        function loadTableEvent() {
            return $('.table-event').loadTable({
                url: `{{ route('admin.event.get-data') }}`,
                columns: [
                    {data: ['title'], title: 'Título'},
                    {data: ['user'], title: 'Criado por'},
                    {
                        data: ['start'], title: 'Início', render: (title, data) => {
                            let date = data.shift();
                            return moment(date).format('DD/MM/YYYY HH:mm');
                        }
                    },
                    {
                        data: ['end'], title: 'Fim', render: (title, data) => {
                            let date = data.shift();
                            return moment(date).format('DD/MM/YYYY HH:mm');
                        }
                    },
                    {
                        data: ['id'], title: 'Opções', render: (title, data, item) => {
                            if (__authUser.sysAdmin) {
                                let id = data.shift();
                                return '<div class="table-data-feature">' +
                                    '<button onclick="updateEvent(' + id + ')" class="item" data-toggle="tooltip" ' +
                                    'data-placement="top" title="Alterar">' +
                                    '<i class="zmdi zmdi-edit text-warning"></i>' +
                                    '</button>' +
                                    '<button onclick="deleteEvent(' + id + ')" class="item" data-toggle="tooltip" ' +
                                    'data-placement="top" title="Remover">' +
                                    '<i class="zmdi zmdi-delete text-danger"></i>' +
                                    '</button>' +
                                    '</div>';
                            }
                            return '';
                        },
                    },
                ],
                afterInit: () => {
                    $('[data-toggle="tooltip"]').tooltip();
                },
            });
        }

        function updateEvent(id) {
            let $form = $('#form-edit-event'), $loadForm = $('#loader-edit');
            $('#modal-edit-event').modal('show');
            $.ajax({
                url: `/admin/event/get/${id}`,
                type: 'get',
                beforeSend: () => {
                    $form.find('input').prop('readonly', true);
                    $form.find('button').prop('disabled', true);
                    $loadForm.css('display', 'flex');
                    $form.trigger('reset');
                },
                success: response => {
                    $form.find('input').prop('readonly', false);
                    $form.find('button').prop('disabled', false);
                    if (response != null) {
                        for (let k in response) {
                            $form.find(`[name="${k}"]`).val(response[k]);
                        }
                    }
                    $loadForm.css('display', 'none');
                },
                error: err => {
                    $form.find('input').prop('readonly', false);
                    $form.find('button').prop('disabled', false);
                    $loadForm.css('display', 'none');
                    let errors = err.responseJSON.errors, message = ' ';
                    if (errors) {
                        for (let er in errors) {
                            message = errors[er].join('<br>');
                        }
                    } else {
                        message = err.responseJSON.message;
                    }
                    __toast.fire({icon: 'error', title: ' ', html: `&nbsp;&nbsp;${message}`});
                },
            });
        }

        function deleteEvent(id) {
            Swal.fire({
                icon: 'warning',
                text: 'Tem certeza que deseja remover o evento?',
                showCancelButton: true,
                confirmButtonText: 'Remover',
                showLoaderOnConfirm: true,
                cancelButtonText: 'Fechar',
                preConfirm: () => {
                    return fetch(`/admin/event/delete/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                        },
                    }).then(response => {
                        if (!response.ok) {
                            throw new Error(response.statusText)
                        }
                        return response.json();
                    }).catch(() => {
                        Swal.showValidationMessage('Ocorreu um erro ao remover o evento!')
                    });
                },
                allowOutsideClick: () => !Swal.isLoading(),
            }).then((result) => {
                if (result.value) {
                    __toast.fire({
                        icon: 'success',
                        title: `&nbsp;&nbsp;Evento removido!`
                    });
                    _tableEvent.loadTable('reload');
                }
            })
        }

        $(document).ready(function () {
            let divCalendar = document.getElementById('calendar'), $formEdit = $('#form-edit-event');
            $calendar = new FullCalendar.Calendar(divCalendar, {
                timeZone: 'America/Sao_Paulo',
                locale: 'pt-br',
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                selectable: true,
                dayMaxEvents: true,
                editable: true,
                startEditable: true,
                droppable: true,
                dateClick: date => {
                    showEventForm(date);
                },
                select: date => {
                    showEventForm(date);
                },
                eventChange: event => {
                    dragEvent(event);
                },
                events: {
                    url: '/admin/event/get-data',
                },
            });
            $calendar.render();

            $formEdit.on('submit', function (e) {
                e.preventDefault();
                let id = $formEdit.find('input[name="agendaID"]').val(), $loadForm = $('#loader-edit');
                $.ajax({
                    url: `/admin/event/update/${id}`,
                    data: $formEdit.serialize(),
                    type: 'PUT',
                    beforeSend: () => {
                        $formEdit.find('input').prop('readonly', true);
                        $formEdit.find('button').prop('disabled', true);
                        $loadForm.css('display', 'flex');
                    },
                    success: response => {
                        $formEdit.find('input').prop('readonly', false);
                        $formEdit.find('button').prop('disabled', false);
                        $loadForm.css('display', 'none');
                        $formEdit.trigger('reset');
                        $('#modal-edit-event').modal('hide');
                        __toast.fire({icon: 'success', html: `&nbsp;&nbsp;${response.message}`});
                        _tableEvent.loadTable('reload');
                    },
                    error: err => {
                        $formEdit.find('input').prop('readonly', false);
                        $formEdit.find('button').prop('disabled', false);
                        $loadForm.css('display', 'none');
                        let errors = err.responseJSON.errors, message = ' ';
                        if (errors) {
                            for (let er in errors) {
                                message = errors[er].join('<br>');
                            }
                        } else {
                            message = err.responseJSON.message;
                        }
                        __toast.fire({icon: 'error', title: ' ', html: `&nbsp;&nbsp;${message}`});
                    },
                });
            });

            _tableEvent = loadTableEvent();
        });
    </script>
@endpush
