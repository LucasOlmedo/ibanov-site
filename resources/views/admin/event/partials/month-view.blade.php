<div id="month-view" class="row mb-0" style="display: none;">
    <div class="col-12">
        <br>
        <h4 class="label-date-range"></h4>
        <hr>
        <form style="text-align: start;">
            <div class="form-group">
                <label for="evt-title-month" class="control-label mb-1">Título *</label>
                <input id="evt-title-month" name="evt-title" type="text" class="form-control">
            </div>
            <div class="row mb-0 row-times">
                <div class="col-6">
                    <div class="form-group">
                        <label for="evt-start-month" class="control-label mb-1">Início *</label>
                        <input id="evt-start-month" name="evt-start" type="time" class="form-control">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="evt-end-month" class="control-label mb-1">Término *</label>
                        <input id="evt-end-month" name="evt-end" type="time" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="custom-control custom-checkbox mr-sm-2">
                    <input type="checkbox" onchange="changeAllDay(this)" class="custom-control-input"
                           id="all-day-month" name="all-day">
                    <label class="custom-control-label" for="all-day-month">Dia inteiro</label>
                </div>
            </div>
            <div class="form-group mb-0">
                <label for="evt-desc-month" class="control-label mb-1">Descrição *</label>
                <textarea name="evt-desc" id="evt-desc-month" rows="4" class="form-control"></textarea>
            </div>
        </form>
    </div>
</div>
