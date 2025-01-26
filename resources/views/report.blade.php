<html>
<head>
    <meta charset="utf-8">
    <title>Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body class="container">
    <form class="mt-3" method="post" action="/api/getReports">
        @csrf
        <div class="input-group d-flex justify-content-center">
            <input required class="me-3" type="date" id="date_from" name="date_from" placeholder="Дата пошуку з">
            <input required class="me-3" type="date" id="date_to" name="date_to" placeholder="Дата пошуку по">
            <input type="submit" class="btn btn-primary" value="Пошук" onclick="event.preventDefault(); sendPost()">
        </div>
    </form>
</body>
</html>

<script>
    function sendPost()
    {
        const data = {
            date_from: $("#date_from").val(),
            date_to: $("#date_to").val()
        };

        if (data.date_from && data.date_to) {
            $.post("http://esfig.meebeeb.org/api/getReports", data).done(function (response) {
                if (response.length !== 0) {
                    createTable(response)
                } else {
                    window.alert('Nothing was found');
                }
            });
        }
    }

    function createTable(data)
    {
        if ($("table").length) {
            $("table").remove();
        }

        let headers = [
            "ПІБ (хто вирішив заявку)",
            "Відключення",
            "Перевірка/здешевлення",
            "Тех.питання",
            "Інше",
            "Усього",
        ];

        const $table = $("<table>")
            .addClass("table table-sm")
            .append(
                $("<thead>")
                    .addClass("table table-dark")
                    .append(
                        $("<tr>")
                            .addClass("text-center")
                            .append(
                                headers.map((header) => $("<th>").text(header))
                            )
                    )
            )

        const $tbody = $("<tbody>");
        $.each(data, (name, reports) => {
            const columns = [0, 0, 0, 0];
            let total = 0;

            $.each(reports, (_, {type, amount}) => {
                if (type >= 1 && type <= 4) {
                    columns[type - 1] += amount;
                    total += amount;
                }
            });

            const $tr = $("<tr>").addClass("text-center");
            $tr.append($("<th>").text(name));
            $.each(columns, (_, value) => {
                $tr.append($("<th>").text(value));
            });
            $tr.append($("<th>").text(total));
            $tbody.append($tr);
        });
        $table.append($tbody);

        $("body").append($table);
    }
</script>
