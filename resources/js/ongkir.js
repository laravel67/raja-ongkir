import "https://code.jquery.com/jquery-3.6.0.min.js";
import "https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js";
$('select[name="province_origin"]').on("change", function () {
    let provinceId = $(this).val();
    if (provinceId) {
        $.ajax({
            url: "/api/province/" + provinceId + "/cities",
            type: "GET",
            dataType: "JSON",
            success: function (data) {
                $('select[name="city_origin"]').empty(); // Kosongkan city_origin sebelum menambahkan opsi baru
                $.each(data, function (key, value) {
                    $('select[name="city_origin"]').append(
                        `<option value="${key}">${value}</option>`
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error("Error fetching cities:", error); // Tambahkan logging error untuk debugging
            },
        });
    } else {
        $('select[name="city_origin"]').empty();
    }
});

$(".select2").select2({
    ajax: {
        url: "/api/cities",
        type: "POST",
        dataType: "JSON",
        delay: 150,
        data: function (params) {
            return {
                _token: $('meta[name="csrf-token"]').attr("content"),
                search: $.trim(params.term),
            };
        },
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        processResults: function (response) {
            return {
                results: response,
            };
        },
        cache: true,
    },
});
