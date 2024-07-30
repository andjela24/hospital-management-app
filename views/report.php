

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Ukupan broj pacijenata</h4>
                <div class="row">
                    <div class="col-md-6">
                        <label for="total-patients-from" class="form-label">Od</label>
                        <input type="date"
                               name="total-patients-from"
                               class="form-control total-patients-input-helper"
                               id="total-patients-from">
                    </div>
                    <div class="col-md-6">
                        <label for="total-patients-to" class="form-label">Do</label>
                        <input type="date"
                               name="total-patients-to"
                               class="form-control total-patients-input-helper"
                               id="total-patients-to">
                    </div>
                </div>
            </div>
            <div class=" card-body">
                <p>Ukupan broj pacijenata za odabrani period: <span id="total-patients"></span></p>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h4>Ukupan broj recepata</h4>
                <div class="row">
                    <div class="col-md-6">
                        <label for="total-prescription-from" class="form-label">Od</label>
                        <input type="date"
                               name="total-prescription-from"
                               class="form-control total-prescription-input-helper"
                               id="total-prescription-from">
                    </div>
                    <div class="col-md-6">
                        <label for="total-prescription-to" class="form-label">Do</label>
                        <input type="date"
                               name="total-prescription-to"
                               class="form-control total-prescription-input-helper"
                               id="total-prescription-to">
                    </div>
                </div>
            </div>
            <div class=" card-body">
                <p>Ukupan broj izdatih recepata za odabrani period: <span id="total-prescription"></span></p>
            </div>
        </div>
    </div>
</div>
<div  class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Aktivni pacijenti</h4>
            </div>
            <div class="card-body">
                <table class="table" id="active-patients-table">
                    <thead>
                    <tr>
                        <th>Ime</th>
                        <th>Prezime</th>
                        <th>Broj telefona</th>
                        <th>Datum rođenja</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        getTotalPatientsPerPeriod($("#total-patients-from").val(), $("#total-patients-to").val());
        getActivePatients();
        getTotalPrescriptionPerPeriod();

        $(".total-patients-input-helper").change(function () {
            getTotalPatientsPerPeriod($("#total-patients-from").val(), $("#total-patients-to").val());
        });
        $(".total-prescription-input-helper").change(function () {
            getTotalPrescriptionPerPeriod($("#total-prescription-from").val(), $("#total-prescription-to").val());
        });
    });

    function getTotalPatientsPerPeriod(dateFrom, dateTo) {
        if (!dateFrom) {
            dateFrom = new Date();
            dateFrom.setMonth(dateFrom.getMonth() - 6);
            dateFrom = new Date(dateFrom).toISOString().split('T')[0];

            $("#total-patients-from").val(dateFrom);
        }

        if (!dateTo) {
            dateTo = new Date();
            dateTo = new Date(dateTo).toISOString().split('T')[0];

            $("#total-patients-to").val(dateTo);
        }

        let url = `/reportTotalPatientsPerPeriod?dateFrom=${dateFrom}&dateTo=${dateTo}`;

        $.getJSON(url, function (result) {
            console.log(result);
            if (result.length > 0) {
                let totalPatients = result[0].total_patients;
                $("#total-patients").text(totalPatients);
            } else {
                $("#total-patients").text("Nema rezultata");
            }
        });
    }

    function getActivePatients() {
        let url = `/reportActivePatients`;

        $.getJSON(url, function (result) {
            console.log(result);
            if (result.length > 0) {
                $.each(result, function (index, patient) {
                    $("#active-patients-table tbody").append(
                        "<tr>" +
                        "<td>" + patient.first_name + "</td>" +
                        "<td>" + patient.last_name + "</td>" +
                        "<td>" + patient.phone_number + "</td>" +
                        "<td>" + patient.date_of_birth + "</td>" +
                        "</tr>"
                    );
                });
            } else {
                $("#active-patients-table tbody").html("<tr><td colspan='4'>Nema aktivnih pacijenata</td></tr>");
            }
        });
    }

    function getTotalPrescriptionPerPeriod(dateFrom, dateTo) {
        if (!dateFrom) {
            dateFrom = new Date();
            dateFrom.setMonth(dateFrom.getMonth() - 6);
            dateFrom = new Date(dateFrom).toISOString().split('T')[0];

            $("#total-prescription-from").val(dateFrom);
        }

        if (!dateTo) {
            dateTo = new Date();
            dateTo = new Date(dateTo).toISOString().split('T')[0];

            $("#total-prescription-to").val(dateTo);
        }

        let url = `/reportTotalPrescriptionPerPeriod?dateFrom=${dateFrom}&dateTo=${dateTo}`;

        $.getJSON(url, function (result) {
            console.log(result);
            if (result.length > 0) {
                let totalPrescription = result[0].total_prescriptions;
                $("#total-prescription").text(totalPrescription);
            } else {
                $("#total-prescription").text("Nema rezultata");
            }
        });
    }
</script>

